<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $todo = Task::where('user_id', Auth::id())->latest()->get();
        return view('index', ['user' => $user, 'todo'=>$todo]);
    }

    public function store(Request $r){
        //validate
        $data = $r->validate([
            'task' => 'required|min:1'
        ]);

        $submit = new Task();
        $submit->user_id = Auth::id();
        $submit->task = $r->input("task");
        $submit->status = 0;
        $submit->save();
        return redirect()->route('index');
    }

    public function delete(Request $r){
        //validation
        $this->validate($r,[
            'taskIds' => 'required|array',
            'taskIds.*' => 'integer|exists:tasks,id' //checks if IDs exists in the tasks table
        ]);

        $taskIds = $r->input('taskIds');

        try{
            Task::whereIn('id', $taskIds)->delete();
            return redirect()->route('index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete');
        }
    }
}
