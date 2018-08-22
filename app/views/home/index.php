<!DOCTYPE html>
<html>
    <head>
        <title>Ease</title>
        <?php Asset::loadStyles(['base-style.css']); ?>
    </head>
    <body>
        <h1 class="headline"><?= $data['welcome']?></h1>
        <p class="tagline"><?= $data['tagline']?></p>
    </body>
</html>