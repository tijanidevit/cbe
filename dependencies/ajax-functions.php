<?php

require_once "./functions.php";

// if (isset($_POST['action_type']) and $_POST['action_type'] == 'check-test-status') {
//     $exam_id  = $_POST['exam_id'];
//     $centre   = $_POST['centre'];
//     $response = '';
//     $query    = $conn->prepare("SELECT active FROM ongoing_exam WHERE exam_id='$exam_id' AND centre='$centre'");
//     $query->execute();
//     if ($query->rowCount() == 0) {
//         $response = false;
//     } else {
//         $row = $query->fecth(PDO::FETCH_ASSOC);
//         if ($row['active'] == 0) {
//             $response = false;
//         } else {
//             $response = true;
//         }
//     }
//     echo $response;

// }
