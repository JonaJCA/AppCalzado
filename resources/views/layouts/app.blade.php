<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CoreUI CSS -->
    <link href="{{ asset('assets/css/coreui.min.css') }}" rel="stylesheet">
    
    <!-- Custom Auth Styles -->
    <style>
        .auth-background {
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), 
                        url('{{ asset('assets/images/login-bg.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .auth-card {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.4);
            padding: 1rem 2rem;
            transition: all 0.3s ease;
            max-width: 600px;
        }
        
        .auth-card:hover {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }
        
        .auth-logo {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .auth-logo h2 {
            color: #ffffff;
            font-weight: 600;
            margin: 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        
        .auth-logo p {
            color: rgba(255, 255, 255, 0.9);
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }
        
        .card {
            border-radius: 20px;
        }
        
        .form-control {
            border-radius: 20px;
            border: 1px solid rgba(17, 15, 15, 0.4);
        }
        
        .btn-primary {
            background: linear-gradient(45deg, #321fdb, #4f46e5);
            border: none;
            border-radius: 10px;
            padding: 0.35rem 3rem;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: linear-gradient(45deg, #2819c2, #4338ca);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(50, 31, 219, 0.4);
        }
        
        .auth-links {
            text-align: center;
            margin-top: 1.5rem;
        }
        
        .auth-links a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }
        
        .auth-links a:hover {
            color: #ffffff;
            text-decoration: underline;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .auth-card {
                margin: 1rem;
                padding: 1.5rem;
            }
        }
        
        @media (max-width: 576px) {
            .auth-card {
                margin: 0.5rem;
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="auth-background">
        <div class="container-fluid h-100">
            <div class="row h-100 align-items-center justify-content-center justify-content-md-start">
                <!-- Desktop: Lado izquierdo, Mobile: Centrado -->
                <div class="col-12 col-sm-8 col-md-8 col-lg-6 ms-md-auto me-lg-3">
                    <div class="auth-card">
                        <!-- Logo/Título -->
                        <div class="auth-logo">
                            <h2>{{ config('app.name', 'Mi Sistema') }}</h2>
                            <p class="text-muted">Sistema de Inventario</p>
                        </div>

                        <!-- Contenido dinámico -->
                        <main>
                            @yield('content')
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CoreUI JavaScript -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/coreui.bundle.min.js') }}"></script>

    <!-- Scripts adicionales -->
    @stack('scripts')
</body>
</html>