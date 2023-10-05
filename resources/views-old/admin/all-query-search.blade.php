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