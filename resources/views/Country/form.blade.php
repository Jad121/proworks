<script>
    $(document).ready(function(){

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
</script>            
    <form id="addUpdateForm" action="{{ $action === 'add' ? route('country.add') : route('country.update', ['recordId' => $country['ws_country_id']]) }}" method="POST"  >
            @csrf
            <input class="form-control" type="hidden" value="{{$country["ws_country_id"]??''}}" name="id" id="id"> 


            <label for="ws_country_name_en" class="col-form-label">country Name English:</label>
            <input class="form-control" type="text" value="{{$country["ws_country_name_en"]??''}}" name="ws_country_name_en" id="ws_country_name_en"> 

            <label for="ws_country_name_ar" class="col-form-label">ws_country_name_ar:</label>
            <input class="form-control" type="text"   value="{{$country["ws_country_name_ar"]??''}}" name="ws_country_name_ar" id="ws_country_name_ar"> 

            <label for="ws_country_name_cn" class="col-form-label">ws_country_name_cn:</label>
            <input class="form-control" type="text"  value="{{$country["ws_country_name_cn"]??''}}" name="ws_country_name_cn" id="ws_country_name_cn">
            
            <button  class="btn btn-primary mt-4" id="submitBtn">
                Submit
            </button>
        </form>
    

