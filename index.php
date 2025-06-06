<?php

session_start();

require_once "includes/db_connect.php";
require_once "includes/auth.php";
require_once "includes/form_validate.php";

//initiate an error handler function
function myErrorHandler($errno, $errstr)
{
  echo "<b>Error:</b> [$errno] $errstr";
}
//set error handler funtion

set_error_handler("myErrorHandler");


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_POST['save'])) {

    require_once "includes/file_upload.php";

    $full_name = trim(filter_input(INPUT_POST, 'full_name'));
    $username = trim(filter_input(INPUT_POST, 'username'));
    $faculty = trim(filter_input(INPUT_POST, 'faculty'));
    $department = trim(filter_input(INPUT_POST, 'department'));
    $admission_date = trim(filter_input(INPUT_POST, 'admission_date'));
    $admission_type = trim(filter_input(INPUT_POST, 'admission_type'));
    $comment = trim(filter_input(INPUT_POST, 'comment'));

    //checking for empty fields, and throwing an error if left empty
    $errors = formValidation($full_name, $username, $faculty, $department, $admission_date, $admission_type, $filename);
    
    if (empty($errors)) {

      if ($comment == '') {
        $comment = null;
      }

      // connect to the database
      $conn = connectDB();

      //insert the data into a database
      $sql = "INSERT INTO records (full_name, username, faculty, department, admission_date, admission_type, comment, image_file)
      VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

      // prepare an SQL statement for execution
      $stmt = mysqli_prepare($conn, $sql);

      if ($stmt === false) {
        echo mysqli_error($conn);
      } else {

        // bind variables for the parameter makers in the SQL statement
        mysqli_stmt_bind_param($stmt, 'ssssssss', $full_name, $username, $faculty, $department, $admission_date, $admission_type, $comment);

        //execute the prepared statement
        $results = mysqli_stmt_execute($stmt);

        if ($results === false) {
          echo mysqli_stmt_error($stmt);
        } else {
          header('Location: http://localhost:200/index.php?success=1');
          exit;
        }
      }
    } 
  }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Student Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="bg-light py-5">

  <div class="container">
    <div class="card shadow-lg border-0 rounded-4">
      <div class="card-header bg-primary text-white text-center rounded-top-4">
        <h3 class="mb-0">Students Management System</h3>
      </div>
      <div class="card-body">

        <!--show success message-->
        <?php if (isset($_GET['success']) && $_GET['success'] == '1') : ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            🎉 Form submitted successfully!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>

        <!--show failure message-->
        <?php if (!empty($errors)): ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <ul>
            <?php foreach($errors as $error): ?>
              <li><?= $error ?></li>
              <?php endforeach; ?>
          </ul>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">

        <!--Full Name and Username -->

          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control" id="fullName" name="full_name" placeholder="Full Name" required />
                <label for="fullName">Full Name</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="input-group has-validation">
                <span class="input-group-text">@</span>
                <div class="form-floating flex-grow-1">
                  <input type="text" class="form-control" id="username" name="username" placeholder="username" required />
                  <label for="username">Username</label>
                </div>
              </div>
            </div>
          </div>

          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <div class="form-floating">
                <select class="form-select" id="faculty" name="faculty" required>
                  <option disabled selected>Select Faculty</option>
                  <option value="Engineering">Engineering</option>
                  <option value="Science">Science</option>
                  <option value="Arts">Arts</option>
                  <option value="Education">Education</option>
                  <option value="Social Science">Social Science</option>
                </select>
                <label for="faculty">Faculty</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <select class="form-select" id="department" name="department" required>
                  <option disabled selected>Select Department</option>
                  <option value="Met. & Maths Engr.">Met. & Maths Engr.</option>
                  <option value="Microbiology">Microbiology</option>
                  <option value="English">English</option>
                  <option value="Mathematics">Mathematics</option>
                  <option value="Human Kinetics">Human Kinetics</option>
                </select>
                <label for="department">Department</label>
              </div>
            </div>
          </div>

          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <div class="form-floating">
                <input type="date" class="form-control" id="admissionDate" name="admission_date" required />
                <label for="admissionDate">Admission Date</label>
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label">Admission Type</label>
              <div class="form-check form-check">
                <input class="form-check-input" type="radio" name="admission_type" id="merit" value="Merit" />
                <label class="form-check-label" for="merit">Merit</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="admission_type" id="diploma" value="Diploma" checked />
                <label class="form-check-label" for="diploma">Diploma</label>
              </div>
            </div>
          </div>

          <div class="mb-4">
            <label for="comments" class="form-label">Additional Comments</label>
            <textarea class="form-control" id="comments" name="comment" placeholder="Leave a comment here..."></textarea>
          </div>

          <div class="mb-3">
            <label for="file">Upload Image:</label>
            <input type="file" name="file" id="file" accept="image/*" onchange="checkImageResolution(event);">
          </div>
          <div id="error-message" style="color: red"></div>

          </div>

          <div class="d-flex justify-content-center gap-3">
            <button type="submit" class="btn btn-primary px-5" name="save">Submit</button>

            <?php if(isLoggedIn()): ?>
            <a href="/index_records.php" class="btn btn-info px-5">View Records</a>
            <?php endif; ?>

          </div>

        </form>


        <div class="py-3 text-center">

        <?php if (isLoggedIn()): ?>
          <p>You are logged in. <a href="logout.php">Logout</a>?</p>
          <?php else: ?>
            <p>Are you an admin? If yes, <a href="login.php">Login<a>!</p>
          <?php endif; ?>
            
        
      </div>
    </div>
  </div>
  <!-- checking image dimension to be uploaded-->
   <script src="js/image-dimension.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>