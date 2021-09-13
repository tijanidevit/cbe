<?php

require_once "./functions.php";

if (isset($_POST['action_type']) and $_POST['action_type'] == 'submit-exam') {
    $exam_id    = test_input($_POST['examId']);
    $student_id = getValue('student','matric_number','student_id',test_input($_POST['studentId']));
    $score      = test_input($_POST['score']);
    $response   = '';
    $query      = $conn->prepare("SELECT score FROM exam_result WHERE exam_id='$exam_id' AND student_id='$student_id'");
    $query->execute();
    if ($query->rowCount() == 0) {
        $query = $conn->prepare("INSERT INTO exam_result(exam_id,student_id,score) VALUES('$exam_id','$student_id','$score') ");
        if ($query->execute()) {
            $_SESSION['submit-success'] = true;
            $response = true;
        } else {
            $response = false;
        }
    } else {
        $query = $conn->prepare("UPDATE exam_result SET score='$score' WHERE exam_id='$exam_id' AND student_id='$student_id' ");
        if ($query->execute()) {
            $_SESSION['submit-success'] = true;
            $response = true;
        } else {
            $response = false;
        }
    }
    echo $response;

}
