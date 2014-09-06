<br />
<div>
    <form action="<?= URL::route('save-project', array('project_id' => $project->id)) ?>" method="post">
        <div class="form-group">
            <label for="projectTitleInput"><?= trans('projects.project_name') ?> <span class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control" value="<?= Input::old('title', $project->title) ?>" id="projectTitleInput" placeholder="<?= trans('projects.my_awesome_project') ?>" required="required" />
        </div>
        <div class="form-group">
            <label for="projectDescriptionInput"><?= trans('projects.project_description') ?></label>
            <textarea name="description" class="form-control" id="projectDescriptionInput" placeholder="<?= trans('projects.place_description') ?>"><?= Input::old('description', $project->description) ?></textarea>
        </div>
        <div class="text-right">
            <a href="<?= URL::route('projects') ?>" class="btn btn-default"><?= trans('projects.cancel') ?></a>
            <input type="submit" class="btn btn-primary" value="<?= trans('projects.save') ?>" />
        </div>
    </form>
</div>