<br />
<div>
    <table class="table">
        @foreach ($contacts as $contact)
        <tr class="contact<@ $contact->coid @>">
            <td class="col-md-1 text-center">
                <img class="img-thumbnail"
                     alt="Gravatar" src="<@@ Gravatar::src($contact->email, 64) @@>">
                <br />
            </td>
            <td>
                <div class="clearfix">
                    <div class="text-left">
                        <strong><@@ trim($contact->title) != '' ? $contact->title : $contact->name @@></strong>
                        <span class="text-muted"><@@ trim($contact->title) != '' ? $contact->name : '' @@></span>
                        <div><@@ $contact->notes @@></div>
                        <div class="message<@ $contact->coid @>"><?php var_dump($project->puid); ?></div>
                    </div>
                </div>
            </td>
            <td>
                <a href="#" class="btn btn-lg btn-block btn-success">Добавить к проекту</a>
            </td>
        </tr>
        @endforeach
    </table>
</div>