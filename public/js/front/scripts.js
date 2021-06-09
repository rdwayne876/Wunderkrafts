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
                $(".getAttrPrice").html("$"+resp);
                $('#size').val(size)
            }, error: function() {
                alert("Error");
            }
        });

        
    });


});