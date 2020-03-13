<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CoronaVirusData extends CI_Controller 
{
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

        $this->load->view('coronavirus',$result);
    }
}