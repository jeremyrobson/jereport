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

<link href="jereport.css" rel="stylesheet" />
<style>

table {
    table-layout: fixed;
    width: 100%;
    border: 1px solid #AAAAAA;
    border-collapse: collapse;
}

th {
    font-weight: 700;
    background-color: #ddd;
}

td, th {
    border: 1px solid #ccc;
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

<?php $report->render(); ?>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="jereport.js"></script>

</body>

</html>