@extends('admin/layout')
@section('container')

<div class="body-main-content">
    <div class="orders-table-section">
        <div class="timeshare-card">
            <div class="timeshare-card-header">
                <div class="timeshare-card-heading">
                    <h2>All Queries</h2>
                </div>
                <div class="search-filter">
                <form>
                    <div class="row g-2">
                        <div class="col-md-4">
                            <div class="form-group search-form-group">
                                <input type="text" class="form-control" id="search" name="search" placeholder="Search by name, email or phone number" onkeyup ="showValue()">
                                <span class="search-icon"><i class="iconsax" icon-name="search-normal-2"></i></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control" id="select_id" name="select_id" onchange="showValue()">
                                    <option value="">Select status</option>
                                    <option value="1">Mark as resolved</option>
                                    <option value="2">Waiting For User Response</option>
                                    <option value="3">Response sent</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="date" class="form-control" >
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
            <div class="timeshare-card-body">
                <div class="orders-table ts-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email ID</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allqueries as $queries)
                            <tr>
                                <td><div class="ts-table-text">{{$queries->name}}</div></td>
                                <td>
                                    <div class="ts-table-text">{{$queries->email}}</div>    
                                </td>
                                <td>
                                    <div class="orders-status-text Resolved-status">
                                        @if($queries->admin_status == '1')
                                        Mark as resolved
                                        @elseif($queries->admin_status == '2')
                                        Waiting For User Response
                                        @elseif($queries->admin_status == '3')
                                        Response sent
                                        @else
                                        N/A
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="ts-table-action"><a class="view-btn" href="users-details.html">View Conversation</a></div>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="ts-table-pagination">
                        {{ $allqueries->appends(Request::except('page'))->links('vendor.pagination.custom') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')
<script type="text/javascript">
function showValue(){
    var search = $("#search").val();
    var select_id = $("#select_id").val();
    // var choosedate = $("#choosedate").val();

    $.ajax({
        url:"/timesharesimplified/admin/all-queries-search",
        type:"GET",
        cache:false,
        data:{
            search:search,
            status:select_id,
            // choosedate:choosedate,
            
        },
        success:function(res){
            $('.ts-table').html('');
            $('.ts-table').html(res);
        }
    })
}
        

</script>
@endsection