! function(a) {
    "use strict";
    a('#student-login').click(function(e) {
        a('#process-loader').css('display','flex');
        e.preventDefault();
        let action = a(this).parents('form').attr('action');
        let formData = a(this).parents('form').serialize();
        a.ajax({
            url: action,
            type: 'POST',
            dataType: 'JSON',
            data: formData,
            success: function(data) {
                a('#process-loader').hide();
                if (data.error == true) {
                    a("#response-msg").html(data.response).show();
                } else {
                    a("#response-msg").html("").hide();
                    location.href = "home.php";
                }
            },
            error: function(data) {
                a('#process-loader').hide();
                console.log("Unable to login due to " + data);
                console.log(data.response);
                alert("Unable to log in to this account.");
            }
        });
    });
a('#student-login-form').submit(function(e) {
    a('#process-loader').css('display','flex');
        e.preventDefault();
        let action = a(this).attr('action');
        let formData = a(this).serialize();
        a.ajax({
            url: action,
            type: 'POST',
            data: formData,
            dataType: 'JSON',
            success: function(data) {
               if (data.error == true) {
                    a("#response-msg").html(data.response).show();
                } else {
                    a("#response-msg").html("").hide();
                    location.href = "home.php";
                }
            },
            error: function(response) {
                a('#process-loader').hide();
                console.log("Unable to login due to " + response);
                alert("Unable to log in to this account.");
            }
        });
    });
    a('#end-ongoing-test').click(function() {
        let accessPin = a(this).attr('pin');
        let access = prompt("You are about to end all ongoing tests. All students will be logged out. Please enter your access pin to confirm the operation.");
        if (access == accessPin) {
            a.ajax({
                url: 'dependencies/ajax-functions.php',
                type: 'post',
                data: {
                    action_type: 'end-ongoing-test'
                },
                success: function(response) {
                    alert(response);
                    a('.ongoing-exam-button').hide();
                },
                error: function(response) {
                    console.log("Unable to end ongoing test due to " + response);
                    alert("opps! process terminated, Please check your internet connection.");
                }
            });
        } else {
            alert("Operation Terminated.");
        }
    });
    a('.trash-button').click(function(e) {
        let __this = a(this);
        e.preventDefault();
        let linkHref = __this.attr('href');
        let examId = __this.attr('exam-id');
        let accessPin = __this.attr('pin');
        let access = prompt("You are about to trash this item. Please enter your access pin to confirm the operation.");
        if (access == accessPin) {
            a.ajax({
                url: 'actions/' + linkHref,
                type: 'post',
                data: {
                    exam_id: examId
                },
                success: function(data) {
                    alert(data.response);
                    console.log(data);
                    if (data.error == false) {
                        __this.parents('tr').remove();
                    }
                },
                error: function(response) {
                    console.log("Unable to delete exam due to " + response);
                    alert("Opps! process terminated, Please check your internet connection.");
                }
            });
        } else {
            alert("Operation Terminated.");
        }
    });
    a('.trash-button2').click(function(e) {
        e.preventDefault();
        let linkHref = a(this).attr('href');
        if (confirm("Pressing OK means you want to delete this item.") == true) {
            location.href = linkHref;
        }
    });
    a('#add-new').click(function() {
        if (a(this).text() == 'Add New') {
            a(this).text('Close');
        } else {
            a(this).text('Add New');
        }
        a(this).toggleClass('btn-success btn-warning');
        a('#new-form').fadeToggle();
    });
}(jQuery)