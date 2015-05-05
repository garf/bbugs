
$('.delete-project').click(function(){
    var p = prompt($(this).attr('data-message'));
    var url = $(this).attr('data-url');
    if(p == 'OK' || p == 'ОК') {
        document.location.href= url;
    }
});