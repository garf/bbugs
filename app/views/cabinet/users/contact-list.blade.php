<br />
<div class="well well-sm "><a href="#addContact" role="button" data-toggle="modal" class="btn btn-success btn-flat"><@@ trans('users.add') @@></a></div>
@if (count($contacts) > 0)
    <div class="table-responsive">
        <table class="table">
            @foreach ($contacts as $contact)
            <tr class="contact<@ $contact->coid @>">
                <td class="col-md-1 text-center">
                    <img class="img-thumbnail"
                         alt="Gravatar" src="<@@ Gravatar::src($contact->email, 64) @@>">
                    <br />
                    <div style="margin-top: 5px;">
                        <a href="#" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="<@@ trans('users.edit') @@>"><i class="fa fa-pencil"></i></a>
                        <a href="<@URL::route('contact-delete', array($contact->coid))@>"
                           data-toggle="tooltip" data-placement="top"
                           data-id="<@$contact->coid@>"
                           data-message="Удалить <@@ $contact->title @@>?"
                           onclick="return false;"
                           class="btn btn-sm btn-danger delete-contact" title="<@@trans('users.delete')@@>">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </td>
                <td>
                    <div class="clearfix">
                        <div class="text-left">
                            <strong><@@ trim($contact->title) != '' ? $contact->title : $contact->name @@></strong>
                            <span class="text-muted"><@@ trim($contact->title) != '' ? $contact->name : '' @@></span>
                            @if ($contact->is_email)
                            <div>
                                <span class="text-muted"><@ trans('users.email') @>:</span>
                                <a href="mailto:<@@ $contact->email @@>"><@@ $contact->email @@></a>
                            </div>
                            @endif
                            @if ($contact->is_phone && trim($contact->phone) != '')
                            <div>
                                <span class="text-muted"><@ trans('users.phone') @>:</span>
                                +<@@ $contact->phone @@>
                            </div>
                            @endif
                            @if ($contact->is_skype && trim($contact->skype) != '')
                            <div>
                                <span class="text-muted"><@ trans('users.skype') @>:</span>
                                <a href="skype:<@@ $contact->skype @@>">
                                    <@@ $contact->skype @@>
                                </a>
                            </div>
                            @endif
                            <div><@@ $contact->notes @@></div>
                            <div class="message<@ $contact->coid @>"></div>
                        </div>
                        <div class="text-muted text-right "><@ trans('users.created') @>: <@ date('Y.m.d H:i', $contact->created) @></div>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
@else
    <div class="alert alert-info"><@ trans('users.no_contacts') @></div>
@endif

<!-- Modal -->
<div class="modal fade" id="addContact" tabindex="-1" role="dialog" aria-labelledby="addContactLabel" aria-hidden="true">
    <div class="modal-dialog" ng-controller="AddContactController">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"><@ trans('users.modal_add_title') @></h4>
            </div>
            <form action="<@ URL::route('contact-add-search') @>" method="post" id="addContactForm">
                <div class="modal-body">
                    <div><@ trans('users.insert_email') @></div>
                    <br />
                    <div class="input-group">
                        <input type="text" name="email" class="form-control" ng-model="model.email" maxlength="100" placeholder="<@ trans('users.email') @>" />
                        <span class="input-group-btn">
                            <button class="btn btn-info" type="button" ng-click="search()"><@ trans('users.find') @></button>
                        </span>
                    </div>
                    <div class="text-center" ng-show="isLoading();"><br /><img src="/template/common/img/loaders/220x20.gif" alt="..." /></div>
                    <div ng-show="isFound()">
                        <br />
                        <table class="table">
                            <tr>
                                <td class="col-md-1"><img src="{{ user.gravatar }}" alt="" class="media-object img-thumbnail user-img" /></td>
                                <td>
                                    <div>
                                        <span class="text-muted"><@ trans('users.name') @></span>: {{ user.name }}<br />
                                        <span class="text-muted"><@ trans('users.email') @></span>: {{ user.email }}<br />
                                        <span class="text-muted"><@ trans('users.phone') @></span>: +{{ user.phone }}
                                    </div>
                                    <div style="margin-top: 6px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><@ trans('users.title') @></span>
                                            <input type="text" name="title" class="form-control" ng-model="model.title" placeholder="<@ trans('users.ph_title') @>">
                                        </div>
                                        <br />
                                        <div class="input-group">
                                            <span class="input-group-addon"><@ trans('users.notes') @></span>
                                            <input type="text" name="notes" class="form-control" ng-model="model.notes" placeholder="<@ trans('users.ph_notes') @>">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <button class="btn btn-success btn-sm btn-block" style="margin-top: 10px;" type="button" ng-click="add()"><@ trans('users.add_now') @></button>
                        <hr />
                    </div>
                    <div ng-show="isError();" class="alert alert-danger">{{ message }}</div>
                </div>
                <div class="modal-footer">

                </div>
            </form>
        </div>
    </div>
</div>

