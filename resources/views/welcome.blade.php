<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Analog Task</title>

    <!-- Fonts -->

    <!-- Styles -->
    <link href="{{URL::to('css/app.css')}}" rel="stylesheet">
</head>
<body>
<div id="app">
{{--    <analog-component/>--}}
    <task-component/>
</div>
<script src="{{URL::to('js/app.js')}}"></script>

</body>

</html>
