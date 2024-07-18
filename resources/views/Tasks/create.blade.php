<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<x-app-layout>
<form action="{{ url('/Tasks') }}" method="post">
    {{ csrf_field() }}
    @include('tasks.form', ['Modo' => 'Crear'])
</form>
</x-app-layout>