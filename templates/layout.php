<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GWSC</title>
    <link rel="stylesheet" href="styles/app.css" />
    <!-- External plugin js -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body>
    <?php
    require_once 'templates/common/navBar/index.php';
    require_once $__app;
    require_once 'templates/common/footer/index.php';
    ?>


    <!-- Add external css for related pages -->
    <script type="text/javascript">
        <?php
        foreach ($__cssLinks as $__cssLink) {
        ?>
            const cssFile = "<?php echo $__cssLink; ?>"
            const link = document.createElement("link");
            link.href = cssFile;
            link.type = "text/css";
            link.rel = "stylesheet";
            document.getElementsByTagName("head")[0].appendChild(link);
        <?php
        }
        ?>
    </script>
    <script src="js/utils/passwordUtils.js" defer></script>
</body>

</html>