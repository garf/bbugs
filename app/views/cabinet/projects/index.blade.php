<br />
<div class="well well-sm">
    <a class="btn btn-success" data-toggle="modal" data-target="#newProjectModal"><@ trans('projects.create_project') @></a>
</div>
@if(count($projects) != 0)

<div>
    <table class="table table-bordered">
        @foreach ($projects as $project)
            <tr>
                <td style="border-left: 9px solid <@ ($project->creator == Auth::user()->id) ? '#007700' : '#dddd00' @>">
                    <h4><a href="<@ URL::route('issues-project', array($project->id)) @>"><@ $project->title @></a></h4>
                    <div>
                        <span class="text-muted"><@ trans('projects.your_role') @>:</span>
                        <@ trans('users.roles.' . $project->role) @>
                    </div>
                    <div><@ Str::limit($project->description, 400) @></div>
                    <div class="text-right">
                        <span class="text-muted"><@ trans('projects.created_at') @>: <@ date(trans('common.date_format'), $project->created) @></span>
                    </div>
                </td>
                <td class="col-lg-2 text-center">
                    <a href="#" class="btn btn-sm btn-info btn-block ">
                        <@ trans('projects.view_info') @>
                    </a>
                    <a href="#" class="btn btn-sm btn-success btn-block ">
                        <@ trans('projects.add_users') @>
                    </a>
                    <a href="#" class="btn btn-sm btn-warning btn-block ">
                        <@ trans('projects.edit_project') @>
                    </a>
                    <a data-url="<@ URL::route('project-delete', array('id' => $project->id )) @>"
                       data-message="<@ trans('projects.delete_confirm', array('title' => $project->title)) @>"
                       class="btn btn-sm btn-danger btn-block delete-project">
                        <@ trans('projects.delete_project') @>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
</div>

@else
    <div class="alert alert-info"><@ trans('projects.no_projects') @></div>
@endif

<div class="modal fade" id="newProjectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" action="<@ URL::route('create-project') @>" method="post" id="newProjectForm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel"><@ trans('projects.new_project') @></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="projectTitleInput"><@ trans('projects.project_name') @> <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" value="<@ Input::old('title') @>" id="projectTitleInput" placeholder="<@ trans('projects.my_awesome_project') @>" required="required" />
                    </div>
                    <div class="form-group">
                        <label for="projectDescriptionInput"><@ trans('projects.project_description') @></label>
                        <textarea name="description" class="form-control" id="projectDescriptionInput" placeholder="<@ trans('projects.place_description') @>"><@ Input::old('description') @></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><@ trans('projects.close') @></button>
                    <input type="submit" class="btn btn-primary" value="<@ trans('projects.create') @>" />
                </div>
            </form>
        </div>
    </div>
</div>