<?php

/**
 * The MySQL database connection
 */

function connectDB(){
    $db_host = 'localhost';
    $db_name = 'student_records';
    $db_user = 'lexiscode';
    $db_password = 'LexisAcademy';

    $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

    if(mysqli_connect_error()){
        echo mysqli_connect_error();
        exit;

    }

    return $conn;

}