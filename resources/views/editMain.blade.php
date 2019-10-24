@extends('layouts.app')

@section('content')
            <meta name= "viewport" content= "width=device-width, initial-scale=1">
    <div class="container" overflow="auto">
        <div class="col">
            <!-- Current Tasks -->
             <div class="blog section section-invert py-6">

            @if(!empty($products) && $products->count())

            <br>
            <h4 class="text-center">My Product Log</h4>
            </div>
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
                                $date= \Carbon\Carbon::parse($product->created_at)->format('M d, Y');
                                ?>
                                    @if ($databaseemail == $loggedemail && $createddate > $last30daydate)
                                    <tr>
                                        <td class="table-text"><div>{{ $product->description }}</div></td>
                                        <td class="table-text"><div>{{ $product->store }}</div></td>
                                        <td class="table-text"><div>{{ $date }}</div></td>
                                        <!-- <td class="table-text"><div>{{ $product->regularPrice }}</div></td>
                                        <td class="table-text"><div>{{ $product->salePrice }}</div></td>
                                        <td class="table-text"><div>{{ $product->internalPrice }}</div></td> -->

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

                      </div>
                      <br><br>

                      @else



                        <div class="center">
                          <br></br>
                        <h3>You have not logged any products yet.</h3>
                        <h5>Go to the Add Product page to begin logging your product.</h5>
                     </div>

                       @endif

        </div>
        <form action="{{ url('/add') }}" method="GET">
        <button type="submit" class="btn btn-outline-secondary btn-pill previous pull-left">← Step 1: Add a Product</button>
      </form>
      <form action="{{ url('/createreport') }}" method="GET">
      <button type="submit" class="btn btn-outline-secondary btn-pill next pull-right">Step 3: Create Report →</button>
    </div>
@endsection
