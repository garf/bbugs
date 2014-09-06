<br />
<script>
    document.ask = "<?= URL::route('project-users', array('project_id' => $project->id)) ?>";
    document.add = "<?= URL::route('project-add-user') ?>";
    document.remove = "<?= URL::route('project-remove-user') ?>";
</script>
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
            <div class="col-md-4">
                <div class="clearfix">
                    <div class="text-left">
                        <div>
                            <strong>{{ contact.title }}</strong>
                            <span class="text-muted">{{ contact.name }}</span>
                        </div>
                        <div><span class="text-muted"><?= trans('projects.role') ?>:</span> {{ contact.role }}</div>
                        <div>{{ contact.notes }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div ng-show="contact.already">
                    <form>
                        <div class=" clearfix">
                            <div class="form-group">
                                <label for="projectBudgetInput"><?= trans('projects.hour_cost') ?></label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" name="budget" class="form-control" value="{{ contact.hour_cost }}" id="projectBudgetInput" placeholder="5000.00" />
                                <span class="input-group-btn">
                                    <button class="btn btn-success" type="button"><?= trans('projects.set') ?></button>
                                </span>
                                </div>
                            </div>
                        </div>
                    </form>
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