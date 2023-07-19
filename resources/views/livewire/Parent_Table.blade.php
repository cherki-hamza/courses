<button class="btn btn-success btn-sm btn-lg pull-right" wire:click="showformadd" type="button">{{
    trans('dashboard.add_parent') }}</button><br><br>
<div class="table-responsive">
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
        style="text-align: center">
        <thead>
            <tr class="table-success">
                <th>#</th>
                <th>{{ trans('dashboard.Email') }}</th>
                <th>{{ trans('dashboard.Name_Father') }}</th>
                <th>{{ trans('dashboard.National_ID_Father') }}</th>
                <th>{{ trans('dashboard.Passport_ID_Father') }}</th>
                <th>{{ trans('dashboard.Phone_Father') }}</th>
                <th>{{ trans('dashboard.Job_Father') }}</th>
                <th>{{ trans('dashboard.Processes') }}</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            @foreach ($my_parents as $my_parent)
            <tr>
                <?php $i++; ?>
                <td>{{ $i }}</td>
                <td>{{ $my_parent->Email }}</td>
                <td>{{ $my_parent->Name_Father }}</td>
                <td>{{ $my_parent->National_ID_Father }}</td>
                <td>{{ $my_parent->Passport_ID_Father }}</td>
                <td>{{ $my_parent->Phone_Father }}</td>
                <td>{{ $my_parent->Job_Father }}</td>
                <td>
                    <button wire:click="edit({{ $my_parent->id }})" title="{{ trans('dashboard.Edit') }}"
                        class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger btn-sm" wire:click="delete({{ $my_parent->id }})"
                        title="{{ trans('dashboard.Delete') }}"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
            @endforeach
    </table>
</div>
