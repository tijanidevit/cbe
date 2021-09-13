! function(a) {
    "use strict";
    var examDetails = JSON.parse(localStorage.getItem('examDetails'));
    var visitedQuestions = [],
        answeredQuestion = [],
        correctAnswer = [],
        currentQuestion = 0,
        tq = 0,
        examDuration,
        questions = [];
    var countdown;
    initialise();

    function initialise() {
        a.ajax({
            url: 'dependencies/load-questions.php',
            type: 'post',
            dataType: 'JSON',
            data: {
                student_id: examDetails.examNo,
                exam_id: examDetails.examId
            },
            success: function(response) {
                a('#course-name').text(response.course);
                a('#exam-duration').text(response.examDuration);
                a('#total-questions').text(response.totalQuestions);
                questions = response.questions;
                tq = response.totalQuestions;
                examDuration = response.examDuration;
                for (let i = 1; i <= tq; i++) {
                    a('#question-list').append('<button data-attribute="' + i + '" class="btn mb-2 btn-xs btn-primary mr-2">' + i + '</button>');
                }
                loadQuestions(questions, tq);
            },
            error: function(response) {
                setTimeout(function() {
                    console.log(response);
                    a('#seek-attention').css('display', 'flex');
                }, 2500);
            }
        });
    };

    function startExam() {
        visitedQuestions = [];
        answeredQuestion = [];
        correctAnswer = [];
        currentQuestion = 0;
        initialise();
        a('.instruction-pane').hide('fast', function() {
            a('.examination-pane').show();
            timer();
            displayQuestion(0);
            a('.option-value').change(function() {
                let o = a(this).val();
                let __this = a(this);
                if (questions[currentQuestion].ansType == 'single') {
                    let n = {
                        q: currentQuestion,
                        a: o
                    };
                    if (answeredQuestion.length == 0) {
                        answeredQuestion.push(n);
                    } else {
                        for (let y = 0; y < answeredQuestion.length; y++) {
                            if (answeredQuestion[y].q == currentQuestion) {
                                answeredQuestion[y].a = o;
                            } else {
                                answeredQuestion.push(n);
                            }
                        }
                    }
                    if (o === questions[currentQuestion].ans && questions[currentQuestion].ansType == 'single') {
                        if (correctAnswer.indexOf(currentQuestion) == -1) {
                            correctAnswer.push(currentQuestion);
                        }
                    } else if (o === questions[currentQuestion].ans && questions[currentQuestion].ansType == 'multiple') {
                        if (correctAnswer.indexOf(currentQuestion) == -1) {
                            correctAnswer.push(currentQuestion);
                        }
                    } else {
                        correctAnswer.pop(correctAnswer.indexOf(currentQuestion));
                    }
                } else if (questions[currentQuestion].ansType == 'multiple') {
                    // console.log(a('.option-value:checked').val());
                }
            });
            a('#question-list button').click(function() {
                let n = a(this).attr('data-attribute');
                a('#question' + currentQuestion + ' .option-value').each(function() {
                    if (a(this).prop('checked')) {
                        a('#question-list button[data-attribute="' + (currentQuestion + 1) + '"]').removeClass('btn-danger').addClass('btn-success');
                    }
                });
                currentQuestion = n - 1;
                displayQuestion(currentQuestion);
            });
        });
    }

    function displayQuestion(q) {
        if ((q + 1) == tq) {
            a('#next-question').hide();
            a('#submit-answer').show();
        } else {
            a('#submit-answer').hide();
            a('#next-question').show();
        }
        if (q == 0) {
            a('#previous-question').attr('disabled', 'disabled');
        } else {
            a('#previous-question').removeAttr('disabled');
        }
        a('#question-list button[data-attribute="' + (currentQuestion + 1) + '"]').removeClass('btn-primary').addClass('btn-danger');
        a('#pre-loader').show();
        a('.floated-questions').hide('fast', function() {
            a('#pre-loader').hide();
            a('#question' + q).slideDown('fast');
        });
    }

    function loadQuestions(b, c) {
        //shuffle questions
        b = shuffle(b);
        let d = '';
        // console.log(b[0]);
        for (let o = 0; o < c; o++) {
            d = d + '<div id="question' + o + '" class="floated-questions"> <p class="text-dark mt-0 mb-4"><span>' + (o + 1) + '</span>. <span id="question-text">' + b[o].q + '</span></p>';
            if (b[o].at != '' && b[o].at != '0') {
                d = d + '<div id="question-attachment"><img src="admin/uploads/' + b[o].at + '" alt="image" style="width:250px;height:auto;"></div>';
            }
            d = d + ' <div class="option-panel">';
            //shuffle options``
            let e = shuffle(b[o].op);
            visitedQuestions.push({
                question: b[o],
                options: e
            });
            if (b[o].ansType == 'multiple') {
                for (let i = 0; i < e.length; i++) {
                    d = d + '<div class="custom-control custom-radiod"> <input type="checkbox" id="customRadiod' + o + '-' + i + '" name="question' + o + '[]" multiple class="custom-control-inputd option-value" value="' + e[i] + '"> <label class="custom-control-labeld text-dark font-weight-0" for="customRadiod' + o + '-' + i + '"><b>' + optionLetter(i) + ".</b> " + e[i] + '</label></div>';
                }
            } else {
                for (let i = 0; i < e.length; i++) {
                    d = d + '<div class="custom-control custom-radio"> <input type="radio" id="customRadio' + o + '-' + i + '" name="question' + o + '" class="custom-control-input option-value" value="' + e[i] + '"> <label class="custom-control-label text-dark font-weight-0" for="customRadio' + o + '-' + i + '"><b>' + optionLetter(i) + ".</b> " + e[i] + '</label></div>';
                }
            }
            d = d + ' </div> </div><div class="clearfix"></div>';
        }
        a('#question-pane').html(d);
    }

    function timer() {
        var timer = a('#timer');
        var hrTime = a('#hr');
        var mmTime = a('#mm');
        var ssTime = a('#ss');
        var hr = examDuration.substring(0, 2);
        var mm = examDuration.substring(3, 5);
        var ss = examDuration.substring(6, 8);
        // let totalTime = duration;
        let remainTime = 0;
        countdown = setInterval(function() {
            if (ss > 0) {
                ss--;
            } else {
                if (mm > 0) {
                    mm--;
                } else {
                    if (hr > 0) {
                        mm = 59;
                        hr--;
                    } else {
                        clearInterval(countdown);
                        timeElapsed();
                    }
                }
                ss = 59;
            }
            ssTime.text(leadingzero(ss));
            mmTime.text(leadingzero(mm));
            hrTime.text(leadingzero(hr));
            if (ss <= 59 && mm <= 4 && hr == 0) {
                a('#timer').addClass('text-danger blink-text');
            }
        }, 1000);
    }

    function leadingzero(n) {
        if (String(n).length == 1) {
            n = "0" + n;
        }
        return n;
    }

    function optionLetter(a) {
        a++;
        if (a == 1) {
            return "A";
        } else if (a == 2) {
            return "B";
        } else if (a == 3) {
            return "C";
        } else if (a == 4) {
            return "D";
        } else if (a == 5) {
            return "E";
        } else if (a == 6) {
            return "F";
        } else if (a == 7) {
            return "G";
        } else if (a == 8) {
            return "H";
        }
    }

    function timeElapsed() {
        submitExam();
    }

    function submitExam() {
        a('#submit-overlay').css('display', 'flex');
        a.ajax({
            url: 'dependencies/submit-exam.php',
            type: 'post',
            data: {
                action_type: 'submit-exam',
                studentId: examDetails.examNo,
                examId: examDetails.examId,
                score: correctAnswer.length
            },
            success: function(response) {
                a('#submit-overlay').hide();
                setTimeout(function() {
                    if (response == true) {
                        $('.examination-pane').hide();
                        $('.instruction-pane').show();
                        let cbeTestResult = {
                            questions: visitedQuestions,
                            answers: answeredQuestion
                        };
                        localStorage.setItem('cbeTestResult', JSON.stringify(cbeTestResult));
                        if (answeredQuestion.length == 0 || visitedQuestions.length == 0) {
                            $('#timeElapsed').click();
                        } else {
                            $('#exam-score').html(correctAnswer.length + " out of " + tq);
                            $('#check-answer-modal').click();
                        }
                    } else {
                        console.log(response);
                        a('#seek-attention').css('display', 'flex');
                    }
                }, 1000);
            },
            error: function(response) {
                a('#submit-overlay').hide();
                setTimeout(function() {
                    console.log(response);
                    a('#seek-attention').css('display', 'flex');
                }, 1000);
            }
        });
    }

    function shuffle(arr) {
        let ctr = arr.length;
        let temp;
        let index;
        // While there are elements in the array
        while (ctr > 0) {
            // Pick a random index
            index = Math.floor(Math.random() * ctr);
            // Decrease ctr by 1
            ctr--;
            // And swap the last element with it
            temp = arr[ctr];
            arr[ctr] = arr[index];
            arr[index] = temp;
        }
        return arr;
    }
    a('#start-exam').click(function() {
        startExam();
    });
    a('#next-question').click(function() {
        a('#question' + currentQuestion + ' .option-value').each(function() {
            if (a(this).prop('checked')) {
                a('#question-list button[data-attribute="' + (currentQuestion + 1) + '"]').removeClass('btn-danger').addClass('btn-success');
            }
        });
        currentQuestion += 1;
        displayQuestion(currentQuestion);
    });
    a('#previous-question').click(function() {
        a('#question' + currentQuestion + ' .option-value').each(function() {
            if (a(this).prop('checked')) {
                a('#question-list button[data-attribute="' + (currentQuestion + 1) + '"]').removeClass('btn-danger').addClass('btn-success');
            }
        });
        currentQuestion--;
        displayQuestion(currentQuestion);
    });
    a('#submit-answer,#submit-exam').click(function() {
        a('#confirm-submit-modal').click();
    });
    a('#confirm-submit').click(function() {
        a('.close-modal').click();
        setTimeout(function() {
            submitExam();
        }, 1500);
    });
}(jQuery)