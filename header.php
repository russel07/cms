<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <title>Basic CMS <?php echo $title;?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl?>/asset/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl?>/asset/css/style.css"/>

    <!-- Include the Quill library -->
    <link href="<?php echo $baseUrl?>/asset/css/quill.css" rel="stylesheet">
    <script src="<?php echo $baseUrl?>/asset/js/quill.js"></script>
    <script>
        var base_url = '<?php echo $baseUrl?>';
        var quill2 ;
    </script>
</head>
<body>
<div class="home" id="data">
    <div class="container">
        <nav class="bg-warning navbar navbar-dark navbar-expand-lg">
            <a class="navbar-brand page" href="index.php">Basic CMS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <?php if($loggedIn):?>
                    <li class="nav-item active">
                        <a class="nav-link page" href="./admin.php">Home</a>
                    </li>
                <?php endif;?>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <?php if($loggedIn):?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo $username;?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item page" page-type="logout" href="./logout.php">Logout</a>
                            </div>
                        </li>

                    <?php else: if(!isset($installer)): ?>
                        <li class="nav-item active">
                            <a class="nav-link page" href="./admin.php">Admin?</a>
                        </li>
                    <?php endif; endif;?>
                </ul>

            </div>
        </nav>
