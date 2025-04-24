<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Unauthorized</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                background-color: #f8f9fa;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .unauth-card {
                max-width: 500px;
                width: 100%;
                background: #fff;
                padding: 2rem;
                border-radius: 1rem;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="unauth-card">
            <h3 class="mb-3 text-danger">Unauthorized Access</h3>
            <p class="mb-4">You must be logged in to access this page.</p>
            <a href="index.php" class="btn btn-primary">Back to Homepage</a>
        </div>
    </body>
    </html>