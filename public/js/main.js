
$(document).ready(function () {
  // Delete User Ajax  -------------------------------------------//
  $(".delete-user-btn").on("click", deleteUserEvent);
  function deleteUserEvent(e) {
    e.preventDefault();
    let id = $(this).parent().find('input[name="id"]');
    console.log(id.val());
    $.ajax({
      method: "POST",
      url: "../delete-user.php",
      data: {
        deleteUserBtn: true,
        id: id.val(),
      },
      dataType: "json",
      success: function (data) {
        appendUserList(data);
        console.log(data);
      },
    });
  }

  function appendUserList(data) {
    let userList = $(".userList");
    let html = "";

    for (texterino of data["users"]) {
      html +=
        "<table>" +
        "<thead>" +
        "<tr>" +
        "<td>Username:</td>" +
        "<td>First name:</td>" +
        "<td>Last name:</td>" +
        "<td>E-mail:</td>" +
        "<td>Password:</td>" +
        "<td>Phone:</td>" +
        "<td>Street:</td>" +
        "<td>Postal code:</td>" +
        "<td>City:</td>" +
        "<td>Country:</td>" +
        "<td>Register date:</td>" +
        "</tr>" +
        "</thead>" +
        "<tbody>" +
        "<td>" +
        texterino["username"] +
        "</td>" +
        "<td>" +
        texterino["first_name"] +
        "</td>" +
        "<td>" +
        texterino["last_name"] +
        " </td>" +
        "<td>" +
        texterino["email"] +
        "</td>" +
        "<td>" +
        texterino["password"] +
        "</td>" +
        "<td>" +
        texterino["phone"] +
        "</td>" +
        "<td>" +
        texterino["street"] +
        "</td>" +
        "<td>" +
        texterino["postal_code"] +
        "</td>" +
        "<td>" +
        texterino["city"] +
        "</td>" +
        "<td>" +
        texterino["country"] +
        " </td>" +
        "<td>" +
        texterino["register_date	"] +
        " </td>" +
        "<td>" +
        '<form method="POST">' +
        '<input type="submit" class="delete-user-btn btn bg-light text-dark mb-2" name="deleteUserBtn" value="Delete">' +
        '<input type="hidden" name="id" value="' +
        texterino["id"] +
        '">' +
        "</form>" +
        "</td>" +
        "<td>" +
        '<form action="updateuser.php?" method="GET">' +
        '<input type="submit" class="btn bg-light text-dark mb-2" name="id" value="Update">' +
        '<input type="hidden" name="id" value="' +
        texterino["id"] +
        '">' +
        "</form>" +
        "</td>" +
        "</tbody>" +
        "</table>";
    }
    userList.html(html);
    $(".delete-user-btn").on("click", deleteUserEvent);
  }
});

// Delete Product Ajax -------------------------------------------//
$(".delete-product-btn").on("click", deleteProductEvent);
function deleteProductEvent(e) {
  e.preventDefault();
  let id = $(this).parent().find('input[name="id"]');
  console.log(id.val());
  $.ajax({
    method: "POST",
    url: "../delete-product.php",
    data: {
      deleteProductBtn: true,
      id: id.val(),
    },
    dataType: "json",
    success: function (data) {
      appendProductList(data);
      console.log(data);
    },
  });
}

function appendProductList(data) {
  let lists = $(".lists");
  let html = "";

  for (article of data["products"]) {
    html +=
      '<tbody class="articleList">' +
      "<tr>" +
      '<td scope="row articleImg">' +
      '<img src="' +
      article["img_url"] +
      '" width="50px">' +
      "</td>" +
      "<td>" +
      '<input type="text" class="bg-dark border-0 text-white" name="title" value="' +
      article["title"] +
      '">' +
      "</td>" +
      "<td>" +
      '<input type="text" class="bg-dark border-0 text-white" name="description" value="' +
      article["description"] +
      '">' +
      "</td>" +
      "<td>" +
      '<input type="text" name="price" value="' +
      article["price"] +
      '">' +
      "</td>" +
      "<td>" +
      '<form method="POST">' +
      '<input type="submit" class="delete-product-btn" name="deleteProductBtn" value="Delete">' +
      '<input type="hidden" name="id" value="' +
      article["id"] +
      '">' +
      "</form>" +
      "</td>" +
      "<td>" +
      '<form method="GET">' +
      '<input type="submit" name="updateProductBtn class="btn bg-white update-product-btn" value="Update">' +
      '<input type="hidden" name="id" value="' +
      article["id"] +
      '">' +
      "</form>" +
      "</td>" +
      "</tr>" +
      "</tbody>";
  }
  lists.html(html);
  $(".delete-product-btn").on("click", deleteProductEvent);
  $(".update-product-btn").on("click", updateProductEvent);
}

// Update Btn Ajax  -------------------------------------------//
$('.update-cart-form input[name="quantity"]').on("change", function () {
  let quantity = $(this).val();
  let cartId = $(this).data("id");

  $.ajax({
    method: "POST",
    url: "../update-cart-item.php",
    data: { quantity: quantity, cartId: cartId },
    success: function () {},
  });
});

// Update Product Ajax  -------------------------------------------//
$(".update-product-btn").on("click", updateProductEvent);
function updateProductEvent(e) {
  e.preventDefault();
  let id = $(this).parent().find('input[name="id"]');
  let title = $(this).parent().parent().parent().find('input[name="title"]');
  let description = $(this)
    .parent()
    .parent()
    .parent()
    .find('input[name="description"]');
  let price = $(this).parent().parent().parent().find('input[name="price"]');
  console.log({
    updateProductBtn: true,
    title: title.val(),
    description: description.val(),
    price: price.val(),
    id: id.val(),
  });
  $.ajax({
    method: "POST",
    url: "../admin/update-product.php",
    data: {
      updateProductBtn: true,
      title: title.val(),
      description: description.val(),
      price: price.val(),
      id: id.val(),
    },
    dataType: "json",
    success: function (data) {
      console.log(data);
      appendUpdateProductList(data);
    },
  });
}

/*User profile modal*/



