<?php
require_once "../../db/dbconfig.php";
require "../dependencies/functions.php";

if (isset($_POST['submit-question'])) {
    $exam_id              = test_input($_POST['exam_id']);
    $passage_id              = test_input($_POST['passage_id']);
    $question_description = test_input($_POST['question_description']);
    $answer               = test_input($_POST['answer']);
    $answer_type          = test_input($_POST['answer_type']);
    $no_of_options_filled = intval(test_input($_POST['no_of_options_filled']));
    $options              = '';
    $attachment           = '0';
    if ($_FILES['attachment']) {
        $attachment = uploadFile($_FILES['attachment'], 'attachment', '../../../');
    }
    
    for ($i = 0; $i < $no_of_options_filled; $i++) {
        if (isset($_POST["option$i"])) {
            $options .= test_input($_POST["option$i"]) . "&&";
        }
    }
    $query = $conn->prepare("INSERT INTO questions(exam_id,passage_id,question_description,options,answer,answer_type,attachment) VALUES('$exam_id','$passage_id','$question_description','$options','$answer','$answer_type','$attachment') ");
    if ($query->execute()) {
        $_SESSION['response'] = displaySuccess('Information successfully received.');
        header("Location: ../questions.php?q=" . encrypt($exam_id));
        exit();
    } else {
        $_SESSION['response'] = displayError("Something went wrong. Couldn't perform this operation.");
        header("Location: ../new-question.php?q=" . encrypt($exam_id));
        exit();
    }

}
