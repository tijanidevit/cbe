<?php
require_once "./functions.php";
if (isset($_POST['student_id']) and isset($_POST['exam_id'])) {
    $questions  = [];
    $student_id = test_input($_POST['student_id']);
    $exam_id    = test_input($_POST['exam_id']);
    $response   = '';
    $error      = false;
    $questions  = [];

    $query = $conn->prepare("SELECT * FROM exams WHERE exam_id='$exam_id' AND active='1' ");
    $query->execute();
    if ($query->rowCount() == 0) {
        $error    = true;
        $response = "An error has occured. Please contact an invigilator.";
    } else {
        $row = $query->fetch(PDO::FETCH_ASSOC);

        $exam_duration   = $row['duration'];
        $total_questions = $row['total_questions'];
        $course          = getValue('course', 'course_id', 'course_name', $row['course_id']);

        $query = $conn->prepare("SELECT * FROM questions WHERE exam_id='$exam_id' AND active='1' ");
        $query->execute();
        $rowCount = $query->rowCount();
        if ($rowCount == 0) {
            $error    = true;
            $response = "An error has occured.No Question found, please contact an invigilator.";
        } else {
            if ($total_questions > $rowCount) {
                $total_questions = $rowCount;
            }
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

                $question    = $row['question_description'];
                $optionArray = explode('&&', $row['options']);
                $options     = [];

                for ($i = 0; $i < count($optionArray); $i++) {
                    if (test_input($optionArray[$i]) != '') {
                        array_push($options, $optionArray[$i]);
                    }
                }
                $answer_type = $row['answer_type'];
                $answer      = [];
                if ($answer_type == 'mutiple') {
                    $answerArray = explode('&&', $row['answer']);
                    for ($i = 0; $i < count($answerArray); $i++) {
                        if (test_input($answerArray[$i]) != '') {
                            array_push($answer, $answerArray[$i]);
                        }
                    }
                } else {
                    $answer = $row['answer'];
                }

                $attachment = '';

                if ($row['attachment'] != '0' || $row['attachment'] != '') {
                    $attachment = $row['attachment'];
                } else {
                    $attachment = '0';
                }

                $single_question = array('q' => $question, 'at' => $attachment, 'ansType' => $answer_type, 'op' => $options, 'ans' => $answer);

                array_push($questions, $single_question);

            }
        }

        echo json_encode(array('questions' => $questions, 'totalQuestions' => $total_questions, 'examDuration' => $exam_duration, 'course' => $course));
    }

}

