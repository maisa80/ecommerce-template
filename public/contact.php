<?php
    require('../src/config.php');
    $pageTitle= 'Contact';
    $pageId = 'contact';
?>

<?php include('layout/header.php'); ?>

<div class="container-fluid p-0" id="contactPage">    
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="contact-info">
                <h1>Contact Us</h1>
                <p>We are located in the heart of the city of Stockholm, Sweden. We are open Monday to Friday from 9:00 to 17:00. We are also open on weekends from 10:00 to 17:00.</p>
                <p>We are happy to answer any questions you have.</p>
                <p>Please feel free to contact us using the contact form.</p> 
                <p>You can also contact us by phone or email.</p>                 
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="contact-form">
                <h1>Contact Form</h1>
                 <form action="contact.php" method="post">
                        <div class="elem-group">
                            <label for="name">Your Name</label>
                            <input type="text" id="name" name="first_name" placeholder="John Doe" pattern=[A-Z\sa-z]{3,20} required>
                        </div>
                        <div class="elem-group">
                            <label for="email">Your E-mail</label>
                            <input type="email" id="email" name="first_email" placeholder="john.doe@email.com" required>
                        </div>
                        <div class="elem-group">
                            <label for="department-selection">Choose Concerned Department</label>
                            <select id="department-selection" name="concerned_department" required>
                                <option value="">Select a Department</option>
                                <option value="billing">Billing</option>
                                <option value="marketing">Marketing</option>
                                <option value="sales">Sales</option>
                            </select>
                        </div>
                        <div class="elem-group">
                            <label for="title">Reason For Contacting Us</label>
                            <input type="text" id="title" name="email_title" required placeholder="Unable to Reset my Password" pattern=[A-Za-z0-9\s]{8,60}>
                        </div>
                        <div class="elem-group">
                            <label for="message">Write your message</label>
                            <textarea id="message" name="first_message" placeholder="Say whatever you want." required></textarea>
                        </div>
                        <button type="submit">Send Message</button>
                    </form>
            </div>
        </div>
    </div>
</div>

        
        




<?php include('layout/footer.php'); ?>