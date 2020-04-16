<?php require_once SITE_ROOT.'app/views/includes/header.php'; ?>

    <div class="container">
        <div class="row" id="containerFirstRow">
            <div class="col-12 col-md-3 " id="dashLeftDiv">
                <div id="profileImage" class=" row justify-content-center">
                    <img  id="profileImg" class="ml-md-4 mr-md-4" src="<?php genURL('public\img\profile.jpg') ?>">
                </div>
                <div id="profileInfo" class="row pt-4">
                    <h3>name</h3>
                    <p class="text-secondary">example@test.com</p>
                </div>
                <div id="profileBar" class="row">
                    <button id="gamesBarBtn" class="active">games</button>
                    <button id="addBarBtn" class="">add new</button>
                    <button id="accountBarBtn" class="">account</button>
                </div>
            </div>

            <div class="col-12 col-md-9" id="dashRightDiv">
            <!-- this is default and fill here via ajax -->
            <?php echo $data; ?>
            </div>
        </div>
    </div>
    <script src="<?php genURL('public\js\auth_dashboard.js') ?>"></script>
<?php require_once SITE_ROOT.'app/views/includes/footer.php'; ?>