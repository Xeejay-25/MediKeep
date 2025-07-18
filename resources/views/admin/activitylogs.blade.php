@extends('admin.Backend.Layout.app')

@section('breadcrumb', 'Activity Logs')
@section('title', 'Activity Logs')

@section('main-content')
    <div class="container-fluid py-4">
        <hr/>

        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="tab-contents active-tab" id="list">
            <div class="card-body">
                <div class="row mt-3">
                    <div class="col-lg-12 mb-lg-0 mb-4">
                        <div class="card z-index-2">
                            <div class="card-body p-4">
                                <div class="card-header mb-2 p-2">
                                    <h3 class="card-title">Activity Logs</h3>
                                </div>
                                <div class="table-responsive">
                                    <table id="activityLogsDataTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>User</th>
                                                <th>Role</th>
                                                <th>Action</th>
                                                <th>URL</th>
                                                <th>Method</th>
                                                <th>IP Address</th>
                                                <th>User Agent</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($logs->count() > 0)
                                                @foreach($logs as $log)
                                                    <tr>
                                                        <td class="align-middle">{{ $loop->iteration }}</td>
                                                        <td class="align-middle">{{ $log->user->name }}</td>
                                                        <td class="align-middle">{{ $log->user_role }}</td>
                                                        <td class="align-middle">{{ $log->action }}</td>
                                                        <td class="align-middle">{{ $log->url }}</td>
                                                        <td class="align-middle">{{ $log->method }}</td>
                                                        <td class="align-middle">{{ $log->ip_address }}</td>
                                                        <td class="align-middle">{{ $log->user_agent }}</td>
                                                        <td class="align-middle">{{ \Carbon\Carbon::parse($log->created_at)->diffForHumans() }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td class="text-center" colspan="9">No activity logs found</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
<script>
    $(document).ready(function() {
        $('#activityLogsDataTable').DataTable({
            "order": [[8, "desc"]], // Order by the Date column (index 8)
            "pageLength": 10, // Set default page length
            "responsive": true, // Enable responsive behavior
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]] // Page length options
        });
    });
</script>
@endpush
