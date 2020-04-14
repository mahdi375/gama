<?php require_once SITE_ROOT.'app/views/includes/header.php'; ?>

    <div class="container justify-content-center ">
        <h1>Join our group</h1>
        
        <form id="registerForm">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="name" class="form-control" id="email" placeholder="Enter Name">
                <p class="mt-3">image(opt)</p>
            </div>
            <div class="custom-file mb-3">
                <input type="file" class="custom-file-input" id="validatedCustomFile" required>
                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                <div class="invalid-feedback">Example invalid custom file feedback</div>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password">
            </div>
            <div class="row justify-content-center justify-content-md-start ml-md-1">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    

<?php require_once SITE_ROOT.'app/views/includes/footer.php'; ?>