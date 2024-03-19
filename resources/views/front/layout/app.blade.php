<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    {{-- start header --}}
    @yield('header')
    {{-- end header --}}
    {{-- start main --}}
    <main>
        @yield('main')
    </main>
    {{-- end main --}}
    {{-- start footer --}}
    @yield('footer')
    {{-- end footer --}}
</body>

</html>
