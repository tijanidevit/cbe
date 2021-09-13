<?php
require_once "../../db/dbconfig.php";
require "../dependencies/functions.php";

$exam_id = decrypt($_GET['q']);

    $query = $conn->prepare("UPDATE exams SET active='0' WHERE exam_id='$exam_id' ");
    if ($query->execute()) {
        $_SESSION['response'] = displaySuccess('Exam has been trashed successfully.');

    } else {
        $_SESSION['response'] = displayError("Something went wrong. Couldn't perform this operation.");
    }

header("Location: ../question-bank.php");
exit();