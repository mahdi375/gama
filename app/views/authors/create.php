<?php require_once SITE_ROOT.'app/views/includes/header.php'; ?>
    <div class="container justify-content-center ">
        <h1 class="mt-md-3 text-muted">Join Our Authors Group</h1>
        
        <form id="registerForm" method="POST" class="mb-4 mt-md-5" enctype="multipart/form-data"> <!-- We sent it via ajax -->
            <div class="form-group">
                <label for="registerName">Name <span class=" ml-4 text-danger" id="registerNameErr"></span></label>
                <input type="text" class="form-control" name="name" id="registerName" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="registerEmail">Email address <span class=" ml-4 text-danger" id="registerEmailErr"></span></label>
                <input type="email" class="form-control" name="email" id="registerEmail" aria-describedby="emailHelp" placeholder="Enter email">
                <p class="mt-3">image[opt] <span class=" text-primary "> less than 200kb</span><span class=" ml-4 text-danger" id="registerImageErr"></span></p>
            </div>
            <div class="custom-file mb-3">
                <input type="file" class="custom-file-input" name="image" id="registerImage" accept="image/*">
                <label class="custom-file-label" id="registerImageLabel" for="registerImage">Choose file...</label>
            </div>
            <div class="form-group">
                <label for="registerPassword">Password <span class=" ml-4 text-danger" id="registerPasswordErr"></span></label>
                <input type="password" class="form-control" name="password" id="registerPassword" placeholder="Password" autocomplete="">
            </div>
            <div class="form-group">
                <label for="registerConfirmPassword">Confirm Password <span class=" ml-4 text-danger" id="registerConfirmPasswordErr"></span></label>
                <input type="password" class="form-control" name="confirm-password" id="registerConfirmPassword" placeholder="Confirm Password" autocomplete="">
            </div>
            <div class="row justify-content-center justify-content-md-start ml-md-1">
                <button type="submit" id="rigsterSubmitBtn" class="btn btn-primary" >Join</button>
            </div>
            <h3 id="regFeedbackMessage" class=" d-none bg-success mt-2 text-white form-control ">feedback message</h3>
            <script src="<?php genURL('public\js\auth_register.js') ?>"></script>
        </form>
    </div>
<?php require_once SITE_ROOT.'app/views/includes/footer.php'; ?>