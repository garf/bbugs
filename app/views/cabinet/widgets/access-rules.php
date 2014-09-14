<div class="panel panel-success">
    <div class="panel-heading"><a onclick="$('#rulesLegend').slideToggle(100);" class="btn btn-xs btn-success"><?= trans('projects.access_rules'); ?></a></div>
    <div class="panel-body" id="rulesLegend" style="display: none;">
        <table class="table table-bordered table-hover text-center">
            <tr>
                <th></th>
                <th class="text-center"><?= trans('users.roles.observer') ?></th>
                <th class="text-center"><?= trans('users.roles.developer') ?></th>
                <th class="text-center"><?= trans('users.roles.teamlead') ?></th>
            </tr>
            <tr class="info">
                <td><b><?= trans('projects.projects') ?></b></td>
                <td><?= trans('users.roles.observer') ?></td>
                <td><?= trans('users.roles.developer') ?></td>
                <td><?= trans('users.roles.teamlead') ?></td>
            </tr>
            <tr>
                <td class="text-left"><?= trans('users.view_project_info') ?></td>
                <td class="success">+</td>
                <td class="success">+</td>
                <td class="success">+</td>
            </tr>
            <tr>
                <td class="text-left"><?= trans('users.view_project') ?></td>
                <td class="success">+</td>
                <td class="success">+</td>
                <td class="success">+</td>
            </tr>
            <tr>
                <td class="text-left"><?= trans('users.edit_project') ?></td>
                <td class="danger">-</td>
                <td class="danger">-</td>
                <td class="success">+</td>
            </tr>
            <tr>
                <td class="text-left"><?= trans('users.delete_project') ?></td>
                <td class="danger">-</td>
                <td class="danger">-</td>
                <td class="success">+</td>
            </tr>
            <tr>
                <td class="text-left"><?= trans('users.manage_project_members') ?></td>
                <td class="danger">-</td>
                <td class="danger">-</td>
                <td class="success">+</td>
            </tr>
            <tr>
                <td colspan="4"></td>
            </tr>
            <tr class="info">
                <td><b><?= trans('issues.issues') ?></b></td>
                <td><?= trans('users.roles.observer') ?></td>
                <td><?= trans('users.roles.developer') ?></td>
                <td><?= trans('users.roles.teamlead') ?></td>
            </tr>
            <tr>
                <td class="text-left"><?= trans('users.view_issue') ?></td>
                <td class="success">+</td>
                <td class="success">+</td>
                <td class="success">+</td>
            </tr>
            <tr>
                <td class="text-left"><?= trans('users.add_issue') ?></td>
                <td class="danger">-</td>
                <td class="success">+</td>
                <td class="success">+</td>
            </tr>
            <tr>
                <td class="text-left"><?= trans('users.edit_issue') ?></td>
                <td class="danger">-</td>
                <td class="success">+</td>
                <td class="success">+</td>
            </tr>
            <tr>
                <td class="text-left"><?= trans('users.update_issue') ?></td>
                <td class="danger">-</td>
                <td class="success">+</td>
                <td class="success">+</td>
            </tr>
            <tr>
                <td class="text-left"><?= trans('users.delete_issue') ?></td>
                <td class="danger">-</td>
                <td class="danger">-</td>
                <td class="success">+</td>
            </tr>
            <tr>
                <td colspan="4"></td>
            </tr>
            <tr class="info">
                <td><b><?= trans('files.files') ?></b></td>
                <td><?= trans('users.roles.observer') ?></td>
                <td><?= trans('users.roles.developer') ?></td>
                <td><?= trans('users.roles.teamlead') ?></td>
            </tr>
            <tr>
                <td class="text-left"><?= trans('users.view_files_list') ?></td>
                <td class="danger">-</td>
                <td class="success">+</td>
                <td class="success">+</td>
            </tr>
            <tr>
                <td class="text-left"><?= trans('users.upload_files') ?></td>
                <td class="danger">-</td>
                <td class="success">+</td>
                <td class="success">+</td>
            </tr>
            <tr>
                <td class="text-left"><?= trans('users.download_files') ?></td>
                <td class="danger">-</td>
                <td class="success">+</td>
                <td class="success">+</td>
            </tr>
            <tr>
                <td class="text-left"><?= trans('users.delete_files') ?></td>
                <td class="danger">-</td>
                <td class="danger">-</td>
                <td class="success">+</td>
            </tr>
        </table>
        <div class="text-right"><a onclick="$('#rulesLegend').slideUp(100);" class="btn btn-xs btn-success"><?= trans('projects.close'); ?></a></div>
    </div>
</div>