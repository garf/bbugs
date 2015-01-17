function AddUserToProjectController($scope, $http) {

    $scope.loading = false;

    $scope.list = function() {

        $scope.loading = true;
        $scope.contacts = [];

        $http(
            {
                method: 'GET',
                url: document.ask
            }
        )
        .success(function(data, status, headers, config) {
            $scope.error = data.error;
            $scope.message = data.message;
            if(!$scope.error) {
                $scope.contacts = data.contacts;
                $scope.projects = data.projects;

                angular.forEach($scope.contacts, function(cval, ckey) {
                    var keepGoing = true;
                    angular.forEach($scope.projects, function(pval, pkey){
                        if(keepGoing) {
                            if(pval.id == cval.id) {
                                $scope.contacts[ckey].already = true;
                                $scope.contacts[ckey].role = pval.role;
                                $scope.contacts[ckey].hour_cost = (pval.hour_cost != 0) ? pval.hour_cost : 0;
                                keepGoing = false;
                            }
                        }
                    });
                });
            }

            $scope.loading = false;
        })
        .error(function(data, status, headers, config){
            $scope.loading = false;
        });
    };

    $scope.addToProject = function(projectId, userId, role) {
        $scope.loading = true;
        $http(
            {
                method: 'POST',
                url: document.add,
                data: {
                    project_id: projectId,
                    user_id: userId,
                    role: role
                }
            }
        )
            .success(function(data, status, headers, config) {
                $scope.error = data.error;
                $scope.message = data.message;
                if(!$scope.error) {
                    $scope.list();
                }

                $scope.loading = false;
            })
            .error(function(data, status, headers, config){
                $scope.error = true;
                $scope.loading = false;
            });
    };

    $scope.removeFromProject = function(projectId, userId) {
        $scope.loading = true;
        console.log(projectId);
        console.log(userId);
        $http(
            {
                method: 'POST',
                url: document.remove,
                data: {
                    project_id: projectId,
                    user_id: userId
                }
            }
        )
            .success(function(data, status, headers, config) {
                $scope.error = data.error;
                $scope.message = data.message;
                if(!$scope.error) {
                    $scope.list();
                }

                $scope.loading = false;
            })
            .error(function(data, status, headers, config){
                $scope.error = true;
                $scope.loading = false;
            });
    };

    $scope.roleClass = function(role) {
        var roles = {
            observer: 'info',
            developer: 'success',
            teamlead: 'danger'
        };
        return roles[role];
    };

    $scope.isLoading = function() {
        return $scope.loading;
    };

    $scope.isError = function() {
        return $scope.error;
    };

}