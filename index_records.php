<?php

require_once "includes/db_connect.php";

$conn = connectDB();

//Read from the database

$sql = "SELECT * FROM records";

$results = mysqli_query($conn, $sql);

if ($results === false) {
    echo mysqli_error($conn);
} else {
    $all_data = mysqli_fetch_all($results, MYSQLI_ASSOC);
}

//Clearing all records at once from the database
if (isset($_POST['clear_records'])) {

    $sql = "TRUNCATE TABLE records";
    mysqli_query($conn, $sql);

    header("Location: http://localhost:200/index_records.php");
    exit();
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="bg-light py-5">

    <div class="container">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-primary text-white text-center rounded-top-4">
                <h3 class="mb-0">Student Records</h3>
                <small class="text-light">List of all registered students</small>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Username</th>
                                <th>Faculty</th>
                                <th>Department</th>
                                <th>Admission Date</th>
                                <th>Admission Type</th>
                                <th>Comments</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <?php if (!empty($all_data)): ?>
                            <tbody>

                                <!-- Example Data Row -->
                                <?php foreach ($all_data as $index => $data): ?>
                                    <tr>
                                        <td><?= $data['id'] ?></td>
                                        <td><?= $data['full_name'] ?></td>
                                        <td><?= $data['username'] ?></td>
                                        <td><?= $data['faculty'] ?></td>
                                        <td><?= $data['department'] ?></td>
                                        <td><?= $data['admission_date'] ?></td>
                                        <td><?= $data['admission_type'] ?></td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $data['id'] ?>">
                                                Comments
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal<?= $data['id'] ?>" aria-labelledby="exampleModalLabel<?= $data['id'] ?>" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Student Comment</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?= $data['comment'] ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-secondary" href="show.php?id=<?= $data['id'] ?>">Show</a>
                                            <a class="btn btn-sm btn-warning me-1" href="edit.php?id=<?=$data['id'] ?>">Update</a>
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                                <!-- Additional rows will go here from the database -->

                            </tbody>
                        <?php else: ?>
                            <p>No student records found.</p>
                        <?php endif; ?>
                    </table>
                </div>
                <div class="text-center mt-4 d-flex justify-content-center gap-3">
                    <a href="/index.php" class="btn btn-success px-4">Add New Student</a>

                    <form method="POST">
                        <button type="submit" name="clear_records" class="btn btn-dark px-4">Clear Records</button>
                    </form>
                </div>

            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>