function AddCommentController($scope) {

    $scope.lines = [];

    $scope.addFile = function() {
        $scope.lines.push($scope.lines.length+1);
    };

    $scope.removeFile = function(index) {
        $scope.lines.splice(index, 1);
    };

    $scope.isMaxMessage = function() {
        return $scope.lines.length >= 4;
    }
}
$(document).ready(function(){
    $('textarea').autosize({append: "\n"});
});