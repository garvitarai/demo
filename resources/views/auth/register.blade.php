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
    <a href="http://www.compr.ca" style="text-decoration:none" ><h3 class="section-title text-center m-5"><img src="https://s3.ca-central-1.amazonaws.com/tjxcanada/public/tag+copy.svg" class="mr-2" font-color="white">compr</h3></a>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="panel panel-default">

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <br></br>

                    <!--Username shards-->
                        <div class="form-group col-md-6 {{ $errors->has('name') ? ' has-error' : '' }}">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                                </div>
                                <input id="name" class="form-control" aria-label="Username" aria-describedby="basic-addon1" value="{{ old('name') }}" required autofocus placeholder="Name" type="text" name="name">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--Email shards-->
                        <div class="form-group col-md-6 {{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                                </div>
                                <input id="email" class="form-control" aria-label="Username" aria-describedby="basic-addon1" value="{{ old('email') }}" required autofocus placeholder="Email Address" type="email" name="email">

                                @if ($errors->has('email'))

                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group dropdown">
                            <label for="Department" class="col-md-4 control-label">Department</label>

                            <div class="col-md-6">
                              <select multiple="multiple" name="department[]" required>
                                <!-- <option value="Electronics">Electronics</option>
                                <option value="Footwear">Footwear</option>
                                <option value="Handbags">Handbags</option>
                                <option value="Kitchen">Kitchen</option>
                                <option value="Toys">Toys</option>
                                <option value="Womens Clothing">Women's Clothing</option>
                                <option value="Beauty">Beauty</option>
                                <option value="Food">Food</option> -->
                                <option value="Backpacks">Backpacks</option>
                                <option value="Office Furniture">Office Furniture</option>
                                <option value="Mens Footwear">Men's Footwear</option>
                                <option value="Womens Clothing">Women's Clothing</option>
                              </select>
                            </div>
                        </div>

                         <div class="form-group dropdown">
                            <label for="Department" class="col-md-4 control-label">Role</label>

                            <div class="col-md-4">
                              <select name="role" required>
                                <!-- <option value="GMM">GMM</option> -->
                                <option value="Manager">Manager</option>
                                <!-- <option value="Executive Assistant">Executive Assistant</option> -->
                                <option value="Merchant">Merchant</option>
                              </select>
                            </div>
                        </div>

                        <!--Password shards-->
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-unlock"></i></span>
                                </div>
                                <input id="password" class="form-control" placeholder="Enter Your Password" aria-label="Password" aria-describedby="basic-addon1" name="password" required type="password">
                                 @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        </div>

                        <!--end-->

                        <!--Confirm Password shards-->
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-unlock"></i></span>
                                </div>
                                <input id="password-confirm" class="form-control" placeholder="Confirm Password" aria-label="Password" aria-describedby="basic-addon1" name="password_confirmation" required type="password">
                                 @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        </div>

                        <!--end-->

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary btn-pill">Register</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                    Already have an account? Log in <a href="{{ url('/login') }}"> here.</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
