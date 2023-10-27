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


    $("#addUpdateForm").submit(function(e){
        e.preventDefault();
        var action=$(this).attr("action");
        var formData = $('#addUpdateForm').serialize();
        $.ajax({
            method:"post",
            url:action,
            headers:csrfHeader(),
            data:formData,
            // processData:false,
            // conentType:false,
          
            success:function(result){
                alert(result.message)
                $('#data-table-default').DataTable().ajax.reload();
                $('#addUpdateModal').modal('hide'); 
            }

        });

    });

 

     })
</script>




            
            <form id="addUpdateForm" action="{{ $action === 'add' ? route('users.add') : route('users.update', ['recordId' => $user['ws_user_id']]) }}" method="POST"  >
                    @csrf
                    <input class="form-control" type="hidden" value="{{$user["id"]??''}}" name="id" id="id"> 


                    <label for="ws_user_fname" class="col-form-label">ws_user_fname:</label>
                    <input class="form-control" type="text" value="{{$user["ws_user_first_name"]??''}}" name="ws_user_fname" id="ws_user_fname"> 

                    <label for="ws_user_lname" class="col-form-label">ws_user_lname:</label>
                    <input class="form-control" type="text"   value="{{$user["ws_user_last_name"]??''}}" name="ws_user_lname" id="ws_user_lname"> 

                    <label for="ws_user_email" class="col-form-label">ws_user_email:</label>
                    <input class="form-control" type="text"  value="{{$user["ws_user_email"]??''}}" name="ws_user_email" id="ws_user_email"> 

                    <label for="ws_user_password" class="col-form-label">ws_user_password:</label>
                    <input class="form-control" type="text" name="ws_user_password" id="ws_user_password"  value="{{$user["ws_user_password"]??''}}"> 

                    <label for="ws_user_address" class="col-form-label">ws_user_address:</label>
                    <input class="form-control" type="text" name="ws_user_address" id="ws_user_address"  value="{{$user["ws_user_address"]??''}}"> 

                    <label for="ws_user_phone" class="col-form-label">ws_user_phone:</label>
                    <input class="form-control" type="text" name="ws_user_phone" id="ws_user_phone"  value="{{$user["ws_user_phone"]??''}}"> 


                    <label for="ws_user_address" class="col-form-label">ws_user_country:</label>
                    <select id="countryDropdown" class="form-control" name="countryDropdown">
                        <option value="0" selected>Select a Country</option>
                    </select>
                    
                    
                    
                    <button  class="btn btn-primary mt-4" id="submitBtn">
                       Submit
                    </button>
                </form>
            

  