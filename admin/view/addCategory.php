<?php

include "../view/header.php";
include "../view/sidebar.php";
include "../view/navbar.php";
include "../../Conn.php";
?>
<?php 
if (isset($_POST['addCategory'])){
    $title = $_POST['title'];
    if ($title==""){
      echo "title is required";
    }else{
      $checkTitle = "SELECT * FROM `categories` WHERE `title` ='$title'";
      $runCheckTitle = mysqli_query($conn,$checkTitle);

      $titleRows = mysqli_num_rows($runCheckTitle);

      if($titleRows>0){
        echo 'category is exist';
      }else{
        $addCat = "insert into `categories`(`title`) values ('$title')";
        $runAddCategory = mysqli_query($conn , $addCat);
         if($runAddCategory){
          echo"category inserted successfully ";
         }else {
          echo "category inserted failed ";
         }
      }
    }
}

?>


              <div class="card-body px-5 py-5">
                <h3 class="card-title text-left mb-3">Add Category</h3>
                <form method="POST" action="addCategory.php">
                  <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control p_input text-light">
                  </div>
                  <div class="text-center">
                    <button type="submit" name="addCategory" class="btn btn-primary btn-block enter-btn">Add</button>
                  </div>
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

<?php 
include "../view/footer.php";
 ?>