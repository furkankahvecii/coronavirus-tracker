<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CoronaVirusData extends CI_Controller 
{
    public function index()
    {
        $url = "https://raw.githubusercontent.com/CSSEGISandData/COVID-19/master/csse_covid_19_data/csse_covid_19_time_series/time_series_19-covid-Confirmed.csv";
        $contents = file_get_contents($url);
        if ($contents === false) {
            $result['error'] = true;
            $this->load->view('coronavirus',$result);
        }
        else{
            $csv = array_map('str_getcsv', explode("\n", $contents));
            $info = $csv[0];
            unset($csv[0]);
            $sonuc['results'] = array();
            $sonuc['TOTAL_CASE_REPORTED'] = 0;
            $sonuc['TOTAL_CASE_REPORTED_LASTDAY'] = 0;

    
            foreach($csv as $row => $innerArray){
                if(count($innerArray) == count($info)){
                    $sonuc['results'][] = array(
                        "STATE" => $innerArray[0],
                        "COUNTRY" => $innerArray[1],
                        "TOTAL_CASE" => $innerArray[count($innerArray)-1],
                        "TOTAL_CASE_LASTDAY" => $innerArray[count($innerArray)-2]
                    );
                    $sonuc['TOTAL_CASE_REPORTED'] += $innerArray[count($innerArray)-1] != NULL ? $innerArray[count($innerArray)-1]:0;
                    $sonuc['TOTAL_CASE_REPORTED_LASTDAY'] += $innerArray[count($innerArray)-2]!= NULL ? $innerArray[count($innerArray)-2]:0;
                }  
            }
            $this->load->view('coronavirus',$sonuc);
        }
    }
}