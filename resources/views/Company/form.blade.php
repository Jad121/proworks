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



       
            
            <form id="addUpdateForm" action="{{ $action === 'add' ? route('company.add') : route('company.update', ['recordId' => $company['ms_company_id']]) }}" method="POST"  >
                    @csrf
                    <input class="form-control" type="hidden" value="{{$comapny["ws_company_id"]??''}}" name="id" id="id"> 


                    <label for="ms_company_name_en" class="col-form-label">Comapny Name English:</label>
                    <input class="form-control" type="text" value="{{$comapny["ms_company_name_en"]??''}}" name="ms_company_name_en" id="ms_company_name_en"> 

                    <label for="ms_company_name_ar" class="col-form-label">ms_company_name_ar:</label>
                    <input class="form-control" type="text"   value="{{$comapny["ms_company_name_ar"]??''}}" name="ms_company_name_ar" id="ms_company_name_ar"> 

                    <label for="ms_company_name_cn" class="col-form-label">ms_company_name_cn:</label>
                    <input class="form-control" type="text"  value="{{$comapny["ms_company_name_cn"]??''}}" name="ms_company_name_cn" id="ms_company_name_cn">
                    
                    <button  class="btn btn-primary mt-4" id="submitBtn">
                       Submit
                    </button>
                </form>
            

  