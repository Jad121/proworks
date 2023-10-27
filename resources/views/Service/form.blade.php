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



       
            
            <form id="addUpdateForm" action="{{ $action === 'add' ? route('service.add') : route('service.update', ['recordId' => $service['ms_service_id']]) }}" method="POST"  >
                    @csrf
                    <input class="form-control" type="hidden" value="{{$service["ms_service_id"]??''}}" name="id" id="id"> 


                    <label for="ms_service_name_en" class="col-form-label">service Name English:</label>
                    <input class="form-control" type="text" value="{{$service["ms_service_name_en"]??''}}" name="ms_service_name_en" id="ms_service_name_en"> 

                    <label for="ms_service_name_ar" class="col-form-label">ms_service_name_ar:</label>
                    <input class="form-control" type="text"   value="{{$service["ms_service_name_ar"]??''}}" name="ms_service_name_ar" id="ms_service_name_ar"> 

                    <label for="ms_service_name_cn" class="col-form-label">ms_service_name_cn:</label>
                    <input class="form-control" type="text"  value="{{$service["ms_service_name_cn"]??''}}" name="ms_service_name_cn" id="ms_service_name_cn">
                    
                    <label for="ms_service_fees" class="col-form-label">ms_service_fees:</label>
                    <input class="form-control" type="text"  value="{{$service["ms_service_fees"]??''}}" name="ms_service_fees" id="ms_service_fees">
                    
                    <button  class="btn btn-primary mt-4" id="submitBtn">
                       Submit
                    </button>
                </form>
            

  