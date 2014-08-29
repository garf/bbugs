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

    $('.add-contact').click(function(){

    });
});

function AddContactController($scope, $http) {

    $scope.found = false;
    $scope.loading = false;
    $scope.error = false;
    $scope.message = '';

    $scope.search = function() {
        $scope.loading = true;
        $scope.found = false;
        $http(
            {
                method: 'POST',
                url: "/contact-add-search",
                data: {
                    email: $scope.model.email
                }
            }
        )
            .success(function(data, status, headers, config) {
                $scope.error = data.error;
                if(!data.error) {
                    $scope.found = true;
                    $scope.model.title = data.user.name;
                    $scope.user = data.user;
                } else {
                    $scope.found = false;
                    $scope.message = data.message;
                }
                $scope.loading = false;
            })
            .error(function(data, status, headers, config){
                $scope.loading = false;
                $scope.found = false;
                $scope.done = false;
            });
    };

    $scope.add = function() {
        $scope.loading = true;
        $http(
            {
                method: 'POST',
                url: "/contact-add",
                data: {
                    email: $scope.model.email,
                    title: $scope.model.title || ' ',
                    notes: $scope.model.notes || ' '
                }
            }
        )
            .success(function(data, status, headers, config) {
                $scope.error = data.error;
                if(!data.error) {
                    $scope.done = true;
                    $scope.message = data.message;
                    document.location.reload();
                    return;
                } else {
                    $scope.found = false;
                    $scope.done = false;
                    $scope.message = data.message;
                }
                $scope.loading = false;
            })
            .error(function(data, status, headers, config){
                $scope.loading = false;
                $scope.done = false;

            });
    };

    $scope.isFound = function() {
        return $scope.found;
    };

    $scope.isError = function() {
        return $scope.error;
    };

    $scope.isLoading = function() {
        return $scope.loading;
    };
}