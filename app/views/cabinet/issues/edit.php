<br />
<div ng-controller="NewIssueController">
    <form method="post" action="<?= URL::route('issue-save', array('issue_id' => $issue->id)) ?>">
        <input type="hidden" name="_token" value="<?= $token ?>" />
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= trans('issues.issue_content') ?>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="titleInput" class="control-label col-lg-12"><?= trans('issues.issue_title') ?></label>
                        <div class="col-md-12">
                            <input type="text" name="title" id="titleInput" class="form-control" value="<?= Input::old('title', $issue->title) ?>" required="required" />
                        </div>
                    </div>
                    <br />
                    <br />
                    <br />
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box">
                                <header>
                                    <h5><?= trans('issues.issue_description') ?></h5>
                                    <ul class="nav nav-tabs pull-right">
                                        <li class="active">
                                            <a href="#markdown" data-toggle="tab"><?= trans('issues.markup') ?></a>
                                        </li>
                                        <li class=""> <a href="#preview" data-toggle="tab"><?= trans('issues.preview') ?></a>  </li>
                                    </ul>
                                </header>
                                <div id="div-3" class="body tab-content">
                                    <div class="tab-pane fade active in" id="markdown">
                                        <div class="wmd-panel">
                                            <div id="wmd-button-bar" class="btn-toolbar"></div>
                                            <textarea class="form-control wmd-input" rows="10" name="content" id="wmd-input"></textarea>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="preview">
                                        <div id="wmd-preview" class="wmd-panel wmd-preview"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= trans('issues.issue_settings') ?>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="typeSelect" class="control-label col-lg-4"><?= trans('issues.issue_type') ?></label>
                        <div class="col-md-8">
                            <select name="issue_type" class="form-control" id="typeSelect">
                                <option value="task" <?= ($issue->issue_type == 'task') ? 'selected="selected"' : '' ?>><?= trans('issues.type.task.title') ?></option>
                                <option value="bug" <?= ($issue->issue_type == 'bug') ? 'selected="selected"' : '' ?>><?= trans('issues.type.bug.title') ?></option>
                                <option value="research" <?= ($issue->issue_type == 'research') ? 'selected="selected"' : '' ?>><?= trans('issues.type.research.title') ?></option>
                            </select>
                        </div>
                    </div>
                    <br />
                    <br />
                    <div class="form-group">
                        <label for="statusSelect" class="control-label col-lg-4"><?= trans('issues.issue_status') ?></label>
                        <div class="col-md-8">
                            <select name="status" class="form-control" id="statusSelect">
                                <option value="new" <?= ($issue->status == 'new') ? 'selected="selected"' : '' ?>><?= trans('issues.status.new.title') ?></option>
                                <option value="opened" <?= ($issue->status == 'opened') ? 'selected="selected"' : '' ?>><?= trans('issues.status.opened.title') ?></option>
                                <option value="in_work" <?= ($issue->status == 'in_work') ? 'selected="selected"' : '' ?>><?= trans('issues.status.in_work.title') ?></option>
                                <option value="need_feedback" <?= ($issue->status == 'need_feedback') ? 'selected="selected"' : '' ?>><?= trans('issues.status.need_feedback.title') ?></option>
                                <option value="closed" <?= ($issue->status == 'closed') ? 'selected="selected"' : '' ?>><?= trans('issues.status.closed.title') ?></option>
                                <option value="not_actual" <?= ($issue->status == 'not_actual') ? 'selected="selected"' : '' ?>><?= trans('issues.status.not_actual.title') ?></option>
                            </select>
                        </div>
                    </div>
                    <br />
                    <br />
                    <div class="form-group">
                        <label for="prioritySelect" class="control-label col-lg-4"><?= trans('issues.issue_priority') ?></label>
                        <div class="col-md-8">
                            <select name="priority" class="form-control" id="prioritySelect">
                                <option value="1" <?= ($issue->priority == '1') ? 'selected="selected"' : '' ?>><?= trans('issues.priority.1.title') ?></option>
                                <option value="2" <?= ($issue->priority == '2') ? 'selected="selected"' : '' ?>><?= trans('issues.priority.2.title') ?></option>
                                <option value="3" <?= ($issue->priority == '3') ? 'selected="selected"' : '' ?>><?= trans('issues.priority.3.title') ?></option>
                                <option value="4" <?= ($issue->priority == '4') ? 'selected="selected"' : '' ?>><?= trans('issues.priority.4.title') ?></option>
                                <option value="5" <?= ($issue->priority == '5') ? 'selected="selected"' : '' ?>><?= trans('issues.priority.5.title') ?></option>
                            </select>
                        </div>
                    </div>
                    <br />
                    <hr />
                    <div class="form-group">
                        <label for="assigneeSelect" class="control-label col-lg-4"><?= trans('issues.assignee') ?></label>
                        <div class="col-md-8">
                            <select name="assigned" class="form-control" id="assigneeSelect">
                                <option value="0" <?= ($issue->assigned == '0') ? 'selected="selected"' : '' ?>></option>
                                <?php foreach ($contacts as $contact) { ?>
                                    <?php if ($contact->role == 'observer') continue; ?>
                                    <option value="<?= $contact->id ?>" <?= ($issue->assigned == $contact->id) ? 'selected="selected"' : '' ?>>
                                        <?= (empty($contact->title)) ? $contact->name : $contact->title ?>
                                        <?php if ($contact->id == Auth::user()->id) { ?>
                                            (<?= trans('issues.you') ?>)
                                        <?php } ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <br />
                    <br />
                </div>
            </div>

        </div>
        <div class="clearfix">
            <input type="submit" value="<?= trans('issues.edit_issue') ?>" class="btn btn-block btn-lg btn-primary" />
        </div>
        <br />
    </form>
</div>