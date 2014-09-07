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
$(document).ready(function(){
    $("#commentTextarea").markupy();
    $('.quote-comment').click(function(){
        var id = $(this).attr('data-quote-id');
        var ct = $("#commentTextarea");
        ct.val( ct.val() + $('#commentContent' + id).text().trim() );
        $("html, body").animate({scrollTop: ct.offset().top }, 200);
    });
});