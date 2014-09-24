function AddCommentController($scope) {

    $scope.lines = [];

    $scope.addFile = function() {
        $scope.lines.push($scope.lines.length+1);
    };

    $scope.removeFile = function(index) {
        $scope.lines.splice(index, 1);
    };

    $scope.isMaxMessage = function() {
        var max = $('#maxFiles').val();
        return $scope.lines.length >= (max - 1);
    }
}

/*----------- BEGIN Markdown.Editor CODE -------------------------*/
var converter = new Markdown.getSanitizingConverter();
var cont = $("#wmdContent");
var context = cont.text();
cont.html(converter.makeHtml(context));


$.each($('.comment-text'), function(key, value){
    var contextComment = $(value).text();
//    console.log(contextComment);
    $(this).html(converter.makeHtml(contextComment));
});


var editor = new Markdown.Editor(converter);
editor.run();

/*----------- END Markdown.Editor CODE -------------------------*/

$('.quote-comment').click(function(){
    var id = $(this).attr('data-quote-id');
    var ct = $("#commentTextarea");
    ct.val( ct.val() + $('#commentContent' + id).text().trim() ).trigger('autosize.resize');
    $("html, body").animate({scrollTop: ct.offset().top }, 200);
});