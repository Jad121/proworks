@include('User.form')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Table List</title>
    {{-- <link href="{{asset('assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')}}" rel="stylesheet" /> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<!-- DataTables JavaScript -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>



    <script>
        $(document).ready(function() {
            $('#data-table-default').DataTable({
                ajax: {
                    url: '/getUsers', // Replace with your Laravel route
                    dataSrc: '',
                },
                columns: [
                    { data: 'ws_user_id' },
                    { data: 'ws_user_first_name' },
                    { data: 'ws_user_last_name' },
                    { data: 'ws_user_password' },
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
                            return '<button class="btn btn-danger">Delete</button>';
                        }
                    },
                  
                ]
            });



            $('#add-button').click(function() {
                $('#modalTitle').text('Add Record');
                $('#submitBtn').text('Add');
                $('#addUpdateForm')[0].reset(); 
                $('#addUpdateModal').modal('show');
                $('#addUpdateModal').data('action', 'add'); 
            });




            $('#data-table-default tbody').on('click', 'button.btn-primary', function() {
            var data = $('#data-table-default').DataTable().row($(this).parents('tr')).data();
            $('#modalTitle').text('Update Record');
            $('#submitBtn').text('Update');
            // Fill the form fields with the data of the selected record
            $('#addUpdateForm #ws_user_fname').val(data.ws_user_first_name);
            $('#addUpdateForm #ws_user_lname').val(data.ws_user_last_name);
            $('#addUpdateForm #ws_user_email').val(data.ws_user_email);
            $('#addUpdateForm #ws_user_phone').val(data.ws_user_phone);
            $('#addUpdateForm #ws_user_address').val(data.ws_user_address);
            $('#addUpdateForm #ws_user_password').val(data.ws_user_password);
            // ... and so on for other fields
            $('#addUpdateModal').modal('show');
            $('#addUpdateModal').data('action', 'update'); // Store action information
            $('#addUpdateModal').data('record-id', data.ws_user_id); // Store the ID of the record being updated
        });

        });
    </script>
    

</head>
<body>
    
    <div class="container mt-5">
        <button class="btn btn-success" id="add-button">Add</button>
        <table id="data-table-default" class="table table-striped table-bordered align-middle">
          <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Password Name</th>
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
  







    {{-- <script src="{{asset('assets/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
	<script src="{{asset('assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{asset('assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js')}}"></script> --}}
</body>
</html>