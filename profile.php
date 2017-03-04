<?php ob_start();
include 'header.php';
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    die();
}
?>
<!-- Contact Section -->
<section id="" style="height:90vh">
    <div class="container" style="margin-top:50px">
        <div class="row">
            <div class="col-lg-4">
              <?php
                $users = Users::all();
                if (sizeof($users) > 1) {
                    echo " <form method='post'>
                            <select class='form-control' name='user_email'>";
                    for ($i = 0 ; $i < sizeof($users) ; $i++) {
                        if ($users[$i]->role !="Admin") {
                            ?>
                              <option value="<?php echo $users[$i]->email; ?>"><?php echo $users[$i]->email ?></option>
                            <?php
                        }
                    }
                    echo "    </select>";
                    if (!isset($_REQUEST["update_user"])) {
                        echo "     <br/>
                                    <button class='btn btn-success' name='new_user'>Add Users</button>
                                    <button class='btn btn-success' name='update_user'>Update Users</button>";
                    }
                    echo       "</form>";
                } else {
                    echo "<form method='post'>
                            <button name='new_user'>Add Users</button>
                         </form>
                       ";
                }
                if (isset($_POST["new_user"]) || isset($_POST["add_user"])) {
                    include 'new_user.php';
                }
                ?>
            </div>
            <?php
            if (isset($_REQUEST["update_user"])) {
              $user_email = $_REQUEST["user_email"];
            }else{
              $user_email = $_SESSION['email'];
            }
            include 'update_password.php';
            ?>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
