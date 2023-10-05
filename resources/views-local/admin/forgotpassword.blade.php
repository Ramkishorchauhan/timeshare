<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Timesharesimplyfied</title>    
    <link rel="stylesheet" type="text/css" href="{{asset('public/admin_assets/css/auth.css')}}">
    <script src="{{asset('public/admin_assets/js/jquery-3.7.0.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/admin_assets/plugins/Iconsax/geticons.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/admin_assets/js/function.js')}}" type="text/javascript"></script>

</head>
    <body>
        <div class="auth-section">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form">
                        <div class="brand-logo">
                            <img src="{{asset('public/admin_assets/images/logo.png')}}" alt="logo">
                        </div>
                        @if(session('error'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Warning!</strong>{{session('error')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        @endif
                        
                        <form class="pt-4" action="{{route('login.forgotpassword')}}" method="post">
                            @csrf
                            <div class="form-group">
                            <input name="password" type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="New Password" required>
                            <input name="email" type="hidden" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="New Password" value="{{$email}}">
                            <input type="hidden" value="{{$id}}" name="id">
                            </div>
                            <div class="form-group">
                                <input name="confirmpassword" type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Confirm Password" required>
                            </div>
                            <div class="form-group">
                                <button class="auth-form-btn">Update</button>
                            </div>
                    
                            <div class="mt-1 text-center">
                                <a class="auth-link text-black" href="{{ url('login') }}">Back To Login?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>



<!-- end document-->
<script>
    $(".alert").alert('close');
</script>