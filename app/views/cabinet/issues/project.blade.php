<br />
<div class="well well-sm">
    <a href="#" class="btn btn-danger">New Issue</a>
</div>
<ul class="nav nav-tabs" role="tablist">
    <li class="active"><a href="<@ URL::route('') @>" role="tab">Actual</a></li>
    <li><a href="#profile" role="tab">Closed</a></li>
</ul>
<table class="table table-condensed table-hover">
    <tr>
        <th class="col-md-1">ID</th>
        <th><@ trans('issues.issue_title') @></th>
        <th><@ trans('issues.issue_status') @></th>
        <th><@ trans('issues.issue_type') @></th>
        <th><@ trans('issues.issue_priority') @></th>
    </tr>
    @foreach ($issues as $issue)
        <tr>
            <td>#<@ $issue->id @></td>
            <td><@ $issue->title @></td>
            <td><@ trans('issues.status.' . $issue->status) @></td>
            <td><@ $issue->issue_type @></td>
            <td><@ trans('issues.priority.' . $issue->priority . '.title') @></td>
        </tr>
    @endforeach
</table>