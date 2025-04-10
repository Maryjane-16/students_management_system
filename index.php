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
        <form>

          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control" id="fullName" placeholder="Full Name" required />
                <label for="fullName">Full Name</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="input-group has-validation">
                <span class="input-group-text">@</span>
                <div class="form-floating flex-grow-1">
                  <input type="text" class="form-control" id="username" placeholder="Username" required />
                  <label for="username">Username</label>
                </div>
              </div>
            </div>
          </div>

          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <div class="form-floating">
                <select class="form-select" id="faculty" required>
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
                <select class="form-select" id="department" required>
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
                <input type="date" class="form-control" id="admissionDate" placeholder="Admission Date" required />
                <label for="admissionDate">Admission Date</label>
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label d-block">Admission Type</label>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="admissionType" id="merit" value="Merit" />
                <label class="form-check-label" for="merit">Merit</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="admissionType" id="diploma" value="Diploma" checked />
                <label class="form-check-label" for="diploma">Diploma</label>
              </div>
            </div>
          </div>

          <div class="mb-4">
            <label for="comments" class="form-label">Additional Comments</label>
            <textarea class="form-control" id="comments" rows="4" placeholder="Leave a comment here..."></textarea>
          </div>

          <div class="d-grid">
            <button type="submit" class="btn btn-primary btn-lg rounded-pill">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
