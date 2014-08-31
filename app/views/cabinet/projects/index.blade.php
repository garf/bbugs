<br />
<div class="well well-sm">
    <a href="#" class="btn btn-success"><@ trans('projects.add_project') @></a>
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
                </td>
                <td class="col-lg-2 text-center">
                    <a href="#" class="btn btn-sm btn-success btn-block disabled"><@ trans('projects.add_users') @></a>
                    <a href="#" class="btn btn-sm btn-warning btn-block disabled"><@ trans('projects.edit_project') @></a>
                    <a href="#" class="btn btn-sm btn-danger btn-block disabled"><@ trans('projects.delete_project') @></a>
                </td>
            </tr>
        @endforeach
    </table>
</div>

@else
    <div class="alert alert-info">Нет созданных проектов</div>
@endif

<?php
    $str = '[code=sql] SELECT title FROM users LIMIT 1; [/code]';
    echo Markupy::parse($str);
    echo htmlspecialchars(Markupy::parse($str));
?>