<nav class="navbar navbar-expand-lg navbar-light bg-light pl-5">
    <a class="navbar-brand" href="<?php genURL('Pages/home') ?>">
    <img src="<?php genURL('public\img\logo.jpg') ?>" width="30" height="30" class="d-inline-block align-top" alt="">
    <?php echo SITE_TITLE ?>
    </a>        
    <button class="navbar-toggler" type="button"  id="navbarCollapseBtn" data-toggle="collapse" >
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse " id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="<?php genURL('Pages/games') ?>">Games</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php genURL('Pages/contact') ?>">Contact</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php genURL('Pages/about') ?>">About</a>
        </li>
    </ul>
    <ul class="navbar-nav mr-5">
        <li class="nav-item">
            <a class="nav-link" id="logInbtn" href="">Log in</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="signInbtn" href="<?php genURL('authors/create') ?>">Sign in</a>
        </li>  
    </ul>
  </div>
</nav>

<div class="container justify-content-lg-end d-none " id="logindiv" >
    <form class="justify-content-center  pt-2 form-inline" >

        <label class="sr-only" for="inlineFormInputGroupUsername2">Email</label>
        <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
            <div class="input-group-text">@</div>
            </div>
            <input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Email">
        </div>

        <label class="sr-only" for="log_password">password</label>
        <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
            <div class="input-group-text">password</div>
            </div>
            <input type="text" class="form-control" id="log_password" placeholder="">
        </div>

        <button type="submit" class="btn btn-primary mb-2">Submit</button>
    </form>
</div>