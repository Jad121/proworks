@extends('layouts.dashboard')


@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">

        <!-- END breadcrumb -->
        <!-- BEGIN page-header -->
        <h1 class="page-header">
            Countries
        </h1>
        <!-- END page-header -->
        <!-- BEGIN panel -->
        <div class="panel panel-inverse">
            <!-- BEGIN panel-heading -->
            <div class="panel-heading">

                <div class="panel-heading-btn d-flex justify-content-between w-100">
                    <span>
                        New Record
                    </span>
                    <a href="{{ route('country.list') }}">All Record</a>
                </div>
            </div>
            <!-- END panel-heading -->
            <!-- BEGIN panel-body -->
            <div class="panel-body">

                <form id="addUpdateForm" data-parsley-validate
                    action="{{ $action === 'add' ? route('country.add') : route('country.update', ['recordId' => $country['ws_country_id']]) }}"
                    method="POST">




                    @csrf
                    <input class="form-control form-control-lg" type="hidden" value="{{ $country['ws_country_id'] ?? '' }}"
                        name="id" id="id">
                    <div class="form-group">
                        <label for="ws_country_name_en" class="col-form-label">Name(En)</label>
                        <input class="form-control form-control-lg" type="text"
                            value="{{ $country['ws_country_name_en'] ?? '' }}" name="ws_country_name_en"
                            id="ws_country_name_en" required data-parsley-required-message="Required">
                    </div>

                    <div class="form-group">
                        <label for="ws_country_name_ar" class="col-form-label">Name(AR)</label>
                        <input class="form-control form-control-lg" type="text" dir="rtl"
                            value="{{ $country['ws_country_name_ar'] ?? '' }}" name="ws_country_name_ar"
                            id="ws_country_name_ar" required data-parsley-required-message="Required">
                    </div>

                    <div class="form-group">
                        <label for="ws_country_name_cn" class="col-form-label">Name(CN)</label>
                        <input class="form-control form-control-lg" type="text"
                            value="{{ $country['ws_country_name_cn'] ?? '' }}" name="ws_country_name_cn"
                            id="ws_country_name_cn" required data-parsley-required-message="Required">

                    </div>




                    @if ($action == 'add')
                        <button class="btn btn-lg btn-success px-5">
                            Add
                        </button>
                    @else
                        <button class="btn btn-lg btn-primary px-5">
                            Update
                        </button>
                        <button class="btn btn-lg btn-danger px-5">
                            delete
                        </button>
                    @endif



                </form>






            </div>
            <!-- END panel-body -->

        </div>
        <!-- END panel -->
    </div>
    <!-- END #content -->


    <script>
        $(document).ready(function() {

            $("#addUpdateForm").submit(function(e) {
                e.preventDefault();

                if ($(".parsley-required").length) {
                    return;
                }
                var action = $(this).attr("action");
                var formData = $(this).serialize();
                $.ajax({
                    method: "post",
                    url: action,
                    headers: csrfHeader(),
                    data: formData,
                    success: function(result) {
                        alert(result.message)
                        location.href = "{{ route('country.list') }}";
                        $('#addUpdateModal').modal('hide');
                    }

                });

            });

        })
    </script>
@endsection
