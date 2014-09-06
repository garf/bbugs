<br />
<div class="well well-sm">
    <a href="<?= URL::route('issue-new', array('project_id' => $issue->project_id)); ?>" class="btn btn-danger"><?= trans('issues.new_issue') ?></a>
</div>
<div class="panel panel-success">
    <div class="panel-heading clearfix">
        <div style="float: left;"><strong><?= $issue->title ?></strong></div>
        <div style="float: right;">
            <a href="#" class="btn btn-xs btn-warning"><?= trans('issues.edit') ?></a>
            <a href="#contentBlock" data-toggle="collapse" class="btn btn-xs btn-default minimize-box" title="<?= trans('issues.minimize') ?>">
                <i class="fa fa-angle-up"></i>
            </a></div>
    </div>
    <div id="contentBlock" class="body collapse in">
        <div class="panel-body">
            <?= nl2br($issue->content) ?>
        </div>
    </div>

    <div class="panel-footer clearfix">
        <div class="col-md-2">
            <span class="text-muted"><?= trans('issues.issue_status') ?>: </span>
            <span><?= trans('issues.status.' . $issue->status . '.title') ?></span>
        </div>
        <div class="col-md-2">
            <span class="text-muted"><?= trans('issues.issue_priority') ?>: </span>
            <span class="<?= trans('issues.priority.' . $issue->priority . '.class') ?>">
                <?= trans('issues.priority.' . $issue->priority . '.title') ?>
            </span>
        </div>
        <div class="col-md-2">
            <span class="text-muted"><?= trans('issues.issue_type') ?>: </span>
            <span><?= trans('issues.type.' . $issue->issue_type . '.title') ?></span>
        </div>
        <div class="col-md-3">
            <span class="text-muted"><?= trans('issues.creator') ?>: </span>
            <span><?= !empty($creator->title) ? $creator->title : $creator->name ?></span>
        </div>
        <div class="col-md-3">
            <span class="text-muted"><?= trans('issues.assignee') ?>: </span>
            <span><?= !empty($assigned->title) ? $assigned->title : $assigned->name ?></span>
        </div>
    </div>
</div>
<?php if (count($files) != 0) { ?>
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <div class=""style="float: left;"><?= trans('issues.files') ?></div>
            <div class="" style="float: right;" >
                <a href="#fileBlock" data-toggle="collapse" class="btn btn-xs btn-default minimize-box" title="<?= trans('issues.minimize') ?>">
                    <i class="fa fa-angle-up"></i>
                </a>
            </div>
        </div>
        <div id="fileBlock" class="body collapse in">
            <table class="table table-condensed table-hover">
                <?php foreach ($files as $file) { ?>
                <tr>
                    <td>
                        <div style="float: left;">
                        <i class="fa fa-file"></i>
                            <a href="<?= URL::route('download', array('file_id' => $file->salt . '-' . $file->id)) ?>">
                                <?= $file->file_title ?>
                            </a>
                        (<?= round($file->file_size, 2) ?> kb)
                        </div>
                        <?php if($is_teamlead) { ?>
                        <div style="float: right;">
                            <a href="<?= URL::route('file-delete', array('file_id' => $file->salt . '-' . $file->id)) ?>"
                               onclick="return confirm('<?= trans('issues.want_delete_file', array('name' => e($file->file_title))) ?>');">
                                <?= trans('issues.delete') ?>
                            </a>
                        </div>
                        <?php } ?>
                        <div class="clearfix"></div>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
<?php } ?>
<div class="panel panel-default">
    <div class="panel-heading clearfix">
        <div class=""style="float: left;"><?= trans('issues.comments') ?></div>
        <div class="" style="float: right;" >
            <a href="#commentsBlock" data-toggle="collapse" class="btn btn-xs btn-default minimize-box" title="<?= trans('issues.minimize') ?>">
                <i class="fa fa-angle-up"></i>
            </a>
        </div>
    </div>
    <div id="commentsBlock" class="body collapse in">
        <table class="table table-hover">
            <?php foreach ($comments as $comment) { ?>
            <tr>
                <td>
                    <table class="table table-bordered" >
                        <tr class="info" id="comment<?= $comment->id ?>">
                            <td colspan="2" class="clearfix">
                                <div class="col-md-10"><i class="fa fa-circle"></i> <?= !empty($comment->title) ? $comment->title : $comment->name ?></div>
                                <div class="col-md-2 text-muted"><?= date(trans('common.datetime_format'), $comment->created) ?></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-md-1">
                                <img src="<?= e(Gravatar::src($comment->email, 64)) ?>" alt="" />
                            </td>
                            <td id="commentContent<?= $comment->id ?>">
                                <?= $comment->comment ?>
                            </td>
                        </tr>
                        <tr class="warning">
                            <td colspan="2">
                                <div class="col-md-4">
                                    <a href="javascript: ;" class="btn btn-primary btn-line btn-xs quote-comment" data-quote-id="<?= $comment->id ?>"><?= trans('issues.quote') ?></a>&nbsp;
                                    <?php if ($comment->creator == Auth::user()->id) { ?>
                                        <a href="<?= URL::route('delete-comment', array('comment_id' => $comment->id)) ?>"
                                           onclick="return confirm('<?= trans('issues.want_delete_comment') ?>');"
                                           class="btn btn-danger btn-line btn-xs">
                                            <?= trans('issues.delete') ?>
                                        </a>&nbsp;
                                    <?php } ?>
                                </div>

                                <div class="col-md-6"></div>

                                <div class="col-md-2">
                                    <?php if ($comment->files_count > 0) { ?>
                                    <i class="fa fa-file"></i>
                                    <i class="text-muted">
                                        <?= trans('issues.files_were_uploaded',
                                        array(
                                        'num' => $comment->files_count,
                                        'pl' => Lang::choice(
                                        trans('issues.files_pl'),
                                        $comment->files_count
                                        )))
                                        ?>
                                    </i>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <?php } ?>
        </table>
        <hr />
    </div>

    <div id="commentNew" class="panel-body" ng-controller="AddCommentController">
        <form action="<?= URL::route('update-issue', array('issue_id' => $issue->id)) ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" id="maxFiles" value="<?= Files::getInstance()->maxUserFiles(Auth::user()->id, 'comment') ?>" />
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?= trans('issues.new_comment') ?>
                    </div>
                    <div class="panel-body">
                        <textarea class="form-control"
                                  id="commentTextarea"
                                  name="comment"
                                  placeholder="<?= trans('issues.ph_comment') ?>"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?= trans('issues.attach_files') ?>
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
                                <?= trans('issues.one_more_file') ?>
                            </a>
                        </div>
                        <div class=" clearfix"></div>
                        <br />
                        <div class="alert alert-danger" ng-show="isMaxMessage()"><?= trans('issues.no_more_files') ?></div>
                        <div class="alert alert-info"><?= trans('issues.max_file_size') ?>: <strong><?= TplHelpers::getMaxFilesize() ?></strong></div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?= trans('issues.parameters') ?>
                    </div>
                    <div class="panel-body">
                        <div>
                            <div class="form-group">
                                <label for="assignedSelect" class="control-label col-lg-4"><?= trans('issues.assign_to') ?></label>
                                <div class="col-lg-8">
                                    <select name="assigned" id="assignedSelect" class="form-control">
                                        <option value="0"></option>
                                        <?php foreach ($contacts as $contact) { ?>
                                            <?php if ($contact->role == 'observer') continue; ?>
                                            <option value="<?= $contact->id ?>" <?= ($issue->assigned == $contact->id) ? 'selected="selected"' : '' ?>>
                                                <?= (trim($contact->title) != '') ? $contact->title : $contact->name ?>
                                                <?php if ($contact->id == Auth::user()->id) { ?>
                                                    (<?= trans('issues.you') ?>)
                                                <?php } ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br />
                        <div>
                            <div class="form-group">
                                <label for="statusSelect" class="control-label col-lg-4"><?= trans('issues.change_status') ?></label>
                                <div class="col-lg-8">
                                    <select name="status" id="statusSelect" class="form-control">
                                        <option value="opened" <?= ($issue->status == 'opened') ? 'selected="selected"' : '' ?>><?= trans('issues.status.opened.title') ?></option>
                                        <option value="in_work" <?= ($issue->status == 'in_work') ? 'selected="selected"' : '' ?>><?= trans('issues.status.in_work.title') ?></option>
                                        <option value="need_feedback" <?= ($issue->status == 'need_feedback') ? 'selected="selected"' : '' ?>><?= trans('issues.status.need_feedback.title') ?></option>
                                        <optgroup label="Closed">
                                            <option value="closed" <?= ($issue->status == 'closed') ? 'selected="selected"' : '' ?>><?= trans('issues.status.closed.title') ?></option>
                                            <option value="not_actual" <?= ($issue->status == 'not_actual') ? 'selected="selected"' : '' ?>><?= trans('issues.status.not_actual.title') ?></option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br />
                        <div>
                            <div class="form-group">
                                <label for="prioritySelect" class="control-label col-lg-4"><?= trans('issues.issue_priority') ?></label>
                                <div class="col-lg-8">
                                    <select name="priority" id="prioritySelect" class="form-control">
                                        <option value="1" <?= ($issue->priority == 1) ? 'selected="selected"' : '' ?>><?= trans('issues.priority.1.title') ?></option>
                                        <option value="2"<?= ($issue->priority == 2) ? 'selected="selected"' : '' ?>><?= trans('issues.priority.2.title') ?></option>
                                        <option value="3"<?= ($issue->priority == 3) ? 'selected="selected"' : '' ?>><?= trans('issues.priority.3.title') ?></option>
                                        <option value="4"<?= ($issue->priority == 4) ? 'selected="selected"' : '' ?>><?= trans('issues.priority.4.title') ?></option>
                                        <option value="5"<?= ($issue->priority == 5) ? 'selected="selected"' : '' ?>><?= trans('issues.priority.5.title') ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br />
                        <div>
                            <div class="form-group">
                                <label for="hoursInpur" class="control-label col-lg-8"><?= trans('issues.hours_to_complete') ?>:</label>
                                <div class="col-lg-4">
                                    <input type="text" name="hours_spent" class="form-control" id="hoursInput" value="<?= $issue->hours_spent ?>" placeholder="0.00" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="text-right">
                <input type="submit" class="btn btn-primary btn-lg btn-block" value="<?= trans('issues.update_issue') ?>" />
            </div>
        </form>
    </div>
</div>