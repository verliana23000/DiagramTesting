<?php

$data = file('library.ptl');
$hasil = array();
$counter = 0;
/**
 * Pencarian:
 * Activity State
 *      (object State StartState dan EndState
 *      (object --> ActivityState dan Decision
 * Activity Name, dan
 * ID
 */


/** 
 * Looping Pertama
 * untuk mencari State, Activity Name, dan ID 
 * */
for ($i = 0; $i < count($data); $i++){

    // Activity State
    if( (str_contains($data[$i], '(object ActivityStateView ')) ){
        $activity_state = "ActivityState";
        $activity_name = str_replace('"', '', trim($data[$i],"\t     (object ActivityStateView "));
        $activity_name = str_replace('@', '', trim($activity_name));
        $id = substr($activity_name,-2);
        $activity_name = preg_replace('/[0-9]+/', '', $activity_name);
        $counter++;

        $hasil[$counter] = array(
            "State" => $activity_state,
            "Activity Name" => $activity_name,
            "ID" => $id,
            "Dependency" => ""
        );
    }

    // DecisionState
    elseif( (str_contains($data[$i], '(object DecisionView ')) ){
        $activity_state = "DecisionState";
        $activity_name = str_replace('"', '', trim($data[$i],"\t     (object DecisionView "));
        $activity_name = str_replace('@', '', trim($activity_name));
        $id = substr($activity_name,-2);
        $activity_name = preg_replace('/[0-9]+/', '', $activity_name);
        $counter++;

        $hasil[$counter] = array(
            "State" => $activity_state,
            "Activity Name" => $activity_name,
            "ID" => $id,
            "Dependency" => ""
        );
    }

    //StartState & EndState
    elseif( (str_contains($data[$i], '(object StateView ')) ) {
        $activity_state = str_replace('"', '', trim($data[$i],"\t     (object StateView "));
        $activity_state = str_replace('@', '', trim($activity_state));
        $activity_state = str_replace('$', '', trim($activity_state));
        $activity_state = preg_replace('/UNNAMED/i', '', $activity_state);
        $activity_state = preg_replace('/[0-9]+/','', $activity_state);
        $activity_state = str_replace(' ', '', trim($activity_state));
        
        $activity_name = str_replace('"', '', trim($data[$i],"\t     (object StateView "));
        $activity_name = preg_replace('/StartState/', '',$activity_name);
        $activity_name = preg_replace('/EndState/', '', $activity_name);
        $activity_name = str_replace('@', '', trim($activity_name));
        $id = substr($activity_name,-2);
        $activity_name = preg_replace('/[0-9]+/','', $activity_name);
        $counter++;

        $hasil[$counter] = array(
            "State" => $activity_state,
            "Activity Name" => $activity_name,
            "ID" => $id,
            "Dependency" => ""
        );
    }
}

/** 
 * Looping Pertama
 * untuk mencari Dependency 
 * */
for ($i = 0; $i < count($data); $i++){

        if( (str_contains($data[$i], '(object TransView ')) ){

            $client = str_replace('"', '', trim($data[$i+4],"\t     client\t@ \n"));
            $supplier = str_replace('"', '', trim($data[$i+5],"\t     supplier\t@ \n"));

            for ($urutan = 1; $urutan <= count($hasil); $urutan++) { 
                
                if ($hasil[$urutan]['ID'] == $supplier) {
                    $hasil[$urutan]["Dependency"] = $client;
                }else if($hasil[$urutan]["State"] == "StartState"){
                    $hasil[$urutan]["Dependency"] = 0;
                }

            }
            
        }
        
print_r($hasil);
}


?>