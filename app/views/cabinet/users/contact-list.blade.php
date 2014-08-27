<br />
<div class="well well-sm"><a href="#" class="btn btn-success btn-flat">{{{trans('users.add')}}}</a></div>
<table class="table table-responsive">
    @foreach ($contacts as $contact)
    <tr class="contact{{$contact->coid}}">
        <td class="col-md-1 text-center">
            <img class="img-thumbnail"
                 alt="Gravatar" src="{{ Gravatar::src($contact->email, 64) }}">
            <br />
            <div style="margin-top: 5px;">
                <a href="#" class="btn btn-sm btn-warning" title="{{{trans('users.edit')}}}"><i class="fa fa-pencil"></i></a>
                <a href="{{URL::route('contact-delete', array($contact->coid))}}"
                   data-id="{{$contact->coid}}"
                   data-message="Удалить {{{$contact->title}}}?"
                   onclick="return false;"
                   class="btn btn-sm btn-danger delete-contact" title="{{{trans('users.delete')}}}">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </td>
        <td class="clearfix">
            <div class="text-muted text-right">{{trans('users.created')}}: {{date('Y.m.d H:i', $contact->created)}}</div>
            <div class="text-left">
                <strong>{{{$contact->title}}}</strong> <span class="text-muted">{{{$contact->name}}}</span>
                @if ($contact->is_email)
                <div><a href="mailto:{{{$contact->email}}}">{{{$contact->email}}}</a></div>
                @endif
                @if ($contact->is_phone)
                <div>+{{{$contact->phone}}}</div>
                @endif
                <div>{{{$contact->notes}}}</div>
                <div class="message{{$contact->coid}}"></div>
            </div>
        </td>
    </tr>
    @endforeach
</table>