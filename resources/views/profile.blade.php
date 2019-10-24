@extends('layouts.app')

@section('content')
<br></br>
<div class="container">
  <div class="row">
    <div class="col">
      <img src="https://s3.ca-central-1.amazonaws.com/tjxcanada/public/default.jpg" style="width:150px; height:150px; float:left; border-radius:50%; margin-right: 25px;">
      <h4> {{$user -> name}}'s Profile </h4>
      <h5> {{$user -> role}}</h5>
      <h6> Account created: {{$user -> created_at->diffForHumans()}}</h6>
      <!-- <form enctype="multipart/form-data" action="/profile" method="POST">
        <label>Update Profile Image</label>
        <input type="file" name="avatar">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <input type="submit" class="pull-right btn btn-sm btn-primary">
      </form> -->
    </div>
  </div>
</div>
@endsection
