@include('partials.meta')

<body>

    <!-- ======= Header ======= -->
    @include('partials.header')

    <!-- ======= Sidebar ======= -->
    @include('partials.sidebar')

    <main id="main" class="main">

        @yield('content')

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('partials.footer')