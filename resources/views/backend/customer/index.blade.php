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
                <h1>Customers</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Customers</div>
                </div>
            </div>

            <div class="section-body">
                <div class="viewmodal"></div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Customer List</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="customerlist">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Join at</th>
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
    <script>
        $(function() {
            $('#customerlist').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.customer') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'email_verified_at',
                        name: 'email_verified_at'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                ]
            });
        });
    </script>
@endsection
