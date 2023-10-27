<form id="addUpdateForm"
    action="{{ $action === 'add' ? route('company.add') : route('company.update', ['recordId' => $company['ms_company_id']]) }}"
    method="POST">
    <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">
            @if ($action == 'add')
                Add Comapny
            @else
                Update 
            @endif
            Company
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">

        @csrf
        <input class="form-control form-control-lg" type="hidden" value="{{ $company['ms_company_id'] ?? '' }}"
            name="id" id="id">
        <div class="form-group">
            <label for="ms_company_name_en" class="col-form-label">Name(En)</label>
            <input class="form-control form-control-lg" type="text"
                value="{{ $company['ms_company_name_en'] ?? '' }}" name="ms_company_name_en" id="ms_company_name_en">
        </div>

        <div class="form-group">
            <label for="ms_company_name_ar" class="col-form-label">Name(AR)</label>
            <input class="form-control form-control-lg" type="text" dir="rtl"
                value="{{ $company['ms_company_name_ar'] ?? '' }}" name="ms_company_name_ar" id="ms_company_name_ar">
        </div>

        <div class="form-group">
            <label for="ms_company_name_cn" class="col-form-label">Name(CN)</label>
            <input class="form-control form-control-lg" type="text"
                value="{{ $company['ms_company_name_cn'] ?? '' }}" name="ms_company_name_cn" id="ms_company_name_cn">

        </div>

    </div>

    <div class="modal-footer justify-content-center p-2 m-2">
        @if ($action == 'add')
            <button class="btn btn-lg btn-success px-5">
                Add
            </button>
        @else
            <button class="btn btn-lg btn-primary px-5">
                Update
            </button>
        @endif

    </div>

</form>

<script>
    $(document).ready(function() {

        $("#addUpdateForm").submit(function(e) {
            e.preventDefault();
            var action = $(this).attr("action");
            var formData = $(this).serialize();
            $.ajax({
                method: "post",
                url: action,
                headers: csrfHeader(),
                data: formData,
                success: function(result) {
                    alert(result.message)
                    $table.DataTable().ajax.reload();
                    $('#addUpdateModal').modal('hide');
                }

            });

        });



    })
</script>
