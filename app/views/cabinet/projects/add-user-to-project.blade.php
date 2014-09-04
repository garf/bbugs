<br />
<script>
    document.ask = "<@ URL::route('project-users', array('project_id' => $project->id)) @>";
    document.add = "<@ URL::route('project-add-user') @>";
    document.remove = "<@ URL::route('project-remove-user') @>";
</script>
<div ng-controller="AddUserToProjectController" ng-init="list()">
    <div class="text-center alert alert-info" ng-show="isLoading()">
        <img src="/template/common/img/loaders/220x20.gif" alt="Loading..." />
    </div>
    <div class="text-center alert alert-danger" ng-show="isError()">
        {{ message }}
    </div>
    <table class="table">
        <tr class="contact" ng-repeat="contact in contacts">
            <td class="col-md-1 text-center">
                <img class="img-thumbnail" alt="Gravatar" ng-src="{{ contact.avatar }}">
                <br />
            </td>
            <td>
                <div class="clearfix">
                    <div class="text-left">
                        <strong>{{ contact.title }}</strong>
                        <span class="text-muted">{{ contact.name }}</span>
                        <div>{{ contact.notes }}</div>
                    </div>
                </div>
            </td>
            <td class="text-right">

                <a ng-click="addToProject(<@ $project->id @>, contact.id, 'observer')" ng-hide="contact.already" class="btn btn-labeled btn-info">
                    <span class="btn-label">
                        <i class="fa fa-plus"></i>
                    </span>
                    <@ trans('projects.observer') @>
                </a>
                <a ng-click="addToProject(<@ $project->id @>, contact.id, 'developer')" ng-hide="contact.already" class="btn btn-labeled btn-success">
                    <span class="btn-label">
                        <i class="fa fa-plus"></i>
                    </span>
                    <@ trans('projects.developer') @>
                </a>
                <a ng-click="addToProject(<@ $project->id @>, contact.id, 'teamlead')" ng-hide="contact.already" class="btn btn-labeled btn-danger">
                    <span class="btn-label">
                        <i class="fa fa-plus"></i>
                    </span>
                    <@ trans('projects.teamlead') @>
                </a>

                <a ng-click="removeFromProject(<@ $project->id @>, contact.id)" ng-show="contact.already" class="btn btn-labeled btn-default">
                    <span class="btn-label">
                        <i class="fa fa-minus"></i>
                    </span>
                    <@ trans('projects.remove_user') @>
                </a>
            </td>
        </tr>
    </table>
</div>