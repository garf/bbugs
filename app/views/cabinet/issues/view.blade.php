<br />
<div class="well well-sm"><a href="#" class="btn btn-danger"><@ trans('issues.new_issue') @></a></div>
<div class="panel panel-success">
    <div class="panel-heading clearfix">
        <div style="float: left;"><strong><@ $issue->title @></strong></div>
        <div style="float: right;">
            <a href="#" class="btn btn-xs btn-warning"><@ trans('issues.edit') @></a>
            <a href="#contentBlock" data-toggle="collapse" class="btn btn-xs btn-default minimize-box">
                <i class="fa fa-angle-up"></i>
            </a></div>
    </div>
    <div id="contentBlock" class="body collapse in">
        <div class="panel-body">
            <@ nl2br($issue->content) @>
        </div>
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
@if (count($files) != 0)
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <div class=""style="float: left;"><@ trans('issues.files') @></div>
            <div class="" style="float: right;" >
                <a href="#fileBlock" data-toggle="collapse" class="btn btn-xs btn-default minimize-box">
                    <i class="fa fa-angle-up"></i>
                </a>
            </div>
        </div>
        <div id="fileBlock" class="body collapse in">
            <table class="table table-condensed">
                @foreach ($files as $file)
                <tr>
                    <td>
                        <i class="fa fa-file"></i> <a href=""><@ $file->file_title @></a>
                        (<@ round($file->file_size, 2) @> kb)
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@endif
<div class="panel panel-default">
    <div class="panel-heading clearfix">
        <div class=""style="float: left;"><@ trans('issues.comments') @></div>
        <div class="" style="float: right;" >
            <a href="#commentsBlock" data-toggle="collapse" class="btn btn-xs btn-default minimize-box">
                <i class="fa fa-angle-up"></i>
            </a>
        </div>
    </div>
    <div id="commentsBlock" class="body collapse in">
        <table class="table">
            @foreach ($comments as $comment)
            <tr>
                <td>
                    <table class="table table-bordered" >
                        <tr class="info" id="comment<@ $comment->id @>">
                            <td colspan="2" class="clearfix">
                                <div class="col-md-10"><@ !empty($comment->title) ? $comment->title : $comment->name @> <i class="fa fa-chevron-down"></i></div>
                                <div class="col-md-2 text-muted"><@ date(trans('common.datetime_format'), $comment->created) @></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-md-1">
                                <img src="<@@ Gravatar::src($comment->email, 64) @@>" alt="" />
                            </td>
                            <td>
                                <@ $comment->comment @>
                                @if ($comment->files_count > 0)
                                <div class="text-right">
                                    <i class="fa fa-file"></i>
                                    <i class="text-muted">
                                        <@ trans('issues.files_were_uploaded',
                                        array(
                                        'num' => $comment->files_count,
                                        'pl' => Lang::choice(
                                            trans('issues.files_pl'),
                                            $comment->files_count
                                        )))
                                        @>
                                    </i>
                                </div>
                                @endif
                            </td>
                        </tr>
                        <tr class="warning">
                            <td colspan="2">
                                @if ($comment->creator == Auth::user()->id)
                                <a href="#" class="btn btn-danger btn-xs"><@ trans('issues.delete') @></a>&nbsp;
                                @endif
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            @endforeach
        </table>
        <hr />
    </div>

    <div id="commentNew" class="panel-body" ng-controller="AddCommentController">
        <form action="<@ URL::route('add-comment', array('issue_id' => $issue->id)) @>" method="post" enctype="multipart/form-data">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <@ View::make('cabinet.widgets.edit-toolbar', array('to' => '#commentTextarea')); @>
                    </div>
                    <div class="panel-body">
                        <textarea class="form-control"
                                  id="commentTextarea"
                                  name="comment"
                                  placeholder="<@ trans('issues.ph_comment') @>"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <@ trans('issues.attach_files') @>
                    </div>
                    <div class="panel-body">
                        <div>
                            <div class="col-md-6">
                                <input type="file" name="userfile[]" />
                            </div>
                            <div class="clearfix"></div>
                            <div ng-repeat="(index, line) in lines">
                                <div class="col-md-8">
                                    <input type="file" name="userfile[]" />
                                </div>
                                <div class="col-md-2">
                                    <a class="btn btn-xs btn-danger" ng-click="removeFile(index)"><i class="fa fa-times"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div style="margin-top: 15px;" class="col-md-12" ng-hide="isMaxMessage()">
                            <a class="btn btn-xs btn-success btn-labeled" ng-click="addFile();">
                                <span class="btn-label"><i class="fa fa-plus"></i></span>
                                <@ trans('issues.one_more_file') @>
                            </a>
                        </div>
                        <div class=" clearfix"></div>
                        <br />
                        <div class="alert alert-danger" ng-show="isMaxMessage()"><@ trans('issues.no_more_files') @></div>
                        <div class="alert alert-info"><@ trans('issues.max_file_size') @>: <strong><@ Config::get('files.max_size')/1000000 @></strong> MB</div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <@ trans('issues.parameters') @>
                    </div>
                    <div class="panel-body">
                        <div>
                            <strong><@ trans('issues.assign_to') @></strong><br />
                            <select name="assigned" class="form-control">
                                @foreach ($contacts as $contact)
                                <option value="<@ $contact->id @>"
                                <@ ($issue->assigned == $contact->id) ? 'selected="selected"' : '' @>>
                                <@ (trim($contact->title) != '') ? $contact->title : $contact->name @>
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <strong><@ trans('issues.change_status') @></strong><br />
                            <select name="status" class="form-control">
                                <option value="opened"><@ trans('issues.status.opened') @></option>
                                <option value="in_work"><@ trans('issues.status.in_work') @></option>
                                <option value="need_feedback"><@ trans('issues.status.need_feedback') @></option>
                                <optgroup label="Closed">
                                    <option value="closed"><@ trans('issues.status.closed') @></option>
                                    <option value="not_actual"><@ trans('issues.status.not_actual') @></option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="text-right">
                <input type="submit" class="btn btn-primary btn-lg btn-block" value="<@ trans('issues.add_comment') @>" />
            </div>
        </form>
    </div>
</div>