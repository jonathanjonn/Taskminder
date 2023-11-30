<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TodoController extends Controller
{
    public function index(){
        $todos = Todo::all();
        return view('todos.index', ['todos' => $todos]);
    }

    public function create(){
        return view('todos.create');
    }

    public function store(TodoRequest $request){
        Todo::create([
            'title' => $request->title,
            'description' => $request->description,
            'is_complete' => 0
        ]);

        $request->session()->flash('success-alert', 'task created');

        return to_route('todos.index');
    }

    public function detail($id){
        
        $todos = Todo::find($id);
        if (!$todos) {
            request()->session()->flash('error', 'task not available');

            return to_route('todos.index')->withErrors([
                'error' => 'No task available'
            ]);
        }

        return view('todos.detail', ['todo' => $todos]);
    }

    public function edit($id){

        $todos = Todo::find($id);
        if (!$todos) {
            request()->session()->flash('error', 'task not available');

            return to_route('todos.edit')->withErrors([
                'error' => 'No task available'
            ]);
        }

        return view('todos.edit', ['todo' => $todos]);
    }

    public function update(TodoRequest $request){

        $todos = Todo::find($request->todo_id);
        if (!$todos) {
            request()->session()->flash('error', 'task not available');

            return to_route('todos.index')->withErrors([
                'error' => 'No task available'
            ]);
        }

        $todos->update([
            'title' => $request->title,
            'description' => $request->description,
            'is_complete' => $request->is_complete
        ]);

        $request->session()->flash('update-alert', 'task created');

        return to_route('todos.index');
    }

    public function remove(Request $request){

        $todos = Todo::find($request->todo_id);
        if (!$todos) {
            request()->session()->flash('error', 'task not available');

            return to_route('todos.index')->withErrors([
                'error' => 'No task available'
            ]);
        }

        $todos->delete();
        $request->session()->flash('delete-alert', 'task deleted');

        return to_route('todos.index');
    }
    
}