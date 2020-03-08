<?php

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $page_title; ?></title>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- Custom CSS  -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat|Russo+One" rel="stylesheet">
        <!-- Icons -->
        <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <?php
        foreach ($css_files as $css) {
            // in_array('public', $dirs) ? $path = '' : $path = 'public/';
            $path = "../../";
            echo '<link rel="stylesheet" href="'.$path.'css/'.$css.'">';
        }
        ?>
    </head>

	<body>
        <a href="index.php?req=buscar">BUSCAR</a>
        <br>
        <a href="index.php?req=resultados">RESULTADOS</a>
        <br>
        <a href="index.php?req=array">ARRAY</a>
        <br>
        <hr>
