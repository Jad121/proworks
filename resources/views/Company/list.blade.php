@extends('layouts.dashboard')

@section('table_title')
    Comapnies
@endsection
@section('table')
    <div class="container">
        <button data-add-record class="btn btn-lg btn-success px-5 my-2">Add</button>
        <table id="table" class="table table-striped table-bordered align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Company Name English</th>
                    <th>Company Name Arabic</th>
                    <th>Company Name Chinese</th>
                    <th>Update</th>

                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>

            </tbody>

        </table>
    </div>



    <div class="modal fade" id="addUpdateModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Records</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                </div>
            </div>

        </div>
    </div>



    <script>
        var $table;
        $(document).ready(function() {
            $table = $('#table');
            $table.DataTable({
                ajax: {
                    url: '/company/get',
                    dataSrc: '',
                },
                columns: [{
                        data: 'ms_company_id'
                    },
                    {
                        data: 'ms_company_name_en'
                    },
                    {
                        data: 'ms_company_name_ar'
                    },
                    {
                        data: 'ms_company_name_cn'
                    },


                    {
                        data: null,
                        render: function(data, type, row) {
                            return '<button data-update-record class="btn btn-lg btn-primary">Update</button>';
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return '<button data-delete-record class=" btn btn-lg btn-danger">Delete</button>';
                        }
                    },

                ]
            });


            $('[data-add-record]').click(function() {
                loadHtml('#addUpdateModal .modal-content',"{{ route('company.form') }}");
               
                $('#addUpdateModal').modal('show');
            });


            $(document).on('click', '[data-update-record]', function() {
                var data = $table.DataTable().row($(this).parents('tr')).data();
                var recordId = data.ms_company_id;
                loadHtml('#addUpdateModal .modal-content',"{{ route('company.form') }}?id=" +
                    recordId);
               
                $('#addUpdateModal').modal('show');
            })

            $(document).on('click', '[data-delete-record]', function() {
                var data = $table.DataTable().row($(this).parents('tr')).data();
                var recordId = data.ms_company_id;
                $.ajax({
                    headers: csrfHeader(),
                    url: '/company/delete/',
                    headers:csrfHeader(),
                    method: 'post',
                    data: {
                        recordId: recordId
                    },
                    success: function(response) {
                        alert(response.message)
                        $table.DataTable().ajax.reload();
                    }
                })
            })







        })
    </script>
@endsection
