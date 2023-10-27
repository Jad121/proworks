@extends('admin.index')

@section('content')
<div class="container mt-5">
    <button class="btn btn-success" id="add-button">Add Employee</button>
    <table id="data-table-default" class="table table-striped table-bordered align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Company ID</th>
                <th>Country ID</th>
                <th>Service ID</th>
                <th>Status ID</th>
                <th>User ID</th>
                <th>Employee Name</th>
                <th>Boarder Number</th>
                <th>Payment Proof Number</th>
                <th>Iqama Number</th>
                <th>Iqama Date of Birth</th>
                <th>Iqama Expiry Date</th>
                <th>Employee Fees</th>
                <th>Requested Date</th>
                <th>Completed Date</th>
                <th>Is Invoice</th>
                <th>Comment</th>
                <th>Created By</th>
                <th>Created Date</th>
                <th>Updated By</th>
                <th>Updated Date</th>
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
                url: '/employee/get', 
                dataSrc: '',
            },
            columns: [
                { data: 'ms_employee_id' },
                { data: 'ms_employee_name' },
                { data: 'ms_employee_boarder_nb' },
                { data: 'ms_employee_payment_proof_nb' },
                { data: 'ms_employee_iqama_nb' },
                { data: 'ms_employee_iqama_dob' },
                { data: 'ms_employee_iqama_expiry' },
                { data: 'ms_employee_fees' },
                { data: 'ms_employee_requested_date' },
                { data: 'ms_employee_completed_date' },
                { data: 'ms_employee_is_invoice' },
                { data: 'ms_employee_comment' },
                { data: 'ms_employee_created_by' },
                { data: 'ms_employee_created_date' },
                { data: 'ms_employee_updated_by' },
                { data: 'ms_employee_updated_date' },
                { data: 'ms_company_id' },
                { data: 'ms_country_id' },
                { data: 'ms_service_id' },
                { data: 'ms_status_id' },
                { data: 'ws_user_id' },
              
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
            $('#addUpdateModal .modal-body').load("{{ route('employee.form') }}");
            $('#addUpdateModal').modal('show');
        });

        // Handling the "Update" button click
        $('#data-table-default tbody').on('click', 'button.btn-primary', function() {
            var data = $('#data-table-default').DataTable().row($(this).parents('tr')).data();
            $('#modalTitle').text('Update Form');
            var recordId = data.ms_employee_id;
            $('#addUpdateModal .modal-body').load("{{ route('employee.form') }}?id=" + recordId);
            $('#addUpdateModal').modal('show');
        })

        $('#data-table-default tbody').on('click', 'button.btn-danger', function() {
            var data = $('#data-table-default').DataTable().row($(this).parents('tr')).data();
            var recordId= data.ms_employee_id;
           $.ajax({
            headers:csrfHeader(),
            url:'/employee/delete/',
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


