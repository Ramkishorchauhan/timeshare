@extends('admin/layout')
@section('container')

<div class="body-main-content">
    <div class="user-profile-section">
        <div class="row g-1">
            <div class="col-md-3">
                <div class="side-profile-item">
                    <div class="side-profile-media">
                        @if (File::exists($user->image))
                            <img src="{{ asset('uploads/' . $user->image) }}">
                        @else
                            <img src="{{asset('public/admin_assets/images/user.jpg')}}">
                        @endif
                    </div>
                    <div class="side-profile-text">
                        <h2>{{ $user->name }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-3">
                        <div class="user-contact-info">
                            <div class="user-contact-info-icon">
                                <img src="{{asset('public/admin_assets/images/email-icon.svg')}}">
                            </div> 
                            <div class="user-contact-info-content">
                                <h2>Email Address</h2>
                                <p>{{ $user->email }}</p>
                            </div>    
                        </div> 
                    </div>

                    <div class="col-md-3">
                        <div class="user-contact-info">
                            <div class="user-contact-info-icon">
                                <img src="{{asset('public/admin_assets/images/phone-icon.svg')}}">
                            </div> 
                            <div class="user-contact-info-content">
                                <h2>Phone Number</h2>
                                <p>{{ $user->contact }}</p>
                            </div>    
                        </div> 
                    </div>

                    <div class="col-md-3">
                        <div class="user-contact-info">
                            <div class="user-contact-info-icon">
                                <img src="{{asset('public/admin_assets/images/Contract.svg')}}">
                            </div> 
                            <div class="user-contact-info-content">
                                <h2>Total Contract Signed</h2>
                                <p>03</p>
                            </div>    
                        </div> 
                    </div>

                    <div class="col-md-3">
                        <div class="user-contact-info">
                            <div class="user-contact-info-icon">
                                <img src="{{asset('public/admin_assets/images/coins1.svg')}}">
                            </div> 
                            <div class="user-contact-info-content">
                                <h2>Recent Point Estimates</h2>
                                <p>Result $279</p>
                            </div>    
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="overview-points-section">
        <h2>Total Timeshare Points Rented Across All Users</h2>
        <div class="overview-points-slider">
            <div class="row">
                @php
                    print_r($contract_details);
                @endphp
                @foreach ($contract_details as $cd)

                    <div class="col-md-3">
                        <div class="overview-item ye-overview">
                            <div class="overview-item-content">
                            @foreach ($developers as $d)
                               @if($d->name == $cd->developer_name)
                                <p>{{$d->name}}</p>
                                
                               @endif
                            @endforeach
                                <h2>{{$cd->points}}</h2>
                            </div>    
                            <div class="overview-item-icon">
                                <img src="{{asset('public/admin_assets/images/coins.svg')}}">
                            </div>    
                        </div>
                    </div>
                @endforeach

                <!-- <div class="col-md-3">
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

                <div class="col-md-3">
                    <div class="overview-item ye-overview">
                        <div class="overview-item-content">
                            <p>Worldmark By Wyndham</p>
                            <h2>3.7M</h2>
                        </div>    
                        <div class="overview-item-icon">
                            <img src="{{asset('public/admin_assets/images/coins.svg')}}">
                        </div>    
                    </div>
                </div> -->
            </div>
        </div>
    </div>

    <div class="timeshare-section">
        <div class="timeshare-header">
            <div class="mr-auto">
                <h4 class="heading-title">Points Rent Out Estimates</h4>
            </div>
            <div class="ts-filter wd40">
                <div class="row g-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="date" class="form-control" name="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <select class="form-control">
                                <option>Accepted offer</option>
                                <option>Rejected offer</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="estimates-item">
                    <div class="estimates-head">
                        <div class="accepted-estimates-text">Accepted Estimates</div>
                        <div class="estimates-date">30 Dec, 2022, 00:07:52 AM</div>
                    </div>
                    <div class="estimates-body">
                        <p>Offer Receive Of $6,600 By Renting Out <span>10,000 Pts</span></p>
                        <div class="estimates-body-content">
                            <div class="estimates-comp-info">
                                <div class="estimates-comp-image">
                                    <img src="{{asset('public/admin_assets/images/Marriott Logo 1.png')}}">
                                </div>
                                <div class="estimates-comp-content">
                                    <div class="estimates-comp-name">Marriott</div>
                                    <div class="result-value-text">Result $279</div>
                                </div>
                            </div>
                            <div class="estimates-action">
                                <a href="#" class="PayNow-btn">Pay Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="estimates-item">
                    <div class="estimates-head">
                        <div class="accepted-estimates-text">Accepted Estimates</div>
                        <div class="estimates-date">30 Dec, 2022, 00:07:52 AM</div>
                    </div>
                    <div class="estimates-body">
                        <p>Offer Receive Of $6,600 By Renting Out <span>10,000 Pts</span></p>
                        <div class="estimates-body-content">
                            <div class="estimates-comp-info">
                                <div class="estimates-comp-image">
                                    <img src="{{asset('public/admin_assets/images/Marriott Logo 1.png')}}">
                                </div>
                                <div class="estimates-comp-content">
                                    <div class="estimates-comp-name">Marriott</div>
                                    <div class="result-value-text">Result $279</div>
                                </div>
                            </div>
                            <div class="estimates-action">
                                <a href="#" class="PayNow-btn">Pay Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="estimates-item">
                    <div class="estimates-head">
                        <div class="accepted-estimates-text">Accepted Estimates</div>
                        <div class="estimates-date">30 Dec, 2022, 00:07:52 AM</div>
                    </div>
                    <div class="estimates-body">
                        <p>Offer Receive Of $6,600 By Renting Out <span>10,000 Pts</span></p>
                        <div class="estimates-body-content">
                            <div class="estimates-comp-info">
                                <div class="estimates-comp-image">
                                    <img src="{{asset('public/admin_assets/images/Marriott Logo 1.png')}}">
                                </div>
                                <div class="estimates-comp-content">
                                    <div class="estimates-comp-name">Marriott</div>
                                    <div class="result-value-text">Result $279</div>
                                </div>
                            </div>
                            <div class="estimates-action">
                                <a href="#" class="PayNow-btn">Pay Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="estimates-item">
                    <div class="estimates-head">
                        <div class="accepted-estimates-text">Accepted Estimates</div>
                        <div class="estimates-date">30 Dec, 2022, 00:07:52 AM</div>
                    </div>
                    <div class="estimates-body">
                        <p>Offer Receive Of $6,600 By Renting Out <span>10,000 Pts</span></p>
                        <div class="estimates-body-content">
                            <div class="estimates-comp-info">
                                <div class="estimates-comp-image">
                                    <img src="{{asset('public/admin_assets/images/Marriott Logo 1.png')}}">
                                </div>
                                <div class="estimates-comp-content">
                                    <div class="estimates-comp-name">Marriott</div>
                                    <div class="result-value-text">Result $279</div>
                                </div>
                            </div>
                            <div class="estimates-action">
                                <a href="#" class="PayNow-btn">Pay Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection