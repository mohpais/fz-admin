@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-4" style="justify-content: space-between">
                        <div class="col-auto">
                            <h4 class="card-title">Data table</h4>
                        </div>
                        <div class="col-auto">
                            <button id="addUser" class="btn btn-sm btn-success">+ Add User</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table id="datatable" class="table data-table no-footer">
                                <thead>
                                    <tr role="row">
                                        <th>No</th>
                                        <th>Photo</th>
                                        <th>Fullname</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Creation Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            // var ModalNames = $('#modal'),
            //     ModalForms = $('.forms-modal'),
            //     ModalLabels = $('#modal-showLabel')
            //     ModalButton = $('.btn-submit')

            // Datatables config
            var table = $('.data-table').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('home') }}"
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {
                        data: 'photo', 
                        name: 'photo',
                        orderable: false, 
                        searchable: false
                    },
                    {data: 'fullname', name: 'fullname'},
                    {data: 'email', name: 'email'},
                    {data: 'username', name: 'username'},
                    {data: 'created_at', name: 'created_at'},
                    {
                        data: 'action', 
                        name: 'action', 
                        orderable: false, 
                        searchable: false
                    },
                ]
            })

            // $('#dismiss').on('click', closeModal)

            // /* Modal Add Experience */
            // $('#addUser').on('click', function() {
            //     openModal(true, 'Add User', 'create-user', 'Create')
            // });

            // function openModal(resetForms, titleModal, buttonId, buttonTitle) {
            //     if (resetForms) ModalForms.trigger("reset");
            //     ModalLabels.html(titleModal);
            //     ModalButton.attr('id', buttonId).html(buttonTitle);
            //     ModalNames.modal('show');
            //     $("html").addClass("overflow-hidden")
            // }

            // function closeModal(resetForms) {
            //     if (resetForms) ModalForms.trigger("reset");
            //     ModalNames.modal('hide');
            //     $("html").removeClass("overflow-hidden")
            // }


        })
    </script>
@endpush
