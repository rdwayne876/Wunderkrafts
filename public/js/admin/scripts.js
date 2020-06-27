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

    // Update Section status
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

    //Update Categorty Status
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

    // get category level
    $('#section_id').change(function() {
        var section_id = $(this).val();
        // alert(section_id);

        $.ajax({
            type:'post',
            url:'/admin/appendLevel',
            data: {section_id:section_id},

            success: function(resp) {
                $("#categoryLevel").html(resp);
            }, 
            error:function() {
                alert("Error");
            }
        });
    });

    // Confirm delete
    /* $(".confirmDelete").click(function() {
        var name =$(this).attr("name");

        if(confirm("Are you sure you want to delete this "+name+"?")) {
            return true;
        }
        return false;
    }); */

    /* -- Sweet Alert - Parameter -- */
    $(".confirmDelete").click(function() { 

        var record =$(this).attr("record");
        var recordid = $(this).attr("recordid");

        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger m-l-10',
            buttonsStyling: false
        }).then(function () {
            swal(
                'Deleted!',
                'Your data has been deleted.',
                'success'
                )

                window.location.href="/admin/"+record+"/"+recordid;

        }, function (dismiss) {
            if (dismiss === 'cancel') {
                swal(
                    'Cancelled',
                    'Your data is safe',
                    'error'
                    )
            }
        })
    });
});