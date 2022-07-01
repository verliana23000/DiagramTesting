<?php 
   $jml= 0;
   $data = file('spp.ptl');
   $arr = array();
      $arr['0']= array(
         "state"  => "ActivityStateView",
         "name"   => "input bobot tugas",
         "id"     => "2",
      );
      $arr['1']= array(
         "state"  => "ActivityStateView",
         "name"   => "input bobot uts",
         "id"     => "3",
      );
      $arr['2']= array(
         "state"  => "ActivityStateView",
         "name"   => "input bobot uas",
         "id"     => "5",
      );
      $arr['3']= array(
         "state"  => "StartState",
         "name"   => "UNNAMED$0",
         "id"     => "8",
      );
      $arr['4']= array(
         "state"  => "ActivityStateView",
         "name"   => "input tahun ajaran",
         "id"     => "9",
      );
      $arr['5']= array(
         "state"  => "ActivityStateView",
         "name"   => "input semester",
         "id"     => "11",
      );
      $arr['6']= array(
         "state"  => "ActivityStateView",
         "name"   => "input kode matakuliah",
         "id"     => "13",
      );
      $arr['7']= array(
         "state"  => "DecisionView",
         "name"   => "UNNAMED$1",
         "id"     => "15",
      );
      $arr['8']= array(
         "state"  => "ActivityStateView",
         "name"   => "tampil matakuliah",
         "id"     => "17",
      );
      $arr['9']= array(
         "state"  => "ActivityStateView",
         "name"   => "input skor tugas",
         "id"     => "18",
      );
      $arr['10']= array(
         "state"  => "ActivityStateView",
         "name"   => "input rata-rata tugas",
         "id"     => "20",
      );
      $arr['11']= array(
         "state"  => "ActivityStateView",
         "name"   => "input nilai uts",
         "id"     => "22",
      );
      $arr['12']= array(
         "state"  => "ActivityStateView",
         "name"   => "input nilai uas",
         "id"     => "24",
      );
      $arr['13']= array(
         "state"  => "ActivityStateView",
         "name"   => "input nilai akhir",
         "id"     => "26",
      );
      $arr['14']= array(
         "state"  => "ActivityStateView",
         "name"   => "konversi nilai ke huruf",
         "id"     => "28",
      );
      $arr['15']= array(
         "state"  => "EndState",
         "name"   => "UNNAMED$3",
         "id"     => "30",
      );
      $arr['16']= array(
         "state"  => "ActivityStateView",
         "name"   => "input nim mahasiswa",
         "id"     => "32",
      );
      $arr['17']= array(
         "state"  => "DecisionView",
         "name"   => "input nim mahasiswa",
         "id"     => "32",
      );
      $arr['18']= array(
         "state"  => "ActivityStateView",
         "name"   => "tampil nama mahasiswa",
         "id"     => "36",
      );
      $arr['19']= array(
         "state"  => "ActivityStateView",
         "name"   => "input kelas",
         "id"     => "37",
      );
      
      for ($i = 0; $i < count($data); $i++) {
            if( ((str_contains($data[$i],'(object ActivityStateView ')) || (str_contains($data[$i],'(object DecisionView ')) || (str_contains($data[$i],'(object StateView '))) !== false ){
               print(substr($data[$i],10));
           
            if((str_contains($data[$i+60], 'client'))  !== false){
               print ($data[$i+60]. " " .$data[$i+61]);
            } 
         }
            $jml++;
      }
      
      
   
      print("======================================================= \n");

      print("================ ADT ================================== \n");


      foreach($arr as $datas){
         print("State   : ".$datas["state"] . " || " . " Name   : ".$datas["name"] . " || " . " Id  : ".$datas["id"] . "\n");
         // print("Name    : ".$datas["name"] . "\n");
         // print("Id      : ".$datas["id"] . "\n");
         // print("====================================================== \n");
      }

      print("======================================================= \n");
      print("=================== ADG =============================== \n");

      
      foreach($arr as $datas){
            //for ($y = 0; $y < count($datas); $y++) {
               print ($datas["id"]. "->" . $datas["id"] . "\n");
               // if($datas["id"] !== false){
               // }
            //}
      }
   
?>