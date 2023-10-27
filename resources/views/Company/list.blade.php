
@extends('admin.index')
@section('content')
    <div class="container mt-5">
        <button class="btn btn-success" id="add-button">Add</button>
        <table id="data-table-default" class="table table-striped table-bordered align-middle">
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

    
  

    <script>
        $(document).ready(function() {
            $('#data-table-default').DataTable({
                ajax: {
                    url: '/company/get', 
                    dataSrc: '',
                },
                columns: [
                    { data: 'ms_company_id' },
                    { data: 'ms_company_name_en' },
                    { data: 'ms_company_name_ar' },
                    { data: 'ms_company_name_cn' },
                    
                  
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
                $('#addUpdateModal .modal-body').load("{{ route('company.form') }}");
                $('#addUpdateModal').modal('show');
            });

            // Handling the "Update" button click
            $('#data-table-default tbody').on('click', 'button.btn-primary', function() {
                var data = $('#data-table-default').DataTable().row($(this).parents('tr')).data();
                $('#modalTitle').text('Update Form');
                var recordId = data.ms_company_id;
                $('#addUpdateModal .modal-body').load("{{ route('company.form') }}?id=" + recordId);
                $('#addUpdateModal').modal('show');
            })

            $('#data-table-default tbody').on('click', 'button.btn-danger', function() {
                var data = $('#data-table-default').DataTable().row($(this).parents('tr')).data();
                var recordId= data.ms_company_id;
               $.ajax({
                headers:csrfHeader(),
                url:'/company/delete/',
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

