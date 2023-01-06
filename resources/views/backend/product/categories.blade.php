@extends('layouts.backend.app')
@push('head')
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/modules/datatables/datatables.min.css">
    <link rel="stylesheet"
        href="{{ asset('backend') }}/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <script src="{{ asset('backend') }}/assets/modules/jquery.min.js"></script>
@endpush
@section('content')
    <div class="main-content" style="min-height: 834px;">
        <section class="section">
            <div class="section-header">
                <h1>Categories</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Categories</div>
                </div>
            </div>

            <div class="section-body">
                <div class="viewmodal"></div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="javascript:void(0)" id="addCategories" class="btn btn-primary"> Add Categories</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="categoriesList">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Name</th>
                                                <th>Slug</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @push('js')
        <script src="{{ asset('backend') }}/assets/modules/datatables/datatables.min.js"></script>
        <script src="{{ asset('backend') }}/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js">
        </script>
        <script src="{{ asset('backend') }}/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
    @endpush
    <script src="{{ asset('backend/script/categories.js') }}"></script>
@endsection
