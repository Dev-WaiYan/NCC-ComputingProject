<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyShop - Computer and Computer Accessories</title>
    <link rel="stylesheet" href="../styles/app.css" />
    <!-- External plugin js -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    require_once 'templates/common/admin/navBar/index.php';
    require_once $__app;
    require_once 'templates/common/admin/footer/index.php';
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
    <script src="../js/utils/passwordUtils.js" defer></script>
</body>

</html>