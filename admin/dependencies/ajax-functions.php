<?php
require_once "../../db/dbconfig.php";
require_once "./functions.php";

if (isset($_POST['action_type']) and $_POST['action_type'] == 'end-all-ongoing-test') {
    $query = $conn->prepare("UPDATE ongoing_exam set active='0' WHERE active='1' ");
    if ($query->execute()) {
    	$query = $conn->prepare("UPDATE exams set status='not active' WHERE active='active' ");
        if ($query->execute()) {
        	echo "All ongoing tests has been stopped and submitted.";
        }
    }

}
