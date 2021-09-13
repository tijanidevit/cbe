! function(a) {
    "use strict";
    a('#end-ongoing-test').click(function() {
        let accessPin = a(this).attr('pin');
        let access = prompt("You are about to end all ongoing tests. All students will be logged out. Please enter your access pin to confirm the operation.");
        if (access == accessPin) {
            
            a.ajax({
                url: 'dependencies/ajax-functions.php',
                type : 'post',
                data: {
                    action_type: 'end-ongoing-test'
                },
                success: function(response) {
                    alert(response);
                },
                error: function(response) {
                    console.log("Unable to end ongoing test due to " + response);
                    alert("opps! process terminated, Please check your internet connection.");
                }
            });
        } else {
            alert("Operation terminated, incorrect access pin.");
        }
    });
}(jQuery)