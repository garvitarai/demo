<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>compr - Merchandise Comparison Software</title>
        

        <!-- CSS Dependencies -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://s3.ca-central-1.amazonaws.com/tjxcanada/public/shards.min.css">
        <link rel="stylesheet" href="https://s3.ca-central-1.amazonaws.com/tjxcanada/public/shards-extras.min.css">
        <link rel="stylesheet" href="https://s3.ca-central-1.amazonaws.com/tjxcanada/public/shards.css">
        <!-- Styles -->
        <style>
            html, body {
                font-weight: 100;
                height: 100vh;
                background: linear-gradient(#fa8a3f,#ff7300);
            }
            .row{
                background-color: #ffffff;
                
            }

            .section-title{
                color: #ffffff;
            }
        </style>
    </head>
<body>
<a href="http://www.compr.ca" style="text-decoration:none" ><h3 class="section-title text-center m-5"><img src="https://s3.ca-central-1.amazonaws.com/tjxcanada/public/tag+copy.svg" class="mr-2" >compr</h3></a>
<div class="container">

    <div class="row">
        <div class="col-md-8 col-md-offset-5">
            <div class="panel panel-default">
                <div class="panel-body">
                                            <br></br>
                    <form action="{{ route('login') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}




                        @if ($message = Session::get('success'))
                            <div class = "alert alert-success" role = "alert">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        @if ($message = Session::get('warning'))
                            <div class = "alert alert-warning" role = "alert">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                            <!--Username shards-->
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input id="email" class="form-control" aria-label="Username" aria-describedby="basic-addon1" value="{{ old('email') }}" required autofocus placeholder="Email Address" type="email" name="email">
                                    
                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>
                            </div>
                       

                        <!--Password shards-->
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-unlock"></i></span>
                                </div>
                                <input id="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" name="password" required type="password">
                                 @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        </div>

                       <!--  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember {{ old('remember') ? 'checked' : '' }}"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-7">
                                <!--<a class="btn btn-primary btn-pill" href="">Log In</a>-->
                                <button type="submit" class="btn btn-primary btn-pill">Log In</button>
                                <a class="btn btn-link" href="{{ route('password.request') }}">Forgot Your Password?
                                </a>
                            </div>
                        </div>
                         <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                            Don't have an account? Register <a href="{{ url('/register') }}"> here.</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
