<table id="stockdata" class="display" style="width:100%">
    <thead>
    <tr>
        <th>Product Name</th>
        <th>Quantity In Stock</th>
        <th>Price Per Item</th>
        <th>Datetime Submitted</th>
        <th>Total Value Number</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @if(count($stockData) > 0)
        @foreach($stockData as $v)
            <tr>
                <td class="editable" data-pk="{!! $v->id !!}" data-name="name" data-title="Enter Name">{!! $v->name !!}</td>
                <td class="text-center editable" data-pk="{!! $v->id !!}" data-name="qty" data-title="Enter Quantity In Stock">{!! $v->qty !!}</td>
                <td class="text-center editable" data-pk="{!! $v->id !!}" data-name="price" data-title="Enter Price Per Item">{!! $v->price !!}</td>
                <td class="text-center">{!! date("F j, Y H:i:s", strtotime($v->created_at)) !!}</td>
                <td class="text-center">{!! ($v->qty) * ($v->price) !!}</td>
{{--                <td class="text-center"><a href="javascript:void(0);" class="removeit" data-id="{!! $v->id !!}"></a></td>--}}
                <td class="text-center"><a href="{!! url("/removeit/" . $v->id) !!}" class="removeit" data-id="{!! $v->id !!}"><i class="fa fa-trash" style="color: darkred" aria-hidden="true"></i></a></td>
            </tr>
        @endforeach
        <tr>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-center">{!! $TotalValueNumber[0]->total_price !!}</td>
            <td class="text-center"></td>
        </tr>
    @endif
    </tbody>
</table>
