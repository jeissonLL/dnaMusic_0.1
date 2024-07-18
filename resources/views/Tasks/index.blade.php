<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<x-app-layout>
@if(Session::has('Mensaje'))
    <div class="alert alert-success">
        {{ Session::get('Mensaje') }}
    </div>
@endif

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <a href="{{ url('/Tasks/create') }} " class="btn btn-primary">Agregar tarea</a>
            </div>
        </div>
    </div>
</div>


<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Titulo</th>
            <th>Descripcion</th>
            <th>Estado</th>
            <th>Due Date</th>
            <th>usuario asignado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($tasks as $task)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $task->title }}</td>
            <td>{{ $task->description }}</td>
            <td>{{ $task->status }}</td>
            <td>{{ $task->due_date }}</td>
            <td>{{ $task->user ? $task->user->name : 'No asignado' }}</td>
            <td>
                <a href="{{ url('/Tasks/' . $task->id . '/edit') }}">Editar</a>
                |
                <form method="post" action="{{ url('/Tasks/' . $task->id) }}" style="display:inline">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" onclick="return confirm('¿Desea borrar la tarea?');">Borrar</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</x-app-layout>
