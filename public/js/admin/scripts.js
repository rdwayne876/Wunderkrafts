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
    $(document).on("click","updateSectionStatus", function(){
        var status = $(this).children("i").attr("status");
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
                        "<i class='la la-toggle-off' aria-hidden='true' status='Inactive'></i>")
                } else if(resp['status']==1) {
                    $("#section-"+section_id).html(
                        "<i class='la la-toggle-on' aria-hidden='true' status='Active'></i>")
                }
            }, error:function() {
                alert("Error");
            }
        });
    });

    //Update Categorty Status
    $(document).on("click",".updateCategoryStatus", function(){
        var status = $(this).children("i").attr("status");
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
                        "<i class='la la-toggle-off' aria-hidden='true' status='Inactive'></i>")
                } else if(resp['status']==1) {
                    $("#category-"+category_id).html(
                        "<i class='la la-toggle-on' aria-hidden='true' status='Active'></i>")
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

    
    /* $(".confirmDelete").click(function() {
        var name =$(this).attr("name");

        if(confirm("Are you sure you want to delete this "+name+"?")) {
            return true;
        }
        return false;
    }); */

    // Confirm delete
    $(document).on("click",".confirmDelete", function(){
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

    //Update Product Status
    $(document).on("click",".updateProductStatus", function(){
        var status = $(this).children("i").attr("status");
        var product_id = $(this).attr("product_id");

        $.ajax({
            type: 'POST',
            url: '/admin/updateProductStatus',
            data: {status:status, product_id:product_id},
            success:function(resp) {
                if(resp['status']== 0){
                    $("#product-"+product_id).html(
                        "<i class='la la-toggle-off' aria-hidden='true' status='Inactive'></i>")
                } else if(resp['status']==1) {
                    $("#product-"+product_id).html(
                        "<i class='la la-toggle-on' aria-hidden='true' status='Active'></i>")
                }
            }, error:function() {
                alert("Error");
            }
        });
    });

    //Update Attributes Status
    $(document).on("click",".updateAttributeStatus", function(){
        var status = $(this).children("i").attr("status");
        var attribute_id = $(this).attr("attribute_id");


        $.ajax({
            type: 'POST',
            url: '/admin/updateAttributeStatus',
            data: {status:status, attribute_id:attribute_id},
            success:function(resp) {
                if(resp['status'] == 0){
                    $("#attribute-"+attribute_id).html(
                            "<i class='la la-toggle-off' aria-hidden='true' status='Inactive'></i>");
                } else if(resp['status'] == 1) {
                    $("#attribute-"+attribute_id).html(
                        "<i class='la la-toggle-on' aria-hidden='true' status='Active'></i>");
                }
            }, error:function() {
                alert("Error");
            }
        });
    });

    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><div></div><div></div><input type="text" name="size[]" placeholder="Size"/>&nbsp;<input type="text" name="colour[]" placeholder="Colour"/>&nbsp;<input type="text" name="sku[]" placeholder="SKU"/>&nbsp;<input type="text" name="price[]" placeholder="Price"/>&nbsp;<input type="text" name="stock[]" placeholder="Stock"/><a href="javascript:void(0);" class="remove_button">Remove</a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });

    //Update Image Status
    $(document).on("click",".updateImageStatus", function(){
        var status = $(this).children("i").attr("status");
        var image_id = $(this).attr("image_id");


        $.ajax({
            type: 'POST',
            url: '/admin/updateImageStatus',
            data: {status:status, image_id:image_id},
            success:function(resp) {
                if(resp['status'] == 0){
                    $("#image-"+image_id).html(
                        "<i class='la la-toggle-off' aria-hidden='true' status='Inactive'></i>");
                } else if(resp['status'] == 1) {
                    $("#image-"+image_id).html(
                        "<i class='la la-toggle-on' aria-hidden='true' status='Active'></i>");
                }
            }, error:function() {
                alert("Error");
            }
        });
    });

    // Update Brand status
    $(document).on("click",".updateBrandStatus", function(){
        var status = $(this).children("i").attr("status");
        var brand_id = $(this).attr("brand_id");
        // alert(status);
        // alert(brand_id);

        $.ajax({
            type: 'POST',
            url: '/admin/updateBrandStatus',
            data: {status:status, brand_id:brand_id},
            success:function(resp) {
                if(resp['status']== 0){
                    $("#brand-"+brand_id).html(
                        "<i class='la la-toggle-off' aria-hidden='true' status='Inactive'></i>")
                } else if(resp['status']==1) {
                    $("#brand-"+brand_id).html(
                        "<i class='la la-toggle-on' aria-hidden='true' status='Active'></i>")
                }
            }, error:function() {
                alert("Error");
            }
        });
    });

    // Update Banner status
    $(document).on("click",".updateBannerStatus", function(){
        var status = $(this).children("i").attr("status");
        var banner_id = $(this).attr("banner_id");
        // alert(status);
        // alert(banner_id);

        $.ajax({
            type: 'POST',
            url: '/admin/updateBannerStatus',
            data: {status:status, banner_id:banner_id},
            success:function(resp) {
                if(resp['status']== 0){
                    $("#banner-"+banner_id).html(
                        "<i class='la la-toggle-off' aria-hidden='true' status='Inactive'></i>")
                } else if(resp['status']==1) {
                    $("#banner-"+banner_id).html(
                        "<i class='la la-toggle-on' aria-hidden='true' status='Active'></i>")
                }
            }, error:function() {
                alert("Error");
            }
        });
    });

    // Update Coupon status
    $(document).on("click",".updateCouponStatus", function(){
        var status = $(this).children("i").attr("status");
        var coupon_id = $(this).attr("coupon_id");
        // alert(status);
        // alert(coupon_id);

        $.ajax({
            type: 'POST',
            url: '/admin/updateCouponStatus',
            data: {status:status, coupon_id:coupon_id},
            success:function(resp) {
                if(resp['status']== 0){
                    $("#coupon-"+coupon_id).html(
                        "<i class='la la-toggle-off' aria-hidden='true' status='Inactive'></i>")
                } else if(resp['status']==1) {
                    $("#coupon-"+coupon_id).html(
                        "<i class='la la-toggle-on' aria-hidden='true' status='Active'></i>")
                }
            }, error:function() {
                alert("Error");
            }
        });
    });

    $("#manualCoupon").click(function(){
        $("#couponField").show();
    });

    $("#automaticCoupon").click(function(){
        $("#couponField").hide();
    });

});




    