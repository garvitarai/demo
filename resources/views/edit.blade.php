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
<script type="text/javascript" src="{{ asset('public/js/jQuery-2.1.4.min.js') }}"></script>
    <div class="container">
      <div class="blog section section-invert py-4">
        <h4 class="text-center">Edit Product</h4>
      </div>
    @if ($errors->any())
    @endif
    <br>
        <div class="col">
            <div class="panel panel-info">
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- Update comp product form -->
                    <form action = "{{action('EditController@update', $id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data" >
                        {{ csrf_field() }}

                        <!-- Update description -->
                       <input type="hidden" value="{{csrf_token()}}" name="_token" />
                            <div class="form-group row{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="regular-price" class="col-sm-2 col-form-label">Description*</label>

                            <div class="col-sm-8">
                                <input id="description" type="text" class="form-control" name="description" required value="{{$product->description}}">

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Insert pictures here -->
                        @if(count($picture) > 0)
                        <div class="form-group">
                          <label for="pics" class="col-sm-2 col-form-label">Captured Pictures</label>
                          @foreach ($picture as $pic)
                            <div class="col-sm-12">
                              <img class="center-block" style="max-height: 300px" src="{{$pic->comments}}"/>
                            </div>
                          @endforeach
                        </div>
                        @endif

                        <!--Update Store Information-->
                        <div class="form-group row{{ $errors->has('store-name') ? ' has-error' : '' }}">
                              <input type="hidden" value="{{csrf_token()}}" name="_token" />
                            <label for="store-name" class="col-sm-2 col-form-label">Store*</label>

                            <div class="col-sm-8">
                                <input id="store-name" type="text" class="form-control" name="store" required value="{{$product->store}}">

                                @if ($errors->has('store-name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('store-name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                            <div class="form-group row{{ $errors->has('regular-price') ? ' has-error' : '' }}">
                            <label for="regular-price" class="col-sm-2 col-form-label">Regular Price*</label>

                            <div class="col-sm-8">
                                <input id="regular-price" min="0" max= "3000" step="0.01" type="number" class="form-control" name="regularPrice" required value="{{$product->regularPrice}}">

                                @if ($errors->has('regular-price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('regular-price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Update sale price -->
                        <div class="form-group row">
                            <label for="sale-price" class="col-sm-2 col-form-label">Sale Price</label>

                            <div class="col-sm-8">
                                <input type="number" min="0" step="0.01" name="salePrice" id="sale-price" class="form-control" value="{{$product->salePrice}}">
                            </div>
                        </div>

                        <!-- Update TJX price -->
                            <div class="form-group row{{ $errors->has('internalPrice') ? ' has-error' : '' }}">
                            <label for="tjx-price" class="col-sm-2 col-form-label">TJX Price*</label>

                            <div class="col-sm-8">
                                <input id="tjx-price" step="0.01" min="0" max= "3000" type="number" class="form-control" name="internalPrice" required value="{{$product->internalPrice}}">

                                @if ($errors->has('internalPrice'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('internalPrice') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-btn fa-check"></i>Update Product
                                </button>
                                <br><br>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
