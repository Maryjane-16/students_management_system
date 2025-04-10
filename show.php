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
            <p><strong>Full Name:</strong> Okwuazi MaryJane</p>
            <p><strong>Username:</strong> maryjane23</p>
            <p><strong>Faculty:</strong> Science</p>
            <p><strong>Department:</strong> Microbiology</p>
          </div>
          <div class="col-md-6">
            <p><strong>Admission Date:</strong> 2024-09-10</p>
            <p><strong>Admission Type:</strong> Diploma</p>
            <p><strong>Comments:</strong> Looking forward to research.</p>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-between mt-4">
          <a href="index.html" class="btn btn-secondary px-4">← Back</a>
          <a href="delete.php?id=1" class="btn btn-danger px-4" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
