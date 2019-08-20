<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("report.php");
$report = new Report(["month", "farm", "block", "chemical", "crop"], ["amount", "total"]);
?>

<!doctype html>
<html>

<head>

<style>

table {
    width: 100%;
    border: 1px solid #AAAAAA;
}

td, th {
    border: 1px solid #AAAAAA;
    padding: 0.25em;
}

td a {
    float: right;
    border: 1px solid black;
    background-color: lightgray;
    text-decoration: none;
    padding: 0 0.25em;
}

</style>

</head>

<body>

<?php $report->render2(); ?>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="jereport.js"></script>

</body>

</html>