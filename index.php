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
          <div class="col-lg-4 col-lg-offset-4 login-form" >

                <form  method="post" style="margin: 40px">
                    <div class="group">
                        <input type="email" placeholder="Email" name="email" required="required"><span class="highlight"></span><span class="bar"></span>
                    </div>
                    <div class="group">
                        <input type="password" name="password" placeholder="Password" required="required"><span class="highlight"></span><span class="bar"></span>
                    </div>
                    <button type="submit" name="login" class="button btn-success">
                        Login
                        <div class="ripples buttonRipples">
                            <span class="ripplesCircle"></span>
                        </div>
                    </button>
                    <div style="text-align:center;" >

                        <?php
                        if (isset($_REQUEST['login']))
                        {
                          echo "here";
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
              </form>
          </div>
    </div>
</div>
</header>


<?php include 'footer.php'; ?>
