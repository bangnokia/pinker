<html lang="en">

<head>
    <title>Pinker</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @livewireStyles
</head>

<body class="m-0 p-0">
    <div class="">
        <livewire:tinker />
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
    @livewireScripts
 </body>

</html>
