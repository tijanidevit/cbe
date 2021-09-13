! function(a) {
    "use strict";
    // var examDetails = JSON.parse(localStorage.getItem('examDetails'));
    var cbeTestResult = JSON.parse(localStorage.getItem('cbeTestResult'));
    var visitedQuestions = [],
        answeredQuestion = [],
        correctAnswer = [],
        currentQuestion = 0,
        tq = 0,
        examDuration,
        questions = [];
    var countdown;

    function startExam() {
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
                    if (answeredQuestion.indexOf(n) == -1) {
                        answeredQuestion.push(n);
                    } else {
                        answeredQuestion[answeredQuestion.indexOf(n)].ans = o;
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
                // console.log(correctAnswer);
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
    // console.log(cbeTestResult.questions.length);
    loadQuestions(cbeTestResult.questions, cbeTestResult.questions.length);

    function loadQuestions(b, c) {
        let d = '';
        for (let o = 0; o < c; o++) {
            d = d + '<div id="question' + o + '" class="floated-questions"> <p class="text-dark mt-0 mb-4"><span>' + (o + 1) + '</span>. <span id="question-text">' + b[o].question.q + '</span></p>';
            if (b[o].question.at != '' && b[o].question.at != '0') {
                d = d + '<div id="question-attachment"><img src="admin/uploads/' + b[o].at + '" alt="image" style="width:250px;height:auto;"></div>';
            }
            d = d + ' <div class="option-panel">';
            // options``
            let e = b[o].options;
            if (b[o].ansType == 'multiple') {
                for (let i = 0; i < e.length; i++) {
                    d = d + '<div class="custom-control custom-radiod"> <input type="checkbox" id="customRadiod' + o + '-' + i + '" name="question' + o + '[]" multiple class="custom-control-inputd option-value" value="' + e[i] + '"> <label class="custom-control-labeld text-dark font-weight-0" for="customRadiod' + o + '-' + i + '"><b>' + optionLetter(i) + ".</b> " + e[i] + '</label></div>';
                }
            } else {
                let chosenAns = cbeTestResult.answers.filter(function(index) {
                    return index.q == o;
                });
                for (let i = 0; i < e.length; i++) {
                    if (chosenAns.length > i) {
                        d = d + '<div class="custom-control custom-radio text-danger"> <input type="radio" id="customRadio' + o + '-' + i + '" name="question' + o + '" class="custom-control-input option-value" value="' + e[i] + '"> <label class="custom-control-label ';
                        if (e[i] === b[o].question.ans && b[o].question.ans === chosenAns[0].a) {
                            d = d + 'text-success correct-ans ';
                        } else if (e[i] == b[o].question.ans && b[o].question.ans != chosenAns[0].a) {
                            d = d + 'text-success correct-ans ';
                        } else if (e[i] !== b[o].question.ans && e[i] == chosenAns[0].a) {
                            d = d + 'text-danger wrong-ans ';
                        } else {
                            d = d + 'text-dark ';
                        }
                        d = d + 'font-weight-0" for="customRadio' + o + '-' + i + '"><b>' + optionLetter(i) + ".</b> " + e[i] + '</label></div>';
                    }else{
                        d = d + '<div class="custom-control custom-radio text-danger"> <input type="radio" id="customRadio' + o + '-' + i + '" name="question' + o + '" class="custom-control-input option-value" value="' + e[i] + '"> <label class="custom-control-label ';
                        if (e[i] === b[o].question.ans) {
                            d = d + 'text-success correct-ans ';
                        }  else {
                            d = d + 'text-dark ';
                        }
                        d = d + 'font-weight-0" for="customRadio' + o + '-' + i + '"><b>' + optionLetter(i) + ".</b> " + e[i] + '</label></div>';
                    }
                }
            }
            d = d + ' </div> </div><div class="clearfix"></div><br />';
        }
        a('#question-pane').html(d);
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