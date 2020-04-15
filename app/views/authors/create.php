<?php require_once SITE_ROOT.'app/views/includes/header.php'; ?>
    <div class="container justify-content-center ">
        <h1>Join Our Authors Group</h1>
        
        <form id="registerForm" action="<?php genURL('authors/store') ?>" method="POST">
            <div class="form-group">
                <label for="registerName">Name <span class=" ml-4 text-danger" id="registerNameErr"></span></label>
                <input type="text" class="form-control" id="registerName" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="registerEmail">Email address <span class=" ml-4 text-danger" id="registerEmailErr"></span></label>
                <input type="email" class="form-control" id="registerEmail" aria-describedby="emailHelp" placeholder="Enter email">
                <p class="mt-3">image(opt) <span class=" ml-4 text-danger" id="registerImageErr"></span></p>
            </div>
            <div class="custom-file mb-3">
                <input type="file" class="custom-file-input" id="registerImage">
                <label class="custom-file-label" id="registerImageLabel" for="registerImage">Choose file...</label>
                <div class="invalid-feedback">Example invalid custom file feedback</div>
            </div>
            <div class="form-group">
                <label for="registerPassword">Password <span class=" ml-4 text-danger" id="registerPasswordErr"></span></label>
                <input type="password" class="form-control" id="registerPassword" placeholder="Password" autocomplete="">
            </div>
            <div class="form-group">
                <label for="registerConfirmPassword">Confirm Password <span class=" ml-4 text-danger" id="registerConfirmPasswordErr"></span></label>
                <input type="password" class="form-control" id="registerConfirmPassword" placeholder="Confirm Password" autocomplete="">
            </div>
            <div class="row justify-content-center justify-content-md-start ml-md-1">
                <button type="submit" id="rigsterSubmitBtn" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    

<?php require_once SITE_ROOT.'app/views/includes/footer.php'; ?>