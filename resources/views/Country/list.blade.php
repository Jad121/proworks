@extends('layouts.dashboard')


@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">

        <!-- END breadcrumb -->
        <!-- BEGIN page-header -->
        <h1 class="page-header">
            Countries
        </h1>
        <!-- END page-header -->
        <!-- BEGIN panel -->
        <div class="panel panel-inverse">
            <!-- BEGIN panel-heading -->
            <div class="panel-heading">

                <div class="panel-heading-btn d-flex justify-content-between w-100">
                    <span>
                        All Records
                    </span>
                    <a href="{{route('country.form')}}">New Record</a>
                </div>
            </div>
            <!-- END panel-heading -->
            <!-- BEGIN panel-body -->
            <div class="panel-body">
                <div class="container">
                    
                    <table id="table" class="table table-striped table-bordered align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Country Name English</th>
                                <th>Country Name Arabic</th>
                                <th>Country Name Chinese</th>
                                <th>Actions</th>
                                
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
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
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
                                url: '/country/get',
                                dataSrc: '',
                            },
                            columns: [{
                                    data: 'ws_country_id'
                                },
                                {
                                    data: 'ws_country_name_en'
                                },
                                {
                                    data: 'ws_country_name_ar'
                                },
                                {
                                    data: 'ws_country_name_cn'
                                },



                                {
                                    data: null,
                                    render: function(data, type, row) {
                                        return `
                                        <a  href='{{route("country.form")}}/copy/${data.ws_country_id}'   class="btn btn-lg btn-warning">Copy</a>
                                        <a href='{{route("country.form")}}/${data.ws_country_id}' class="btn btn-lg btn-primary">Update</a>
                                        <button data-delete-record class=" btn btn-lg btn-danger">Delete</button>`;
                                    }
                                },
                                 

                            ]
                        });


                        $('[data-add-record]').click(function() {
                            loadHtml('#addUpdateModal .modal-content', "{{ route('country.form') }}");

                            $('#addUpdateModal').modal('show');
                        });


                        $(document).on('click', '[data-update-record]', function() {
                            var data = $table.DataTable().row($(this).parents('tr')).data();
                            var recordId = data.ws_country_id;
                            loadHtml('#addUpdateModal .modal-content', "{{ route('country.form') }}?id=" +
                                recordId);

                            $('#addUpdateModal').modal('show');
                        })

                        $(document).on('click', '[data-delete-record]', function() {
                            var data = $table.DataTable().row($(this).parents('tr')).data();
                            var recordId = data.ws_country_id;

                            $.ajax({

                                url: '/country/delete/',
                                method: 'post',
                                headers: csrfHeader(),
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
            </div>
            <!-- END panel-body -->

        </div>
        <!-- END panel -->
    </div>
    <!-- END #content -->
@endsection
