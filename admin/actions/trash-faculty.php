<?php
require_once "../../db/dbconfig.php";
require "../dependencies/functions.php";

$faculty_id = decrypt($_GET['q']);

    $query = $conn->prepare("UPDATE faculty SET active='0' WHERE faculty_id='$faculty_id' ");
    if ($query->execute()) {
        $_SESSION['response'] = displaySuccess('Faculty has been trashed successfully.');

    } else {
        $_SESSION['response'] = displayError("Something went wrong. Couldn't perform this operation.");
    }

header("Location: ../faculties.php");
exit();