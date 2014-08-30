(function($) {
    $(document).ready(function() {
        if(window.location.hash) {
            var id = '#' + window.location.hash.split('#')[1];
            console.log(id);
            $('.tab-pane').removeClass('active');
            $(id).addClass('active');
        }
        $('.list-inline li > a').click(function() {
            var activeForm = $(this).attr('href') + ' > form';
            $(activeForm).addClass('animated fadeIn');
            setTimeout(function() {
                $(activeForm).removeClass('animated fadeIn');
            }, 1000);
        });
    });
})(jQuery);