<div class="records-filter">
  <form class="form-inline" method="post">
    <div class="text-center">
      <select class="form-control" name="block_number" id="block_number" onchange="get_rows(this)" >
        <option value="0">Select Block</option>
        <?php
         for( $i = 1 ; $i <= 100 ; $i++){
            echo "<option value='".$i."' ";
            if($block_filter == $i )
              echo " selected='selected' ";
            echo" >".$i."</option>";
          }
        ?>
      </select>
      <select class="form-control" name="row_number" onchange="get_tables(this)"  id="row_number">
        <option value="0">Select Row</option>
        <!-- <?php
         for( $i = 1 ; $i <= $row_count ; $i++){
           echo "<option value='".$i."' ";
           if($row_filter == $i )
             echo " selected='selected' ";
           echo" >".$i."</option>";
          }
        ?> -->
      </select>
      <select class="form-control" name="table_number" id="table_number">
        <option value="0">Select Table</option>
        <!-- <?php
         for( $i = 1 ; $i <= $table_count ; $i++){
           echo "<option value='".$i."' ";
           if($table_filter == $i )
             echo " selected='selected' ";
           echo" >".$i."</option>";
          }
        ?> -->
      </select>
      <select class="form-control" name="panel_number">
        <option value="0">Select Panel</option>
        <?php
         for( $i = 1 ; $i <= 40 ; $i++){
           echo "<option value='".$i."' ";
           if($panel_filter == $i )
             echo " selected='selected' ";
           echo" >".$i."</option>";
          }
        ?>
      </select>
      <select class="form-control"  name="limit">
        <option value="10">Limit Records</option>
        <?php
          for( $i = 100 ; $i <= 1000 ;    $i = $i + 100 ){
            echo "<option value='".$i."' ";
            if($limit_filter == $i )
              echo " selected='selected' ";
            echo" >".$i."</option>";
           }
         ?>
      </select>
      <select class="form-control" name="current_page">
        <option value="1">Page Number</option>
        <?php
          for( $i = 1 ; $i <= $total_pages;    $i++ ){
            echo "<option value='".$i."' ";
            if($current_page == $i )
              echo " selected='selected' ";
            echo" >".$i."</option>";
            if( $i == 1000 )
              break;
           }
         ?>
      </select>
      <input class="form-control"  name="seriel_no" placeholder="Seriel no" type="text"/>
      <button class="btn btn-success" type="submit" name="apply_filter" >Show Results</button>
      <button class="btn btn-success" type="submit" name="get_csv" >Write CSV</button>
    </div>
    <br/>
    <div class="text-center">
      <?php
      if (isset($_POST['get_csv'])){
        $data_to_write = Assetsgrid::find('all',array('conditions'=> array_merge(array(1 => $clause), $cond_values) ,"limit"=>1000));
        $index = 0;
        $fp = fopen('output.csv', 'w');
        fputcsv($fp, array('Block', 'Row', 'Table', 'Panel', 'Seriel',
                           'V oc','I sc','V mppt','I mppt','Maxpower','Fillfactor'));
        foreach ($data_to_write as $grid){

          $active_asset = get_active_seriel_number_data($grid->asset);
          if($active_asset){
            fputcsv($fp,[$grid->block_number,$grid->row_number,$grid->table_number,$grid->panel_number,
                     $active_asset->seriel_no,$active_asset->v_oc,$active_asset->i_sc,$active_asset->v_mppt,
                     $active_asset->i_mppt,$active_asset->max_power,$active_asset->fill_factor]);
          }else{
            fputcsv($fp,[$grid->block_number,$grid->row_number,$grid->table_number,$grid->panel_number,
                     "n/a","n/a","n/a","n/a","n/a","n/a","n/a"]);
          }

        }
        echo "<a href='./output.csv' target='_blank'>Download Here</a>";
        header("Refresh: 10;url=records.php");
      }
      ?>
    </div>
  </form>
</div>
