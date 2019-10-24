@extends('layouts.app')

@section('content')
<style type="text/css">
table td {
text-align: center;
}
table th {
text-align: center;
}
</style>

 <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                @if(!empty($data) && $data->count())
                <div class="panel-heading">
                    Export Product Log
                </div>
                <form action="/export" method="POST" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="panel-body">
                        <!-- Add Export Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-6">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-bar-chart"></i>      Create Report
                                </button>
                            </div>
                        </div>
                    </form>

                <div class="row">
                <div class="col-md-5 col-md-offset-1">
                <div class="panel-body">
                    <table class="table table-bordered" align="center">
                        <thead>
                            <tr>
                                <th>Store</th>
                                <th>Description</th>
                                <th>Regular Price</th>
                                <th>TJX Price</th>
                                <th>% WMI Discount</th>
                                <th>Sale Price</th>
                                <th>% WMI Sale Discount</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach($data as $key => $value)
                                <?php
                                $discReg = 0;
                                $discSale = 0;
                                $regCol = 'red';
                                $discCol = 'black';
                                try{
                                $discReg = round((($value->regularPrice - $value->internalPrice) /  $value->regularPrice)*100);
                                $discSale = round((($value->salePrice - $value->internalPrice) /  $value->salePrice)*100);
                            }
                                catch(Exception $e){
                                }
                                ?>
                                    <tr>
                                        <td>{{ $value->store}}</td>
                                        <td>{{ $value->description }}</td>
                                        <td>{{ $value->regularPrice }}</td>
                                        <td>{{ $value->internalPrice }}</td>
                                        @if ($discReg < 20)
                                        <td><font color= "#d62929">{{ $discReg }}</font></td>
                                        @elseif ($discReg > 60)
                                         <td><font color= "#2b942d">{{ $discReg }}</font></td>
                                         @else 
                                         <td>{{ $discReg }}</td>
                                         @endif                 
                                        <td>{{ $value->salePrice }}</td>
                                        @if ($discSale < 20)
                                        <td><font color= "#d62929">{{ $discSale }}</font></td>
                                        @elseif ($discSale > 60)
                                         <td><font color= "#2b942d">{{ $discSale }}</font></td>
                                         @else
                                         <td>{{ $discSale }}</td>
                                         

                                         @endif  

                                    </tr>
                                @endforeach
                            @else
                    <div class="panel-heading">
                    Please log products to create report
                    </div>


                    @endif
                        </tbody>
                    </table>
                </div>
                
            </div>

        </div>
    </div>

     <div class="panel panel-default">
                    <div class ="panel-heading">
                        Signatures
                    </div>
                    
                   
                </div>
                </div>
            </div>
        </div>

    </div>

@endsection 