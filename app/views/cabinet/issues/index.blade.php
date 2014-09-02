<br />

<div>
    <table class="table table-hover">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Project</th>
            <th>Status</th>
            <th>Priority</th>
            <th>Type</th>
            <th>Updated</th>
        </tr>
        @foreach ($issues as $issue)
            <tr class="<@ ($issue->status == 'new') ? 'info' : ''; @> <@ ($issue->priority == '1') ? 'danger' : ''; @>">
                <td>#<@ $issue->id @></td>
                <td>
                    <a href="<@ URL::route('issue-view', array('issue_id' => $issue->id)) @>"><@ $issue->title @></a>
                </td>
                <td><a href="<@ URL::route('issues-project', array($issue->project_id)) @>"><@ $issue->ptitle @></a></td>
                <td><@ trans('issues.status.' . $issue->status . '.title') @></td>
                <td class="<@ trans('issues.priority.' . $issue->priority . '.class') @>"><@ trans('issues.priority.' . $issue->priority . '.title') @></td>
                <td><@ trans('issues.type.' . $issue->issue_type . '.title') @></td>
                <td><@ date(trans('common.datetime_format'), $issue->updated) @></td>
            </tr>
        @endforeach
    </table>
</div>