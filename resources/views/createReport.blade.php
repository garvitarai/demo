@extends('layouts.app')

@section('content')

<meta name= "viewport" content= "width=device-width, initial-scale=1">
<div class="container" overflow="auto">
  <div class="col">
    <br>
    @if(!empty($report) && $report->count())
        <h4 class="text-center">Submit Reports</h4>
          <div class="table-responsive">
            <table class="table table-striped task-table">
              <thead>
                <th>Date</th>
                <th>Department</th>
                <th>Status</th>
                <th>Actions</th>
              </thead>
              <tbody>
                @foreach ($report as $rep)
                <tr>
                  <td class="table-text"><div>{{$rep->date}}</div></td>
                  <td class="table-text"><div>{{$rep->department}}</div></td>
                  <td class="table-text"><div>{{$rep ->products}} <b>{{$rep->status}}</b> product(s)</div></td>
                  <?php
                  $loggedRole = Auth::user()->role;
                  ?>
                  <td class="table-text">
                    <form action="{{url('createreport/'.$rep->date.'/'.$rep->department.'/'.$rep->status)}}" method="GET">
                      <button type="submit" class="btn btn-success">Create Report</button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          @else
          <div class="center">
                          <br></br>
                        <h3>There are no products pending submission.</h3>
                        <h5>Go to the Add Product page to log products, and create this month's report!</h5>
                     </div>
                       @endif
    </div>
    <br><br>

    <form action="{{ url('/edit') }}" method="GET">
    <button type="submit" class="btn btn-outline-secondary btn-pill previous pull-left" href="">← Step 2: My Products</button>
    </form>
    <form action="{{ url('/reports') }}" method="GET">
    <button type="submit" class="btn btn-outline-secondary btn-pill next pull-right">Step 4: My Reports →</button>
    </form>
  </div>
@endsection
