<?php


function getRecordById($conn, $id){

    // fetches a specific record by its id
    $sql = "SELECT * FROM records WHERE id = ?";

    //prepare an SQL statement for execution
    $stmt = mysqli_prepare($conn, $sql);

    //bind variables for the parameter markers in the SQL statement prepared
    mysqli_stmt_bind_param($stmt, 'i', $id);

    //execute the prepared statement
    mysqli_stmt_execute($stmt);

    //get a result set from a prepared statement as an object
    $get_result = mysqli_stmt_get_result($stmt);

    //mysqli_fetch_array(get_result, MYSQLI_ASSOC);
    return mysqli_fetch_assoc($get_result);
}
