<?php ob_start();
include 'header.php';
if (!isset($_SESSION['email']))
{
 header("Location: index.php");
 die();
}
$users = Users::all();
$user = Users::find(array('conditions' => array('email = ?', $_SESSION['email']),'limit' => 1));
?>
<!-- Contact Section -->
<section id="" style="height:90vh">
    <div class="container" style="margin-top:50px">
        <div class="row">
            <div class="col-lg-4">
                <div class="">
                    <div class="">
                      <h4>Email: <?php echo $user->email; ?></h4>
                    </div>
                </div>
                <div class="">
                    <div class="">
                      <h4>Role: <?php echo $user->role; ?></h4>
                    </div>
                </div>
                <form method="post">
                  <div class="row control-group">
                      <div class="form-group col-xs-12 floating-label-form-group controls">
                          <label>Current Password</label>
                          <input type="password" name="current_password" class="form-control" required placeholder="Your Current Password">
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
                    if(isset($_REQUEST["update_password"] )){
                      if( $_REQUEST["current_password"] != "" && $_REQUEST["new_password"] != "" && $_REQUEST["new_password_r"] != "" )
                      {
                        if( $_REQUEST["current_password"] == $user->password && $_REQUEST["new_password"] ==  $_REQUEST["new_password_r"] )
                        {
                          $user->update_attributes(array(
                            "password"=>$_REQUEST["new_password"]
                          ));
                          echo '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:20px">
                          <div class="alert alert-success alert-success ">
                          <a href="#" class="close" data-dismiss="alert">&times;</a>
                          <strong>Sucess!</strong>Password updated sucessfully.
                          </div>
                          </div>
                          </div>';
                          header("Refresh: 0.1;url=profile.php");
                        }else{
                          echo '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:20px">
                          <div class="alert alert-danger alert-error ">
                          <a href="#" class="close" data-dismiss="alert">&times;</a>
                          <strong>Error!</strong> Wrong passwords or password does not match.
                          </div>
                          </div>
                          </div>';
                        }

                      }else{
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
            <div class="col-lg-4 col-lg-offset-2">
              <?php
                if(sizeof($users) > 1){
                  echo " <form method='post'>
                            <select class='form-control' name='user_id'>";
                            for($i = 0 ; $i < sizeof($users) ; $i++ ) {
                              if($users[$i]->role !="Admin"){
                            ?>
                              <option value="<?php echo $users[$i]->id; ?>"><?php echo $users[$i]->email ?></option>
                            <?php
                              }
                            }
                  echo "    </select>
                          <br/>
                          <button class='btn btn-success' name='new_user'>Add Users</button>
                         </form>";
                }else{
                echo " <form method='post'>
                          <button name='new_user'>Add Users</button>
                       </form>
                     ";
                }
                  if(isset($_POST["new_user"]) || isset($_REQUEST["add_user"] )){
                  ?>
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
                      if(isset($_REQUEST["add_user"] )){
                        if( $_REQUEST["email"] != "" && $_REQUEST["new_password"] != "" && $_REQUEST["new_password_r"] != "" )
                        {
                          if( $_REQUEST["new_password"] ==  $_REQUEST["new_password_r"] )
                          {

                              $user_find = Users::find(array('conditions' => array('email = ?', $_REQUEST['email']),'limit' => 1));
                              if($user_find){
                                echo '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:20px">
                                <div class="alert alert-danger alert-error ">
                                <a href="#" class="close" data-dismiss="alert">&times;</a>
                                <strong>Error!</strong>User Already exits.
                                </div>
                                </div>
                                </div>';
                              }else{
                                try{
                                Users::create(array(
                                  "email"=>$_REQUEST["email"],
                                  "password"=>$_REQUEST["new_password"],
                                  "role" => "Standard"
                                ));
                                }catch(Exception $e){
                                  echo $e;
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
                          }else{
                            echo '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:20px">
                            <div class="alert alert-danger alert-error ">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <strong>Error!</strong>password does not match.
                            </div>
                            </div>
                            </div>';
                          }

                        }else{
                          echo '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:20px">
                          <div class="alert alert-danger alert-error ">
                          <a href="#" class="close" data-dismiss="alert">&times;</a>
                          <strong>Error!</strong> Please Enter all the fields.
                          </div>
                          </div>
                          </div>';
                        }
                      }
                      ?>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-12">
                            <button type="submit" name="add_user" class="btn btn-success btn-lg button">Add User</button>
                        </div>
                    </div>
                </form>
                <?php
                  }
                ?>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
