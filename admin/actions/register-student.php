<?php
require_once "../../db/dbconfig.php";
require "../dependencies/functions.php";

if (isset($_POST['submit-question'])) {
    $matric_number    = test_input($_POST['matric_number']);
    $studentship_type = test_input($_POST['studentship_type']);
    $department_id    = test_input($_POST['department_id']);
    $level_id         = test_input($_POST['level_id']);
    $fullname         = test_input($_POST['fullname']);
    $profile_picture  = uploadFile2($_FILES['profile_picture'], 'student', '../..');

    $query = $conn->prepare("SELECT matric_number FROM student WHERE matric_number='$matric_number'");
    $query->execute();
    if ($query->rowCount() > 0) {
        $_SESSION['response'] = displayError("Unable to register student. Another record was found with this matric number.");
        header("Location: ../students");
        exit();
    } else {
        $query = $conn->prepare("INSERT INTO student(matric_number,studentship_type,fullname,department_id,level_id,profile_picture) VALUES('$matric_number','$studentship_type','$fullname','$department_id','$level_id','$profile_picture') ");
        if ($query->execute()) {
            $_SESSION['response'] = displaySuccess('Information successfully received.');
            header("Location: ../students.php");
            exit();
        } else {
            $_SESSION['response'] = displayError("Something went wrong. Couldn't perform this operation.");
            header("Location: ../new-student");
            exit();
        }
    }
}
