<?php
require_once "../../db/dbconfig.php";
require "../dependencies/functions.php";

if (isset($_POST['add-new'])) {
    $department_name  = test_input($_POST['department_name']);
    $faculty_id  = test_input($_POST['faculty_id']);
   
    $query    = $conn->prepare("INSERT INTO departments(department_name,faculty_id) VALUES('$department_name','$faculty_id') ");
    if ($query->execute()) {
        $_SESSION['response'] = displaySuccess('Information successfully received.');
        header("Location: ../departments.php");
        exit();        
    } else {
        $_SESSION['response'] = displayError("Something went wrong. Couldn't perform this operation.");
        header("Location: ../departments.php");
        exit();
    }
    
}
