@extends('layouts.app')

@section('content')

<meta name= "viewport" content= "width=device-width, initial-scale=1">
<div class="container" overflow="auto">
  <div class="col">
    @foreach ($first as $f)
    <form action = "{{url('reports/'.$f->dater.'/'.$f->department)}}" method="POST" class="form-horizontal" enctype="multipart/form-data" >

    {{ csrf_field() }}
    <div class="panel panel-default">
        <div class="blog section section-invert py-6">
        <br>
        <h5 class="section-title text-center m-7">
            <b>{{Auth::user()->department}}</b>{{$f->department}} — {{$f->dater}}
        </h5>
        </div>
        </div>
        @endforeach

        <div class="panel-body">
          <div class="table-responsive">
            <table class="table table-striped task-table">
              <thead>
                <th>Within<br>20%-60%?</th>
                <th>Store</th>
                <th>Description</th>
                <th>Discounts</th>
                <th>Prices</th>
                <th>Logged By</th>
                <th>Submitted By</th>
              </thead>
              <tbody>
                @foreach ($products as $prod)
                  <!-- discount calculation -->
                  <?php
                  $reg = 0;
                  $sale = 0;
                  try {
                    $reg = round((($prod->regularPrice - $prod->internalPrice) / $prod->regularPrice)*100);
                    $sale = round((($prod->salePrice - $prod->internalPrice) / $prod->salePrice)*100);
                  }
                  catch(Exception $e){
                  }

                  if ($reg > 0 && $sale > 0)  {
                  $minValue = min($reg,$sale);
                  }
                  elseif ($sale < 0) {
                  $minValue = $sale;
                  }
                  elseif ($reg > 0 ) {
                  $minValue = $reg;
                  }
                  else
                  $minValue = $sale;
                  ?>

                  <tr>
                    @if ($minValue >= 20 and $minValue <= 60)
                    <td class="table-text" bgcolor="#2b942d"><center><div style="font-size:x-large"><i class="fa fa-check"></i></div></center></td>
                    @elseif ($minValue <=20)
                    <td class="table-text" bgcolor= "#e63900"><center><div style="font-size:x-large"><i class="fa fa-remove"></i></div></center></td>
                    @else
                    <td class= "table-text" bgcolor="#ffe866"><center><div style="font-size:x-large">&#9888;</div></center></td>
                    @endif

                    <td class="table-text">
                      <div>{{$prod->store}}</div>
                      <input type="hidden" name="id[]" value="{{$prod->id}}">
                    </td>
                    <td class="table-text"><div>{{$prod->description}}</div></td>
                    <td class="table-text">
                      <div>Regular: {{$reg}}%</div>
                      <div>Sale: {{$sale}}%</div>
                    </td>
                    <td class="table-text">
                      <div>Their Price: ${{$prod->regularPrice}}</div>
                      <div>Their Sale Price: ${{$prod->salePrice}}</div>
                      <div>Our Price: ${{$prod->internalPrice}}</div>
                    </td>
                    <td class="table-text">
                      <div>{{$prod->name}}</div>
                    </td>
                    <td class="table-text">
                      <div>{{$prod->submittedBy}}</div>
                    </td>

                 <td class="table-text">
                  <div class="col-sm-12">
                                      <!-- Modal -->
                  @foreach ($picture as $pic)
                  @if ($prod->id == $pic->productId)
                  <center><button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#myModal-<?php echo $prod->id;?>"><i class="fa fa-camera"></i></button></center>
                  </td>


                  <div id="myModal-<?php echo $prod->id;?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-body">
                         <button type="button" class="close" class="close" id="btnWidgetClose" style="font-size:30px;opacity:0.5;"></button>
                        <img class="img-responsive" style="max-width: 100%;" src="{{$pic->comments}}"/>
                        </div>


                      @else
                      @endif


                    </div>
                  </div>
                  @endforeach

                  @endforeach

                 </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <?php
        $loggedRole = Auth::user()->role;
        $loggedName = Auth::user()->name;
        ?>
        @if ($loggedRole == "Manager" && $prod->status != 'Approved')

        <div class="form-group">
          <br><br>

                     <!-- Trigger -->
         <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModal" style="float: right;">Review Report</button>

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">&#10071; Confirm</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  I, <strong> <?php echo $loggedName ?></strong>, have approved the contents of this report.</font>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-warning" data-dismiss="modal"></i>Cancel</button>
                  <button type="submit" class="btn btn-danger" name="action" value="reject" data-toggle="tooltip" data-placement="top" title="Reject the report if doesn't meet requirements, the buyer will be alerted.">Reject Report</button>
                  <button type="submit" class="btn btn-success" name="action" value="approve">Approve Report</button>
                </div>
              </div>
            </div>
          </div>

        @else
    @if(session('message'))
      {{session('message')}};
    @endif
  @endif
  <br><br>
  <form action="{{ url('/reports') }}" method="GET">
    <button type="submit" class="btn btn-outline-secondary btn-pill previous pull-left" href="">← Back to View Reports</button>
  </form>

  </div>

</div>
@endsection
