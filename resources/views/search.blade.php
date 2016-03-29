<!DOCTYPE HTML>
<html>
    <head>
        @include('layouts.head')
    </head>
    <body>
    <h1>Résultat</h1>
    @foreach($results as $result)
        {{ $result[0] }}
    @endforeach
    </body>
</html>