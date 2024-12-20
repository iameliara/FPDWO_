<html>
    <head>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="{{ url('assets/bootstrap/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ url('assets/bootstrap/bootstrap-icons.css') }}">
        <script src="{{ url('assets/bootstrap/bootstrap.bundle.min.js') }}"></script>

        <!-- jQuery -->
        <script src="{{ url('assets/jquery/jquery-3.6.0.min.js') }}"></script>

        <!-- Main Application -->
        <title>@yield('title') | Sistem Manajemen Cuti</title>
        <meta name="viewport" content="width=device-width,initial-scale=1">

        @stack('header')
    </head>
    <body class="bg-light">
        <div id="main-content" class="d-flex flex-row">
            <div class="bg-dark text-light d-none d-lg-block shadow overflow-auto" style="width: 300px; height: 100vh">
                <h3 class="py-4 text-center menu-title">@yield('menutitle')</h3>
                <ul class="nav nav-pills flex-column nav-content">@yield('sidebar')</ul>
            </div>
            <div class="flex-grow-1 d-flex flex-column overflow-auto" style="height: 100vh">
                <div class="d-block d-lg-none">
                    <div class="navbar navbar-expand-lg navbar-dark bg-dark">
                        <div class="container-fluid">
                            <span class="navbar-brand menu-title">@yield('menutitle')</span>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav-container">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="nav-container">
                                <ul class="navbar-nav me-auto nav-content" id="nav">@yield('sidebar')</ul>
                            </div>
                        </div>
                    </div>
                </div>
                @if (!empty(session('status')))
                    <div class="px-4 py-2">
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <div class="py-2">{{ session('status') }}</div>
                        </div>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="px-4 py-2">
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            @foreach ($errors->all() as $error)
                                <div class="py-2">{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif
                <div id="content" class="flex-grow-1 p-4">@yield('content')</div>
                <div class="p-3 text-center">Copyright &copy; 2022, Sistem Manajemen Cuti</div>
            </div>
        </div>
    </body>
</html>
