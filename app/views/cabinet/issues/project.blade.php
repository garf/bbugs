<br />
<div class="well well-sm">
    <a href="#" class="btn btn-danger"><@ trans('issues.new_issue') @></a>
</div>
<strong><@ trans('issues.filter') @>:</strong>
<div class="btn-group">
    <a href="<@ URL::route('issues-project', array('project_id' => $project->id, 'stat' => 'not_done')) @>"
       class="btn btn-xs btn-info">
        <@ trans('issues.all_opened') @>
    </a>
    <button type="button" class="btn btn-xs btn-info dropdown-toggle" data-toggle="dropdown">
        <span class="caret"></span>
        <span class="sr-only"></span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <li>
            <a href="<@ URL::route('issues-project', array('project_id' => $project->id, 'stat' => 'new')) @>">
                <@ trans('issues.status.news') @>
            </a>
        </li>
        <li>
            <a href="<@ URL::route('issues-project', array('project_id' => $project->id, 'stat' => 'opened')) @>">
                <@ trans('issues.status.openeds') @>
            </a>
        </li>
        <li>
            <a href="<@ URL::route('issues-project', array('project_id' => $project->id, 'stat' => 'in_work')) @>">
                <@ trans('issues.status.in_works') @>
            </a>
        </li>
        <li>
            <a href="<@ URL::route('issues-project', array('project_id' => $project->id, 'stat' => 'need_feedbacks')) @>">
                <@ trans('issues.status.need_feedbacks') @>
            </a>
        </li>
    </ul>
</div>
<div class="btn-group">
    <a href="<@ URL::route('issues-project', array('project_id' => $project->id, 'stat' => 'done')) @>"
       class="btn btn-default btn-xs">
        <@ trans('issues.all_closed') @>
    </a>
    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
        <span class="caret"></span>
        <span class="sr-only"></span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <li>
            <a href="<@ URL::route('issues-project', array('project_id' => $project->id, 'stat' => 'closed')) @>">
                <@ trans('issues.status.closed') @>
            </a>
        </li>
        <li>
            <a href="<@ URL::route('issues-project', array('project_id' => $project->id, 'stat' => 'not_actual')) @>">
                <@ trans('issues.status.not_actual') @>
            </a>
        </li>
    </ul>
</div>
<br />
<br />
<table class="table table-condensed table-hover">
    <tr>
        <th class="col-md-1">ID</th>
        <th><@ trans('issues.issue_title') @></th>
        <th><@ trans('issues.issue_status') @></th>
        <th><@ trans('issues.issue_type') @></th>
        <th><@ trans('issues.issue_priority') @></th>
        <th><@ trans('issues.created') @></th>
    </tr>
    @foreach ($issues as $issue)
        <tr>
            <td>#<@ $issue->id @></td>
            <td><a href="<@ URL::route('issue-view', array($issue->id)) @>"><@ $issue->title @></a></td>
            <td><@ trans('issues.status.' . $issue->status) @></td>
            <td><@ trans('issues.type.' . $issue->issue_type . '.title') @></td>
            <td>
                <span class="<@ trans('issues.priority.' . $issue->priority . '.class') @>">
                    <@ trans('issues.priority.' . $issue->priority . '.title') @>
                </span>
            </td>
            <td class="text-muted"><@ date(trans('common.datetime_format'), $issue->created) @></td>
        </tr>
    @endforeach
</table>