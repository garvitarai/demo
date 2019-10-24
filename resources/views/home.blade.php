@extends('layouts.app')

@section('content')

    <div class="blog section section-invert py-4">
        <h3 class="section-title text-center m-5">Welcome {{ Auth::user()->name }}, what would you like to do?</h3>
<?php
 $loggedrole = Auth::user()->role;
 if ($loggedrole == 'Merchant') { ?>

        <div class="container">
          <div class="py-4">
            <div class="row">
              <div class="card-deck">
              <div class="col-md-12 col-lg-4">
                <div class="card mb-4">
                  <div class="card-body" style="text-align: center;">
                    <h4 class="card-title">Products</h4>
                    <p class="card-text">Go comparison shopping and collect data on your competitor's products.</p>
                    <a class="btn btn-primary btn-pill" href="{{ url('/add') }}">Add Product &#10133;</a>
                    <br></br>
                    <a class="btn btn-primary btn-pill" href="{{ url('/edit') }}">View Products &#128221;</a>
                  </div>
                </div>
              </div>

              <div class="col-md-12 col-lg-4">
                <div class="card mb-4">
                  <div class="card-body" style="text-align: center;">
                    <h4 class="card-title">Reporting</h4>
                    <p class="card-text">Create and submit comparison shopping reports for approval.</p>
                    <a class="btn btn-primary btn-pill" href="{{ url('/createreport') }}">Create Report &#9997;</a>
                    <br></br>
                    <a class="btn btn-primary btn-pill" href="{{ url('/reports') }}">View Reports &#128065;</a>
                  </div>
                </div>
              </div>

              <div class="col-md-12 col-lg-4">
                <div class="card mb-4">
                  <div class="card-body" style="text-align: center;">
                    <h4 class="card-title">Analytics</h4>
                    <p class="card-text">Analyze compliance performance of your departments.</p>
                    <a class="btn btn-primary btn-pill" href="{{ url('/analytics') }}">View Dashboard &#128202;</a>
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Managers are to only create and view reports-->
<?php } else { ?>
  <div class="container">
          <div class="py-4">
            <div class="row">
              <div class="card-deck">

               <div class="col-md-12 col-lg-4">
                <div class="card mb-4">
                  <div class="card-body" style="text-align: center;">
                    <h4 class="card-title">Reporting</h4>
                    <p class="card-text">Review monthly reports submitted by merchants for your department.</p>
                    <a class="btn btn-primary btn-pill" href="{{ url('/reports') }}">View Reports &#128065;</a>
                  </div>
                </div>
              </div>

              <div class="col-md-12 col-lg-4">
                <div class="card mb-4">
                  <div class="card-body" style="text-align: center;">
                    <h4 class="card-title">Analytics</h4>
                    <p class="card-text">View descriptive analytics on the compliance performance of your departments.</p>
                    <a class="btn btn-primary btn-pill" href="{{ url('/analytics') }}">View Dashboard &#128202;</a>
                  </div>
                </div>
              </div>

              <div class="col-md-12 col-lg-4">
                <div class="card mb-4">
                  <div class="card-body" style="text-align: center;">
                    <h4 class="card-title">PriceMatch</h4>
                    <p class="card-text">Reduce time in-store for merchants by automating comparison shopping using the web.</p>
                    <a class="btn btn-outline-dark btn-pill" href="#">Coming Soon 🚧</a>
                  </div>
                </div>
              </div>

              </div>
            </div>
          </div>
        </div>
      </div>
      <br><br>
  <?php } ?>

@endsection
