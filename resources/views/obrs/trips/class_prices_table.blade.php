<table width="100%" class="table table-striped table-bordered table-hover dt-responsive" id="dataTables-example">
    <thead>
        <th>Number</th>
        <th>Class</th>
        <th>Price</th>
        <th>Delete</th>
    </thead>
    @foreach($classPricesArray as $key => $classPrice) 
        <tr>
            <td>
                {{ $key }}
            </td>
            <td>
                {{ $classPrice->trip_class }}
            </td>
            <td>
                {{ $classPrice->class_fare }}
            </td>    
            <td>
                <a href="#" type="button" class="btn btn-outline-danger waves-effect btn-sm" style="text-transform: capitalize;">Delete</a>
            </td>                     
        </tr>   
    @endforeach
</table> 
