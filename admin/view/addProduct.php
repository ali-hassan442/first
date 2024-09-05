<?php

include "../view/header.php";

include "../view/sidebar.php";
include "../view/navbar.php";
include "../../conn.php";
?>

      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">
              <?php 
              
              if(isset($_POST['addProduct'])){
                extract($_POST);
                $img = $_FILES['img'];
                $imgName = $img['name'];
                $tmpName = $img['tmp_name'];
                $imgSize = $img['size']/1024*1024;
                $imgExt = pathinfo($imgExt,PATHINFO_EXTENSION);
                $extensions = ['jpg','png','jpeg'];

                if($category=="" || $title=="" || $desc=="" || $price=="" || $quantity==""){
                  echo "all inputs is required";
                }elseif(! in_array($imgExt,$extensions)){
                  echo " choose an image";
                }else{
                  $checkCategory = "SELECT `title` FROM `categories` where `title` = '$title'";
                  $runCheckCategory = mysqli_query($conn , $checkCategory);
                  $categoryRows = mysqli_num_rows($runCheckCategory);
                  if ($categoryRows > 0) {
                  $checkTitle = "SELECT `name` FROM `products` where `name` = '$title'";
                  $runCheckTitle = mysqli_query($conn , $checkTitle);
                  $titleRows = mysqli_num_rows($runCheckTitle);
                    if ($titleRows > 0){
                    echo "product is exist";
                    }else {
                    $selectCatId= "select id from categories where title ='$category'";
                    $runSelectId= mysqli_query($conn , $selectCatId);
                    $fetchId= mysqli_fetch_assoc($runSelectId);
                    $categoryId = $fetchId['id'];
                    $addProduct = "insert into `products` (`name`,`desc`,`price`,`image`,`quantity`,`category_id` ) values ('$name','$desc','$price','$image','$quantity','$categoryId')";
                    $runAddProduct = mysqli_query($conn , $addProduct);
                    move_uploaded_file($tmpName,'../upload'.$imgName);
                    if($runAddProduct){
                      echo "product added successfully";
                    }else{
                      echo "product added failed";
                    }


                    }
                  }
                }
              }
 ?>


              <div class="card-body px-5 py-5">
                <h3 class="card-title text-left mb-3">Add Product</h3>
                <form method="POST" action="addProduct.php" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>Category</label>
                    <input type="text" name="category" class="form-control p_input">
                  </div>
                  <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control p_input">
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <input type="text" name="desc" class="form-control p_input">
                  </div>
                  <div class="form-group">
                    <label>Price</label>
                    <input type="number" name="price" class="form-control p_input">
                  </div>
                  <div class="form-group">
                    <label>Quantity</label>
                    <input type="number" name="quantity" class="form-control p_input">
                  </div>
                  <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="img" class="form-control p_input">
                  </div>
                  <div class="text-center">
                    <button type="submit" name="addProduct" class="btn btn-primary btn-block enter-btn">Add</button>
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