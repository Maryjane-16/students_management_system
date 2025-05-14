<?php

session_start();

use Dompdf\Dompdf;

require_once "vendor/autoload.php";
require_once "includes/db_connect.php";
require_once "includes/get_record_id.php";
require_once "includes/isloggedin.php";

$id = $_GET['id'];

//connect our db
$conn = connectDB();
$data = getRecordById($conn, $id);

//start output buffering
ob_start();

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
</head>
<body>

<article>
    <p>ID: <?= htmlspecialchars($data['id']) ?></p>
    <p>Full name: <?= htmlspecialchars($data['full_name']) ?></p>
    <p>Username: <?= htmlspecialchars($data['username']) ?></p>
    <p>Faculty: <?= htmlspecialchars($data['faculty']) ?></p>
    <p>Department: <?= htmlspecialchars($data['department']) ?></p>
    <p>Admission type: <?= htmlspecialchars($data['admission_type']) ?></p>
    <p>Admission date: <?= htmlspecialchars($data['admission_date']) ?></p>
    <p>Comment: <?= htmlspecialchars($data['comment']) ?></p>

</article>

</body>
</html>

<?php

// get the buffered output and cleans the buffer afterwards
$html = ob_get_clean();

// instantiate and use the dompdf class
$dompdf = new Dompdf();

// load html contents
$dompdf->loadHtml($html);

//setup the paper size and orientattion
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

//output the generated PDF to Browser
$dompdf->stream('output.pdf', ['Attachment' => false]);

?>