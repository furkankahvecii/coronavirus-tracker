<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CoronaVirus extends CI_Controller 
{
    private $url = "https://coronavirus-19-api.herokuapp.com/countries";
    private $img_url = array( 
        "US"=>"United States",
        "UK"=>"United Kingdom", 
        "S. Korea"=>"South Korea", 
        "Czechia"=>"Czech Republic", 
        "UAE"=>"United Arab Emirates", 
        "Diamond Princess" => "United Kingdom",
        "Bosnia and Herzegovina"=>"Bosnia Herzegovina",
        "North Macedonia" => "Macedonia",
        "Réunion"=>"France",
        "Faeroe Islands" => "Faroe Islands",
        "Channel Islands" => "Jersey",
        "DRC" => "Denmark",
        "Isle of Man" => "Ireland",
        "Macao" => "China",
        "Saint Martin" => "France",
        "Eswatini" => "Swaziland",
        "Curaçao" => "Curacao",
        "Cabo Verde" => "Cape Verde",
        "Timor-Leste" => "East Timor",
        "St. Vincent Grenadines" => "St Vincent and Grenadines",
        "Saint Lucia" => "St Lucia",
        "Saint Kitts and Nevis" => "St Kitts and Nevis",
        "Congo" => "Democratic Republic Congo Brazzaville",
        "Sint Maarten" => "Netherlands",
        "MS Zaandam" => "Netherlands",
        "British Virgin Islands" => "United Kingdom",
        "Guinea-Bissau" => "Guinea Bissau",
        "St. Barth" => "France",
        "CAR" => "Central African Republic",
        "Caribbean Netherlands" => "Netherlands",
        "World" => "https://www.gstatic.com/images/icons/material/system_gm/1x/language_grey600_24dp.png");
    
    private $geochart_country= array( "USA"=>"US", "UK"=>"United Kingdom", "S. Korea"=>"South Korea");

    public function __construct()
    {
        parent::__construct();
    }

    
    public function index()
    {
        $data['RESULT_DATA'] = $this->fetch_data();
        
        $data['TOTAL_CASE_REPORTED'] = $data['RESULT_DATA'][0]['cases'];//array_sum(array_column($data['RESULT_DATA'],'cases'));
        $data['TOTAL_DEATHS_REPORTED'] = $data['RESULT_DATA'][0]['deaths'];//array_sum(array_column($data['RESULT_DATA'],'deaths'));          
        $data['TOTAL_RECOVERED_REPORTED'] = $data['RESULT_DATA'][0]['recovered'];//array_sum(array_column($data['RESULT_DATA'],'recovered'));
        $data['TOTAL_CASE_REPORTED_LASTDAY'] = $data['RESULT_DATA'][0]['todayCases'];//$data['TOTAL_CASE_REPORTED'] - array_sum(array_column($data['RESULT_DATA'],'todayCases'));

        usort($data['RESULT_DATA'], array($this,'cmp'));     
     
        $this->load->view('coronavirus_vw',$data);
    }

    private function change_country($data,$geochart_country)
    {
        $i = 0;
        foreach($data as $each){
           if(array_key_exists($each['country'], $geochart_country)){
                $data[$i]['country'] = $geochart_country[$each['country']];
            }
            $i++;  
       }

       return $data;
    }

    private function fetch_data()
    {
        $data = array();
        $contents = file_get_contents($this->url);
        if ($contents === false)  $resultJSON = NULL;
        else    $data = json_decode($contents,true);

        $data = $this->change_country($data,$this->geochart_country);
        $data = $this->change_image_url($data,$this->img_url);

        return $data;
    }

    private function number_format_array($data){
        $keys = array_keys($data[0]);
        for($i=0;$i<count($data);$i++){
            foreach($keys as $key){
                $data[$i][$key] = is_numeric($data[$i][$key]) ? number_format($data[$i][$key]) : $data[$i][$key];
            }
        }
    
        return $data;
    }

    private function cmp($a, $b)
    {
        if ($a['cases'] == $b['cases']) return 0;
        return ($a['cases'] < $b['cases']) ? 1 : -1;
    }

    private function change_image_url($data,$img_url)
    {     
        $i = 0;
        foreach($data as $each){
           if(array_key_exists($each['country'], $img_url)){
                $data[$i]['image'] = $img_url[$each['country']];
            }
            else
                $data[$i]['image'] = $each['country'];
            $i++;  
       }
        return $data;
    }
}
