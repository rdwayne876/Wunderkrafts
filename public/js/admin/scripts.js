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
                
            }, error: function() {
                alert("Error");
            }
        });
    });

    $(".updateSectionStatus").click(function() {
        var status = $(this).text();
        var section_id = $(this).attr("section_id");
        // alert(status);
        // alert(section_id);

        $.ajax({
            type: 'POST',
            url: '/admin/updateSectionStatus',
            data: {status:status, section_id:section_id},
            success:function(resp) {
                if(resp['status']== 0){
                    $("#section-"+section_id).html(
                        "<a class='updateSectionStatus' href='javascript:void(0)''>Inactive</a>")
                } else if(resp['status']==1) {
                    $("#section-"+section_id).html(
                        "<a class='updateSectionStatus' href='javascript:void(0)''>Active</a>")
                }
            }, error:function() {
                alert("Error");
            }
        });
    });

    $(".updateCategoryStatus").click(function() {
        var status = $(this).text();
        var category_id = $(this).attr("category_id");
        // alert(status);
        // alert(category_id);

        $.ajax({
            type: 'POST',
            url: '/admin/updateCategoryStatus',
            data: {status:status, category_id:category_id},
            success:function(resp) {
                if(resp['status']== 0){
                    $("#category-"+category_id).html(
                        "<a class='updateCategoryStatus' href='javascript:void(0)''>Inactive</a>")
                } else if(resp['status']==1) {
                    $("#category-"+category_id).html(
                        "<a class='updateCategoryStatus' href='javascript:void(0)''>Active</a>")
                }
            }, error:function() {
                alert("Error");
            }
        });
    });
});