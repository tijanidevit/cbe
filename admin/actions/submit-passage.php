<?php
require_once "../../db/dbconfig.php";
require "../dependencies/functions.php";

if (isset($_POST['submit-passage'])) {
    $exam_id              = test_input($_POST['exam_id']);
    $passage = test_input($_POST['passage']);
    $instruction = test_input($_POST['instruction']);
    $query = $conn->prepare("INSERT INTO passages(exam_id,passage,instructions) VALUES('$exam_id','$passage','$instruction') ");
    if ($query->execute()) {
        $_SESSION['response'] = displaySuccess('Information successfully received.');
        header("Location: ../passages.php?q=" . encrypt($exam_id));
        exit();
    } else {
        $_SESSION['response'] = displayError("Something went wrong. Couldn't perform this operation.");
        header("Location: ../passages.php?q=" . encrypt($exam_id));
        exit();
    }

}
