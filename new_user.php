<form method="post">
  <div class="row control-group">
      <div class="form-group col-xs-12 floating-label-form-group controls">
          <label>User Email</label>
          <input type="email"  name="email" class="form-control" required placeholder="New User Email">
          <p class="help-block text-danger"></p>
      </div>
  </div>
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
    if (isset($_REQUEST["add_user"])) {
        if ($_REQUEST["email"] != "" && $_REQUEST["new_password"] != "" && $_REQUEST["new_password_r"] != "") {
            if ($_REQUEST["new_password"] ==  $_REQUEST["new_password_r"]) {
                $user_find = Users::find(array('conditions' => array('email = ?', $_REQUEST['email']),'limit' => 1));
                if ($user_find) {
                    echo '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:20px">
              <div class="alert alert-danger alert-error ">
              <a href="#" class="close" data-dismiss="alert">&times;</a>
              <strong>Error!</strong>User Already exits.
              </div>
              </div>
              </div>';
                } else {
                    try {
                        Users::create(array(
                "email"=>$_REQUEST["email"],
                "password"=>$_REQUEST["new_password"],
                "role" => "Standard"
              ));
                    } catch (Exception $e) {
                        error_log($e);
                    }
                    echo '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:20px">
              <div class="alert alert-success alert-success ">
              <a href="#" class="close" data-dismiss="alert">&times;</a>
              <strong>Sucess!</strong>User Added sucessfully.
              </div>
              </div>
              </div>';
                    header("Refresh: 0.1;url=profile.php");
                }
            } else {
                echo '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:20px">
          <div class="alert alert-danger alert-error ">
          <a href="#" class="close" data-dismiss="alert">&times;</a>
          <strong>Error!</strong>password does not match.
          </div>
          </div>
          </div>';
            }
        } else {
            echo '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:20px">
        <div class="alert alert-danger alert-error ">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Error!</strong> Please Enter all the fields.
        </div>
        </div>
        </div>';
        }
    } ?>
  </div>
  <div class="row">
      <div class="form-group col-xs-12">
          <button type="submit" name="add_user" class="btn btn-success btn-lg button">Add User</button>
      </div>
  </div>
</form>
