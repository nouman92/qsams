<?php ob_start();
include 'header.php';
if (!isset($_SESSION['email']))
{
 header("Location: index.php");
 die();
}
$user = Users::find(array('conditions' => array('email = ?', $_SESSION['email']),'limit' => 1));
?>
<!-- Contact Section -->
<section id="" style="height:100vh">
    <hr/>
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="row control-group">
                    <div class="">
                      <h4>Email: <?php echo $user->email; ?></h4>
                    </div>
                </div>
                <div class="row control-group">
                    <div class="">
                      <h4>Role: <?php echo $user->role; ?></h4>
                    </div>
                </div>
                <form method="post">
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Name</label>
                            <input type="text" class="form-control" value="<?php echo $user->name;?>" name="name" required placeholder="Your Name">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Phone</label>
                            <input type="text" class="form-control" value="<?php echo $user->phone;?>" name="phone" required placeholder="Your Phone">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <br/>
                    <div id="success">
                      <?php
                      if(isset($_REQUEST["save_data"] )){
                        if( $_REQUEST["name"] != "" && $_REQUEST["phone"] != "" )
                        {
                            $user->update_attributes(array(
                              "name"=>$_REQUEST["name"],
                              "phone"=>$_REQUEST["phone"]
                            ));
                            echo '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:20px">
                            <div class="alert alert-success alert-success ">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <strong>Sucess!</strong>Data updated sucessfully.
                            </div>
                            </div>
                            </div>';
                            header("Refresh: 0.1;url=profile.php");
                        }else{
                          echo '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:20px">
                                  <div class="alert alert-danger alert-error ">
                                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                                        <strong>Error!</strong> Please Enter all the Data.
                                  </div>
                          </div>
                          </div>';
                        }
                      }
                      ?>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-12">
                            <button type="submit" name="save_data" class="btn btn-success btn-lg">Update Data</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-lg-offset-2">
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
                        <button type="submit" name="update_password" class="btn btn-success btn-lg">Update Password</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
