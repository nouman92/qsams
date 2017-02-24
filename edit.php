<?php include 'header.php';
if (!isset($_SESSION['email']))
{
 header("Location: index.php");
 die();
}
if(!isset($_REQUEST['record_id']))
{
  header("Location: records.php");
  die();
}
$asset;
$record_id = $_REQUEST['record_id'];
$assetsGrid = Assetsgrid::find($record_id);
if(isset($_REQUEST['update_record']) && isset($_REQUEST['assets_id']) && isset($_REQUEST['seriel_number']) ){
  try{
      $asset_id = $_REQUEST['assets_id'];
      $asset_to_update = Asset::find($asset_id);
      $asset_to_update->update_attributes(array(
        "seriel_no" => $_REQUEST['seriel_number'],
        "v_oc"=>$_REQUEST['v_oc'],
        "i_sc"=>$_REQUEST['i_sc'],
        "v_mppt"=>$_REQUEST['v_mppt'],
        "i_mppt"=>$_REQUEST['i_mppt'],
        "fill_factor"=>$_REQUEST['fill_factor'],
        "max_power"=>$_REQUEST['max_power']));
      header("Location: detail.php?record_id=".$record_id);
      die();
  }catch(Exception $e){
    echo $e;
  }
}
else if(isset($_REQUEST['add_record']) && isset($_REQUEST['seriel_number'])){
  try{
    foreach ($assetsGrid->asset as $a){

      $asset_to_update = Asset::find($a->id);
      $asset_to_update->update_attributes(array(
        "active"=>0,
        "removed" => date('Y-m-d H:i:s')
        )
      );
    }
    Asset::create(array(
      "seriel_no" => $_REQUEST['seriel_number'],
      "v_oc"=>$_REQUEST['v_oc'],
      "i_sc"=>$_REQUEST['i_sc'],
      "v_mppt"=>$_REQUEST['v_mppt'],
      "i_mppt"=>$_REQUEST['i_mppt'],
      "fill_factor"=>$_REQUEST['fill_factor'],
      "max_power"=>$_REQUEST['max_power'],
      "active" => 1,
      "installed"=> date('Y-m-d H:i:s'),
      "assets_grid_id"=>$assetsGrid->id)
    );
    header("Location: detail.php?record_id=".$record_id);
    die();
  }catch(Exception $ex){
  //  echo $ex;
    echo "Error occured while processing your request";
  }
}

$is_new = true;
if(sizeof($assetsGrid->asset) > 0 && !isset($_REQUEST['new_record'])){
  foreach ($assetsGrid->asset as $a){
    if($a->active == 1){
      $asset = $a;
      $is_new = false;
      break;
    }
  }
}
?>
<div class="container">
  <h2>Edit Record</h2>
  <hr/>
  <form class="form" method="post">
  <div class="row">
    <div class="">
      <input type="hidden" name="record_id" value="<?php echo $assetsGrid->id; ?>">
      <div class="form-group col-md-2">
        <label class="" for="block_number">Block:</label>
        <input class="form-control" type="text" value="<?php echo $assetsGrid->block_number; ?>" name="block_number" disabled="true">
      </div>
      <div class="form-group col-md-2">
        <label class="" for="block_number">Row:</label>
        <input class="form-control" type="text" value="<?php echo $assetsGrid->row_number; ?>" name="block_number" disabled="true">
      </div>
      <div class="form-group col-md-2">
        <label class="" for="block_number">Table:</label>
        <input class="form-control" type="text" value="<?php echo $assetsGrid->table_number; ?>" name="block_number" disabled="true">
      </div>
      <div class="form-group col-md-2">
        <label class="" for="block_number">Panel:</label>
        <input class="form-control" type="text" value="<?php echo $assetsGrid->panel_number; ?>" name="block_number" disabled="true">
      </div>
      <div class="form-group col-md-2">
        <label class="" for="block_number">Position:</label>
        <input class="form-control" type="text" value="<?php echo $assetsGrid->panel_position; ?>" name="block_number" disabled="true">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <input type="hidden" name="assets_id" value="<?php echo $asset->id; ?>">
      <div class="form-group">
        <label class="" for="seriel_number">Seriel #:</label>
        <input class="form-control" type="text" value="<?php echo $asset->seriel_no; ?>" name="seriel_number" required>
      </div>
      <div class="form-group">
        <label class="" for="voltages">v_oc:</label>
        <input class="form-control" type="number"  step="any" value="<?php echo $asset->v_oc; ?>" name="v_oc" required>
      </div>
      <div class="form-group">
        <label class="" for="i_sc">i_sc:</label>
        <input class="form-control" type="number"  step="any" value="<?php echo $asset->i_sc; ?>" name="i_sc" required>
      </div>
      <div class="form-group">
        <label class="" for="v_mppt">v_mppt:</label>
        <input class="form-control" type="number"  step="any" value="<?php echo $asset->v_mppt; ?>" name="v_mppt" required>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label class="" for="i_mppt">i_mppt:</label>
        <input class="form-control" type="number"  step="any" value="<?php echo $asset->i_mppt; ?>" name="i_mppt" required>
      </div>
      <div class="form-group">
        <label class="" for="max_power">max_power:</label>
        <input class="form-control" type="number"  step="any" value="<?php echo $asset->max_power; ?>" name="max_power" required>
      </div>
      <div class="form-group">
        <label class="" for="fill_factor">fill_factor:</label>
        <input class="form-control" type="number"  step="any" value="<?php echo $asset->fill_factor; ?>" name="fill_factor" required>
      </div>
      <br/>
      <?php if($is_new)  { ?>
        <input class="btn btn-primary" name="add_record" type="submit" value="Add New"/>
      <?php }else{ ?>
        <input class="btn btn-primary" name="update_record" type="submit" value="Update"/>
        <input class="btn btn-primary" name="new_record" type="submit" value="Add New"/>
      <?php }?>

    </div>
  </div>
</form>
</div>
