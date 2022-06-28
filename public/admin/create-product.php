<?php
require '../../src/config.php';
checkLoginSession();

$title = '';
$description = '';
$price = '';
$error = '';
$msg = '';
$newPathAndName = "";
$img_url = "";
$pageTitle = 'Add Product';

if (isset($_POST['add'])) {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);

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
        $path = "../img/";
        //this is the actual path and actual name of the file
        $newPathAndName = $path . $fileName;

        // Check if the file is an image                
        $allowedFileTypes = [
            'image/jpg',
            'image/jpeg',
            'image/gif',
            'image/png',
        ];
        echo "<pre>";
        var_dump((bool) array_search($fileType, $allowedFileTypes, true));
        echo "</pre>";

        $isFileTypeAllowed = (bool) array_search($fileType, $allowedFileTypes, true);
        if ($isFileTypeAllowed == false) {
            $error = "The file type is invalid. Allowed types are jpeg, png, gif.<br>";
        } else {
            // Will try to upload the file with the function 'move_uploaded_file'
            // Returns true/false depending if it was successful or not
            $isTheFileUploaded = move_uploaded_file($fileTempName, $newPathAndName);
            if ($isTheFileUploaded == false) {
                // Otherwise, if upload unsuccessful, show errormessage
                $error = "Could not upload the file. Please try again<br>";
            }
        }
    }

    if (empty($error)) {
        $msg = "Successfully uploaded the new rum";
        // Insert the new product into the database
        $img_url = $newPathAndName;
    } else {
        $msg = $error;
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

if ($error) {
    $msg = "<div class='errors'>{$error}</div>";
}

if (empty($error)) {
    try {
        $query = "
                INSERT INTO products (title, description, price, img_url)
                VALUES (:title, :description, :price, :img_url);
            ";

        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':price', $price);
        $stmt->bindValue(':img_url', $img_url);
        $products = $stmt->execute();
    } catch (\PDOException$e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }
    if ($products) {
        $msg = '<p class="success">Your product are now posted. </p>';
    }
}

$products = $productDbHandler->fetchAllProducts();

?>

<?php include 'layout/header.php';?>

<!-- Add new products -->
<div class="d-flex flex-column bg-light py-4">
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="col">
      <h5>Add product</h5>
      <input type="text" name="title" placeholder="Title">

      <div class="wp-100"></div>

      <form action="products.php?" method="POST">
        <input type="file" class="btn py-2 px-0" name="upload" value="" />
      </form>

      <div class="wp-100"></div>

      <textarea type="text" name="description" placeholder="Description" rows="5" cols="60" style="resize:none"></textarea>

      <div class="wp-100"></div>

      <input type="text" name="price" placeholder="Price">
      <button class="btn1" name="add">Add product</button>
    </div>
  </form>

  <div class="col">
    <?=$msg?>
  </div>
</div>

<!--  Display all products -->
<table class="table table-dark lists">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Price</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>

  <?php foreach ($products as $key => $article) {?>
    <tbody class="articleList">
      <tr>
        <td scope="row articleImg">
          <img src="<?=$article['img_url']?>" style="width:50px;height:auto;">
        </td>
        <td>
          <input type="text" class="bg-dark border-0 text-white" name="title" value="<?=htmlentities($article['title'])?>">
        </td>

        <td>
          <input type="text" class="bg-dark border-0 text-white" name="description" value="<?=substr(htmlentities($article['description']), 0, 10)?>">
        </td>

        <td>
          <input type="text" name="price" value="<?=htmlentities($article['price'])?>">SEK
        </td>

        <td>
          <form method="POST">
            <input type="hidden" name="id" value="<?=$article['id']?>">
            <input type="submit" name="deleteProductBtn" value="Delete" class="delete-product-btn btn bg-light">
          </form>
        </td>

        <td>
          <form method="GET">
            <input type="hidden" name="id" value="<?=$article['id']?>">
            <input type="submit" name="updateProductBtn" value="Update" class="update-product-btn btn bg-white">
          </form>
        </td>
      </tr>
    <?php }?>
    </tbody>
</table>


<?php include 'layout/footer.php';?>