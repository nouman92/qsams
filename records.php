<?php include 'header.php';
if (!isset($_SESSION['email']))
{
 header("Location: index.php");
 die();
}

$current_page  = 1;
$limit_filter = 100;

$block_filter = 0;
$row_filter = 0;
$table_filter = 0;
$panel_filter = 0;

$seriel_filter = "";

$clause = '';
$glue = '';
$cond_values = array();

if (isset($_POST['apply_filter']) || isset($_POST['get_csv']) )
{
  $block_filter = $_POST['block_number'];
  $row_filter = $_POST['row_number'];
  $table_filter = $_POST['table_number'];
  $panel_filter = $_POST['panel_number'];
  $seriel_filter = $_POST['seriel_no'];
  $limit_filter = $_POST['limit'];
  $current_page = $_POST['current_page'];
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

if (isset($_POST['apply_filter'])){
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
function get_active_seriel_number_data($assets) {

    if(sizeof($assets) > 0){
      foreach ($assets as $asset){
        if($asset->active == 1)
        {
          return $asset;
        }
      }
    }
    return null;
}
?>
<section class="" id="">
  <br/>
    <div class="container">
        <div class="row">
          <?php include 'refrences.php';?>
          <hr/>
          <?php include 'filters.php';?>
          <hr/>
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
                  "<td><a href='/detail.php?record_id=".$grid->id."' class='blue-text'><i class='fa fa-user'>View</i></a></td>";
                  if($_SESSION['role'] == "Admin"){
                    echo "<td><a href='/edit.php?record_id=".$grid->id."' class='teal-text'><i class='fa fa-pencil'>Edit</i></a></td>";
                  }
                 echo "</tr> ";
              }
            ?>
            </tbody>
          </table>
          </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
