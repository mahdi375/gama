    <div class="container justify-content-center " id="dashboardAccount">
        <h1 class="display-4 row mt-3 mt-md-4 justify-content-center" id="dashboardAccountTitle">Edit account</h1>
        <p class="mb-1 mb-md-4 text-info">Edit What You Want !</p><hr>
        <form id="dashboardAccountEditForm" method="POST" enctype="multipart/form-data"> <!-- We sent it via ajax -->
            <div class="form-group mb-4">
                <label for="dashboardAccountEditName">New Name <span class=" ml-4 text-danger" id="dashboardAccountEditNameErr"></span></label>
                <input type="text" class="form-control" name="name" id="dashboardAccountEditName" placeholder="Enter Name">
            </div><hr>

            <div class="form-group">
                <p class="mt-3">profile picture <span class=" text-primary "> &nbsp < 200kb </span><span class=" ml-4 text-danger" id="dashboardAccountEditImageErr"></span></p>
            </div>

            <div class="custom-file mb-2">
                <input type="file" class="custom-file-input" name="image" id="dashboardAccountEditImage" accept="image/*">
                <label class="custom-file-label" id="dashboardAccountEditImageLabel" for="dashboardAccountEditImage">Choose file...</label>
            </div><hr >

            <div class="form-group">
                <label for="dashboardAccountEditOldPassword">Old-Password <span class=" ml-4 text-danger" id="dashboardAccountEditOldPasswordErr"></span></label>
                <input type="password" class="form-control" name="oldPassword" id="dashboardAccountEditOldPassword" placeholder="Password" autocomplete="">
            </div>
            
            <div class="form-group">
                <label for="dashboardAccountEditNewPassword">New-Password <span class=" ml-4 text-danger" id="dashboardAccountEditNewPasswordErr"></span></label>
                <input type="password" class="form-control" name="newPassword" id="dashboardAccountEditNewPassword" placeholder="Password" autocomplete="">
            </div>

            <div class="form-group">
                <label for="dashboardAccountEditConfirmPassword">Confirm Password <span class=" ml-4 text-danger" id="dashboardAccountEditConfirmPasswordErr"></span></label>
                <input type="password" class="form-control" name="confirm-password" id="dashboardAccountEditConfirmPassword" placeholder="Confirm Password" autocomplete="">
            </div>

            <div class="row justify-content-center justify-content-md-start ml-md-1 mb-3">
                <button type="submit" id="dashboardAccountEditSubmitBtn" class="btn btn-primary" >Edit</button>
                <span class=" ml-4 mt-3 text-danger" id="dashboardAccountEditNothingErr"></span>
            </div>
        </form>
    </div>