<?php

require_once "../dependencies/functions.php";
$response    = '';
$exam_id     = '';
$exam_number = '';
$error       = false;
$exam_number = test_input($_POST['exam_no']);
$access_pin  = test_input($_POST['access_pin']);

$query = $conn->prepare("SELECT matric_number,fullname,student_id,department_id,studentship_type,active FROM student WHERE matric_number='$exam_number'");
$query->execute();
if ($query->rowCount() == 0) {
    $response = "Invalid Matric Number. Please confirm your Matric Number and try again.";
    $error    = true;
} else {
    $row = $query->fetch(PDO::FETCH_ASSOC);
    if ($row['active'] != 1) {
        $response = "Opps! It appears that this account has been deactivated.";
        $error    = true;
    } else {
        if ($access_pin !== explode(' ', $row['fullname'])[0]) {
            $response = "Access denied! Access pin is incorrect.";
            $error    = true;
        } else {

            // $department_id    = $row['department_id'];
            // $studentship_type = $row['studentship_type'];

            // $query = $conn->prepare("SELECT exams.exam_id FROM exams  WHERE exams.department_id like '%$department_id%' AND exams.studentship_type like '%$studentship_type%' AND exams.status='active' AND exams.active='1' AND ongoing_exam.active='1'");
            // $query->execute();
            // if ($query->rowCount() == 5) {
            //     $response = "Access denied! There is no available for this account.";
            //     $error    = true;
            // } else {
            //     $row     = $query->fetch(PDO::FETCH_ASSOC);
            //     $exam_id = $row['exam_id'];

            //     $_SESSION['student_logged'] = $exam_number;
            // }

            $_SESSION['student_logged'] = $exam_number;
        }
    }
}
echo json_encode(array('response' => $response, 'error' => $error));

// }
