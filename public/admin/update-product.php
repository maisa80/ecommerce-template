<?php
  require('../../src/config.php');
  $pageTitle = 'Update product';
  $pageId = 'UpdateProduct';
  //  ini_set('display_errors', 1);

  // debug($_POST);
  $msg         = '';
  $error       = '';
  $title       = '';
  $description = '';
  $price       = '';
  $stock       = '';
  $img_url   = '';


  if (isset($_POST['uploadBtn'])) {
  $title       = trim($_POST['title']);
  $description = trim($_POST['description']);
  $price       = trim($_POST['price']);
  $stock       = trim($_POST['stock']);
  $img_url     = trim($_POST['img_url']);
 
    if (is_uploaded_file($_FILES['uploadedFile']['tmp_name'])) {
        // Get the file name and size
        $fileName = $_FILES['uploadedFile']['name'];
        $fileType = $_FILES['uploadedFile']['type'];
        $fileTempPath = $_FILES['uploadedFile']['tmp_name'];
        $path = "img/";
        // Check if the file is an image
        $newFilePath = $path . $fileName;

        /** File type error handling **/
        $allowedFileTypes = [
            'image/png',
            'image/jpeg',
            'image/gif',
        ];

        $isFileTypeAllowed = array_search($fileType, $allowedFileTypes, true);
        if ($isFileTypeAllowed === false) {
            $error .= "The file type is invalid. Allowed types are jpeg, png, gif. <br>";
        }

        /** File size error handling **/
        if ($_FILES['uploadedFile']['size'] > 1000000) { // Allows only files under 1 mbyte
            $error .= 'Exceeded filesize limit.<br>';
        }

        if (empty($error)) {
            $isTheFileUploaded = move_uploaded_file($fileTempPath, $newFilePath);

            if ($isTheFileUploaded) {
                // Success the file is uploaded
                $img_url = $newFilePath;
            } else {
                // Could not upload the file
                $error = "Could not upload the file";
            }
        }
    }
    if (empty($error)) {
        // INSERT INTO/ UPDATE
        $productDbHandler->updateProduct(
          $_GET['productId'],
          $title,
          $description,
          $price,
          $stock,
          $img_url
          
      );
        $msg = '
            <div class="alert alert-success alert-dismissible d-flex align-items-center fade show">
              <i class="bi-check-circle-fill"></i>
              <strong class="mx-2">Success!</strong> Your product was successfully updated.
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>';
    } else {
        $msg = $error;
    }

  } 

  $products = $productDbHandler->fetchProductById($_GET['productId']);

?>
<?php include('layout/header.php'); ?>
<div id="content">
    <h4>Update product</h4>
    <?=$msg?>


    <table class="table">
        <form method="POST" action="#" enctype="multipart/form-data">
            <tr>
                <td>

                    <image class="rounded mx-auto d-block" src="<?=$products['img_url']?>"
                        style="width:200px;height:auto;">
                        <label>File:</label>
                        <input type="file" name="uploadedFile"><br>
                        <input type="hidden" class="text form-control" name="img_url"
                            value="<?=htmlentities($products['img_url']) ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="input1">title:</label><br>
                    <input type="text" class="text form-control" name="title"
                        value="<?=htmlentities($products['title']) ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="input5">price:</label><br>
                    <input type="text" class="text form-control" name="price"
                        value="<?=htmlentities($products['price']) ?>">
                </td>
            </tr>
            <tr>

                <td>
                    <label for="input6">stock:</label><br>
                    <input type="text" class="text form-control" name="stock"
                        value="<?=htmlentities($products['stock']) ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="input2">description:</label><br>
                    <textarea type="text" rows="3" class="text form-control" name="description"
                        value="<?=htmlentities($products['description']) ?>"><?=htmlentities($products['description']) ?></textarea>
                </td>
            </tr>
            <tr>
                <td id="product">
                    <input type="submit" class="btn btn-warning" value="Update" name="uploadBtn">

                </td>
            <tr>
        </form>
    </table>

    <a href="products.php"><i class="fas fa-angle-left"></i> Back</a>

</div>
<?php include('layout/footer.php'); ?>