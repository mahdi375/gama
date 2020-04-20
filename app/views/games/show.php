<?php require_once SITE_ROOT.'app/views/includes/header.php'; ?>

    <div class="container">
        <pre>
        <?php print_r($data['game']); ?>
        <?php foreach($data['related'] as $game){ echo $game->title ;} ?>
        </pre>

    </div>
<?php require_once SITE_ROOT.'app/views/includes/footer.php'; ?>