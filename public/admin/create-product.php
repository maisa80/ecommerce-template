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
    $error .= "<li>Title is mandatory</li>";
  }

  if (empty($description)) {
    $error .= "<li>Description is mandatory</li>";
  }

  if (empty($price)) {
    $error .= "<li>Price is mandatory</li>";
  }
  if (empty($stock)) {
    $error .= "<li>Stock is mandatory</li>";
  }
  if (empty($img_url)) {
    $error .= "<li>Product's image is mandatory</li>";
  }
  


if(filter_var($price, FILTER_VALIDATE_INT) == false) {
  $error .= "<li>The price must be numbers only </li>";
}

if(filter_var($stock, FILTER_VALIDATE_INT) == false) {
  $error .= "<li>The stock  must be numbers only </li>";
}
  if ($error) {
    $msg = "<div class='alert alert-danger alert-dismissible d-flex align-items-center fade show'>
    <i class='bi-check-circle-fill'></i><ul>{$error}</ul>
    <button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
  }
if (empty($error)) {
    // INSERT INTO/ UPDATE
    $productData = [
        'title'      => $title,
        'description'    => $description,
        'price'     => $price,
        'stock'         => $stock,
        'img_url'         => $img_url
    ];

    $result = ($productData);

    if ($result) {
        
        $productDbHandler->addProduct(
          $title,
          $description,
          $price,
          $stock,
          $img_url
        );
     
          $msg = '<div class="alert alert-success alert-dismissible d-flex align-items-center fade show">
          <i class="bi-check-circle-fill"></i>
          <strong class="mx-2">Success!</strong> The product was successfully created.
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      ';
    } else {
      $msg = $error;
  }

} 
}
$products = $productDbHandler->fetchAllProducts();

?>

<?php include 'layout/header.php';?>
<div id="content">
<h5>Add product</h5>
<?=$msg?>
    <!-- Add new products -->
    <form action="" method="POST" enctype="multipart/form-data">
    <div class="col">
     
      <input type="text" class="text form-control" name="title" placeholder="Title">
      <br>
      <form action="products.php?" method="POST">
        <input type="file" class="btn py-2 px-0" name="upload" value="" />
      </form>
      <br>
      <textarea type="text" class="text form-control" name="description" placeholder="Description" rows="5" cols="60" style="resize:none"></textarea>
      <br>

      <input type="text" class="text form-control" name="price" placeholder="Price">
      <br>
      <input type="text" class="text form-control" name="stock" placeholder="Stock">
      <br>
      <button class="btn btn-warning" name="add">Add product</button>
    </div>
  </form>
  <br>
    <a href="products.php"><i class="fas fa-angle-left"></i> Back</a>
</div>
<?php include('layout/footer.php'); ?>