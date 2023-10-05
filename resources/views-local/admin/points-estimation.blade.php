@extends('admin/layout')
@section('container')




    <div class="body-main-content">
        <div class="timeshare-section">
            <div class="timeshare-header">
                <div class="mr-auto">
                    <h4 class="heading-title">Points Estimation</h4>
                </div>
                <div class="ts-filter wd80">
                    <div class="row g-2">
                        <div class="col-md-3">
                            <div class="form-group search-form-group">
                                <input type="text" class="form-control" name="Start Date" placeholder="Search by name, email or phone number">
                                <span class="search-icon"><img src="{{asset('public/admin_assets/images/search-normal.svg')}}"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="form-control">
                                    <option>Select hotel</option>
                                    <option selected="">Show all</option>
                                    <option>Marriott Vacation club</option>
                                    <option>Westin</option>
                                    <option>Worldmark By Wyndham</option>
                                    <option>Holiday Inn</option>
                                    <option>Wyndham</option>
                                    <option>Lawrence Welk</option>
                                    <option>Diamond Resorts</option>
                                    <option>Disney</option>
                                    <option>Grand Colorado</option>
                                    <option>Ritz Carlton</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <select class="form-control">
                                    <option>Select Estimates</option>
                                    <option>Accepted Estimates</option>
                                    <option>Rejected Estimates</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="date" class="form-control" placeholder="26 March, 2023">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="date" class="form-control" placeholder="26 March, 2023">
                            </div>
                        </div>
                    </div>   
                </div>
            </div>
        </div>


            <div class="overview-points-section">
            <div class="overview-points-slider">
                <div class="row">
                    <div class="col-md-6">
                        <div class="overview-item ye-overview">
                            <div class="overview-item-content">
                                <p>Total estimate accepted</p>
                                <h2>$2.5K</h2>
                            </div>    
                            <div class="overview-item-icon">
                                <img src="{{asset('public/admin_assets/images/coins.svg')}}">
                            </div>    
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="overview-item ye-overview">
                            <div class="overview-item-content">
                                <p>Total estimate Rejected</p>
                                <h2>$1.2K</h2>
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
                    <div class="estimates-item rejected-stimates-item">
                        <div class="estimates-head">
                            <div class="accepted-estimates-text">Rejected Estimates</div>
                            <div class="estimates-date">30 Dec, 2022, 00:07:52 AM</div>
                        </div>
                        <div class="estimates-body">
                            <p>Offer Receive Of $6,600 By Renting Out  <span>10,000 Pts</span></p>
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
                                    <a href="#" class="PayNow-btn">View user profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="estimates-item rejected-stimates-item">
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
                    <div class="estimates-item rejected-stimates-item">
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
                    <div class="estimates-item rejected-stimates-item">
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