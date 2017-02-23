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
?>

<div class="container">
  <h2>Record Details - <a class="btn" href="<?php echo "/qsams/edit.php?record_id=".$assetsGrid->id; ?>" > Edit</a>
</h2>

  <hr/>
  <?php
    foreach ($assetsGrid->asset as $asset){
  ?>
  <div class="col-md-10">
    <div class="col-md-6">
      <table class="table table-hover">
          <tr >
              <th class="text-left text-info">Block # </th>
              <td class="text-right">
                <?php
                echo $assetsGrid->block_number;
                ?>
               </td>
          </tr>
          <tr >
              <th class="text-left text-info">Row # </th>
              <td class="text-right">
                <?php
                echo $assetsGrid->row_number;
                ?>
               </td>
          </tr>
          <tr >
              <th class="text-left text-info">Table # </th>
              <td class="text-right">
                <?php
                echo $assetsGrid->table_number;
                ?>
               </td>
          </tr>
          <tr >
              <th class="text-left text-info">Panel # </th>
              <td class="text-right">
                <?php
                echo $assetsGrid->panel_number;
                ?>
               </td>
          </tr>
          <tr >
              <th class="text-left text-info">Position</th>
              <td class="text-right">
                <?php
                echo $assetsGrid->panel_position;
                ?>
               </td>
          </tr>
          <tr >
              <th class="text-left text-info">Seriel #</th>
              <td class="text-right">
                <?php
                echo $asset->seriel_no;
                ?>
               </td>
          </tr>
          <tr >
              <th class="text-left text-info">Voltages</th>
              <td class="text-right">
                <?php
                echo $asset->voltages;
                ?>
               </td>
          </tr>
      </table>
    </div>
    <div class="col-md-4">
    </div>
  </div>
  <?php
    }
  ?>
</div>

<?php include 'footer.php';?>
