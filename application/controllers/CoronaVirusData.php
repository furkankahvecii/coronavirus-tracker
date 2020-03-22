<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CoronaVirusData extends CI_Controller 
{
    private $url = "https://coronavirus-19-api.herokuapp.com/countries";

    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $data['RESULT_DATA'] = array();
        $data['TOTAL_CASE_REPORTED'] = 0;
        $data['TOTAL_DEATHS_REPORTED'] = 0;
        $data['TOTAL_RECOVERED_REPORTED'] = 0;
        $data['TOTAL_CASE_REPORTED_LASTDAY'] = 0;

        $contents = file_get_contents($this->url);
        if ($contents === false)  $resultJSON = NULL;
        else    $data['RESULT_DATA'] = json_decode($contents,true);
        
        foreach($data['RESULT_DATA'] as $result){
            $data['TOTAL_CASE_REPORTED'] += $result['cases'];
            $data['TOTAL_DEATHS_REPORTED'] += $result['deaths'];            
            $data['TOTAL_RECOVERED_REPORTED'] += $result['recovered'];
            $data['TOTAL_CASE_REPORTED_LASTDAY'] += $result['cases']-$result['todayCases'];
        }

        $this->load->view('coronavirus',$data);
    }
}