@extends('layouts.app')

@section('content')

    <div class="container">
        <h3 class="section-title text-center m-5">Login</h3>

        <div class="col-sm-offset-2 col-sm-8">

            <div class="panel panel-default">
                

                <div class="panel-body">
                    <!-- Display Validation Errors
                    @include('common.errors') -->

                    <form action="{{ route('login') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @if ($message = Session::get('success'))
                            <div class = "alert alert-sucess">
                                <p>(( $message ))</p>
                            </div>
                        @endif

                        @if ($message = Session::get('warning'))
                            <div class = "alert alert-warning">
                                <p>(( $message ))</p>
                            </div>
                        @endif
                        <!-- Username need to change the input details -->
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">Username</label>

                            <div class="col-sm-6">
                                <input type="text" name="description" id="task-name" class="form-control" autocomplete="off" value="{{ old('task') }}">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="store-name" class="col-sm-3 control-label">Password</label>
                        <!-- Password need to change input details -->
                            <div class="col-sm-6">
                                <input type="text" name="store" id="store-name" class="form-control" value="{{ old('task') }}">
                            </div>
                        </div>

                        <div class="checkbox">
                            <input name="remember" id="remember" type="checkbox" value="1"><label for="remember">Remember Me></label></input>
                        </div>
                        
                        <!-- Add Login Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                
                                 <button onclick="location.href= 'home'" type="button" class="btn btn-default">Login</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                    Don't have an account? Register <a href="{{ url('/register') }}"> here</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

 
@endsection
