<?php
require_once "../../db/dbconfig.php";
require "../dependencies/functions.php";

if (isset($_POST['update-question'])) {
    $exam_id              = test_input($_POST['exam_id']);
    $question_id          = test_input($_POST['question_id']);
    $question_description = test_input($_POST['question_description']);
    $answer               = test_input($_POST['answer']);
    $answer_type          = test_input($_POST['answer_type']);
    $no_of_options        = intval(test_input($_POST['no_of_options']));
    $options              = '';
    $attachment           = '0';
    if (isset($_FILES['attachment'][0])) {
        $attachment = uploadFile($_FILES['attachment'], 'attachment', 'child');
    }

    for ($i = 0; $i < $no_of_options; $i++) {
        if (isset($_POST["option$i"])) {
            $options .= test_input($_POST["option$i"]) . "&&";
        }
    }
//     echo $options;
// exit();
    $query = '';
    if ($attachment == '0') {
        $query = $conn->prepare("UPDATE questions SET exam_id ='$exam_id',question_description ='$question_description',options ='$options',answer ='$answer',answer_type ='$answer_type' WHERE question_id='$question_id' ");
        
    } else {
        $query = $conn->prepare("UPDATE questions SET exam_id ='$exam_id',question_description ='$question_description',options ='$options',answer ='$answer',answer_type ='$answer_type', attachment='$attachment' WHERE question_id='$question_id' ");
    }
    if ($query->execute()) {
            $_SESSION['response'] = displaySuccess('Information successfully updated.');
            header("Location: ../questions.php?q=" . encrypt($exam_id));
            exit();
        } else {
            $_SESSION['response'] = displayError("Something went wrong. Couldn't perform this operation.");
            header("Location: ../edit-question.php?q=" . encrypt($question_id)."&e=".encrypt($exam_id));
            exit();
        }

}
