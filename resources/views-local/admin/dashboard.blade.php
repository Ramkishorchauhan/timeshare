@extends('admin/layout')
@section('container')
	<div class="body-main-content">
		<div class="overview-section">
			<div class="row g-2">
				<div class="col-md-3">
					<div class="overview-item ye-overview">
						<div class="overview-item-content">
							<p>Total registered users</p>
							<h2>{{$users}}</h2>
						</div>    
						<div class="overview-item-icon">
							<i class="iconsax" icon-name="users"></i>
						</div>    
					</div>
				</div>

				<div class="col-md-3">
					<div class="overview-item re-overview">
						<div class="overview-item-content">
							<p>Total estimate accepted</p>
							<h2>$ 2.5K</h2>
						</div>    
						<div class="overview-item-icon">
							<i class="iconsax" icon-name="tick-circle"></i>
						</div>    
					</div>
				</div>

				<div class="col-md-3">
					<div class="overview-item re-overview">
						<div class="overview-item-content">
							<p>Total estimate Rejected</p>
							<h2>$ 1.2K</h2>
						</div>    
						<div class="overview-item-icon">
							<i class="iconsax" icon-name="close-circle"></i>
						</div>    
					</div>
				</div>

				<div class="col-md-3">
					<div class="overview-item re-overview">
						<div class="overview-item-content">
							<p>Total Contract Signed</p>
							<h2>2.5K</h2>
						</div>    
						<div class="overview-item-icon">
							<i class="iconsax" icon-name="document-text-1"></i>
						</div>    
					</div>
				</div>
			</div>
		</div>


		<div class="overview-points-section">
			<h2>Total Timeshare Points Rented Across All Users</h2>
			<div class="overview-points-slider">
				<div id="TimesharePoints" class="owl-carousel owl-theme">
					<div class="item">
						<div class="overview-item ye-overview">
							<div class="overview-item-content">
								<p>Marriott</p>
								<h2>3.7M</h2>
							</div>    
							<div class="overview-item-icon">
								<img src="{{asset('public/admin_assets/images/coins.svg')}}">
							</div>    
						</div>
					</div>

					<div class="item">
						<div class="overview-item ye-overview">
							<div class="overview-item-content">
								<p>Westin</p>
								<h2>3.7M</h2>
							</div>    
							<div class="overview-item-icon">
								<img src="{{asset('public/admin_assets/images/coins.svg')}}">
							</div>    
						</div>
					</div>

					<div class="item">
						<div class="overview-item ye-overview">
							<div class="overview-item-content">
								<p>Worldmark By Wyndham</p>
								<h2>3.7M</h2>
							</div>    
							<div class="overview-item-icon">
								<img src="{{asset('public/admin_assets/images/coins.svg')}}">
							</div>    
						</div>
					</div>

					<div class="item">
						<div class="overview-item ye-overview">
							<div class="overview-item-content">
								<p>Bluegreen</p>
								<h2>3.7M</h2>
							</div>    
							<div class="overview-item-icon">
								<img src="{{asset('public/admin_assets/images/coins.svg')}}">
							</div>    
						</div>
					</div>

						<div class="item">
						<div class="overview-item ye-overview">
							<div class="overview-item-content">
								<p>Holiday Inn</p>
								<h2>3.7M</h2>
							</div>    
							<div class="overview-item-icon">
								<img src="{{asset('public/admin_assets/images/coins.svg')}}">
							</div>    
						</div>
					</div>


						<div class="item">
						<div class="overview-item ye-overview">
							<div class="overview-item-content">
								<p>Wyndham</p>
								<h2>3.7M</h2>
							</div>    
							<div class="overview-item-icon">
								<img src="{{asset('public/admin_assets/images/coins.svg')}}">
							</div>    
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="timeshare-section">
			<div class="row">
				<div class="col-md-6">
					<div class="timeshare-card">
						<div class="timeshare-card-header">
							<div class="timeshare-card-heading">
								<h2>Timeshare Budget</h2>
							</div>
						</div>
						<div class="timeshare-card-body">
							<div class="timeshare-card-media">
								<div id="manage-budget"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="timeshare-card">
						<div class="timeshare-card-header">
							<div class="timeshare-card-heading">
								<h2> Help & Support query</h2>
							</div>
							<div class="timeshare-card-action">
								<a href=""> Recent 10 query</a>
							</div>
						</div>

						<div class="timeshare-card-body">
							<div class="timeshare-card-list">
								@foreach($helpsupports as $helpsupport)
								<div class="query-item">
									<div class="query-item-icon" >
										@if(!empty($helpsupport->profile_img))
											<img src="{{asset('storage/app/public/profile_pics/'.$helpsupport->profile_img)}}" style="width: 62px;height: 65px;border-radius: 50%;">
										@else
											<img src="{{asset('public/admin_assets/images/user.jpg')}}" style="width: 62px;height: 65px;border-radius: 50%;">
										@endif
									</div>
									<div class="query-item-content">
										<h2>{{ $helpsupport->name }}</h2>
										<p>{{ $helpsupport->message }}</p>
									</div>
								</div>
								@endforeach
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
      height: 400,
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