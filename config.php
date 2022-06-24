<?php
    //Koneksi Database
    $server = "localhost";
    $user = "root";
    $pass = "";
    $database = "db_farmasi";

    $koneksi = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($koneksi));
    ?>