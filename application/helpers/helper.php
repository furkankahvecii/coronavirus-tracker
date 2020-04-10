<?php
  
    function change_country($data,$geochart_country)
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

    function number_format_array($data){
        $keys = array_keys($data[0]);
        for($i=0;$i<count($data);$i++){
            foreach($keys as $key){
                $data[$i][$key] = is_numeric($data[$i][$key]) ? number_format($data[$i][$key]) : $data[$i][$key];
        }
    }

    return $data;
    }

    
    function cmp($a, $b)
    {
        if ($a['cases'] == $b['cases']) return 0;
        return ($a['cases'] < $b['cases']) ? 1 : -1;
    }

    function change_image_url($data,$img_url)
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

?>
