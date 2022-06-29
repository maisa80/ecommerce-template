<?php
require '../../src/config.php';
$pageTitle = 'Create product';
$pageId = 'createProduct';
ini_set('display_errors', 1);

$title          = '';
$description    = '';
$price          = '';
$stock          = '';
$error          = '';
$msg            = '';
$newPathAndName = '';
$img_url        = '';

if (isset($_POST['add'])) {
    $title       = trim($_POST['title']);
    $description = trim($_POST['description']);
    $stock       = trim($_POST['stock']);
    $price       = trim($_POST['price']);
  
    

    // Upload image  
    // Get the file name and extension
    if (is_uploaded_file($_FILES['upload']['tmp_name'])) {
        //this is the actual name of the file
        $fileName = $_FILES['upload']['name'];
        //this is the file type
        $fileType = $_FILES['upload']['type'];
        //this is the temporary name of the file
        $fileTempName = $_FILES['upload']['tmp_name'];
        //this is the path where you want to save the actual file
        $path = "img/";
        //this is the actual path and actual name of the file
        $newPathAndName = $path . $fileName;

        // Check if the file is an image                
        $allowedFileTypes = [
            'image/jpg',
            'image/jpeg',
            'image/gif',
            'image/png',
        ];

        $isFileTypeAllowed = array_search($fileType, $allowedFileTypes, true);
        if ($isFileTypeAllowed === false) {
            $error .= "The file type is invalid. Allowed types are jpeg, png, gif. <br>";
        }

        /** File size error handling **/
        if ($_FILES['upload']['size'] > 1000000) { // Allows only files under 1 mbyte
            $error .= 'Exceeded filesize limit.<br>';
        }
    
    if (empty($error)) {
      $isTheFileUploaded = move_uploaded_file($fileTempName, $newPathAndName);

      if ($isTheFileUploaded) {
          // Success the file is uploaded
          $img_url = $newPathAndName;
      } else {
          // Could not upload the file
          $error = "Could not upload the file";
      }
    }
  }


  if (empty($title)) {
    $error .= "<p>Title is mandatory</p>";
  }

  if (empty($description)) {
    $error .= "<p>Description is mandatory</p>";
  }

  if (empty($price)) {
    $error .= "<p>Price is mandatory</p>";
  }
  if (empty($stock)) {
    $error .= "<p>Stock is mandatory</p>";
  }
  if (empty($img_url)) {
    $error .= "<p>Product's image is mandatory</p>";
  }
  if ($error) {
    $msg = "<div class='alert alert-danger alert-dismissible d-flex align-items-center fade show'>
    <i class='bi-check-circle-fill'></i><ul>{$error}</ul>
    <button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
  }
  if (empty($error)) {
      try {
        
        $productDbHandler->addProduct($title, $description, $price, $stock, $img_url);
      } catch (\PDOException$e) {
          throw new \PDOException($e->getMessage(), (int) $e->getCode());
      }
          $msg = '<div class="alert alert-success alert-dismissible d-flex align-items-center fade show">
          <i class="bi-check-circle-fill"></i>
          <strong class="mx-2">Success!</strong> The product was successfully created.
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      ';
  }
 
}
$products = $productDbHandler->fetchAllProducts();

?>

<?php include 'layout/header.php';?>
<div id="content">
    <!-- Add new products -->
    <div class="d-flex flex-column py-6">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="col">
                <?=$msg?>
            </div>
            <div class="row">
                <div class="col">
                <h4>Add product</h4>

                    <input type="text" class="text form-control" name="title" placeholder="Title">

                    </br>

                    <form action="products.php?" method="POST">
                        <input type="file" class="btn py-2 px-0" name="upload" value="" />
                    </form>

                    </br>

                    <textarea type="text" class="text form-control" name="description" placeholder="Description"
                        rows="5" cols="60" style="resize:none"></textarea>

                    </br>

                    <input type="number" class="text form-control" name="price" value="1" min="0">
                    </br>
                    <input type="number" class="text form-control" name="stock" value="1" min="0">
                    </br>
                    <button class="btn btn-warning" name="add">Add product</button>
                </div>

        </form>


    </div>
</div>

<?php include 'layout/footer.php';?>