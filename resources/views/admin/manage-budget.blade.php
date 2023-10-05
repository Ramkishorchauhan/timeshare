@extends('admin/layout')
@section('container')
    <div class="body-main-content">
        <div class="timeshare-section">
            <div class="timeshare-header">
                <div class="mr-auto">
                    <h4 class="heading-title">Manage Budget</h4>
                </div>
                <div class="ts-filter wd30">                    
                </div>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-7">
                    <div class="timeshare-card">
                        <div class="timeshare-card-header">
                            <div class="timeshare-card-heading">
                                <h2>Budget</h2>
                            </div>
                        </div>
                        <div class="timeshare-card-body">
                            <div class="manage-budget-form">
                                <form action="{{route('admin.add-budget')}}" method="post">
                                @csrf
                                <input type="hidden" class="form-control" name="developer_id" value="{{ request()->session()->get('USER_ID') }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Developer Name </label>
                                            <select class="form-control" name="developer_id" required>
                                                <option value="" selected="">Select Developer</option>
                                                @foreach($developers as $devloper) 
                                               <!-- @php echo ($devloper->id); @endphp -->
                                                    <option value="{{$devloper->id}}">{{$devloper->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Amount</label>
                                            <input type="text" name="budget" class="form-control" name="" placeholder="Enter amount" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" aria-label="Default select example" id="status" name="status" required>
                                                <option value="1" selected>Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <input type="date" class="form-control" name="from_date" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <input type="date" class="form-control" name="to_date" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button class="save-btn">Save</button>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="timeshare-card">
                        <div class="timeshare-card-header">
                            <div class="timeshare-card-heading">
                                <h2>Result</h2>
                            </div>
                        </div>
                        <div class="timeshare-card-body">
                            <div class="timeshare-card-media">
                                <div id="manage-budget"></div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="timeshare-card-body">
        <div class="orders-table ts-table">
            <table class="table rejected-stimates-item">
                <thead>
                    <tr>
                        <th>Developer Name</th>                        
                        <th>Total Budget</th>
                        <th>Budget Used</th>
                        <th>Budget Remain</th>                        
                        <th>Budget Last Date</th>
                        <th>Status</th>                       
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id = "row">                   
                    @foreach($budgetList as $list)
                    <tr>

                        <td><div class="ts-table-text">{{$list->name}}</div></td>
                        <td><div class="ts-table-text">{{$list->budget}}</div></td>
                        <td><div class="ts-table-text">{{$list->used_amount}}</div></td>
                        <td><div class="ts-table-text">{{$list->budget-$list->used_amount}}</div></td>
                        <!--td><div class="ts-table-text">{{$list->from_date}}</div></td-->
                        <td><div class="ts-table-text">{{$list->to_date}}</div></td>
                        <td>
                            @if($list->status == 1)
                                <div class="orders-price-text accepted-offer">Active</div>
                            @else
                                <div class="result-value-text" style="text-align:center; border-radius: 50px; font-weight: 500;">Deactivate</div>
                            @endif
                        </td>
                        <td>
                            <div class="ts-table-action">                                
                                <button type="button" class="edit-btn"  value="{{$list->id}}"><img src="{{asset('public/admin_assets/images/edit-2.svg')}}"></button>  
                                <!-- href="{{URL('admin/edit-developer-budget/'.$list->id)}}"-->
                                <a class="delete-btn" href="#"><img src="{{asset('public/admin_assets/images/delete-icon.svg')}}"></a>
                            </div>
                        </td>
                        
                    </tr>
            
                @endforeach
                </tbody>
            </table>
            
        </div>
    </div>




    
 <!-- edit Developers -->
<div class="modal lm-modal fade" id="editDevelopers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="timeshare-modal-form">
            <h2>Edit Budget</h2>
            
            <form action="{{route('admin.update-budget')}}" method="post">
                @csrf
                <input type="hidden" class="form-control" name="developer_id" value="{{ request()->session()->get('USER_ID') }}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Developer Name </label>
                            <select class="form-control" name="developer_id" required>
                                <option value="" selected="">Select Developer</option>
                                @foreach($developers as $devloper) 
                                <!-- @php echo ($devloper->id); @endphp -->
                                    <option value="{{$devloper->id}}">{{$devloper->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="text" name="budget" class="form-control" name="" placeholder="Enter amount" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" aria-label="Default select example" id="status" name="status" required>
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="date" class="form-control" name="from_date" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>End Date</label>
                            <input type="date" class="form-control" name="to_date" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <button class="save-btn">Save</button>
                        </div>
                    </div>
                </div>
                </form>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function(){

var options = {
      series: [{{$totalbudget}},{{$totalbudget-$used_budget}},{{$used_budget}}],
      labels: ['Total amount', 'Remaining amount', 'Used amount'],
      chart: {
      type: 'donut',
      height: 260,
    },
    colors: ['#353334','#0C8AFF', '#C0C0C0'],
    
    legend: {
      show: true,
      position: 'bottom',
      markers: {
        width: 7,
        height: 7,
        shape: 'square',
        radius: 0,
      }
    },
   
    };

    var chart = new ApexCharts(document.querySelector("#manage-budget"), options);
    chart.render();

});


$(document).ready(function(){
    $(document).on('click','.edit-btn',function() {
	    var budget_id=$(this).val();
        //alert(budget_id);
       
        $("#editDevelopers").modal('show');
        $.ajax({
			url : "edit-developer-budget/"+budget_id,
			type : 'GET',
			
			success : function(res){
				//alert('<img src="'+path + res.developers.logo + '" />');
                $('#developer_id').val(res.budget.developer_id);
                $('#name').val(res.budget.name);
                $('#location').val(res.budget.location);
                $('#valid_days').val(res.budget.valid_days);
                $('#status').val(res.budget.status);
                $('#created_by').val(res.budget.created_by);               

        	}
		});
        
	});

    
});


</script>
@endsection