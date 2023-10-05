@extends('admin/layout')
@section('container')
<div class="body-main-content">
                <div class="orders-table-section">
                    <div class="timeshare-card">
                        <div class="timeshare-card-header">
                            <div class="timeshare-card-heading">
                                <h2>Contracts</h2>
                            </div>
                            <div class="search-filter">
                                <div class="row g-2">
                                    <div class="col-md-3">
                                        <div class="form-group search-form-group">
                                            <input type="text" class="form-control" name="Start Date" placeholder="Search by name, email or phone number">
                                            <span class="search-icon"><i class="iconsax" icon-name="search-normal-2"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select class="form-control">
                                                <option>Select hotel</option>
                                                <option selected>Show all</option>
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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="date" class="form-control" placeholder="26 March, 2023">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <a class="send-notification-btn" data-bs-toggle="modal" data-bs-target="#sendnotification">Sent Notification</a> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="timeshare-card-body">

                            <div class="timeradio">
                                <input type="radio" name="contractstype" id="Marriott" value="contracts1">
                                <label for="Marriott">
                                    <span class="radio-circle-mark"></span>
                                    <div class="contracts-list-content">
                                        <div class="row align-items-center g-1">
                                            <div class="col-md-5">
                                                <div class="estimates-comp-info">
                                                    <div class="estimates-comp-image">
                                                        <img src="{{asset('public/admin_assets/images/Marriott Logo 1.png')}}">
                                                    </div>
                                                    <div class="estimates-comp-content">
                                                        <div class="estimates-comp-name">Marriott</div>
                                                        <div class="manage-developers-PDF"><a href="#"><img src="{{asset('public/admin_assets/images/PDF_file_icon.svg')}}">View PDF</a></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="contracts-profile-item">
                                                    <div class="contracts-profile-media"><img src="{{asset('public/admin_assets/images/user.jpg')}}"></div>
                                                    <div class="contracts-profile-text">
                                                        <h2>Ellie Blish</h2>
                                                        <div class="contracts-cont-info-list">
                                                            <div class="contracts-cont-info-item"><img src="{{asset('public/admin_assets/images/email-icon.svg')}}"> elirzahir@gmail.com</div>
                                                            <div class="contracts-cont-info-item"><img src="{{asset('public/admin_assets/images/phone-icon.svg')}}"> +9735635465</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="contracts-profile-action">
                                                    <a href="#">View</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                </label>
                            </div>

                            <div class="timeradio">
                                <input type="radio" name="contractstype" id="contracts2" value="contracts1">
                                <label for="contracts2">
                                    <span class="radio-circle-mark"></span>
                                    <div class="contracts-list-content">
                                        <div class="row align-items-center g-1">
                                            <div class="col-md-5">
                                                <div class="estimates-comp-info">
                                                    <div class="estimates-comp-image">
                                                        <img src="{{asset('public/admin_assets/images/Marriott Logo 1.png')}}">
                                                    </div>
                                                    <div class="estimates-comp-content">
                                                        <div class="estimates-comp-name">Marriott</div>
                                                        <div class="manage-developers-PDF"><a href="#"><img src="{{asset('public/admin_assets/images/PDF_file_icon.svg')}}">View PDF</a></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="contracts-profile-item">
                                                    <div class="contracts-profile-media"><img src="{{asset('public/admin_assets/images/user.jpg')}}"></div>
                                                    <div class="contracts-profile-text">
                                                        <h2>Ellie Blish</h2>
                                                        <div class="contracts-cont-info-list">
                                                            <div class="contracts-cont-info-item"><img src="{{asset('public/admin_assets/images/email-icon.svg')}}"> elirzahir@gmail.com</div>
                                                            <div class="contracts-cont-info-item"><img src="{{asset('public/admin_assets/images/phone-icon.svg')}}"> +9735635465</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="contracts-profile-action">
                                                    <a href="#">View</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                </label>
                            </div>


                            <div class="timeradio">
                                <input type="radio" name="contractstype" id="contracts3" value="contracts1">
                                <label for="contracts3">
                                    <span class="radio-circle-mark"></span>
                                    <div class="contracts-list-content">
                                        <div class="row align-items-center g-1">
                                            <div class="col-md-5">
                                                <div class="estimates-comp-info">
                                                    <div class="estimates-comp-image">
                                                        <img src="{{asset('public/admin_assets/images/Marriott Logo 1.png')}}">
                                                    </div>
                                                    <div class="estimates-comp-content">
                                                        <div class="estimates-comp-name">Marriott</div>
                                                        <div class="manage-developers-PDF"><a href="#"><img src="{{asset('public/admin_assets/images/PDF_file_icon.svg')}}">View PDF</a></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="contracts-profile-item">
                                                    <div class="contracts-profile-media"><img src="{{asset('public/admin_assets/images/user.jpg')}}"></div>
                                                    <div class="contracts-profile-text">
                                                        <h2>Ellie Blish</h2>
                                                        <div class="contracts-cont-info-list">
                                                            <div class="contracts-cont-info-item"><img src="{{asset('public/admin_assets/images/email-icon.svg')}}"> elirzahir@gmail.com</div>
                                                            <div class="contracts-cont-info-item"><img src="{{asset('public/admin_assets/images/phone-icon.svg')}}"> +9735635465</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="contracts-profile-action">
                                                    <a href="#">View</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                </label>
                            </div>


                            <div class="timeradio">
                                <input type="radio" name="contractstype" id="contracts4" value="contracts1">
                                <label for="contracts4">
                                    <span class="radio-circle-mark"></span>
                                    <div class="contracts-list-content">
                                        <div class="row align-items-center g-1">
                                            <div class="col-md-5">
                                                <div class="estimates-comp-info">
                                                    <div class="estimates-comp-image">
                                                        <img src="{{asset('public/admin_assets/images/Marriott Logo 1.png')}}">
                                                    </div>
                                                    <div class="estimates-comp-content">
                                                        <div class="estimates-comp-name">Marriott</div>
                                                        <div class="manage-developers-PDF"><a href="#"><img src="{{asset('public/admin_assets/images/PDF_file_icon.svg')}}">View PDF</a></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="contracts-profile-item">
                                                    <div class="contracts-profile-media"><img src="{{asset('public/admin_assets/images/user.jpg')}}"></div>
                                                    <div class="contracts-profile-text">
                                                        <h2>Ellie Blish</h2>
                                                        <div class="contracts-cont-info-list">
                                                            <div class="contracts-cont-info-item"><img src="{{asset('public/admin_assets/images/email-icon.svg')}}"> elirzahir@gmail.com</div>
                                                            <div class="contracts-cont-info-item"><img src="{{asset('public/admin_assets/images/phone-icon.svg')}}"> +9735635465</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="contracts-profile-action">
                                                    <a href="#">View</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                </label>
                            </div>

                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>




 <!-- send notification -->
<div class="modal lm-modal fade" id="sendnotification" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="timeshare-modal-form">
            <h2>Send Notification</h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Title">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <textarea type="text" class="form-control" placeholder="Description"></textarea>
                    </div>
                </div>
                
                <div class="col-md-12">
                    <div class="form-group">
                       <button class="cancel-btn" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                       <button class="save-btn">Send</button>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
