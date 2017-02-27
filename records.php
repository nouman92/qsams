<?php include 'header.php';
if (!isset($_SESSION['email']))
{
 header("Location: index.php");
 die();
}

$current_page  = 1;
$limit_filter = 10;

$block_filter = 0;
$row_filter = 0;
$table_filter = 0;
$panel_filter = 0;

$seriel_filter = "";

$clause = '';
$glue = '';
$cond_values = array();

if (isset($_POST['apply_filter']))
{
  $block_filter = $_POST['block_number'];
  $row_filter = $_POST['row_number'];
  $table_filter = $_POST['table_number'];
  $panel_filter = $_POST['panel_number'];
  $seriel_filter = $_POST['seriel_no'];
  $limit_filter = $_POST['limit'];
  $current_page = $_POST['current_page'];
  $_POST = array();
}


if( $block_filter != 0){
  $clause .= $glue . ' block_number = ?';
  $cond_values[] = $block_filter;
  $glue = ' AND';
}

if( $row_filter != 0){
  $clause .= $glue . ' row_number = ?';
  $cond_values[] = $row_filter;
  $glue = ' AND';
}

if( $table_filter != 0){
  $clause .= $glue . ' table_number = ?';
  $cond_values[] = $table_filter;
  $glue = ' AND';
}

if( $panel_filter != 0){
  $clause .= $glue . ' panel_number = ?';
  $cond_values[] = $panel_filter;
  $glue = ' AND';
}

if( $seriel_filter != ""){
  try{
  $assetsGrid = Assetsgrid::All(array(
    'conditions' => array("seriel_no like ? " , '%'.$seriel_filter.'%'),
    "joins"=>array('asset'),
    'limit' => $limit_filter,
    'offset' => (($current_page-1) * $limit_filter)
  ));
  $total_records = Assetsgrid::count(array(
    'conditions' => array("seriel_no like ? " , '%'.$seriel_filter.'%'),
    "joins"=>array('asset'),
    'limit' => $limit_filter,
    'offset' => (($current_page-1) * $limit_filter)
  ));
   }catch(Exception $ex){
    echo $ex;
  }
}else{
  $assetsGrid = Assetsgrid::find('all',array('conditions'=> array_merge(array(1 => $clause), $cond_values) ,"limit"=>$limit_filter,'offset' => (($current_page-1) * $limit_filter)));
  $total_records = Assetsgrid::count(array('conditions'=> array_merge(array(1 => $clause), $cond_values)));
}

$total_pages = ceil($total_records / $limit_filter);
// if (isset($_POST['get_csv'])){
//   $index = 0;
//   $file = fopen('output.csv', 'w');
//   fputcsv($file, array('Block', 'Row', 'Table', 'Panel', 'Seriel'));
//   foreach ($assetsGrid as $grid){
//     $index++;
//     fputcsv($file,[$grid->block_number,$grid->row_number,$grid->table_number,$grid->panel_number,get_active_seriel_number($grid->asset)]);
//     if($index == 200)
//       break;
//   }
//   fclose($file);
//   header('Content-Type: text/csv; charset=utf-8');
//   header('Content-Disposition: attachment; filename=data.csv');
// }
?>
<section class="" id="">
    <hr/>
    <div class="container">
        <div class="row">
          <div class="container text-center" style="">
              <div class="col-sm-2 portfolio-item" style="height: 90px;">
                  <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">
                      <img src="vendor/img/main-layout.jpg" style="height:100%;width:100%" class="img-thumbnail" alt="">
                  </a>
              </div>
              <div class="col-sm-2 portfolio-item" style="height: 90px;">
                  <a href="#portfolioModal3" class="portfolio-link" data-toggle="modal">
                      <img src="vendor/img/satallite.jpg" style="height:100%;width:100%" class="img-thumbnail" alt="">
                  </a>
              </div>
              <div class="col-sm-2 portfolio-item" style="height: 90px;">
                  <a href="#portfolioModal2" class="portfolio-link" data-toggle="modal">
                      <img src="vendor/img/block.jpg" style="height:100%;width:100%" class="img-thumbnail" alt="">
                  </a>
              </div>
              <div class="col-sm-2 portfolio-item" style="height: 90px;">
                  <a href="#portfolioModal4" class="portfolio-link" data-toggle="modal">
                      <img src="vendor/img/table.jpg" style="height:100%;width:100%" class="img-thumbnail" alt="">
                  </a>
              </div>
              <div class="col-sm-2 portfolio-item" style="height: 90px;">
                  <a href="#portfolioModal5" class="portfolio-link" data-toggle="modal">
                      <img src="vendor/img/row.jpg" style="height:100%;width:100%" class="img-thumbnail" alt="">
                  </a>
              </div>
              <div class="col-sm-2 portfolio-item" style="height: 90px;">
                  <a href="#portfolioModal6" class="portfolio-link" data-toggle="modal">
                      <img src="vendor/img/table-layout.jpg"  style="height:100%;width:100%" class="img-thumbnail" alt="">
                  </a>
              </div>
              <?php include 'refrences.php';?>
          </div>
          <hr/>
          <div class="jumbotron">
            <form class="form-inline" action="/qsams/records.php" method="post">
              <div class="text-center">
                <select class="form-control" name="block_number">
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
                <select class="form-control" name="row_number">
                  <option value="0">Select Row</option>
                  <?php
                   for( $i = 1 ; $i <= 13 ; $i++){
                     echo "<option value='".$i."' ";
                     if($row_filter == $i )
                       echo " selected='selected' ";
                     echo" >".$i."</option>";
                    }
                  ?>
                </select>
                <select class="form-control" name="table_number">
                  <option value="0">Select Table</option>
                  <?php
                   for( $i = 1 ; $i <= 8 ; $i++){
                     echo "<option value='".$i."' ";
                     if($table_filter == $i )
                       echo " selected='selected' ";
                     echo" >".$i."</option>";
                    }
                  ?>
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
                    for( $i = 10 ; $i <= 50 ;    $i = $i + 10 ){
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
                    for( $i = 1 ; $i <= $total_pages ;    $i++ ){
                      echo "<option value='".$i."' ";
                      if($current_page == $i )
                        echo " selected='selected' ";
                      echo" >".$i."</option>";
                     }
                   ?>
                </select>
                <input class="form-control"  name="seriel_no" placeholder="Seriel no" type="text"/>
              </div>
              <br/>
              <div class="text-center">
                <input class="btn btn-success" type="submit" name="apply_filter" value="Show Results"/>
                <!-- <input class="btn btn-success" type="submit" name="get_csv" value="Write CSV"/> -->
              </div>
            </form>
          </div>
          <div class="container" style="">
            <table id="assetsGrid" class="table table-striped table-bordered table-hover  text-center">
            <thead>
              <tr >
                <th class="text-center">Block#</th>
                <th class="text-center">Row#</th>
                <th class="text-center">Table#</th>
                <th class="text-center">Panel#</th>
                <th class="text-center">Serial#</th>
                <th class="text-center">View</th>
                <?php if($_SESSION['role'] == "Admin"){ ?>
                  <th class="text-center">Edit</th>
                <?php }?>
              </tr>
            </thead>
            <tbody>
            <?php
              foreach ($assetsGrid as $grid){
                echo
                "<tr>".
                  "<td>".$grid->block_number . "</td>".
                  "<td>".$grid->row_number . "</td>".
                  "<td>".$grid->table_number . " </td>".
                  "<td>".$grid->panel_number. " </td>".
                  "<td>".get_active_seriel_number($grid->asset)."</td>".
                  "<td><a href='/qsams/detail.php?record_id=".$grid->id."' class='blue-text'><i class='fa fa-user'>View</i></a></td>";
                  if($_SESSION['role'] == "Admin"){
                    echo "<td><a href='/qsams/edit.php?record_id=".$grid->id."' class='teal-text'><i class='fa fa-pencil'>Edit</i></a></td>";
                  }
                 echo "</tr> ";
              }
              function get_active_seriel_number($assets) {
                  $seriel_no = "not available";
                  if(sizeof($assets) > 0){
                    foreach ($assets as $asset){
                      if($asset->active == 1)
                      {
                        $seriel_no = $asset->seriel_no;
                        break;
                      }
                    }
                  }
                  return $seriel_no;
              }
            ?>
            </tbody>
          </table>
          </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
