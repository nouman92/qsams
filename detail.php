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
  <h2>Record Details - <a class="btn" href="<?php echo "/qsams/edit.php?record_id=".$assetsGrid->id; ?>" > Edit</a></h2>
  <hr/>
  <div>
    <table class="table table-striped text-left">
        <tr >
            <th class="text-left">Block # </th>
            <td class="text-left text-info">
              <?php
              echo $assetsGrid->block_number;
              ?>
            </td>
            <th class="text-left">Row # </th>
            <td class="text-left text-info">
              <?php
              echo $assetsGrid->row_number;
              ?>
            </td>
            <th class="text-left">Table # </th>
            <td class="text-left text-info">
              <?php
              echo $assetsGrid->table_number;
              ?>
            </td>
            <th class="text-left">Panel # </th>
            <td class="text-left text-info">
              <?php
              echo $assetsGrid->panel_number;
              ?>
            </td>
            <th class="text-left">Position</th>
            <td class="text-left text-info">
              <?php
              echo $assetsGrid->panel_position;
              ?>
            </td>
           </tr>
         </table>
  </div>
  <hr/>
  <?php
    $active_asset;
    foreach ($assetsGrid->asset as $asset){
      if($asset->active == 1)
        $active_asset = $asset;
    }
  ?>
  <div class="row">
    <?php if($active_asset){
      echo "<h3>Active Asset</h3>";
    }?>
    <div class="col-md-5">
    <table class="table table-bordered table-hover table-striped">
        <tr>
          <th class="text-left text-info">Seriel #</th>
          <td class="text-right">
            <?php
            echo $active_asset->seriel_no;
            ?>
          </td>
        </tr>
        <tr>
            <th class="text-left text-info">V oc</th>
            <td class="text-right">
              <?php
              echo $active_asset->v_oc;
              ?>
             </td>
        </tr>
        <tr>
            <th class="text-left text-info">I sc</th>
            <td class="text-right">
              <?php
              echo $active_asset->i_sc;
              ?>
             </td>
        </tr>
        <tr>
            <th class="text-left text-info">V mppt</th>
            <td class="text-right">
              <?php
              echo $active_asset->v_mppt;
              ?>
             </td>
        </tr>
        <tr>
            <th class="text-left text-info">I mppt</th>
            <td class="text-right">
              <?php
              echo $active_asset->i_mppt;
              ?>
             </td>
        </tr>
        <tr>
            <th class="text-left text-info">Max power</th>
            <td class="text-right">
              <?php
              echo $active_asset->max_power;
              ?>
             </td>
        </tr>
        <tr>
            <th class="text-left text-info">Fill factor</th>
            <td class="text-right">
              <?php
              echo $active_asset->fill_factor;
              ?>
             </td>
        </tr>
      </table>
  </div>
  </div>
  <hr/>
  <div class="row">
    <?php
      foreach ($assetsGrid->asset as $asset){
        if($asset->active == 0){
    ?>
    <div class="col-md-5">
      <table class="table table-bordered table-hover table-striped">
          <tr>
            <th class="text-left text-info">inactive - Replaced</th>
            <td class="text-right">
              <?php
              echo $asset->removed->format('Y-m-d');
              ?>
            </td>
          </tr>
          <tr>
            <th class="text-left text-info">Seriel #</th>
            <td class="text-right">
              <?php
              echo $asset->seriel_no;
              ?>
            </td>
          </tr>
          <tr>
              <th class="text-left text-info">V oc</th>
              <td class="text-right">
                <?php
                echo $asset->v_oc;
                ?>
               </td>
          </tr>
          <tr>
              <th class="text-left text-info">I sc</th>
              <td class="text-right">
                <?php
                echo $asset->i_sc;
                ?>
               </td>
          </tr>
          <tr>
              <th class="text-left text-info">V mppt</th>
              <td class="text-right">
                <?php
                echo $asset->v_mppt;
                ?>
               </td>
          </tr>
          <tr>
              <th class="text-left text-info">I mppt</th>
              <td class="text-right">
                <?php
                echo $asset->i_mppt;
                ?>
               </td>
          </tr>
          <tr>
              <th class="text-left text-info">Max power</th>
              <td class="text-right">
                <?php
                echo $asset->max_power;
                ?>
               </td>
          </tr>
          <tr>
              <th class="text-left text-info">Fill factor</th>
              <td class="text-right">
                <?php
                echo $asset->fill_factor;
                ?>
               </td>
          </tr>
        </table>
    </div>
    <?php
        }
      }
    ?>
  </div>
</div>
