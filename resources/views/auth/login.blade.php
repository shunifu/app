<!doctype html>
<html lang="en">
  @foreach (\App\Models\School::all() as $item)
  <head>
  	<title>{{$item->school_name}}-Shunifu</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Web Application Manifest -->
{{-- <link rel="manifest" href="/manifest.json"> --}}
<!-- Chrome for Android theme color -->
{{-- <meta name="theme-color" content="#000000"> --}}

<!-- Add to homescreen for Chrome on Android -->
 <meta name="mobile-web-app-capable" content="yes">
<meta name="application-name" content="PWA">
<link rel="icon" sizes="512x512" href="{{config('app.school_logo')}}"> 

<!-- Add to homescreen for Safari on iOS -->
 <meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-title" content="PWA">
<link rel="apple-touch-icon" href="{{config('app.school_logo')}}">



<script>
    window.addEventListener('installready', function(e){
				
				  //Show your own installation UI
				  //Include our Install Button code for best results
				  //e.detail.ios is true if the user is on Safari/iOS. 
				  //Or false if it's a native prompt (all other platforms)
				  console.log(e.detail.ios); 
				
			});
</script>
<link rel="manifest" href="https://progressier.com/client/progressier.json?id=mRuQhHD6PyzeinPjlO9K"><script defer src="https://progressier.com/client/script.js?id=mRuQhHD6PyzeinPjlO9K"></script> 



<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
*{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
 font-family: "Lato", Arial, sans-serif;
font-size: 16px;
line-height: 1.8;
font-weight: normal;
color: gray;
/* position: relative;
z-index: 0; */
padding: 0; 
}
/* body{
  font-family: "Lato", Arial, sans-serif;
font-size: 16px;
line-height: 1.8;
font-weight: normal;
color: gray;
/* position: relative;
z-index: 0; */
/* padding: 0; 
} */ 
/* body:after {
position: absolute;
top: 0;
left: 0;
right: 0;
bottom: 0;
content: '';
background: #000;
opacity: .3;
z-index: -1;
} */

.background{
  background: url({{$item->school_background_image}});
  background-size:cover;
  background-repeat:repeat;
  content: '';
    position: absolute;
    left: 0;
    width: 100%;
    top: 0;
    height: 100%;
    
 
}
.background img{

}

.overlay{
 
  background-color: rgba(0, 0, 0, 0.623);
  content: '';
    position: absolute;
    left: 0;
    width: 100%;
    top: 0;
    height: 100%;
}

::placeholder {
  background-color: rgba(0, 0, 0, 0);
}

.form-control {
background: transparent;
border: none;
height: 50px;
color: rgb(46, 46, 46) !important;
border: 1px solid grey;
background: rgba(255, 255, 255, 0.08);
border-radius: 10px;
padding-left: 20px;
padding-right: 20px;
-webkit-transition: 0.3s;
-o-transition: 0.3s;
transition: 0.3s; }
@media (prefers-reduced-motion: reduce) {
.form-control {
  -webkit-transition: none;
  -o-transition: none;
  transition: none; } }
.form-control::-webkit-input-placeholder {
/* Chrome/Opera/Safari */
color: rgba(173, 173, 173, 0.8) !important; }
.form-control::-moz-placeholder {
/* Firefox 19+ */
color: rgba(255, 255, 255, 0.8) !important; }
.form-control:-ms-input-placeholder {
/* IE 10+ */
color: rgba(255, 255, 255, 0.8) !important; }
.form-control:-moz-placeholder {
/* Firefox 18- */
color: rgba(255, 255, 255, 0.8) !important; }
.form-control:hover, .form-control:focus {
background: rgb(207, 207, 207);
outline: none;
-webkit-box-shadow: none;
box-shadow: none;
border-color: rgba(255, 255, 255, 0.4); }
.form-control:focus {
border-color: rgba(255, 255, 255, 0.4); }

/* 
input[type="text"]::placeholder { */
                 
                 /* Firefox, Chrome, Opera */
                 /* text-align: center; */
               
                 /* background-color: transparent; */
             /* } */
             /* input[type="password"]::placeholder { */
                 
                 /* Firefox, Chrome, Opera */
                 /* text-align: center; */
             /* } */

/* .bg-image:after {
    content: '';
    position: absolute;
    left: 0;
    width: 100%;
    top: 0;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.699);
  } */

.container{
    margin: 50px auto;
}
.panel-heading{
    text-align: center;
    margin-bottom: 10px;
}
#forgot{
    min-width: 100px;
    margin-left: auto;
    text-decoration: none;
}
a:hover{
    text-decoration: none;
}
.form-inline label{
    padding-left: 10px;
    margin: 0;
    cursor: pointer;
}
.btn.btn-primary{
    margin-top: 20px;
    border-radius: 15px;
}
.panel{
    min-height: 380px;
    /* box-shadow: 20px 20px 80px rgb(218, 218, 218); */
    border-radius: 12px; 
    background-color: rgb(255, 255, 255);
}

.panel-heading h3{
  /* color: rgb(141, 141, 141); */
}

.slogan{
  /* color: white; */
}
.panel-body{
 /* background-color: aqua; */

}
.input-field{
    /* border-radius: 5px;
    padding: 5px;
    display: flex;
    align-items: center;
    cursor: pointer;
    border: 1px solid #ddd; 
    color: #4343ff00; */
}
input[type='text'],
input[type='password']{
    /* border: none;
    outline: none;
    box-shadow: none;
    width: 100%; 
    background-color: none; */
}
.fa-eye-slash.btn{
    border: none;
    outline: none;
    box-shadow: none;
}
img{
    width: 40px;
    height: 40px;
    object-fit: cover;
    border-radius: 50%;
    position: relative;
}
a[target='_blank']{
    position: relative;
    transition: all 0.1s ease-in-out;
}

.bordert{
    border-top: 1px solid #aaa;
    position: relative;
}
.bordert:after{
    content: "or login with";
    position: absolute;
    top: -13px;
    left: 37%;
    background-color: #fff;
    padding: 0px 8px;
}
@media(max-width: 360px){
    #forgot{
        margin-left: 0;
        padding-top: 10px;
    }
    body{
        height: 100%;
    }
    .container{
        margin: 30px 0;
    }
    .bordert:after{
        left: 25%;
    }
}

  </style>
	 {{-- @laravelPWA --}}

	</head>
 
<body>

	<div class="background">
	<div class="overlay">
    <div class="container">
    

 
    <div class="row">
        <div class="offset-md-2 col-lg-5 col-md-7 offset-lg-4 offset-md-3">
            <div class="panel border">
                <div class="panel-heading">
                    <h3 class="text-muted pt-3 font-weight-bold">{{$item->school_name}}</h3>
          <?php
// echo url()->current();


?>
                 <div class="text-muted">{{$item->school_slogan}}</div>
                </div>
                @endforeach
                <hr>
                @if (session('status'))
                <div class="alert alert-success mb-3 rounded-0" role="alert">
                    {{ session('status') }}
                </div>
            @endif
    
            @if (session('error'))
                <div class="alert alert-danger mb-3 rounded-0" role="alert">
                    {{ session('error') }}
                </div>
            @endif
                <div class="panel-body p-3">
                  <form method="POST"  action="{{ route('login') }}">
                    @csrf
                        <div class="form-group ">
                            <div class="input-field">
                              <label  for="">Enter cellnumber or email</label>
                                <span class="far fa-user p-2"></span>
                                <input type="text" required class="form-control{{ $errors->has('auth') ? ' is-invalid' : '' }}" name="auth" value="{{ old('auth') }}" placeholder="Enter Email or Cell Number ">
                                <x-jet-input-error for="auth"></x-jet-input-error>
                            </div>
                        </div>
                        <div class="form-group ">
                        
                            <div class="input-field">
                              <label  for="">Enter Password</label>
                                <span class="fas fa-lock px-2"></span>
                              
                                <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                name="password" required autocomplete="current-password" placeholder="Enter Password">
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                              <x-jet-input-error for="password"></x-jet-input-error>
                                <button class="btn  text-muted">
                                    <span class="far fa-eye-slash"></span>
                                </button>
                            </div>
                        </div>
                    
                        <button class="btn btn-primary btn-block mt-3 px-3 submit">Login to Shunifu</button>
                     
                        <div class="text-center pt-4 text-muted"> <a href="/reset">Forgot Password?</a>
                        </div>
                    </form>
                </div>
                <div class="mx-3 my-2 py-2 bordert">
                    <div class="text-center py-3">
                      <a href="{{ url('/auth/google') }}" class="px-2">
                        <img src="https://www.freepnglogos.com/uploads/google-logo-png/google-logo-png-suite-everything-you-need-know-about-google-newest-0.png"
                            alt="">
                    </a>
                        {{-- <a href="{{ url('/auth/facebook') }}"  class="px-2">
                            <img src="https://www.dpreview.com/files/p/articles/4698742202/facebook.jpeg" alt="">
                        </a> --}}
                      

                      
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
  </div>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>



</html>

