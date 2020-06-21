$(document).ready(function(){
    // check pw
    $("#currentPassword").keyup(function() {
        var currentPassword = $('#currentPassword').val();
        // alert(currentPassword);

        $.ajax({
            type: 'post',
            url: '/admin/checkCurrentPassword',
            data: {currentPassword:currentPassword},
            success: function(resp){
                alert(resp);

                if (resp == 'false') {
                    $("#checkCurrentPassword").html("Current Password is incorrect!")
                } 
                
            }, error: function() {
                alert("Error");
            }
        });
    });
});