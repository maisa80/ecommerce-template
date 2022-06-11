<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="footer-col">
                    <h4>About us</h4>
                    <p>Welcome to Baby's & Me, your one-stop shop for finding the best baby clothing and accessories.
                        Shop for the top-quality baby supplies and accessories online.</p>
                    <p>&copy; 2019 - <?php echo date('Y'); ?> <a href="#">Baby's & Me</a>. All rights reserved.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer-col middle">
                    <h4>More from us</h4>
                    <ul class="list-unstyled">
                        <li><a href="index.php">About us</a></li>
                        <li><a href="#">Faq's</a></li>
                        <li><a href="contact.php">Contact us</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                        <li><a href="#">Privacy</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer-col last">
                    <h4>Follow us</h4>
                    <ul class="list-inline">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- /container -->


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
</script>
<!-- <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.1/js/fontawesome.min.js"></script> -->

<!-- CUSTOM JavaScript -->
<script src="js/main.js"></script>
<script>
    $('#updateUserModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var username = button.data('username');       
  var first_name = button.data('first_name'); 
  var last_name = button.data('last_name'); 
  var email = button.data('email'); 
  var phone = button.data('phone'); 
  var street = button.data('street'); 
  var postal_code = button.data('postal_code'); 
  var city = button.data('city'); 
  var country = button.data('country'); 
  var id = button.data('id');        // Extract the info from the attribute data-id
  console.log(id);
  console.log(username);
  console.log(first_name);
  console.log(last_name);
  
  
  var modal = $(this)
  modal.find('.modal-body input[name="username"]').val(username);
  modal.find('.modal-body input[name="first_name"]').val(first_name);
  modal.find('.modal-body input[name="last_name"]').val(last_name);
  modal.find('.modal-body input[name="email"]').val(email);
  modal.find('.modal-body input[name="phone"]').val(phone);
  modal.find('.modal-body input[name="street"]').val(street);
  modal.find('.modal-body input[name="postal_code"]').val(postal_code);
  modal.find('.modal-body input[name="city"]').val(city);
  modal.find('.modal-body input[name="country"]').val(country);
  modal.find('.modal-body input[name="id"]').val(id);
})

$('#updateUserPasswordModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var password = button.data('password');       
  var confirmPassword = button.data('confirmPassword'); 
  var id = button.data('id');        // Extract the info from the attribute data-id
  console.log(id);

  
  var modal = $(this)
  modal.find('.modal-body input[name="password"]').val(password);
  modal.find('.modal-body input[name="confirmPassword"]').val(confirmPassword);
  modal.find('.modal-body input[name="id"]').val(id);
})
$('#updateUserPasswordModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var img_url = button.data('img_url');       
  var id = button.data('id');        // Extract the info from the attribute data-id
  console.log(id);

  
  var modal = $(this)
  modal.find('.modal-body input[name="img_url"]').val(img_url);
  modal.find('.modal-body input[name="id"]').val(id);
})
</script>
</body>

</html>