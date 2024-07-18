<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tasks;

use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Tasks::with('user')->paginate(5); 
        return view('tasks.index', compact('tasks'));
        
    }

    public function create()
    {
        $users = User::all();
        $tasks = new Tasks(); 
        $Modo = 'Crear';
        return view('tasks.create', compact('users', 'tasks', 'Modo'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string|in:pendiente,en progreso,completada',
            'due_date' => 'required|date',
        ]);

        $task = new Tasks();
        $task->title = $validatedData['title'];
        $task->description = $validatedData['description'];
        $task->status = $validatedData['status'];
        $task->due_date = $validatedData['due_date'];
        $task->user_id = auth()->id();

        $task->save();

        return redirect('/Tasks')->with('Mensaje', 'Tarea creada exitosamente.');
    }

    public function edit($id)
    {
        $tasks = Tasks::findOrFail($id);
        $users = User::all();
        $Modo = 'Editar';
        return view('tasks.edit', compact('tasks', 'users', 'Modo'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string|in:pendiente,en progreso,completada',
            'due_date' => 'required|date',
            'user_id' => 'required|exists:users,id',
        ]);

        $tasks = Tasks::findOrFail($id);
        $tasks->title = $validatedData['title'];
        $tasks->description = $validatedData['description'];
        $tasks->status = $validatedData['status'];
        $tasks->due_date = $validatedData['due_date'];
        $tasks->user_id = $validatedData['user_id'];

        $tasks->save();

        return redirect('/Tasks')->with('Mensaje', 'Tarea modificada exitosamente.');
    }

    public function destroy($id)
    {
        Tasks::destroy($id);
        return redirect('/Tasks')->with('Mensaje', 'Tarea eliminada exitosamente.');
    }
}
