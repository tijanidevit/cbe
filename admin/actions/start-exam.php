<?php
require_once "../../db/dbconfig.php";
require "../dependencies/functions.php";

$exam_id = decrypt($_GET['q']);
$centre  = 'Lab';
$query   = $conn->prepare("UPDATE exams SET status='active' WHERE exam_id='$exam_id' ");
if ($query->execute()) {

    $query = $conn->prepare("SELECT exam_id FROM ongoing_exam WHERE exam_id='$exam_id'");
    $query->execute();
    if ($query->rowCount() == 0) {
        $query = $conn->prepare("INSERT INTO ongoing_exam(exam_id,centre) VALUES('$exam_id','$centre') ");
        if ($query->execute()) {
            $_SESSION['response'] = displaySuccess('Exam has started successfully.');
        } else {
            $_SESSION['response'] = displayError("Something went wrong. Couldn't perform this operation.");
        }
    } else {
        $_SESSION['response'] = displaySuccess('Exam has started successfully.');
    }

} else {
    $_SESSION['response'] = displayError("Something went wrong. Couldn't perform this operation.");
}

header("Location: ../question-bank.php");
exit();
