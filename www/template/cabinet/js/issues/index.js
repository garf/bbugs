$(document).ready(function() {
    $('#dataTable').dataTable({
         "sDom": "<'pull-right'l>t<'row'<'col-lg-6'f><'col-lg-6'p>>",
         "sPaginationType": "bootstrap",
         "oLanguage": {
             "sLengthMenu": "Show _MENU_ entries"
         }
    });
});