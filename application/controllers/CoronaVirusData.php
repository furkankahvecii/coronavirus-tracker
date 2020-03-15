<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CoronaVirusData extends CI_Controller {

	private $url = "https://raw.githubusercontent.com/CSSEGISandData/COVID-19/master/csse_covid_19_data/csse_covid_19_time_series/time_series_19-covid-";
    private $csvColumns =  array("Confirmed","Deaths","Recovered");

    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $urlCsvColumns;

        foreach($this->csvColumns as $each){
            $sonuc = $this->url.$each;
            $urlCsvColumns[] = array($sonuc);
        }
        
        $instance = new CoronaVirus($urlCsvColumns,$this->csvColumns);
        $instance->fetchData();
        $result = $instance->processCsv();
        $result['maps'] = $this->mapData($result['results']);
        usort($result['results'], array($this,'cmp')); // Descending sorting with usort by cmp function
        $this->load->view('coronavirus',$result);
    }

    public function mapData($result){
 
        $res  = array();
        foreach($result as $vals){
            if(array_key_exists($vals['COUNTRY'],$res)){
                $res[$vals['COUNTRY']]['TOTAL_CASE']           += $vals['TOTAL_CASE'];
                $res[$vals['COUNTRY']]['TOTAL_CASE_LASTDAY']   += $vals['TOTAL_CASE_LASTDAY'];
                $res[$vals['COUNTRY']]['TOTAL_DEATH']          += $vals['TOTAL_DEATH'];
                $res[$vals['COUNTRY']]['TOTAL_RECOVERED']      += $vals['TOTAL_RECOVERED'];
            }
            else{
                unset($vals['STATE']);
                $res[$vals['COUNTRY']]  = $vals;
            }
        }
        return $res;
    }

    function cmp($a, $b)
    {
        if ($a['TOTAL_CASE'] == $b['TOTAL_CASE']) {
            return 0;
        }
        return ($a['TOTAL_CASE'] < $b['TOTAL_CASE']) ? 1 : -1; // return ($a['TOTAL_CASE'] < $b['TOTAL_CASE']) ? -1 : 1; -> ASC
    }
}
