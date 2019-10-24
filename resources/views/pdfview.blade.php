<html>

	<table>
		<tr>
			<th>Within <br>20 - 60% ?</th>
            <th>Store</th>
            <th>Description</th>
            <th>Regular <br>Discount</th>
            <th>Sale <br>Discount</th>
            <th>Price <br>Breakdown</th>
            <th>Logged By</th>
            <th>Submitted By</th>
		    </tr>
		@foreach ($products as $prod)
		 <td class="table-text">
          <div>{{$prod->store}}</div>
          <div>{{$prod->description}}</div>
          <div>{{$prod->submittedBy}}</div>
		@endforeach
        </td>
   
	</table>

</html>





