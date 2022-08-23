<?php

include_once "methods.php";

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


print "\n";
print "==================================== Activity Dependency Table =============================================\n";



/** 
 * Looping Pertama pembuatan adt
 * untuk mencari State, Activity Name, dan ID 
 * */

for ($i = 0; $i < count($data); $i++) {

    // Activity State
    if ((str_contains($data[$i], '(object ActivityStateView '))) {
        $activity_state = "ActivityState";
        $activity_name = preprocessingNameActivity($data[$i]);
        $id = preprocessingID($activity_name);
        $activity_name = preprocessingNameFinal($activity_name);
        $counter++;
        $hasil[$counter] = returningArrayWithoutDependency($activity_state, $activity_name, $id);
    }

    // DecisionState
    elseif ((str_contains($data[$i], '(object DecisionView '))) {
        $activity_state = "DecisionState";
        $activity_name = preprocessingNameDecision($data[$i]);
        $id = preprocessingID($activity_name);
        $activity_name = preprocessingNameFinal($activity_name);
        $counter++;
        $hasil[$counter] = returningArrayWithoutDependency($activity_state, $activity_name, $id);
    }

    //StartState & EndState
    elseif ((str_contains($data[$i], '(object StateView '))) {
        $activity_state = preprocessingStateStartEnd($data[$i]);
        $activity_name = preprocessingNameStartEnd($data[$i]);
        $id = preprocessingID($activity_name);
        $activity_name = preprocessingNameFinal($activity_name);
        $counter++;
        $hasil[$counter] = returningArrayWithoutDependency($activity_state, $activity_name, $id);
    }
}

/** 
 * Looping Kedua
 * untuk mencari Dependency 
 * */

for ($i = 0; $i < count($data); $i++) {
    if ((str_contains($data[$i], '(object TransView '))) {
        $client = preprocessingDependency($data[$i + 4]);
        $supplier = preprocessingSupplier($data[$i + 5]);
        for ($urutan = 1; $urutan <= count($hasil); $urutan++) {
            if ($hasil[$urutan]['ID'] == $supplier) {
                $hasil[$urutan]["Dependency"] = $client;
            } else if ($hasil[$urutan]["State"] == "StartState") {
                $hasil[$urutan]["Dependency"] = 0;
            }
        }
    }
}
print_r($hasil);

print "\n";
print "==================================== Activity Dependency Graph ========================================\n";

/** 
 * Looping Ketiga pembuatan adg
 * untuk mencari graph
 * */

$bfs = array();

/**
 * [1] => Array
 * (
 *      [ID Awal] => 0
 *      [Activity Awal] => UNNAMED
 *      [ID Tujuan] => 2
 *      [Activity Tujuan] => start state
 * )
 */

$adg = array();
$flag = 0;
foreach ($hasil as $key => $value) {
    $flag++;
    $dependency = $value['Dependency'];
    $id = $value['ID'];

    $adg[$flag]['ID Awal'] = $dependency;

    if ($dependency == 0) {
        $adg[$flag]['Activity Awal'] = "UNNAMED";
    } else {
        $adg[$flag]['Activity Awal'] = "";
    }

    $adg[$flag]['ID Tujuan'] = $id;
    if (str_contains($value['Activity Name'], "UNNAMED")) {
        $adg[$flag]['Activity Tujuan'] = $value['State'];
    } else {
        $adg[$flag]['Activity Tujuan'] = $value['Activity Name'];
    }
}



// $awal = array_column($hasil, 'ID', 'Activity Name');
// print_r($awal);

// $loop = true;
// $total = count($hasil);
// $counter = 0;
// while($loop){
//     $counter++;

//     if ($counter == $total) {
//         $loop = false;
//     }
// }

// foreach ($hasil as $key => $value) {
//     $id = $value['ID'];
//     $key = array_search($id, $awal);
//     print($id . " --- " . $key . " " . $hasil[$key + 1]['Activity Name'] . "\n");
// }
// $key = array_search($id, $awal);
// $adg[$flag]['Activity Awal'] = $hasil[$key]['Activity Name'];


print_r($adg);

foreach ($hasil as $key => $value) {
    $dependency = $value['Dependency'];
    $id = $value['ID'];
    $bfs[$dependency][] = $id;
}
ksort($bfs);
// print_r($bfs);

foreach ($bfs as $key => $value) {
    foreach ($value as $index => $content) {
        print($key . " -> " . $content . "\n");
    }
}
// print_r($bfs);

/** 
 * Looping Keempat penerapan algoritma bfs untuk setiap path
 * */

//     $start = 0;
//     $path = array();
//     $cabang= array();
//     $sementara=array();
//     $index_path = 0;
//     $count = 0;
//     foreach ($hasil as $key => $value) {
//         foreach($hasil as $k => $v){
//             if($value['Dependency'] == $v['Dependency']){
//                 $count++;
//             }
//         }
//         if($count>1){
//             array_push($cabang,$value['Dependency']);
//         }
//         $count=0;
//     }
//     foreach ($hasil as $key => $value) {
//         foreach($hasil as $k => $v){
//             if($start == $v['Dependency']){
//                 if($cabang[0]==$v['ID'])
//                 {
//                     $count++;
//                 }
//                 if($count>=0)
//                 {
//                     $sementara[]=$v['ID'];
//                     $start=$v['ID'];
//                 }else{
//                     array_push($path,$v['ID']);
//                     // $start=$v['ID'];
//                 }
//             }
//         }
//         if(count($sementara))
//         {

//         }

//     }
// print_r ($sementara);
print "\n";
print "==================================== Test Path =====================================================\n";

$start = 0;
$path = array();


//     $start = 0;
//     $path = array();
//     $index_path = 0;
//     $count = 0;
//     foreach ($hasil as $key => $value) {
//         if($start == $value['Dependency']){
//             array_push($path,$value['ID']);
//             foreach($hasil as $k => $v){
//                 if($value['ID'] == $v['Dependency']){
//                     $count++;
//                 }
//             }
//             for ($j=0; $j>$count; $j++){
//                 $path[$i] = array_push($path,$value['ID']);
//             }
//             if($count > 1){
//                     $path[$index_path] = $path[$index_path-1];
//                     $index_path++;

//                 }
//             }
//         } 
    
// print_r ($path);