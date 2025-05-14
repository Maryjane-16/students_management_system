<?php

session_start();

require_once "includes/DB_connect.php";
require_once "includes/get_record_id.php";
require_once "includes/isloggedin.php";

/**
 * Reading out a specific data from the database
 */

$id = $_GET['id'];

//connect our db
$conn = connectDB();
$data = getRecordById($conn, $id);

// Download to pdf
if (isset($_POST['download'])){
  header("Location: http://localhost/students_management_system/print_pdf.php?id={$data['id']}");
  exit;
}


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

      <!--show success message-->
      <?php if (isset($_SESSION['success_message'])): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['success_message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>

        <!-- Student Info Section -->
        <div class="row mb-3">
          <img src="http://localhost/students_management_system/uploads/<?= $data['image_file'] ?>" alt="">

        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <p><strong>Full Name:</strong> <?= htmlspecialchars($data['full_name']) ?></p>
            <p><strong>Username:</strong> <?= htmlspecialchars($data['username']) ?></p>
            <p><strong>Faculty:</strong> <?= htmlspecialchars($data['faculty']) ?></p>
            <p><strong>Department:</strong> <?= htmlspecialchars($data['department']) ?></p>
          </div>
          <div class="col-md-6">
            <p><strong>Admission Date:</strong> <?= htmlspecialchars($data['admission_date']) ?></p>
            <p><strong>Admission Type:</strong> <?= htmlspecialchars($data['admission_type']) ?></p>
            <p><strong>Comments:</strong> <?= htmlspecialchars($data['comment']) ?></p>
            <P><strong>
              <form method="POST">
                <button type="submit" name="download">Download PDF</button>
              </form>
            </P>
        <!-- </div>
        </div class="col-mb-6">
        <form method="POST">
          <button type="submit" name="download">Download PDF</button>
        </form>
        <div>-->
        </div>



        <!-- Action Buttons -->
        <div class="d-flex justify-content-between mt-4">
          <a href="index_records.php" class="btn btn-secondary px-4">Back</a>
          <a class="btn btn-danger px-4" href="delete.php?id=<?= $id ?>">Delete</a>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
