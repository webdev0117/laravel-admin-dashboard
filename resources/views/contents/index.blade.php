@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" href="/js/plugins/datatables/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="/js/plugins/select2/css/select2.min.css">
@endsection

@section('content')

    <!-- head -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Standard Content</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item active" aria-current="page">Standard Content</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- end head -->

    @include('shared.success')
    @include('shared.error')

    <!-- filter -->
    <div class="content">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">Filter</h3>
                <div class="btn-group btn-group-sm pull-right" role="group">
                    <div class="block-options pl-3 pr-2">
                        <button type="button" class="btn-block-option" data-toggle="block-option"
                                data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                    </div>
                </div>
            </div>
            <div class="block-content">
                <form method="POST" enctype="multipart/form-data" id="form_contents_search">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="d-block"><h4 class="font-w400">Category</h4></label>
                                <div class="row">
                                    <div class="col-6">
                                        <div
                                            class="custom-control custom-checkbox custom-control-inline custom-control-primary">
                                            <input type="checkbox" class="custom-control-input contentcategories-all"
                                                   id="contentcategories-all"
                                                   name="category_ids[]" value=0 checked="">
                                            <label class="custom-control-label" for="contentcategories-all">All</label>
                                        </div>
                                    </div>
                                    @foreach($contentcategories as $key => $row)
                                        <div class="col-6">
                                            <div
                                                class="custom-control custom-checkbox custom-control-inline custom-control-primary">
                                                <input type="checkbox" class="custom-control-input contentcategory"
                                                       id="contentcategories-{{ $row->id }}"
                                                       name="category_ids[]"
                                                       value="{{ $row->id }}">
                                                <label class="custom-control-label"
                                                       for="contentcategories-{{ $row->id }}">{{ $row->content }} (
                                                    ID: {{ $row->id }} )</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <label class="d-block" style="margin-top:30px;"><h4 class="font-w400">Languages</h4>
                                </label>
                                <div class="row">
                                    <div class="col-6">
                                        <div
                                            class="custom-control custom-checkbox custom-control-inline custom-control-primary">
                                            <input type="checkbox" class="custom-control-input" id="languages-all"
                                                   name="language_ids[]" value=0 checked="">
                                            <label class="custom-control-label" for="languages-all">All</label>
                                        </div>
                                    </div>
                                    @foreach($languages as $key => $row)
                                        <div class="col-6">
                                            <div
                                                class="custom-control custom-checkbox custom-control-inline custom-control-primary">
                                                <input type="checkbox" class="custom-control-input language_id"
                                                       id="languages-{{ $row->id }}"
                                                       name="language_ids[]"
                                                       value="{{ $row->id }}">
                                                <label class="custom-control-label"
                                                       for="languages-{{ $row->id }}">{{ $row->content }} (
                                                    ID: {{ $row->id }} )</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="d-block"><h4 class="font-w400">Created</h4></label>
                                <div class="row">
                                    <div class="col-6">
                                        <div
                                            class="custom-control custom-radio custom-control-inline custom-control-primary">
                                            <input type="radio" class="custom-control-input" id="time-all"
                                                   name="time_containment" value="all" checked="">
                                            <label class="custom-control-label" for="time-all">all</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div
                                            class="custom-control custom-radio custom-control-inline custom-control-primary">
                                            <input type="radio" class="custom-control-input" id="time-thismonth"
                                                   name="time_containment" value="this_month">
                                            <label class="custom-control-label" for="time-thismonth">this month</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div
                                            class="custom-control custom-radio custom-control-inline custom-control-primary">
                                            <input type="radio" class="custom-control-input" id="time-today"
                                                   name="time_containment" value="today">
                                            <label class="custom-control-label" for="time-today">today</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div
                                            class="custom-control custom-radio custom-control-inline custom-control-primary">
                                            <input type="radio" class="custom-control-input" id="time-lastmonth"
                                                   name="time_containment" value="last_month">
                                            <label class="custom-control-label" for="time-lastmonth">last month</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div
                                            class="custom-control custom-radio custom-control-inline custom-control-primary">
                                            <input type="radio" class="custom-control-input" id="time-thisweek"
                                                   name="time_containment" value="this_week">
                                            <label class="custom-control-label" for="time-thisweek">this week</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div
                                            class="custom-control custom-radio custom-control-inline custom-control-primary">
                                            <input type="radio" class="custom-control-input" id="time-thisyear"
                                                   name="time_containment" value="this_year">
                                            <label class="custom-control-label" for="time-thisyear">this year</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div
                                            class="custom-control custom-radio custom-control-inline custom-control-primary">
                                            <input type="radio" class="custom-control-input" id="time-lastweek"
                                                   name="time_containment" value="last_week">
                                            <label class="custom-control-label" for="time-lastweek">last week</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div
                                            class="custom-control custom-radio custom-control-inline custom-control-primary">
                                            <input type="radio" class="custom-control-input" id="time-lastyear"
                                                   name="time_containment" value="last_year">
                                            <label class="custom-control-label" for="time-lastyear">last year</label>
                                        </div>
                                    </div>
                                </div>

                                <label class="d-block" style="margin-top:30px;"></label>
                                <div class="row">
                                    <div class="col-6">
                                        <h4 class="font-w400">Status</h4>
                                        <div
                                            class="custom-control custom-checkbox custom-control-inline custom-control-primary">
                                            <input type="checkbox" class="custom-control-input" id="status-active"
                                                   name="active" checked="">
                                            <label class="custom-control-label" for="status-active">active</label>
                                        </div>
                                        <div
                                            class="custom-control custom-checkbox custom-control-inline custom-control-primary">
                                            <input type="checkbox" class="custom-control-input" id="status-archive"
                                                   name="archive">
                                            <label class="custom-control-label" for="status-archive">archive</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h4 class="font-w400">Additional</h4>
                                            <label class="col-form-label" for="code1">Code 1</label>
                                            <input type="text" class="form-control form-control-alt" id="code1" name="code1" placeholder="Enter code 1 here...">
                                            <label class="col-form-label" style="margin-top:15px;" for="version">Version</label>
                                            <input type="text" class="form-control form-control-alt" id="version" name="version" placeholder="Enter version number here...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success my-4">use filter</button>
                    <button type="reset" class="btn btn-secondary">reset filter</button>
                </form>
            </div>
        </div>
    </div>
    <!-- end filter -->

    <!-- Start List Pagination -->
    <div class="content content-full">
        <!-- Dynamic Table Full Pagination -->
        <div class="block block-rounded block-bordered dynamic_container">
            <div class="block-header block-header-default">
                <h3 class="block-title">List</h3>
                <div class="btn-group btn-group-sm pull-right" role="group">
                    <div class="block-options pl-3 pr-2">
                        <a href="{{ route('contents.create') }}" class="btn-block-option">
                            <span class="si si-plus" aria-hidden="true"></span>
                        </a>
                        <button type="button" class="btn-block-option" data-toggle="block-option"
                                data-action="fullscreen_toggle">
                            <i class="si si-size-fullscreen"></i>
                        </button>
                        <button type="button" class="btn-block-option" data-toggle="block-option"
                                data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table id="contents_datatable" class="table table-bordered table-striped table-vcenter">
                    <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th>Code 1</th>
                        <th>Code 2</th>
                        <th>Category</th>
                        <th>Language</th>
                        <th>Version</th>
                        <th></th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full Pagination -->
    </div>
    <!-- End List Pagination -->

    <!-- tools -->
    <div class="content">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">Tools</h3>
                <div class="btn-group btn-group-sm pull-right" role="group">
                    <div class="block-options pl-3 pr-2">
                        <button type="button" class="btn-block-option" data-toggle="block-option"
                                data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                    </div>
                </div>
            </div>
            <div class="block-content">
                <form method="POST" enctype="multipart/form-data" id="form_content_check">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label class="col-form-label" for="code">Code</label>
                                        <input type="text" class="form-control form-control-alt" id="code" name="code" placeholder="Enter code here...">
                                    </div>
                                    <div class="col-6" style="margin-top: 15px;">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6" style="margin-top: 15px;">
                            <div class="form-group">
                                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                    <input type="radio" class="custom-control-input" id="check_langassign" name="toolaction" checked>
                                    <label class="custom-control-label" for="check_langassign">check</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                    <input type="radio" class="custom-control-input" id="check_assign" name="toolaction" >
                                    <label class="custom-control-label" for="check_assign">check all</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                    <input type="radio" class="custom-control-input" id="export" name="toolaction" >
                                    <label class="custom-control-label" for="export">export</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                    <input type="radio" class="custom-control-input" id="exportall" name="toolaction" >
                                    <label class="custom-control-label" for="exportall">export all</label>
                                </div>
                            </div>
                            <a href="{{ route('contentadditionals.index') }}" class="btn btn-primary">show activity list</a>
                        </div>
                    </div>
                    <button class="btn btn-success my-4" id="start_check">start</button>
                </form>
            </div>
        </div>
    </div>
    <!-- end tools -->

@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="/js/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="/js/plugins/datatables/buttons/dataTables.buttons.min.js"></script>
    <script src="/js/plugins/datatables/buttons/buttons.print.min.js"></script>
    <script src="/js/plugins/datatables/buttons/buttons.html5.min.js"></script>
    <script src="/js/plugins/datatables/buttons/buttons.flash.min.js"></script>
    <script src="/js/plugins/datatables/buttons/buttons.colVis.min.js"></script>
    <script src="/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="/js/plugins/select2/js/select2.full.min.js"></script>

    <!-- Page JS Code -->
    <!-- <script src="/js/pages/be_tables_datatables.min.js"></script> -->

    <!-- Page JS Helpers (BS Datepicker + Select2) -->
    <script>jQuery(function () {
            Dashmix.helpers(['datepicker', 'select2']);
        });</script>

    <script>
        $(document).ready(function () {
            var contents_datatable = $('#contents_datatable').DataTable({
                serverSide: true,
                processing: true,
                searching: false,
                ajax: {
                    url: "{{ route('api.contents.search') }}",
                    type: "POST",
                    headers: {
                        'CSRFToken': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: function ( d ) {
                        $('.dynamic_container').addClass('block-mode-loading');
                        d.filters = {
                            category_ids: [],
                            language_ids: [],
                            time_containment: '',
                            active: 0,
                            archive: 0,
                            code1: '',
                            version: '',
                        };
                        var formData = $('#form_contents_search').serializeArray();
                        formData.forEach(function(element) {
                            if (element.name == 'category_ids[]') {
                                d.filters.category_ids.push(element.value);
                            } else if (element.name == 'language_ids[]') {
                                d.filters.language_ids.push(element.value);
                            } else if (element.name == 'time_containment') {
                                d.filters.time_containment = element.value;
                            } else if (element.name == 'active') {
                                d.filters.active = 1;
                            } else if (element.name == 'archive') {
                                d.filters.archive = 1;
                            } else if (element.name == 'code1') {
                                d.filters.code1 = element.value;
                            } else if (element.name == 'version') {
                                d.filters.version = element.value;
                            }
                        })
                    },
                },
                drawCallback: function( settings ) {
                    $('.dynamic_container').removeClass('block-mode-loading');
                },
                lengthMenu: [
                    [ 20, 50, 100 ],
                    [ '20', '50', '100' ]
                ],
                columns: [
                    { data: 'id', className: "text-center", width: "80px",
                        render: function (data, type, full, meta) {
                            return '<a href="{{ route("contents.index")}}/' + data + '/edit">' + data + '</a>';
                        }
                    },
                    { data: 'code1', className: "d-none d-sm-table-cell" },
                    { data: 'code2', className: "d-none d-sm-table-cell" },
                    { data: 'category_content', className: "d-none d-sm-table-cell", orderable: false },
                    { data: 'language_content', className: "d-none d-sm-table-cell", orderable: false },
                    { data: 'version', className: "font-w600" },
                    { data: 'id', className: "text-right", width: "15%", orderable: false,
                        render: function (data, type, full, meta) {
                            return '<a href="{{ route("contents.index")}}/' + data + '/edit" class="btn btn-sm btn-info" style="margin-right:5px;"><i class="si si-pencil"></i></a>' +
                                '<a href="{{ route("contents.index") }}/' + data + '" class="btn btn-sm btn-primary"><i class="si si-doc"></i></a>';
                        }
                    },
                ],
            });

            $('#contentcategories-all').change(function() {
                if ($(this).prop('checked')) {
                    $('form input.contentcategory:checked').each(function() {
                        $(this).prop('checked', false);
                    });
                }
            });
            $('form input.contentcategory').change(function() {
                if ($(this).prop('checked')) {
                    $('form #contentcategories-all').prop('checked', false);
                }
            });

            $('#languages-all').change(function() {
                if ($(this).prop('checked')) {
                    $('form input.language_id:checked').each(function() {
                        $(this).prop('checked', false);
                    });
                }
            });
            $('form input.language_id').change(function() {
                if ($(this).prop('checked')) {
                    $('form #languages-all').prop('checked', false);
                }
            });

            $('#form_contents_search').submit(function() {
                contents_datatable.ajax.reload();
                return false;
            });

            $('#start_check').click(function(event) {
                event.preventDefault();
                if ($('#check_langassign').prop('checked') == true) {
                    let code = $('#code').val();
                    window.location.href = '/contents/check/langassign/' + code;
                } else if ($('#check_assign').prop('checked') == true) {
                    window.location.href = "{{ route('contents.check.assign') }}";
                }
            });
        })
    </script>
@endsection
