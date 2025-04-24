<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['login'])){

        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        if($username == 'lexisacademy' && $password == 'lexisacademy123'){

            // this helps prevent session fixation attacks
            session_regenerate_id(true);

            $_SESSION['is_logged_in'] = true;

            header('Location: http://localhost:200/index_records.php');
            exit;

        }else{

            $error = "Your login credential is incorrect";
        }
        
    }
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-card {
      width: 100%;
      max-width: 400px;
      border-radius: 1rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      padding: 2rem;
      background-color: #ffffff;
    }

    .form-control:focus {
      box-shadow: none;
      border-color: #0d6efd;
    }

    .btn-back {
      margin-left: 0.5rem;
    }
  </style>
</head>
<body>

  <div class="login-card">
    <h3 class="text-center mb-4">Login to Your Account</h3>
    <div class="card-body">

    <?php if (!empty($error)): ?>
        <p class="text-center text-danger"><?= $error ?> </p>
    <?php endif; ?>

    <form method="POST">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
      </div>

      <div class="mb-4">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
      </div>

      <div class="d-flex justify-content-between">
        <button type="submit" name="login" class="btn btn-primary">Login</button>
        <a href="index.php" class="btn btn-secondary">Back</a>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
