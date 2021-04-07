$(document).ready(function(){
   
    /* $("#sort").on('change', function(){
        this.form.submit();
    }); */

    $("#sort").on('change', function(){
        var sort = $(this).val();
        var url = $("#url").val();
        //var material = get_filter("material");
        $.ajax({
            url: url,
            data:{sort:sort, url:url},
            success:function( data){
                $('.filter_products').html(data);
            }
        })
    });

    $(".material").on('click', function(){
        //var class_name = "material";
        var material = get_filter(this.className);
        var sort = $("#sort option:selected").text();
        var url = $("#url").val();
        $.ajax({
            url:url,
            data:{material:material, sort:sort, url:url},
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

});