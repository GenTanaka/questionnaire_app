@include('layouts.head')
<body>
    <div id="app">
        @include('layouts.header')

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
