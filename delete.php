<?php

require_once "includes/DB_connect.php";

session_start();

$id = $_GET['id'];

//connect our db
$conn = connectDB();

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


if (isset($id)){

    $sql = "DELETE FROM records WHERE id = ?";

    // prepare an SQL statement for execution
    $stmt = mysqli_prepare($conn, $sql);

    // bind variables for the parameter makers in the SQL statement
    mysqli_stmt_bind_param($stmt, 'i', $id);

    //execute the prepared statement
    $results = mysqli_stmt_execute($stmt);

    if($results){
        header("Location: http://localhost:200/index_records.php");
        exit;
    }


}