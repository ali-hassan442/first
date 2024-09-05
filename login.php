<?php include 'header.php'; ?>
<?php include 'navbar.php';?>
<?php include "conn.php";  ?>

<?php 
if(isset($_POST['login'])){
  extract($_POST);
  
  if($email == "" || $password == ""){
    echo "email and password are required";

    $fEmail = "select * from `users` where `email` = '$email'";
    $runQuery = mysqli_query($conn,$fEmail);

    $result = mysqli_fetch_assoc($runQuery);
    $hashedPassword = $result['password'] ;
    if (count($result)>0){
      if (password_verify($password,$hashedPassword)){
        $role = $result['role'];
        if ($role == 'admin'){
          header('location: admin/view/layout.php');
        }else {
          $userLoggedIn = true ;

          setcookie ("userLoggedIn",$userLoggedIn,time()+60*60*24*14);
          header("location: shop.php");
        }

      }else{
        echo "invalid password";
      }


    }else {

      echo "email invalid";
    }
  }
}

?>
<div class="card-body px-5 py-5" style="background-color:darkgray;">



            
              
                <h3 class="card-title text-left mb-3">Login</h3>
                <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                  <div class="form-group">
                    <label>email *</label>
                    <input type="email" name="email" class="form-control p_input" >
                  </div>
                  <div class="form-group">
                    <label>Password *</label>
                    <input type="text" name="password" class="form-control p_input" >
                  </div>
                  <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input"> Remember me </label>
                    </div>
                    <a href="forgetPassword.php" class="forgot-pass">Forgot password</a>
                  </div>
                  <div class="text-center">
                    <button type="submit" name="login" class="btn btn-primary btn-block enter-btn">Login</button>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-facebook me-2 col">
                      <i class="mdi mdi-facebook"></i> Facebook </button>
                    <button class="btn btn-google col">
                      <i class="mdi mdi-google-plus"></i> Google plus </button>
                  </div>
                  <p class="sign-up">Don't have an Account?<a href="signup.php"> Sign Up</a></p>
                </form>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>

    <?php include "footer.php" ?>


    //table user, product, cart ,, review comment , rating  = session