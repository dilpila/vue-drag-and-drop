<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    public function index()
    {
        $data['tasks'] = Task::select('id', 'title', 'order')->orderBy('order', 'desc')->get();
        return response()->json([
            'data' => $data,
            'status' => true,
            'message' => 'Data retrive Successfull',
            'code' => Response::HTTP_OK
        ], Response::HTTP_OK);

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ], [
            'title.required' => 'Title are required.',
        ]);

        $order = Task::max('order');
        $data['task'] = Task::create([
            'title' => $request->title,
            'order' => $order + 1
        ]);
        return response()->json([
            'data' => $data,
            'status' => true,
            'message' => 'Data retrive Successfull',
            'code' => Response::HTTP_OK
        ], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        Task::findOrFail($id)->delete();
        return response()->json([
            'data' => null,
            'status' => true,
            'message' => 'Data deleted successful',
            'code' => Response::HTTP_OK
        ], Response::HTTP_OK);
    }

    public function updateDrag(Request $request)
    {

//        dd($request->result);
        try {
           foreach ($request->result as $key=>$result){
               $task = Task::findOrFail($result['id']);
               $task->order = $result['order_new'];
               $task->save();
           }
        } catch (\Exception $e) {
            return response()->json([
                'data' => null,
                'status' => true,
                'message' => $e->getMessage(),
                'code' => 422
            ], 422);

        }

        return response()->json([
            'data' => null,
            'status' => true,
            'message' => 'Data drag and update` successful',
            'code' => Response::HTTP_OK
        ], Response::HTTP_OK);

    }
}
