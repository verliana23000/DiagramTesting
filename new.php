<?php

$hasil = array();

$hasil[0]['State'] = "StartState";
$hasil[0]['Activity Name'] = "UNNAMED";
$hasil[0]['ID'] = 2;
$hasil[0]['Dependency'] = 0;

$hasil[1]['State'] = "ActivityState";
$hasil[1]['Activity Name'] = "enter book code";
$hasil[1]['ID'] = 3;
$hasil[1]['Dependency'] = 2;

/**
 * Array
 * (
 *  [0] => 0
 *  [1] => 2
 * )
 */
$awal = array_column($hasil, 'ID');
print_r($awal);

$id = 2;

$key = array_search($id, $awal);
print($key);

print($hasil[$key]['Activity Name']);

// $key = array_search(2, $data[0]);
// print($key . "\n");
// $key = array_keys($data, 2); 
// print($key);

// print_r($data);

// $data = array(
//     0 => array(22),
//     2 => array(34),
//     5 => array(77)
// );


// if ( array_key_exists(0, $data) ) {
//     print("adaa");
//     $data[0][] = 45;
//     print_r($data);
// }else{
//     print("Tidak adaa");
// }

// // $arr = array();
// //  $arr['a'][] = '2e';
// //  $arr['a'][] = '45';
// //  $arr['a'][] = 'gt';
// //  print_r($arr);

// $str = '    This is a simple piece of text.    ';
// $str = str_replace(' ', '', $str);
// echo $str; // Outputs: Thisisasimplepieceoftext.