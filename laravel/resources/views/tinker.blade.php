<html lang="en">

<head>
    <title>Pinker</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @livewireStyles

</head>

<body class="m-0 p-0">
<div class="">
    <livewire:tinker/>
</div>

<script src="{{ mix('js/app.js') }}"></script>
@livewireScripts
@stack('scripts')
</body>

</html>
