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
<section class="" id="">
    <div class="container">
      <div class="row">
          <h2>Record Details - <a class="btn" href="<?php echo "/qsams/edit.php?record_id=".$assetsGrid->id; ?>" > <h5>Edit Active</h5></a></h2>
          <hr/>
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
              echo "<h4>Current</h4>";
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
              if(sizeof($assetsGrid->asset)>1 ){
                echo "<h4>Previous</h4>";
              }
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
    </div>
</section>
<?php include 'footer.php'; ?>
