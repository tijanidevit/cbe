<?php
require_once "../../db/dbconfig.php";
require "../dependencies/functions.php";
$response = 'failed';
if (isset($_POST['department_id'])) {

    $department_id   = $_POST['department_id'];
    $department_name = $_POST['department_name'];

    $query = $conn->prepare("UPDATE departments SET department_name='$department_name' WHERE department_id='$department_id' ");

    if ($query->execute()) {
        $response = displaySuccess('Department successfully updated.');
    } else {
        $response = displayError("Something went wrong. Couldn't perform this operation.");

    }
    $_SESSION['response'] = $response;
    echo $response;
    header("Location: ../departments.php");
}
