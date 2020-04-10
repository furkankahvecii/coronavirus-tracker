<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Db_corona extends CI_Model
{
    private $url = "https://coronavirus-19-api.herokuapp.com/countries";

  public function __construct()
  {
    parent::__construct();
  }

  public function fetch_data_api()
  {
    $data = array();
    $contents = file_get_contents($this->url);
    if ($contents === false)  $resultJSON = NULL;
    else    $data = json_decode($contents,true);

    return $data;
  }

  public function fetch_data_db()
  {
    return $this->db->query("SELECT * FROM countries ORDER BY cases DESC")->result_array();
  }

  public function get_statistics()
  {
    $this->db->select("SUM(cases) as TOTAL_CASE_REPORTED,SUM(deaths) as TOTAL_DEATHS_REPORTED,SUM(recovered) as TOTAL_RECOVERED_REPORTED, (SUM(cases) - SUM(todayCases)) as TOTAL_CASE_REPORTED_LASTDAY");
    $this->db->from("countries");
    return $this->db->get()->result_array()[0];
  }

}
