<?php


include_once("../controllers/common.php");
include_once("../models/grade.php");
Database::connect('school', 'root', '');
$id = safeGet("id");

$grades = new Grade($id , "std");
$grades->course_id = safeGet("course_id");
$grades->degree = safeGet("degree");
$grades->examine_at = safeGet("examine_at");

$grades->save();

header('Location: ../students.php');
?>