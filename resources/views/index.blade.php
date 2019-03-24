<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>LaraSpa</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons">
    <link rel="stylesheet" href="{!! asset('css/app.css') !!}">

    <!-- Styles -->
    <style>

    </style>

</head>
<body>

<div id="app">
    <App></App>
</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
