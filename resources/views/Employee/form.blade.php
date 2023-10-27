
<script>
    $(document).ready(function(){

        $(document).ready(function(){
        $.ajax({
        url: '/getSelect', 
        type: 'GET',
        success: function(data) {
           
            $('#ms_company_id').empty();
          
            data.company.forEach(function(company) {
                $('#ms_company_id').append($('<option>', {
                    value: company.ms_company_id,
                    text: company.ms_company_name_en
                }));
            });

            $('#ms_country_id').empty();
          
          data.country.forEach(function(country) {
              $('#ms_country_id').append($('<option>', {
                  value: country.ws_country_id,
                  text: country.ws_country_name_en
              }));
          });

          $('#ms_service_id').empty();
          
          data.service.forEach(function(service) {
              $('#ms_service_id').append($('<option>', {
                  value: service.ms_service_id,
                  text: service.ms_service_name_en
              }));
          });

          $('#ms_status_id').empty();
          
          data.status.forEach(function(status) {
              $('#ms_status_id').append($('<option>', {
                  value: status.ms_status_id,
                  text: status.ms_status_name_en
              }));
          });

          $('#ms_user_id').empty();
          
          data.user.forEach(function(user) {
              $('#ms_user_id').append($('<option>', {
                  value: user.ws_user_id,
                  text: user.ws_user_first_name
              }));
          });
            
        },
        error: function() {
            console.error('Failed to fetch Data.');
        }
    });



    $("#addUpdateForm").submit(function(e){
        e.preventDefault();
        var action=$(this).attr("action");
        var formData = $('#addUpdateForm').serialize();
        $.ajax({
            method:"post",
            url:action,
            headers:csrfHeader(),
            data:formData,
            success:function(result){
                alert(result.message)
                $('#data-table-default').DataTable().ajax.reload();
                $('#addUpdateModal').modal('hide'); 
            }

        });

     });
    })

    })
</script>
<div class="container mt-5">
    <form id="addUpdateForm" action="{{ $action === 'add' ? route('employee.add') : route('employee.update', ['recordId' => $employee['ms_employee_id']]) }}" method="POST">
        @csrf
        <input class="form-control" type="hidden" value="{{ $employee['ms_employee_id'] ?? '' }}" name="id" id="id">

        <label for="ms_company_id" class="col-form-label">company:</label>
        <select class="form-control" name="ms_company_id" id="ms_company_id">
            <option value="">Select a company</option>
        </select>

        <label for="ms_country_id" class="col-form-label">Country:</label>
        <select class="form-control" name="ms_country_id" id="ms_country_id">
            <option value="">Select a country</option>
        </select>

        <label for="ms_service_id" class="col-form-label">Service:</label>
        <select class="form-control" name="ms_service_id" id="ms_service_id">
            <option value="">Select a service</option>
        </select>

        <label for="ms_status_id" class="col-form-label">status:</label>
        <select class="form-control" name="ms_status_id" id="ms_status_id">
            <option value="">Select a status</option>
        </select>

        <label for="ms_user_id" class="col-form-label">user:</label>
        <select class="form-control" name="ms_user_id" id="ms_user_id">
            <option value="">Select a user</option>
        </select>
        <div class="form-group">
            <label for="ms_employee_name" class="col-form-label">Employee Name:</label>
            <input class="form-control" type="text" value="{{ $employee['ms_employee_name'] ?? '' }}" name="ms_employee_name" id="ms_employee_name">
        </div>

        <div class="form-group">
            <label for="ms_employee_boarder_nb" class="col-form-label">Boarder Number:</label>
            <input class="form-control" type="text" value="{{ $employee['ms_employee_boarder_nb'] ?? '' }}" name="ms_employee_boarder_nb" id="ms_employee_boarder_nb">
        </div>

        <div class="form-group">
            <label for="ms_employee_payment_proof_nb" class="col-form-label">Payment Proof Number:</label>
            <input class="form-control" type="text" value="{{ $employee['ms_employee_payment_proof_nb'] ?? '' }}" name="ms_employee_payment_proof_nb" id="ms_employee_payment_proof_nb">
        </div>

        <div class="form-group">
            <label for="ms_employee_iqama_nb" class="col-form-label">Iqama Number:</label>
            <input class="form-control" type="text" value="{{ $employee['ms_employee_iqama_nb'] ?? '' }}" name="ms_employee_iqama_nb" id="ms_employee_iqama_nb">
        </div>

        <div class="form-group">
            <label for="ms_employee_iqama_dob" class="col-form-label">Iqama Date of Birth:</label>
            <input class="form-control" type="text" value="{{ $employee['ms_employee_iqama_dob'] ?? '' }}" name="ms_employee_iqama_dob" id="ms_employee_iqama_dob">
        </div>

        <div class="form-group">
            <label for="ms_employee_iqama_expiry" class="col-form-label">Iqama Expiry Date:</label>
            <input class="form-control" type="text" value="{{ $employee['ms_employee_iqama_expiry'] ?? '' }}" name="ms_employee_iqama_expiry" id="ms_employee_iqama_expiry">
        </div>

        <div class="form-group">
            <label for="ms_employee_fees" class="col-form-label">Employee Fees:</label>
            <input class="form-control" type="text" value="{{ $employee['ms_employee_fees'] ?? '' }}" name="ms_employee_fees" id="ms_employee_fees">
        </div>

        <div class="form-group">
            <label for="ms_employee_requested_date" class="col-form-label">Requested Date:</label>
            <input class="form-control" type="text" value="{{ $employee['ms_employee_requested_date'] ?? '' }}" name="ms_employee_requested_date" id="ms_employee_requested_date">
        </div>

        <div class="form-group">
            <label for="ms_employee_completed_date" class="col-form-label">Completed Date:</label>
            <input class="form-control" type="text" value="{{ $employee['ms_employee_completed_date'] ?? '' }}" name="ms_employee_completed_date" id="ms_employee_completed_date">
        </div>

        <div class="form-group">
            <label for="ms_employee_is_invoice" class="col-form-label">Is Invoice:</label>
            <input class="form-control" type="text" value="{{ $employee['ms_employee_is_invoice'] ?? '' }}" name="ms_employee_is_invoice" id="ms_employee_is_invoice">
        </div>

        <div class="form-group">
            <label for="ms_employee_comment" class="col-form-label">Comment:</label>
            <input class="form-control" type="text" value="{{ $employee['ms_employee_comment'] ?? '' }}" name="ms_employee_comment" id="ms_employee_comment">
        </div>

        <button class="btn btn-primary mt-4" id="submitBtn">Submit</button>
    </form>
</div>








