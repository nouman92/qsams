<?php include 'header.php';
if (isset($_SESSION['email']))
{
 header("Location: records.php");
 die();
}
?>
<div class="container">
    <div class="row ">
        <div class="col-md-offset-4 col-md-4 jumbotron">
           <h3>Login:</h3>
          <form class="" method="post" action="/qsams/">
            <div class="form-group">
              <label for="email"> Username:
                  <input type="text" name="email" id="email" placeholder="Email" required="required"/>
              </label>
            </div>
              <div class="form-group">
              <label for="password"> Password:
                  <input type="password" name="password" id="password" placeholder="Password" required="required"/>
              </label>
            </div>
              <button name="login" type="submit" class="btn btn-primary">
                Sign in
              </button>
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
          </form>
        </div>
    </div>
</div>

<?php include 'footer.php';?>
