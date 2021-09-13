<?php
require_once "../../db/dbconfig.php";
require "../dependencies/functions.php";

if (isset($_POST['submit-exam'])) {
    $session  = test_input($_POST['session']);
    $level_id  = test_input($_POST['level_id']);
    $course_id  = test_input($_POST['course_id']);
    $total_questions  = test_input($_POST['total_questions']);
    $duration  = test_input($_POST['duration']);
    $department_id = '';
$studentship_type = '';

    foreach ($_POST['department_id'] as $department){
     $department_id  .= test_input($department).";";
}    foreach ($_POST['studentship_type'] as $studentshipType){
     $studentship_type  .= test_input($studentshipType).";";
}

    $query    = $conn->prepare("INSERT INTO exams(session,department_id,level_id,studentship_type,course_id,total_questions,duration) VALUES('$session','$department_id','$level_id','$studentship_type','$course_id','$total_questions','$duration') ");
    if ($query->execute()) {
        $_SESSION['response'] = displaySuccess('Information successfully received.');
        header("Location: ../question-bank.php");
        exit();        
    } else {
        $_SESSION['response'] = displayError("Something went wrong. Couldn't perform this operation.");
        header("Location: ../new-exam.php");
        exit();
    }
    
}
