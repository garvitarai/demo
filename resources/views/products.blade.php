<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $(".toggle-popover").click(function(){
   		$("#myPopover").popover('toggle');
    });
});
</script>
@extends('layouts.app')

@section('content')

    <div class="blog section section-invert py-4">
    <div class="container">
        <h4 class="text-center"> Add a Product</h4>
        <div class="col">
            <div class="panel panel-info">
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New comp product form -->
                    <form action="/upload" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <!-- Get user email -->
                        <input type="hidden" name="employeeId" value="{{Auth::user()->email}}">
                        <input type="hidden" name="department" value="{{$department}}">

                        <!-- Product log -->
                        <div class="form-group row">
                            <label for="task-name" class="col-sm-2 col-form-label">Description</label>

                            <div class="col-sm-8">
                                <input type="text" name="description" placeholder="Description" id="task-name" class="form-control" autocomplete="off" value="{{ old('description') }}">
                            </div>
                        </div>
                        <!-- Add store name -->
                        <div class="form-group row">
                            <label for="store-name" class="col-sm-2 control-label">Store*</label>

                            <div class="col-sm-8">
                                <input type="text" name="store" id="store-name"placeholder="Store" class="form-control" value="{{ old('store') }}">
                            </div>
                        </div>

                        <!-- Add photos -->
                        <div class="form-group row">
                          <label for="pictures" class="col-sm-2 control-label">Photo of Product</label>
                            <div class="col-sm-8">
                              <input type="file" name="pictures[]" accept="image/*" capture="environment" multiple>
                            </div>
                        </div>

                        <div class="form-group row">
                          <label for="pictures" class="col-sm-2 control-label">Photo of Price Tag</label>
                            <div class="col-sm-8">
                              <input type="file" name="pictures[]" accept="image/*" capture="environment" multiple>
                            </div>
                        </div>

                        <!-- Add regular price name -->
                        <div class="form-group row">
                            <label for="regular-price" class="col-sm-2 control-label">Regular Price</label>

                            <div class="col-sm-8">
                                <input type="number" step="0.01" min=0 name="regularPrice" placeholder="Regular Price" id="regular-price" autocomplete="off" class="form-control" value="{{ old('regularPrice') }}">
                            </div>
                        </div>
                        <!-- Add sale price name -->
                        <div class="form-group row">
                            <label for="sale-price" class="col-sm-2 control-label">Sale Price</label>

                            <div class="col-sm-8">
                                <input type="number" step="0.01" min=0 name="salePrice" placeholder="Sale Price" id="sale-price" class="form-control" value="{{ old('salePrice') }}">
                            </div>
                        </div>

                        <!-- Add TJX price name -->
                        <div class="form-group row">
                            <label for="tjx-price" class="col-sm-2 control-label">TJX Price</label>

                            <div class="col-sm-8">
                                <input type="number" step="0.01" min=0 name="internalPrice" placeholder="TJX Price" id="tjx-price" class="form-control" value="{{ old('internalPrice') }}">
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-10">
                              <br>
                                <button type="submit" class="btn btn-success float-right">
                                    <i class="fa fa-btn fa-check"></i>Submit Product
                                </button>
                              <br>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Tasks -->
            @if (count($products) > 0)
                    <div class="panel panel-default">
                      <br><br>
                        <h4 class="text-center">My Product Log</h4>

                        <div class="panel-body">
                            <div class="table-responsive">
                            <table class="table table-striped task-table">
                                <thead>
                                    <th>Description</th>
                                    <th>Store</th>
                                    <th>Date</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </thead>
                                <tbody>
                                @foreach ($products as $product)
                                <?php
                                $loggedemail =   Auth::user()->email;
                                $databaseemail = ($product->employeeId);
                                $createddate = ($product->created_at);
                                $last30daydate = date('Y-m-d', strtotime('today - 45 days'));
                                $date= \Carbon\Carbon::parse($product->created_at)->diffForHumans();

                                ?>
                                    @if ($databaseemail == $loggedemail && $createddate > $last30daydate)

                                            <tr>
                                                <td class="table-text"><div>{{ $product->description }}</div></td>
                                                <td class="table-text"><div>{{ $product->store }}</div></td>
                                                <td class="table-text"><div>{{ $date }}</div></td>
                                                 <!-- Task Edit Button -->
                                                <td>
                                                  <form action="{{ url('edit/'.$product->id) }}" method="GET">
                                                   <button type="submit" class="btn btn-warning">
                                                     <i class="fa fa-btn fa fa-pencil"></i>
                                                   </button>
                                                 </form>
                                                </td>

                                                <!-- Task Delete Button -->
                                                <td>
                                                  <form action="{{ url('edit/'.$product->id) }}" method="POST">
                                                  {{ csrf_field() }}
                                                  {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn btn-danger">
                                                      <i class="fa fa-btn fa-trash"></i>
                                                    </button>
                                                  </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            <br><br>
                        </div>
                    </div>
            @endif

        </div>
        <br>
      <div class="col">
        <form action="{{ url('/home') }}" method="GET">
          <button type="submit" class="btn btn-outline-secondary btn-pill previous pull-left" href="">← Dashboard</button>
        </form>
        <form action="{{ url('/edit') }}" method="GET">
          <button type="submit" class="btn btn-outline-secondary btn-pill next pull-right">Step 2: My Products →</button>
        </form>
      </div>
    </div>
</div>
    <br>

@endsection
