<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="admin-panel">
    <div id="app">
        <header id="header" class="header">
            @include('layouts.panel.header')
        </header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-2 p-0">
                    <aside id="sidebar" class="sidebar">
                        @include('layouts.panel.sidebar')
                    </aside>
                </div>
                <div class="col-10">
                    <main class="content">
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>
        <footer id="footer" class="footer">

        </footer>
    </div>
    <script>
        var CKEDITOR_BASEPATH = '/libraries/ckeditor/';
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>