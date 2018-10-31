<?php


header('Content-Type: application/json; charset=utf-8');
include_once("../models/grade.php");
Database::connect('school', 'root', '');
$grades = new Grade($_GET['id']);
$grades->delete();
echo json_encode(['status' => 1]);
?>
