function ChangePasswordController($scope) {

    $scope.newPassword = '';
    $scope.confirmPassword = '';

    $scope.isSimilar = function() {
        return ($scope.newPassword == $scope.confirmPassword);
    };

    $scope.isMin = function() {
        return ($scope.passLength() == 0 || $scope.passLength() >= 6);
    };

    $scope.isOldpass = function() {
        return ($scope.oldPassword.length != 0);
    };

    $scope.passLength = function(){
        return $scope.newPassword.length;
    };

}