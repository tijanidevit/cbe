<?php
require_once "../../db/dbconfig.php";
require "../dependencies/functions.php";

$department_id = decrypt($_GET['q']);

    $query = $conn->prepare("UPDATE departments SET active='0' WHERE department_id='$department_id' ");
    if ($query->execute()) {
        $_SESSION['response'] = displaySuccess('Department has been trashed successfully.');

    } else {
        $_SESSION['response'] = displayError("Something went wrong. Couldn't perform this operation.");
    }

header("Location: ../departments.php");
exit();