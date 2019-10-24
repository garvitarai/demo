@extends('layouts.app')

@section('content')

<meta name= "viewport" content= "width=device-width, initial-scale=1">
<div class="container" overflow="auto">
  <div class="col">
    <br>
    @if(!empty($report) && $report->count())

    <h4 class="text-center">My Reports</h4>
          <div class="table-responsive">
            <table class="table table-striped task-table">
              <thead>
                <th>Date</th>
                <th>Department</th>
                <th>Status</th>
                <th>Approved By</th>
                <th>Actions</th>
              </thead>
              <tbody>
                    @foreach ($report as $rep)
                <tr>
                  <td class="table-text"><div>{{$rep->date}}</div></td>
                  <td class="table-text"><div>{{$rep->department}}</div></td>
                  <td class="table-text"><div>{{$rep ->products}} <b>{{$rep->status}}</b> product(s)</div></td>
                  <td class="table-text"><div>{{$rep ->approvedBy}}</b></div></td>
                  <?php
                  $loggedRole = Auth::user()->role;
                  ?>
                  @if ($loggedRole == "Manager" && $rep->status != 'Approved')
                  <td class="table-text">
                    <form action="{{url('reports/'.$rep->date.'/'.$rep->department.'/'.$rep->status)}}" method="GET">
                      <button type="submit" class="btn btn-success"><?php if ($rep->status == 'Approved'){ ?> disabled <?php   } ?>Go to Approve</button>


                    </form>
                  </td>

                  </td>
                  @else
                  <td class="table-text">
                    <form action="{{url('reports/'.$rep->date.'/'.$rep->department.'/'.$rep->status)}}" method="GET">

                      <button type="submit" class="btn btn-outline-secondary">View Products</button>

                    </form>
                     <!-- <form action="{{url('pdfview/'.$rep->date.'/'.$rep->department.'/'.$rep->status)}}" method="GET">
                      <a href = "/pdfview/{date}/{department}/{status}" class = "btn btn-outline-dark"> Save as PDF </a>
                      </form> -->
                  </td>
                  @endif
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
                    @else
                  <?php
                  $loggedRole = Auth::user()->role;
                  ?>
                     @if ($loggedRole == "Manager")
                        <div class="center">
                          <br></br>
                        <h3>You have no reports to be reviewed.</h3>
                        <h5>Wait for a Merchant to submit this month's comparison shopping report!</h5>
                     </div>
                     @else
                      <div class="center">
                          <br></br>
                        <h3>You have no reports that have been approved or submitted.</h3>
                        <h5>Go to the Create Report page to submit your first report!</h5>
                     </div>
                     @endif
                       @endif
    </div>
    <br><br>
            <?php
            $loggedRole = Auth::user()->role;
            ?>
            @if ($loggedRole == "Manager")
            <form action="{{ url('/analytics') }}" method="GET">
            <button type="submit" class="btn btn-outline-secondary btn-pill next pull-right">Analytics →</button>
            </form>
            @else
            <form action="{{ url('/createreport') }}" method="GET">
            <button type="submit" class="btn btn-outline-secondary btn-pill previous pull-left" href="">← Step 3: Create Report</button>
            </form>
            <form action="{{ url('/analytics') }}" method="GET">
            <button type="submit" class="btn btn-outline-secondary btn-pill next pull-right">Step 5: Analytics →</button>
            </form>
            @endif
  </div>
@endsection
