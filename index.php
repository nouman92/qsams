<?php
include 'header.php';
if (isset($_SESSION['email']))
{
 header("Location: records.php");
 die();
}
?>
<header>
<div class="container">
    <div class="row">
          <div class="col-lg-4 col-lg-offset-4" style="background: white;">
              <form method="post" style="margin: 50px">
                  <div class="row control-group">
                      <div class="form-group col-xs-12 floating-label-form-group controls">
                          <label>Email Address</label>
                          <input type="email" name="email" class="form-control" placeholder="Email Address" id="email" required data-validation-required-message="Please enter your email address.">
                          <p class="help-block text-danger"></p>
                      </div>
                  </div>
                  <div class="row control-group">
                      <div class="form-group col-xs-12 floating-label-form-group controls">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" id="password" required data-validation-required-message="Please enter your password.">
                          <p class="help-block text-danger"></p>
                      </div>
                  </div>
                  <br>
                  <div id="success">
                    <?php
                    if (isset($_REQUEST['login']))
                    {
                      if($_REQUEST['email'] == "" )
                      {
                        echo '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:20px">
                        <div class="alert alert-danger alert-error ">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Error!</strong> Please Enter the Email.
                        </div>
                        </div>
                        </div>';
                      }
                      else if (!filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL))
                      {
                        echo '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:20px">
                        <div class="alert alert-danger alert-error ">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Error!</strong>Please enter a valid Email.
                        </div>
                        </div>
                        </div>';
                      }
                      else if($_REQUEST['password']=="")
                      {
                        echo '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:20px">
                        <div class="alert alert-danger alert-error ">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Error!</strong> Please Enter the Password.
                        </div>
                        </div>
                        </div>';
                      }
                      else
                      {
                        try{
                        $users = Users::all(array('conditions' => array('email = ? AND password = ?', $_REQUEST['email'], $_REQUEST['password']),'limit' => 1));
                       }catch(Exception $ed){
                         echo $ed;
                       }
                        if(sizeof($users) > 0)
                        {
                           $_SESSION['email'] = $users[0]->email;
                           $_SESSION['name'] = $users[0]->name;
                           $_SESSION['role'] = $users[0]->role;
                           header("Location: records.php");
                        }
                        else
                        {
                          echo '<div class="alert alert-danger alert-error ">
                           <a href="#" class="close" data-dismiss="alert">&times;</a>
                           <strong>Error!</strong> Invalid email or password.</div>';
                        }
                      }
                    }
                    ?>
                  </div>
                  <div class="row">
                      <div class="form-group col-xs-12">
                          <button type="submit" class="btn btn-success btn-lg" name="login">Login</button>
                      </div>
                  </div>
              </form>
          </div>
    </div>
</div>
</header>


<?php include 'footer.php'; ?>
