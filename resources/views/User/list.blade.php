
@extends('admin.index')
@section('content')
    <div class="container mt-5">
        <button class="btn btn-success" id="add-button">Add</button>
        <table id="data-table-default" class="table table-striped table-bordered align-middle">
          <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                {{-- <th>Password Name</th> --}}
                <th>Address</th>
                <th>Phone</th>
                <th>Email</th>
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
                    // url:{{url("/user/get")}}
                    url: '/getUsers', // Replace with your Laravel route
                    dataSrc: '',
                },
                columns: [
                    { data: 'ws_user_id' },
                    { data: 'ws_user_first_name' },
                    { data: 'ws_user_last_name' },
                    // { data: 'ws_user_password' },
                    { data: 'ws_user_address' },
                    { data: 'ws_user_phone' },
                    { data: 'ws_user_email' },
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
                $('#modalTitle').text('Add User');
                $('#addUpdateModal .modal-body').load("{{ route('users.form') }}");
                $('#addUpdateModal').modal('show');
            });

            // Handling the "Update" button click
            $('#data-table-default tbody').on('click', 'button.btn-primary', function() {
                var data = $('#data-table-default').DataTable().row($(this).parents('tr')).data();
                $('#modalTitle').text('Update User');
                var userId = data.ws_user_id;
                $('#addUpdateModal .modal-body').load("{{ route('users.form') }}?id=" + userId);
                $('#addUpdateModal').modal('show');
            })

            $('#data-table-default tbody').on('click', 'button.btn-danger', function() {
                var data = $('#data-table-default').DataTable().row($(this).parents('tr')).data();
                var userId = data.ws_user_id;
               $.ajax({
                headers:csrfHeader(),
                url:'/users/delete/',
                method:'post',
                data:{userId:userId},
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
                <h5 class="modal-title" id="modalTitle">User Record</h5>
              
            </div>
            <div class="modal-body">
            </div>
        </div>

    </div>
</div>  
        
@endsection

