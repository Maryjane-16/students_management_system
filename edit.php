<?php

session_start();

require_once "includes/db_connect.php";
require_once "includes/get_record_id.php";
require_once "includes/isloggedin.php";
require_once "includes/form_validate.php";

$id = $_GET['id'];

//connect our db
$conn = connectDB();

/**
 *EADING or RETRIEVING SPECIFIC DATA FROM THE DB IN THE EDIT PAGE
 */
if (isset($_GET['id']) || !empty($_GET['id'])) {

  $data = getRecordById($conn, $id);

  // You can handle the case where no record is found int the specified id
  if (!$data) {
    echo require_once "includes/no_record.php";
    exit;
  }

  if ($data) {
    $full_name = $data['full_name'];
    $username = $data['username'];
    $faculty = $data['faculty'];
    $department = $data['department'];
    $admission_date = $data['admission_date'];
    $admission_type = $data['admission_type'];
    $comment = $data['comment'];
    $filename = $data['image_file'];
  }
} else {
  // You can also handle the case where no id is in the URL
  echo require_once "includes/invalid_request.php";
  exit;
}

/**
 * WORKING ON THE UPDATE FUNCTIONALITY
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_POST['update'])) {

    require_once "includes/file_upload.php";

    $full_name = trim(filter_input(INPUT_POST, 'full_name'));
    $username = trim(filter_input(INPUT_POST, 'username'));
    $faculty = trim(filter_input(INPUT_POST, 'faculty'));
    $department = trim(filter_input(INPUT_POST, 'department'));
    $admission_date = trim(filter_input(INPUT_POST, 'admission_date'));
    $admission_type = trim(filter_input(INPUT_POST, 'admission_type'));
    $comment = trim(filter_input(INPUT_POST, 'comment'));

    //checking for empty fields, and throwing an error if left empty
    $errors = formValidation($full_name, $username, $faculty, $department, $admission_date, $admission_type);

    if (empty($errors)) {


      $sql = "UPDATE records
              SET full_name = ?, username = ?, faculty = ?, department = ?, admission_date = ?, admission_type = ?, comment = ?, image_file = ?
              WHERE id = ?";

      // Prepare an SQL statement for execution
      $stmt = mysqli_prepare($conn, $sql);

      //bind variables for the parameter marker in the SQL statement prepared
      mysqli_stmt_bind_param($stmt, 'ssssssssi', $full_name, $username, $faculty, $department, $admission_date, $admission_type, $comment, $filename, $id);

      //execute the prepared statement 
      $results = mysqli_stmt_execute($stmt);

      if ($results) {
        $_SESSION['success_message'] = "Form updated successfully";
        header("Location: http://localhost:200/show.php?id=$id");
        exit;
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
  <title>Students Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="bg-light py-5">

  <div class="container">
    <div class="card shadow-lg border-0 rounded-4">
      <div class="card-header bg-primary text-white text-center rounded-top-4">
        <h3 class="mb-0">Edit Student Record</h3>
      </div>
      <div class="card-body">

        <!--show failure message-->
        <?php if (!empty($errors)): ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
              <?php foreach ($errors as $error): ?>
                <li><?= $error ?></li>
              <?php endforeach; ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
          <!-- full name and username -->
          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control" id="fullName" name="full_name" placeholder="Full Name" value="<?= $full_name ?>" required />
                <label for="fullName">Full Name</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="input-group has-validation">
                <span class="input-group-text">@</span>
                <div class="form-floating flex-grow-1">
                  <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?= $username ?>" required />
                  <label for="username">Username</label>
                </div>
              </div>
            </div>
          </div>

          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <div class="form-floating">
                <select class="form-select" id="faculty" name="faculty" required>
                  <?php
                  $faculties = ['Engineering', 'Science', 'Arts', 'Education', 'Social Science'];

                  foreach ($faculties as $index_value) {
                    $selected = ($index_value === $faculty) ? 'selected' : '';
                    echo "<option value='$index_value' $selected>$index_value</option>";
                  }
                  ?>
                </select>
                <label for="faculty">Faculty</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <select class="form-select" id="department" name="department" required>

                  <?php
                  $departments = ['Met. & Maths Engr.', 'Microbiology', 'English', 'Mathematics', 'Human Kinetics'];

                  foreach ($departments as $index_value) {
                    $selected = ($index_value === $department) ? 'selected' : '';
                    echo "<option value='$index_value' $selected>$index_value</option>";
                  }
                  ?>
                </select>
                <label for="department">Department</label>
              </div>
            </div>
          </div>

          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <div class="form-floating">
                <input type="date" class="form-control" id="admissionDate" name="admission_date" placeholder="Admission Date" value="<?= $admission_date ?>" required />
                <label for="admissionDate">Admission Date</label>
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label d-block">Admission Type</label>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="admission_type" id="merit" value="Merit" <?= ($admission_type === "Merit") ? 'checked' : '' ?>>
                <label class="form-check-label" for="merit">Merit</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="admission_type" id="diploma" value="Diploma" <?= ($admission_type === "Diploma") ? 'checked' : '' ?>>
                <label class="form-check-label" for="diploma">Diploma</label>
              </div>
            </div>
          </div>

          <div class="mb-4">
            <label for="comments" class="form-label">Additional Comments</label>
            <textarea class="form-control" id="comments" rows="4" name="comment" placeholder="Leave a comment here..."><?= $comment ?></textarea>
          </div>

          <div class="mb-3">
            <label for="file">Upload Image:</label>
            <input type="file" name="file" id="file" accept="image/*" onchange="checkImageResolution(event);" value="<?= $filename ?>">
          </div>
          <div id="error-message" style="color: red"></div>

          <div class="d-flex justify-content-center gap-2">
            <button type="submit" name="update" class="btn btn-primary px-5">Update</button>
            <a class="btn btn-secondary px-5" href="/index_records.php">Back</a>
          </div>

        </form>
      </div>
    </div>
  </div>

  <!-- checking image dimension to be uploaded-->
  <script src="js/image-dimension.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>