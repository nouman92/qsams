<?php $user = Users::find(array('conditions' => array('email = ?', $user_email ),'limit' => 1)); ?>
<div class="col-lg-4 col-lg-offset-2">
  <div class="">
      <div class="">
        <p>Email: <span><b><?php echo $user->email; ?></b></span></p>
      </div>
  </div>
  <div class="">
      <div class="">
        <p>Role:  <span><b><?php echo $user->role; ?></b></span></p>
      </div>
  </div>
  <form method="post">
    <?php if($user->role == "Admin" || $_SESSION['role'] == "Standard"){?>
      <div class="row control-group">
          <div class="form-group col-xs-12 floating-label-form-group controls">
              <label>Current Password</label>
              <input type="password" name="current_password" class="form-control" required placeholder="Current Password">
              <p class="help-block text-danger"></p>
          </div>
      </div>
    <?php }?>
    <input type="hidden" name="require_current_password" class="form-control" value="<?php if($user->role == "Admin" || $_SESSION['role'] == "Standard") echo "1"; else echo "0";?>">
    <input type="hidden" name="user_email" class="form-control" value="<?php echo $user->email; ?>">
    <div class="row control-group">
        <div class="form-group col-xs-12 floating-label-form-group controls">
            <label>New Password</label>
            <input type="password" name="new_password" class="form-control" required placeholder="New Password">
            <p class="help-block text-danger"></p>
        </div>
    </div>
    <div class="row control-group">
        <div class="form-group col-xs-12 floating-label-form-group controls">
            <label>Repeat Password</label>
            <input type="password" name="new_password_r"class="form-control" required placeholder="Repeat New Passoword">
            <p class="help-block text-danger"></p>
        </div>
    </div>
    <br>
    <div id="success">
      <?php
      if (isset($_REQUEST["update_password"])) {
          $user1 = Users::find(array('conditions' => array('email = ?', $_REQUEST["user_email"] ),'limit' => 1));

          if ( ($_REQUEST["current_password"] != "" || !$_REQUEST["require_current_password"] ) && $_REQUEST["new_password"] != "" && $_REQUEST["new_password_r"] != "") {
              if (($_REQUEST["current_password"] == $user1->password || !$_REQUEST["require_current_password"]   )&& $_REQUEST["new_password"] ==  $_REQUEST["new_password_r"]) {
                  $user1->update_attributes(array(
              "password"=>$_REQUEST["new_password"]
            ));
                  echo '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:20px">
            <div class="alert alert-success alert-success ">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Sucess!</strong>Password updated sucessfully.
            </div>
            </div>
            </div>';
                  header("Refresh: 0.2;url=profile.php");
              } else {
                  echo '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:20px">
            <div class="alert alert-danger alert-error ">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Error!</strong> Wrong passwords or password does not match.
            </div>
            </div>
            </div>';
              }
          } else {
              echo '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:20px">
          <div class="alert alert-danger alert-error ">
          <a href="#" class="close" data-dismiss="alert">&times;</a>
          <strong>Error!</strong> Please Enter all the Password.
          </div>
          </div>
          </div>';
          }
      }
      ?>
    </div>
    <div class="row">
        <div class="form-group col-xs-12">
            <button type="submit" name="update_password" class="btn btn-success btn-lg button">Update Password</button>
        </div>
    </div>
  </form>
</div>
