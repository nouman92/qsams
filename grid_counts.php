<?php
require './system/initialize.php';

if(isset($_REQUEST["block"])){
    if(isset($_REQUEST["row"])){
     $assetsGrid = Assetsgrid::all(
       array("select"=>"max(table_number) as max_tables",
             "conditions"=>array("row_number = ? and block_number = ?",$_REQUEST["row"],$_REQUEST["block"]),
             "limit"=>1
           )
           );
     if(sizeof($assetsGrid) > 0){
       if($assetsGrid[0]->max_tables != null)
          echo $assetsGrid[0]->max_tables;
      else
          echo "0";
     }

  }else{
    $assetsGrid = Assetsgrid::all(
      array("select"=>"max(row_number) as max_rows",
            "conditions"=>array("block_number = ?",$_REQUEST["block"]),
            "limit"=>1
          )
          );
      if(sizeof($assetsGrid) > 0){
        if($assetsGrid[0]->max_rows != null)
          echo $assetsGrid[0]->max_rows;
        else
          echo "0";
      }
  }
}

?>
