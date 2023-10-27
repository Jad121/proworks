
@extends('admin.index')
@section('content')
    <div class="container mt-5">
        <button class="btn btn-success" id="add-button">Add</button>
        <table id="data-table-default" class="table table-striped table-bordered align-middle">
          <thead>
            <tr>
                <th>ID</th>
                <th>Country Name English</th>
                <th>Country Name Arabic</th>
                <th>Country Name Chinese</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
          
        </table>
    </div>

    
  

    <script>
        $(document).ready(function() {
            $('#data-table-default').DataTable({
                ajax: {
                    url: '/country/get', 
                    dataSrc: '',
                },
                columns: [
                    { data: 'ws_country_id' },
                    { data: 'ws_country_name_en' },
                    { data: 'ws_country_name_ar' },
                    { data: 'ws_country_name_cn' },
                    
                  
                    {
                        data: null,
                        render: function(data, type, row) {
                            return '<button class="btn btn-primary">Update</button>';
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return '<button class=" btn btn-danger">Delete</button>';
                        }
                    },
                  
                ]
            });


            $('#add-button').click(function() {
                $('#modalTitle').text('Add Form');
                $('#addUpdateModal .modal-body').load("{{ route('country.form') }}");
                $('#addUpdateModal').modal('show');
            });

            // Handling the "Update" button click
            $('#data-table-default tbody').on('click', 'button.btn-primary', function() {
                var data = $('#data-table-default').DataTable().row($(this).parents('tr')).data();
                $('#modalTitle').text('Update Form');
                var recordId = data.ws_country_id;
                $('#addUpdateModal .modal-body').load("{{ route('country.form') }}?id=" + recordId);
                $('#addUpdateModal').modal('show');
            })

            $('#data-table-default tbody').on('click', 'button.btn-danger', function() {
                var data = $('#data-table-default').DataTable().row($(this).parents('tr')).data();
                var recordId= data.ws_country_id;
               $.ajax({
                headers:csrfHeader(),
                url:'/country/delete/',
                method:'post',
                data:{recordId:recordId},
                success:function(response){
                    alert(response.message)
                    $('#data-table-default').DataTable().ajax.reload();
                }
               })
            })




            
    

        })
            
        
    </script>

<div class="modal" id="addUpdateModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Records</h5>
              
            </div>
            <div class="modal-body">
            </div>
        </div>

    </div>
</div>  
        
@endsection

