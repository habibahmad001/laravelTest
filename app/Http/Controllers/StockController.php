<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use Illuminate\Support\Facades\Storage;

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


//            $file = $request->file('file');
//            $fileName = $file->getClientOriginalName();
//
//            /*********** Check File Type **********/
//            $fileExtension = $file->getClientOriginalExtension();
////            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
//            $allowedExtensions = ['pdf', 'png', 'jpg', 'jpeg'];
//            if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
//                return response()->json(['status' => "notproceed", 'message' => 'File type should PDF.']);
//            }
//            /*********** Check File Type **********/
//
//            // Check if the file already exists
//            $counter = 1;
//            $originalFileName = $fileName;
//            $path = 'public/' . date("Y").'/'.date("m").'/creditcard/invoice';
//            $filePath = $path . '/' . $fileName;
//
//            while (Storage::exists($filePath)) {
//                $fileName = pathinfo($originalFileName, PATHINFO_FILENAME) . " ($counter)." . pathinfo($originalFileName, PATHINFO_EXTENSION);
//                $filePath = $path . '/' . $fileName;
//                $counter++;
//            }
//            $request->file->storeAs($path, $fileName);

            $record = new Stock();

            $record->name = $request->name;
            $record->qty = $request->qty;
            $record->price = $request->price;
            $record->stock = $request->stock;

            if($record->save()) {
                $data["stockData"] = Stock::orderBy("id", "DESC")->get();
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
}
