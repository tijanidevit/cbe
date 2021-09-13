<?php
require_once "../../db/dbconfig.php";
require "../dependencies/functions.php";

if (isset($_POST['add-new'])) {
    $faculty_name  = test_input($_POST['faculty_name']);
   
    $query    = $conn->prepare("INSERT INTO faculty(faculty_name) VALUES('$faculty_name') ");
    if ($query->execute()) {
        $_SESSION['response'] = displaySuccess('Information successfully received.');
        header("Location: ../faculties.php");
        exit();        
    } else {
        $_SESSION['response'] = displayError("Something went wrong. Couldn't perform this operation.");
        header("Location: ../faculties.php");
        exit();
    }
    
}
