<?php
//require __DIR__ . "/config/connexionsgbd.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello world!</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h1 {
            margin: 20px 0px;
        }
        img {
            width: 250px;
        }
        .logo2 {
            margin-top:40px;
        }
    </style>
</head>
<body>
    <h1>Hello world!</h1>
    <?php

include __DIR__ . "/src/class/testplugin/NewMain.php";
new NewMain();

    ?>
</body>
</html>
