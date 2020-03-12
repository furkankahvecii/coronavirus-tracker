<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CoronaVirusData extends CI_Controller 
{
    public function index()
    {
        $url = "https://raw.githubusercontent.com/CSSEGISandData/COVID-19/master/csse_covid_19_data/csse_covid_19_time_series/time_series_19-covid-Confirmed.csv";
        $url2 = "https://raw.githubusercontent.com/CSSEGISandData/COVID-19/master/csse_covid_19_data/csse_covid_19_time_series/time_series_19-covid-Deaths.csv";
        $url3 = "https://raw.githubusercontent.com/CSSEGISandData/COVID-19/master/csse_covid_19_data/csse_covid_19_time_series/time_series_19-covid-Recovered.csv";

        $contents = file_get_contents($url);
        $contents2 = file_get_contents($url2);
        $contents3 = file_get_contents($url3);
        if ($contents === false) {
            $result['error'] = true;
            $this->load->view('coronavirus',$result);
        }
        else{
            $csvConfirmed = array_map('str_getcsv', explode("\n", $contents));
            $csvDeaths = array_map('str_getcsv', explode("\n", $contents2));
            $csvRecovered = array_map('str_getcsv', explode("\n", $contents3));
            $info = $csvConfirmed[0];
            unset($csvConfirmed[0]);
            unset($csvDeaths[0]);
            unset($csvRecovered[0]);
            $sonuc['results'] = array();
            $sonuc['TOTAL_CASE_REPORTED'] = 0;
            $sonuc['TOTAL_DEATHS_REPORTED'] = 0;
            $sonuc['TOTAL_RECOVERED_REPORTED'] = 0;
            $sonuc['TOTAL_CASE_REPORTED_LASTDAY'] = 0;


            foreach($csvConfirmed as $row => $innerArray){
                if(count($innerArray) == count($info)){
                    $sonuc['results'][] = array(
                        "STATE" => $innerArray[0],
                        "COUNTRY" => $innerArray[1],
                        "TOTAL_CASE" => $innerArray[count($innerArray)-1] != NULL && $innerArray[count($innerArray)-1] != 0  ? $innerArray[count($innerArray)-1] :$innerArray[count($innerArray)-2],
                        "TOTAL_CASE_LASTDAY" => $innerArray[count($innerArray)-2]
                    );
                    $sonuc['TOTAL_CASE_REPORTED'] += $innerArray[count($innerArray)-1] != NULL ? $innerArray[count($innerArray)-1]:0;
                    $sonuc['TOTAL_CASE_REPORTED_LASTDAY'] += $innerArray[count($innerArray)-2]!= NULL ? $innerArray[count($innerArray)-2]:0;
                }  
            }

          $i = 0;
            foreach($csvDeaths as $row => $innerArray){
                if(count($innerArray) == count($info)){
                    $sonuc['results'][$i++]["TOTAL_DEATH"] = $innerArray[count($innerArray)-1] != NULL ? $innerArray[count($innerArray)-1] :$innerArray[count($innerArray)-2];
                    $sonuc["TOTAL_DEATHS_REPORTED"] += $innerArray[count($innerArray)-1] != NULL ? $innerArray[count($innerArray)-1]:0;
                }  
            }

            $i = 0;
            foreach($csvRecovered as $row => $innerArray){
                if(count($innerArray) == count($info)){
                    $sonuc['results'][$i++]["TOTAL_RECOVERED"] = $innerArray[count($innerArray)-1] != NULL ? $innerArray[count($innerArray)-1] :$innerArray[count($innerArray)-2];
                    $sonuc["TOTAL_RECOVERED_REPORTED"] += $innerArray[count($innerArray)-1] != NULL ? $innerArray[count($innerArray)-1]:0;
                }  
            }

          //  echo "<pre>"; print_r($sonuc); echo "</pre>";

          $this->load->view('coronavirus',$sonuc);
        }
    }
}


    