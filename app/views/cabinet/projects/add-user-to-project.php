<br />
<script>
    document.ask = "<?= URL::route('project-users', array('project_id' => $project->id)) ?>";
    document.add = "<?= URL::route('project-add-user') ?>";
    document.remove = "<?= URL::route('project-remove-user') ?>";
</script>
<?= View::make('cabinet.widgets.access-rules'); ?>
<div ng-controller="AddUserToProjectController" ng-init="list()">
    <div class="text-center alert alert-info" ng-show="isLoading()">
        <img src="/template/common/img/loaders/220x20.gif" alt="Loading..." />
    </div>
    <div class="text-center alert alert-danger" ng-show="isError()">
        {{ message }}
    </div>
    <div ng-repeat="contact in contacts | orderBy:'already':false">
        <div class="clearfix">
            <div class="col-md-1">
                <img class="img-thumbnail" alt="Gravatar" ng-src="{{ contact.avatar }}">
            </div>
            <div class="col-md-8">
                <div class="clearfix">
                    <div class="text-left">
                        <div>
                            <strong>{{ contact.title }}</strong>
                            <span class="text-muted">{{ contact.name }}</span>
                        </div>
                        <div ng-show="contact.already"><span class="text-muted"><?= trans('projects.role') ?>:</span> <span class="label" ng-class="roleClass(contact.role)">{{ contact.role }}</span></div>
                        <div>{{ contact.notes }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <a ng-click="addToProject(<?= $project->id ?>, contact.id, 'observer')" ng-hide="contact.already" class="btn btn-labeled btn-xs btn-info">
                    <span class="btn-label">
                        <i class="fa fa-plus"></i>
                    </span>
                    <?= trans('projects.observer') ?>
                </a>
                <br />
                <a ng-click="addToProject(<?= $project->id ?>, contact.id, 'developer')" ng-hide="contact.already" class="btn btn-labeled btn-xs btn-success">
                    <span class="btn-label">
                        <i class="fa fa-plus"></i>
                    </span>
                    <?= trans('projects.developer') ?>
                </a>
                <br />
                <a ng-click="addToProject(<?= $project->id ?>, contact.id, 'teamlead')" ng-hide="contact.already" class="btn btn-labeled btn-xs btn-danger">
                    <span class="btn-label">
                        <i class="fa fa-plus"></i>
                    </span>
                    <?= trans('projects.teamlead') ?>
                </a>
                <a ng-click="removeFromProject(<?= $project->id ?>, contact.id)" ng-show="contact.already" class="btn btn-labeled btn-xs btn-default">
                    <span class="btn-label">
                        <i class="fa fa-minus"></i>
                    </span>
                    <?= trans('projects.remove_user') ?>
                </a>
            </div>
        </div>
        <hr />
    </div>

</div>