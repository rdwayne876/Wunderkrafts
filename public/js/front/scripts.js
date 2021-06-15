$(document).ready(function(){
   
    /* $("#sort").on('change', function(){
        this.form.submit();
    }); */

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#sort").on('change', function(){
        var material = get_filter("material");
        var gemstone = get_filter('gemstone');
        var bundle = get_filter('bundle');
        var sort = $(this).val();
        var url = $("#url").val();
        $.ajax({
            url: url,
            data:{material:material, gemstone:gemstone, bundle:bundle, sort:sort, url:url},
            success:function( data){
                $('.filter_products').html(data);
            }
        })
    });

    $(".material").on('click', function(){
        //var class_name = "material";
        var material = get_filter(this.className);
        var gemstone = get_filter('gemstone');
        var bundle = get_filter('bundle');
        var sort = $("#sort option:selected").val();
        //alert(sort);
        var url = $("#url").val();
        $.ajax({
            url:url,
            data:{material:material, gemstone:gemstone, bundle:bundle, sort:sort, url:url},
            success:function( data){
                $('.filter_products').html(data);
            }
        })
    });

    $(".gemstone").on('click', function(){
        //var class_name = "material";
        var gemstone = get_filter(this.className);
        var material = get_filter('material');
        var bundle = get_filter('bundle');
        var sort = $("#sort option:selected").val();
        //alert(sort);
        var url = $("#url").val();
        $.ajax({
            url:url,
            data:{ gemstone:gemstone, material:material, bundle:bundle, sort:sort, url:url},
            success:function( data){
                $('.filter_products').html(data);
            }
        })
    });

    $(".bundle").on('click', function(){
        //var class_name = "material";
        var bundle = get_filter(this.className);
        var material = get_filter('material');
        var gemstone = get_filter('gemstone');
        var sort = $("#sort option:selected").val();
        //alert(sort);
        var url = $("#url").val();
        $.ajax({
            url:url,
            data:{ bundle:bundle, gemstone:gemstone, material:material, sort:sort, url:url},
            success:function( data){
                $('.filter_products').html(data);
            }
        })
    });
    
    function get_filter(class_name) {
        
        var filter=[];
        //alert(class_name);
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });

        //alert(filter);
        return filter;
    }

    $('.list-size a').click(function(){
        $('.list-size a.active').removeClass('active');
        $(this).addClass('active');

        var size = $('.list-size a.active').children("input").attr("value");
        var  product_id = $('.list-size a.active').children("input").attr("product-id");
        //alert( product_id);
        //alert(test);
        $.ajax({
            url: '/get-size',
            data:{ size:size, product_id:product_id},
            type: 'post',
            success: function( resp) {
                if(resp['discounted_price']>0) {
                    $(".getAttrPrice").html("<del>$"+resp['product_price']+"</del> $"+resp['discounted_price']);
                    $('#size').val(size)
                }else {
                    $(".getAttrPrice").html("$"+resp['product_price']);
                    $('#size').val(size)
                }

            }, error: function() {
                alert("Error");
            }
        });

        
    });

    $(document).on('click', '.btnItemUpdate', function(){

        var cartid = $(this).data('cartid');
        var quantity = $("#qty").val();
        $.ajax({
            data:{"cartid":cartid, "qty":quantity},
            url:'/updateCartItemQty',
            type:'post',
            success:function(resp){
                if(resp.status==false){
                    alert("Product Stock is not available");
                }
                $("#AppendCartItems").html(resp.view);
            }, error:function(){
                alert("Error");
            }
        });
    });

    $(document).on('click', '.itemDelete', function(){

        var cartid = $(this).data('cartid');
        var result = confirm("Are you sure you want to delete this Item?")
        if(result){
            $.ajax({
                data:{"cartid":cartid},
                url:'/deleteCartItem',
                type:'post',
                success:function(resp){
                    $("#AppendCartItems").html(resp.view);
                }, error:function(){
                    alert("Error");
                }
            });
        }
    });

    $("#registerForm").validate({
        rules: {
            name: "required",
            email: {
                required: true,
                email: true,
                remote: "check-email"
            },
            phone: {
                required: true,
                minlength: 10,
                maxlength: 10,
                digits:true
            },
            registerPassword: {
                required: true,
                minlength: 8
            },
            confirmPassword: {
                required: true,
                minlength: 8,
                equalTo: "#registerPassword"
            },
            registerAgree: "required"
        },
        messages: {
            name: "Please enter your Firstname and Lastname",
            email: { 
                email: "Please enter a valid email address",
                required: "Please enter your email address",
                remote: "Email already in use"
             },
            phone: {
                required: "Please provide a phone number",
                minlength: "Phone must be 10 digits",
                maxlength: "Phone must be 10 digits",
                digits: "Please enter a valid phone number"
            },
            registerPassword: {
                required: "Please provide a password",
                minlength: "Your password must be at least 8 characters long"
            },
            confirmPassword: {
                required: "Please confirm your password",
                minlength: "Your password must be at least 8 characters long",
                equalTo: "Please enter the same password as above"
            }, 
            registerAgree: "Please accept our policy",
        }
    });

    $("#registerForm").validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
                minlength: 8
            }
        },
        messages: {
            email: { 
                email: "Please enter your email address",
                required: "Please enter your email address",
             },

            password: {
                required: "Please enter password",
            },
        }
    });

});