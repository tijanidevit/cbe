<?php
require_once "../../db/dbconfig.php";
require "../dependencies/functions.php";

if (!isset($_GET['e']) || empty($_GET['e'])) {

    header("Location: ../question-bank.php");
}
if (!isset($_GET['q']) || empty($_GET['q'])) {

    header("Location: ../questions.php?q=" . $_GET['e']);
}
$question_id = decrypt($_GET['q']);
$exam_id     = $_GET['e'];

$query = $conn->prepare("UPDATE questions SET active='0' WHERE question_id='$question_id' ");
if ($query->execute()) {
    $_SESSION['response'] = displaySuccess('Question has been trashed successfully.');

} else {
    $_SESSION['response'] = displayError("Something went wrong. Couldn't perform this operation.");
}

header("Location: ../questions.php?q=" . $_GET['e']);
exit();
