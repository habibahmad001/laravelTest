<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class StockController extends Controller
{
    public function index()
    {
        try {
            $data['active_class']  = "stock-class";
            $data['page'] = "Stock - Home";
            $data['title']  = "Stock";

            $stockData    = Stock::orderBy('created_at', 'DESC')->get();
            $data['stockData']  = $stockData;
            $data['TotalValueNumber']  = Stock::TotalValueNumber();

//            toastr()->success('Data has been saved successfully!');
//            toastr()->error('An error has occurred please try again later.');
            return view('index',$data);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }


    public function reviewModify(Request $request)
    {

        $contractId = $request->input('pk');
        $field = $request->input('name');
        $value = $request->input('value');

        $obj = Stock::find($contractId);
        if(!$obj){
            abort(404);
        }
        $obj->$field = $value;
        $obj->save();

        return response()->json(['success' => true]);
    }


    public function exportXML(Request $request)
    {
        $stocks = Stock::orderBy('created_at', 'DESC')->get();

        // Create a new DOMDocument instance
        $xmlDoc = new \DOMDocument('1.0', 'utf-8');
        $xmlDoc->formatOutput = true;

        // Create the root element
        $root = $xmlDoc->createElement('tbl_stock');
        $xmlDoc->appendChild($root);

        // Loop through each stock item and create XML nodes
        foreach ($stocks as $stock) {
            $stockElement = $xmlDoc->createElement('stock');

            // Create XML elements for each field
            $productNameElement = $xmlDoc->createElement('Product_Name', htmlspecialchars($stock->name));
            $quantityElement = $xmlDoc->createElement('Quantity_In_Stock', $stock->qty);
            $priceElement = $xmlDoc->createElement('Price_Per_Item', $stock->price);
            $datetimeElement = $xmlDoc->createElement('Datetime_submitted', $stock->created_at->format('Y-m-d H:i:s'));
            $totalValueElement = $xmlDoc->createElement('Total_value_number', $stock->price * $stock->qty);

            // Append elements to stock element
            $stockElement->appendChild($productNameElement);
            $stockElement->appendChild($quantityElement);
            $stockElement->appendChild($priceElement);
            $stockElement->appendChild($datetimeElement);
            $stockElement->appendChild($totalValueElement);

            // Append stock element to root
            $root->appendChild($stockElement);
        }

        // Generate XML string
        $xmlString = $xmlDoc->saveXML();

        // Return as a response
        return response($xmlString)
            ->header('Content-Type', 'text/xml')
            ->header('Content-Disposition', 'attachment; filename="stocks.xml"');
    }

    public function exportJSON(Request $request)
    {
        $stocks = Stock::orderBy('created_at', 'DESC')->get();

        // Convert stock collection to array
        $data = $stocks->map(function ($stock) {
            return [
                'Product Name' => $stock->name,
                'Quantity In Stock' => $stock->qty,
                'Price Per Item' => $stock->price,
                'Datetime submitted' => $stock->created_at->format('Y-m-d H:i:s'),
                'Total value number' => $stock->price * $stock->qty,
            ];
        });

        // Convert array to JSON
        $jsonString = $data->toJson(JSON_PRETTY_PRINT);

        // Return as a response
        return response($jsonString)
            ->header('Content-Type', 'application/json')
            ->header('Content-Disposition', 'attachment; filename="stocks.json"');
    }


    public function store(Request $request)
    {
        try {

            $rules = [
                'name' => 'bail|required|max:250|',
                'qty' => 'bail|required|max:250|',
                'price' => 'required',
                'stock' => 'required',
            ];

            $messsages = array(
                'required' => 'The :attribute field is required.'
            );

            $this->validate($request, $rules,$messsages);


            $record = new Stock();

            $record->name = $request->name;
            $record->qty = $request->qty;
            $record->price = $request->price;
            $record->stock = $request->stock;

            if($record->save()) {
                $data["stockData"] = Stock::orderBy("created_at", "DESC")->get();
                $data['TotalValueNumber']  = Stock::TotalValueNumber();
                $html = view('inc/inc_stocktable')->with($data)->render();
                return response()->json([
                    'status' => 'success',
                    'code'   => 200,
                    'html'   => $html,
                    'msg'    => 'Stock has been created successfully!'
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'Failed',
                'code'   => 500,
                'msg'    => 'Server side error!'
            ]);
            dd($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Stock::destroy($id);
        toastr()->success('Record has been removed successfully!');
        return back();
    }
}
