<?php

class CoronaVirus {
    
    private $url = array();
    private $csvColumns = array();
    private $csvResult;

    public function __construct($url=array(),$csvColumns = array())
    {
        $this->url = $url;
        $this->csvColumns = $csvColumns;
    }

    public function fetchData()
    {
        $csvResult;

        for($i=0;$i<count($this->url);$i++){
            $contents = file_get_contents($this->url[$i][0].".csv");
            if ($contents === false)  $csvResult = NULL;
            else    $csvResult = array_map('str_getcsv', explode("\n", $contents));
            unset($csvResult[0]);
            
            $this->csvResult[$this->csvColumns[$i]] = $csvResult;
        }

        // echo "<pre>";
        // print_r($this->csvResult);
        // echo "</pre>";
    }

    public function processCsv()
    {
        $sonuc['results'] = array();
        $sonuc['TOTAL_CASE_REPORTED'] = 0;
        $sonuc['TOTAL_DEATHS_REPORTED'] = 0;
        $sonuc['TOTAL_RECOVERED_REPORTED'] = 0;
        $sonuc['TOTAL_CASE_REPORTED_LASTDAY'] = 0;

        for($i=0;$i<1;$i++){
            for($j=1;$j<=count($this->csvResult['Confirmed']);$j++){

                $totalCase = $this->csvResult['Confirmed'][$j][count($this->csvResult['Confirmed'][$j])-1];
                $totalCaseLastday = $this->csvResult['Confirmed'][$j][count($this->csvResult['Confirmed'][$j])-2];
                $totalDeath = $this->csvResult['Deaths'][$j][count($this->csvResult['Deaths'][$j])-2];
                $totalRecovered = $this->csvResult['Recovered'][$j][count($this->csvResult['Recovered'][$j])-2];

                $sonuc['results'][] = array(
                    "STATE" => $this->csvResult['Confirmed'][$j][0],
                    "COUNTRY" => $this->csvResult['Confirmed'][$j][1],
                    "TOTAL_CASE" => $totalCase,
                    "TOTAL_CASE_LASTDAY" => $totalCaseLastday,
                    "TOTAL_DEATH" => $totalDeath,
                    "TOTAL_RECOVERED" => $totalRecovered
                );

                $sonuc['TOTAL_CASE_REPORTED'] += $totalCase;
                $sonuc['TOTAL_CASE_REPORTED_LASTDAY'] += $totalCaseLastday;
                $sonuc["TOTAL_DEATHS_REPORTED"] += $totalDeath;
                $sonuc["TOTAL_RECOVERED_REPORTED"] += $totalRecovered;

            }
        }

        return $sonuc;
    }
}
?>