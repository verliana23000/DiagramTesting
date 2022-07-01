<?php

$data = file('spp.ptl');
$hasil = array();
$r[] = "";
$y[] = "";

/**
 * Pencarian:
 * Activity State,
 * Activity Name, dan
 * Id 
 */

for ($i = 0; $i < count($data); $i++) {
    if(((str_contains($data[$i], '(object ActivityStateView')) || (str_contains($data[$i], '(object DecisionView')) || (str_contains($data[$i], '(object StateView')) || (str_contains($data[$i], '(label(object ItemLabel'))) !== false){
        if(((str_contains($data[$i], '(object ActivityStateView')) || (str_contains($data[$i], '(object DecisionView')) || (str_contains($data[$i], '(object ActivityState')))){
            if(((str_contains($data[$i], '(object ActivityStateView')) || (str_contains($data[$i], '(object DecisionView')))){
                if((str_contains($data[$i], '(State'))){
                    $r = "ActivityState";
                }else{
                    $r = "DecisionState";
                }
                    $clean_tab = trim($data[$i],"\t     "); // menghilangkan tab dan spasi kosong
                    $clean_object = strpos($clean_tab, ": "); // memotong kalimat berdasarkan titik dua
                    $clean_plus = $clean_object; // mendapatkan angka untuk memotong 2 huruf ": "
                    $clean_semicolon = substr($clean_tab, $clean_plus); // menghilangkan character berdasarkan $clean_plus
                    $clean_quotes = str_replace('"', '', $clean_semicolon);
                    // $activitystate = trim($clean_quotes, "\n");

                    // $activitystate = str_replace('"', '', trim($data[$i],"\t     (object StateView "));
                    // $activitystate = substr($activitystate, 0,-16);
                    // $activitystate = trim($activitystate, "\n");
                    $activity_name = str_replace('"', '', trim($data[$i+20],"\t     (label(object ItemLabel'\t\n"));
                    $id = str_replace('"', '', trim($data[$i+33],"\t     supplier\t\n") );
                    $id = substr($id, 1);

                    $hasil[$i] = array(
                        "State" => $r,
                        "Activity Name" => $activity_name,
                        "ID" => $id
                    );
                }
            }
        }
    }      
print_r($hasil);
?>