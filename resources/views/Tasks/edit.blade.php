<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<x-app-layout>
<form action="{{ url('/Tasks/' . $tasks->id) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}
    @include('tasks.form', ['Modo' => 'Editar'])
</form>
</x-app-layout>
