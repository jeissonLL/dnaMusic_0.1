
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<form action="{{ $Modo == 'Crear' ? url('/Tasks') : url('/Tasks/' . $tasks->id) }}" method="post">
    {{ csrf_field() }}
    @if($Modo == 'Editar')
        {{ method_field('PATCH') }}
    @endif

    <label for="title">Title</label>
    <input type="text" name="title" id="title" value="{{ isset($tasks->title) ? $tasks->title : '' }}" required>
    <br>
    <label for="description">Description</label>
    <textarea name="description" id="description" required>{{ isset($tasks->description) ? $tasks->description : '' }}</textarea>
    <br>
    <label for="status">Status</label>
    <select name="status" id="status" required>
        <option value="pendiente" {{ isset($tasks->status) && $tasks->status == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
        <option value="en progreso" {{ isset($tasks->status) && $tasks->status == 'en progreso' ? 'selected' : '' }}>En Progreso</option>
        <option value="completada" {{ isset($tasks->status) && $tasks->status == 'completada' ? 'selected' : '' }}>Completada</option>
    </select>
    <br>
    <label for="due_date">Due Date</label>
    <input type="date" name="due_date" id="due_date" value="{{ isset($tasks->due_date) ? $tasks->due_date : '' }}" required>
    <br>

    <label for="user_id">Usuario Asignado</label>
    <select name="user_id" id="user_id" required>
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ isset($tasks->user_id) && $tasks->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
        @endforeach
    </select>
    <br>

    <input type="submit" value="{{ $Modo == 'Crear' ? 'Agregar' : 'Modificar' }}" class="btn btn-primary">
</form>

<a href="{{ url('Tasks') }}">Regresar</a>

