<table id="stockdata" class="display" style="width:100%">
    <thead>
    <tr>
        <th>Product Name</th>
        <th>Quantity In Stock</th>
        <th>Price Per Item</th>
        <th>Datetime Submitted</th>
        <th>Total Value Number</th>
    </tr>
    </thead>
    <tbody>
    @if(count($stockData) > 0)
        @foreach($stockData as $v)
            <tr>
                <td>{!! $v->name !!}</td>
                <td class="text-center">{!! $v->qty !!}</td>
                <td class="text-center">{!! $v->stock !!}</td>
                <td class="text-center">{!! $v->price !!}</td>
                <td class="text-center">{!! $v->total_price !!}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
