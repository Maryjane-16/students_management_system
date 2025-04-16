<?php

require_once "includes/DB_connect.php";


/**
 * Reading out a specific data from the database
 */


 $id = $_GET['id'];

//connect our db
$conn = connectDB();

// fetches a specific record by its id
$sql = "SELECT * FROM records WHERE id = ?";

//prepare an SQL statement for execution
$stmt = mysqli_prepare($conn, $sql);

//bind variables for the parameter markers in the SQL statement prepared
mysqli_stmt_bind_param($stmt, 'i', $id);

//execute the prepared statement
$results = mysqli_stmt_execute($stmt);

//get a result set from a prepared statement as an object
$get_result = mysqli_stmt_get_result($stmt);

//mysqli_fetch_array(get_result, MYSQLI_ASSOC);
$data = mysqli_fetch_assoc($get_result);
//print_r($data);









?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>View Student</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body class="bg-light py-5">

  <div class="container">
    <div class="card shadow-lg border-0 rounded-4">
      <div class="card-header bg-primary text-white text-center rounded-top-4">
        <h3 class="mb-0">Student Details</h3>
      </div>

      <div class="card-body">
        <!-- Student Info Section -->
        <div class="row mb-3">
          <div class="col-md-6">
            <p><strong>Full Name:</strong> <?= $data['full_name'] ?></p>
            <p><strong>Username:</strong> <?= $data['username'] ?></p>
            <p><strong>Faculty:</strong> <?= $data['faculty'] ?></p>
            <p><strong>Department:</strong> <?= $data['department'] ?></p>
          </div>
          <div class="col-md-6">
            <p><strong>Admission Date:</strong> <?= $data['admission_date'] ?></p>
            <p><strong>Admission Type:</strong> <?= $data['admission_type'] ?></p>
            <p><strong>Comments:</strong> <?= $data['comment'] ?></p/p>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-between mt-4">
          <a href="index_records.php" class="btn btn-secondary px-4">Back</a>
          <a href="delete.php?id=1" class="btn btn-danger px-4" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
