<br />
<div class="well well-sm"><a href="#" class="btn btn-danger"><@ trans('issues.new_issue') @></a></div>
<div class="panel panel-success">
    <div class="panel-heading clearfix">
        <div class="col-md-10"><@ $issue->title @></div>
        <div class="col-md-2 text-right"><a href="#" class="btn btn-xs btn-warning">Изменить</a></div>
    </div>
    <div class="panel-body">
        <@ nl2br($issue->content) @>
    </div>
    <div class="panel-footer clearfix">
        <div class="col-md-2">
            <span class="text-muted"><@ trans('issues.issue_status') @>: </span>
            <span><@ trans('issues.status.' . $issue->status) @></span>
        </div>
        <div class="col-md-2">
            <span class="text-muted"><@ trans('issues.issue_priority') @>: </span>
            <span class="<@ trans('issues.priority.' . $issue->priority . '.class') @>">
                <@ trans('issues.priority.' . $issue->priority . '.title') @>
            </span>
        </div>
        <div class="col-md-2">
            <span class="text-muted"><@ trans('issues.issue_type') @>: </span>
            <span><@ trans('issues.type.' . $issue->issue_type . '.title') @></span>
        </div>
        <div class="col-md-3">
            <span class="text-muted"><@ trans('issues.creator') @>: </span>
            <span><@ !empty($creator->title) ? $creator->title : $creator->name @></span>
        </div>
        <div class="col-md-3">
            <span class="text-muted"><@ trans('issues.assignee') @>: </span>
            <span><@ !empty($assigned->title) ? $assigned->title : $assigned->name @></span>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><@ trans('issues.files') @></div>
    <table class="table table-condensed">
        @foreach ($files as $file)
        <tr>
            <td>
                <a href=""><@ $file->file_title @></a>
                (<@ $file->file_size @> kb)
            </td>
        </tr>
        @endforeach
    </table>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><@ trans('issues.comments') @></div>

    <table class="table">
        @foreach ($comments as $comment)
        <tr class="info">
            <td colspan="2" class="clearfix">
                <div class="col-md-10"><@ !empty($comment->title) ? $comment->title : $comment->name @></div>
                <div class="col-md-2 text-muted"><@ date(trans('common.datetime_format'), $comment->created) @></div>
            </td>
        </tr>
        <tr>
            <td class="col-md-1">
                <img src="<@@ Gravatar::src($comment->email, 64) @@>" alt="" />
            </td>
            <td><@ nl2br($comment->comment) @></td>
        </tr>
        @endforeach
    </table>
    <hr />
    <div class="panel-body" ng-controller="AddCommentController">
        <form action="<@ URL::route('add-comment', array('issue_id' => $issue->id)) @>" method="post" enctype="multipart/form-data">
            <b><@ trans('issues.add_comment') @></b><br />
            <textarea class="form-control" id="commentTextarea" name="comment"></textarea>
            <div class="well well-sm">
                <strong>Add files</strong>
                <div>
                    <div class="col-md-3">
                        <input type="file" name="userfile[]" />
                    </div>
                    <div class="clearfix"></div>
                    <div ng-repeat="(index, line) in lines">
                        <div class="col-md-3">
                            <input type="file" name="userfile[]" />
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-xs btn-danger" ng-click="removeFile(index)"><i class="fa fa-times"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div style="margin-top: 15px;" class="col-md-12" ng-hide="isMaxMessage()">
                    <a class="btn btn-xs btn-success btn-labeled" ng-click="addFile();">
                        <span class="btn-label"><i class="fa fa-plus"></i></span>
                        One more file
                    </a>
                </div>
                <div class=" clearfix"></div>
                <br />
                <div class="alert alert-danger" ng-show="isMaxMessage()">Больше файлов нельзя</div>
                <div class="alert alert-info">Max file size: <strong><@ Config::get('files.max_size')/1000000 @></strong> MB</div>
            </div>

            <div class="text-right">
                <input type="submit" class="btn btn-primary btn-lg btn-block" value="<@ trans('issues.add_comment') @>" />
            </div>
        </form>
    </div>
</div>