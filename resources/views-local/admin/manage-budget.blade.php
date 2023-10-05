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
                                            <label>Amount</label>
                                            <input type="text" name="budget" class="form-control" name="" placeholder="Enter amount" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" aria-label="Default select example" id="status" name="status" required>
                                                <option value="1" selected>Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <input type="date" class="form-control" name="from_date" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
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
@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function(){

var options = {
      series: [@foreach($totalbudget as $totalbudgets) {{$totalbudgets->budget}}, 4000, 6000 @endforeach],
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
</script>
@endsection