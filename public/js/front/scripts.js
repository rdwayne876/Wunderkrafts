$(document).ready(function(){
   
    $('.updateView').click(function(){
        var status = $(this).attr('status');
        $('.updateView').removeClass('active').attr('status', '0');
        $(this).addClass('active').attr('status', '1');
        alert(status);
    }); 
});