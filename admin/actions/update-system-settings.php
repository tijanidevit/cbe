<?php
require_once "../../db/dbconfig.php";
require "../dependencies/functions.php";

if (isset($_POST['update-settings'])) {

$studentship_mode = '';

    foreach ($_POST['studentship_mode'] as $studentship){
     $studentship_mode  .= strtolower(test_input($studentship)).";";
}
   $query = $conn->prepare("UPDATE settings SET studentship_mode ='$studentship_mode' ");

    if ($query->execute()) {
            $_SESSION['response'] = displaySuccess('Information successfully updated.');
            header("Location: ../settings.php");
            exit();
        } else {
            $_SESSION['response'] = displayError("Something went wrong. Couldn't perform this operation.");
            header("Location: ../setup.php");
            exit();
        }

}
