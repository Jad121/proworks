<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $.ajax({
        url: '/getCountries', 
        type: 'GET',
        success: function(countries) {
           
            $('#countryDropdown').empty();
            // Add countries to the dropdown
            countries.forEach(function(country) {
                $('#countryDropdown').append($('<option>', {
                    value: country.ws_country_id,
                    text: country.ws_country_name_en
                }));
            });
            
        },
        error: function() {
            console.error('Failed to fetch countries.');
        }
    });

    $('#addUpdateForm').submit(function(event) {
        event.preventDefault();
        var action = $('#addUpdateModal').data('action');
        
        var formData = $('#addUpdateForm').serialize();
        
        if (action === 'add') {
            $.ajax({
                url: '/ws_user/addRecord',
                type: 'POST',
                data: formData,
                success: function(response) {  
                    console.log('Record added successfully');
                    $('#data-table-default').DataTable().ajax.reload();
                },
                error: function(error) {
                    console.error('Failed to add record');
                }
            });
        } else if (action === 'update') {
            var recordId = $('#addUpdateModal').data('record-id');
            $.ajax({
                url: '/ws_user/updateRecord/' + recordId, 
                type: 'PUT', 
                data: formData,
                success: function(response) {
                    console.log('Record updated successfully');
                    $('#data-table-default').DataTable().ajax.reload();
                },
                error: function(error) {
                    console.error('Failed to update record');
                }
            });
        }
        $('#addUpdateModal').modal('hide'); 
    });


    })
</script>


<div class="modal" id="addUpdateModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">User Record</h5>
              
            </div>
            <div class="modal-body">
                <form id="addUpdateForm">
                    @csrf
                    <label for="ws_user_fname" class="col-form-label">ws_user_fname:</label>
                    <input class="form-control" type="text" name="ws_user_fname" id="ws_user_fname"> 

                    <label for="ws_user_lname" class="col-form-label">ws_user_lname:</label>
                    <input class="form-control" type="text" name="ws_user_lname" id="ws_user_lname"> 

                    <label for="ws_user_email" class="col-form-label">ws_user_email:</label>
                    <input class="form-control" type="text" name="ws_user_email" id="ws_user_email"> 

                    <label for="ws_user_password" class="col-form-label">ws_user_password:</label>
                    <input class="form-control" type="text" name="ws_user_password" id="ws_user_password"> 

                    <label for="ws_user_address" class="col-form-label">ws_user_address:</label>
                    <input class="form-control" type="text" name="ws_user_address" id="ws_user_address"> 

                    <label for="ws_user_phone" class="col-form-label">ws_user_phone:</label>
                    <input class="form-control" type="text" name="ws_user_phone" id="ws_user_phone"> 


                    <label for="ws_user_address" class="col-form-label">ws_user_country:</label>
                    <select id="countryDropdown" class="form-control" name="countryDropdown">
                        <option value="0" selected>Select a Country</option>
                    </select>
                    
                    
                    
                    <button type="submit" class="btn btn-primary mt-4" id="submitBtn">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
