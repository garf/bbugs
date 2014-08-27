$(document).ready(function(){
    $('.delete-contact').click(function(){
        var message = $(this).attr('data-message');
        var id = $(this).attr('data-id');
        var url = $(this).attr('href');
        if(confirm(message)) {
            $.get(url, '', function(data){
                var json = $.parseJSON(data);
                if(!json.error) {
                    $('.contact' + id).hide(0);
                } else {
                    $('.message' + id).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' + json.message + '</div>');
                }
            });
        }
        return false;
    });
});