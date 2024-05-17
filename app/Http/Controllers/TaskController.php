<?php
// app/Http/Controllers/ItemController.php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class TaskController extends Controller
{
    public function index()
    {
        try {
            $data['active_class']  = "task-class";
            $data['page'] = "Task - Home";
            $data['title']  = "Task";

            $stockData    = Task::orderBy('created_at', 'DESC')->get();
            $data['taskData']  = $stockData;

            return view('task',$data);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function getData()
    {
        $items = Task::select(['id', 'name', 'readingOrder', 'created_at', 'updated_at']);
        return DataTables::of($items)->make(true);
    }

    public function store(Request $request)
    {
        $item = Task::create($request->all());
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = Task::findOrFail($id);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = Task::destroy($id);
        return response()->json($item);
    }
}

