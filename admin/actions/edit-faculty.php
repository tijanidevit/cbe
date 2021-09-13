<?php
require_once "../../db/dbconfig.php";
require "../dependencies/functions.php";
$response = 'failed';
if (isset($_POST['faculty_id'])) {

    $faculty_id   = $_POST['faculty_id'];
    $faculty_name = $_POST['faculty_name'];

    $query = $conn->prepare("UPDATE faculty SET faculty_name='$faculty_name' WHERE faculty_id='$faculty_id' ");

    if ($query->execute()) {
        $response = displaySuccess('Faculty successfully updated.');
    } else {
        $response = displayError("Something went wrong. Couldn't perform this operation.");

    }
    $_SESSION['response'] = $response;
    echo $response;
    header("Location: ../faculties.php");
}
