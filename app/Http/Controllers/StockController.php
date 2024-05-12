<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;

class StockController extends Controller
{
    public function index()
    {
        try {
            $data['active_class']  = "stock-class";
            $data['page'] = "Stock - Home";
            $data['title']  = "Stock";

            $stockData    = Stock::orderBy('id', 'DESC')->get();
            $data['stockData']  = $stockData;

//            toastr()->success('Data has been saved successfully!');
//            toastr()->error('An error has occurred please try again later.');
            return view('index',$data);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
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
                return response()->json([
                    'status' => 'success',
                    'code'   => '200',
                    'msg'    => 'Stock has been created successfully!'
                ]);
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
