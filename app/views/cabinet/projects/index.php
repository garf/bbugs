<br />
<div class="well well-sm">
    <a class="btn btn-success" data-toggle="modal" data-target="#newProjectModal"><?= trans('projects.create_project') ?></a>
</div>
<?php if(count($projects) != 0) { ?>

<div >
    <?php foreach ($projects as $project) { ?>
        <div class="panel panel-<?= ($project->creator == Auth::user()->id) ? 'success' : 'warning' ?>">
            <div class="panel-heading"><h4><a href="<?= URL::route('issues-project', array($project->id)) ?>"><?= $project->title ?></a></h4></div>
            <div class="panel-body">
                <div class="col-md-10">
                    <div>
                        <span class="text-muted"><?= trans('projects.your_role') ?>:</span>
                        <?= trans('users.roles.' . $project->role) ?>
                    </div>
                    <div class="correct-wrap"><p><?= nl2br(Str::limit($project->description, 400)) ?></p></div>
                    <div class="text-right">
                        <span class="text-muted"><?= trans('projects.created_at') ?>: <?= date(trans('common.date_format'), $project->created) ?></span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="well well-sm clearfix">
                            <a href="<?= URL::route('project-info', array('project_id' => $project->id)) ?>" class="btn btn-xs btn-info btn-block">
                                <?= trans('projects.view_info') ?>
                            </a>
                        <?php if ($project->role == 'teamlead') { ?>
                                <a href="<?= URL::route('edit-project', array('project_id' => $project->id)) ?>" class="btn btn-xs btn-warning btn-block ">
                                    <?= trans('projects.edit_project') ?>
                                </a>
                                <a href="<?= URL::route('add-to-project', array('project_id' => $project->id)) ?>" class="btn btn-xs btn-success btn-block ">
                                    <?= trans('projects.users') ?>
                                </a>
                                <a data-url="<?= URL::route('project-delete', array('id' => $project->id )) ?>"
                                   data-message="<?= trans('projects.delete_confirm', array('title' => $project->title)) ?>"
                                   class="btn btn-xs btn-danger btn-block delete-project">
                                    <?= trans('projects.delete_project') ?>
                                </a>
                        <?php } ?>
                    </div>
                </div>


            </div>
        </div>
    <?php } ?>
</div>

<?php } else { ?>
    <div class="alert alert-info"><?= trans('projects.no_projects') ?></div>
<?php } ?>

<div class="modal fade" id="newProjectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" action="<?= URL::route('create-project') ?>" method="post" id="newProjectForm">
                <input type="hidden" name="_token" value="<?= $token ?>" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?= trans('projects.new_project') ?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="projectTitleInput"><?= trans('projects.project_name') ?> <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" value="<?= Input::old('title') ?>" id="projectTitleInput" placeholder="<?= trans('projects.my_awesome_project') ?>" required="required" />
                    </div>
                    <div class="form-group">
                        <label for="projectDescriptionInput"><?= trans('projects.project_description') ?></label>
                        <textarea name="description" class="form-control" id="projectDescriptionInput" placeholder="<?= trans('projects.place_description') ?>"><?= Input::old('description') ?></textarea>
                    </div>
                    <div class="clearfix">
                        <div class="col-md-8"></div>
                        <div class="form-group col-md-4">
                            <label for="projectBudgetInput"><?= trans('projects.budget') ?></label>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="text" name="budget" class="form-control" value="<?= Input::old('budget') ?>" id="projectBudgetInput" placeholder="5000.00" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?= trans('projects.close') ?></button>
                    <input type="submit" class="btn btn-primary" value="<?= trans('projects.create') ?>" />
                </div>
            </form>
        </div>
    </div>
</div>