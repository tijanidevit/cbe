<?php
require_once "../../db/dbconfig.php";
require "../dependencies/functions.php";

$student_id = decrypt($_GET['q']);

    $query = $conn->prepare("UPDATE student SET active='0' WHERE student_id='$student_id' ");
    if ($query->execute()) {
        $_SESSION['response'] = displaySuccess('Account has been trashed successfully.');

    } else {
        $_SESSION['response'] = displayError("Something went wrong. Couldn't perform this operation.");
    }

header("Location: ../students.php");
exit();