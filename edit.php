<?php include 'header.php';
if (!isset($_SESSION['email']))
{
 header("Location: index.php");
 die();
}
if (!isset($_REQUEST['record_id']))
{
  header("Location: records.php");
  die();
}
$record_id = $_REQUEST['record_id'];
$assetsGrid = Assetsgrid::find($record_id);
if (isset($_REQUEST['assets_id']) && isset($_REQUEST['seriel_number']) && isset($_REQUEST['voltages'])) {
  try{
      $asset_id = $_REQUEST['assets_id'];
      $asset = Asset::find($asset_id);
      $asset->update_attributes(array("seriel_no" => $_REQUEST['seriel_number'],"voltages"=>$_REQUEST['voltages']));
      header("Location: detail.php?record_id=".$record_id);
      die();
  }catch(Exception $e){
    echo $e;
  }
}
?>
<div class="container">
<h2>Edit Record</h2>
<hr/>
<form class="form" method="post">
  <div class="col-md-5">
  <input type="hidden" name="record_id" value="<?php echo $assetsGrid->id; ?>">
  <div class="form-group">
    <label class="" for="block_number">Block:</label>
    <input class="form-control" type="text" value="<?php echo $assetsGrid->block_number; ?>" name="block_number" disabled="true">
  </div>
  <div class="form-group">
    <label class="" for="block_number">Row:</label>
    <input class="form-control" type="text" value="<?php echo $assetsGrid->row_number; ?>" name="block_number" disabled="true">
  </div>
  <div class="form-group">
    <label class="" for="block_number">Table:</label>
    <input class="form-control" type="text" value="<?php echo $assetsGrid->table_number; ?>" name="block_number" disabled="true">
  </div>
  <div class="form-group">
    <label class="" for="block_number">Panel:</label>
    <input class="form-control" type="text" value="<?php echo $assetsGrid->panel_number; ?>" name="block_number" disabled="true">
  </div>
  <div class="form-group">
    <label class="" for="block_number">Position:</label>
    <input class="form-control" type="text" value="<?php echo $assetsGrid->panel_position; ?>" name="block_number" disabled="true">
  </div>
  </div>
  <div class="col-md-5">
    <?php
      foreach ($assetsGrid->asset as $asset){
    ?>
    <input type="hidden" name="assets_id" value="<?php echo $asset->id; ?>">
    <div class="form-group">
      <label class="" for="seriel_number">Seriel #:</label>
      <input class="form-control" type="text" value="<?php echo $asset->seriel_no; ?>" name="seriel_number" required>
    </div>
    <div class="form-group">
      <label class="" for="voltages">Voltages:</label>
      <input class="form-control" type="number"  step="any" value="<?php echo $asset->voltages; ?>" name="voltages" required>
    </div>
    <input class="btn btn-primary" name="save_record" type="submit" value="save"/>
    <?php
      }
    ?>
  </div>
</form>

</div>
<?php include 'footer.php';?>
