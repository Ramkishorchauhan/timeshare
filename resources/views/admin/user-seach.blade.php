
<table class="table rejected-stimates-item">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email ID</th>
            <th>Phone Number</th>
            <th>Status</th>
            <th>offer</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id = "row">
        @foreach($users as $user)
        <tr>
            <td><div class="ts-table-text">{{ $user->name }}</div></td>
            <td>
                <div class="ts-table-text">{{ $user->email }}</div>    
            </td>
            <td>
                <div class="ts-table-text">{{$user->contact}}</div>
            </td>
            <td>
                @if($user->status == 1)
                    <div class="orders-price-text accepted-offer">Active</div>
                @else
                    <div class="result-value-text" style="text-align:center; border-radius: 50px; font-weight: 500;">Deactivate</div>
                @endif
            </td>
            <td>
                <div class="orders-price-text accepted-offer">09</div>
            </td>
            <td>
                <div class="ts-table-action"><a class="view-btn" href="{{ url('admin/users-details') }}/{{ $user->id }}">View</a></div>
            </td>
        </tr>

    @endforeach
    </tbody>
</table>
<div class="ts-table-pagination">
{{ $users->appends(Request::except('page'))->links('vendor.pagination.custom') }}
</div>