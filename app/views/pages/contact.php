<?php require_once SITE_ROOT.'app/views/includes/header.php'; ?>
    <div class="container mb-4" id="contactPage">
        <h1 class="text-muted">Contact us:</h1>
        <form action="" class="mt-md-5 mb-2 pt-md-4" id="contactForm">

            <div id="contactNameDiv" class="form-group pl-md-3 row ">
                <label  for="contactName">Name :<span id='contactNameError' class="text-danger ml-2 mt-3" ></span></label>
                <input type="text" class="form-control col-md-6" name="name" id="contactName" placeholder="Name">
            </div>

            <div id="contactEmailDiv" class="form-group pl-md-3 row">
                <label for="contactEmail">Email :<span id='contactEmailError' class="text-danger ml-2 mt-3" ></span></label>
                <input type="text" class="form-control col-md-6 ml-md-1" name="email" id="contactEmail" placeholder="Email">
            </div>

            <div id="contactMessageDiv" class="form-group">
                <label  for="contactMessage">Message : <span id="contactMessageError" class="text-danger" ></span></label>
                <textarea class="form-control col-md-8" name="message" id="contactMessage"  rows="6"></textarea>
            </div>

            <div id="contactBtnDiv" class="row justify-content-center justify-content-md-start ml-md-3 mt-4 mb-4 mb-lg-0">
                <button type="submit" id="contactSubmitBtn" class="btn btn-primary" >Send Message</button>
            </div>
        </form>
        <div id="contactSuccessMessage" class="d-none alert alert-success" role="alert">
        </div>
    </div>
    <script src="<?php genURL('public\js\contact.js'); ?>"></script>
<?php require_once SITE_ROOT.'app/views/includes/footer.php'; ?>