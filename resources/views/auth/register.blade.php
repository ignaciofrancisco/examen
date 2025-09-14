<!doctype html>
<html lang="es" class="light-style layout-wide customizer-hide" dir="ltr"
      data-theme="theme-default"
      data-assets-path="../../assets/"
      data-template="horizontal-menu-template"
      data-style="light">
<head>
    <meta charset="utf-8" />
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Registro - VentasFix</title>

    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico" />

    <!-- Fonts & Icons -->
    <link rel="stylesheet" href="../../assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="../../assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="../../assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/rtl/core.css" />
    <link rel="stylesheet" href="../../assets/vendor/css/rtl/theme-default.css" />
    <link rel="stylesheet" href="../../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/@form-validation/form-validation.css" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>
    <script src="../../assets/vendor/js/template-customizer.js"></script>
    <script src="../../assets/js/config.js"></script>
</head>

<body>
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-6">

            <!-- Register Card -->
            <div class="card">
                <div class="card-body">

                

                    <h4 class="mb-1">¡Comienza tu aventura aquí!</h4>
                    <p class="mb-6">¡Gestiona tu aplicación de manera fácil y divertida!</p>

                    <!-- ALERTA DE ERROR -->
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    @endif

                    <!-- FORMULARIO -->
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Nombre -->
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" id="nombre" name="nombre"
                                   class="form-control @error('nombre') is-invalid @enderror"
                                   value="{{ old('nombre') }}" required autofocus>
                            @error('nombre')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Apellido -->
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" id="apellido" name="apellido"
                                   class="form-control @error('apellido') is-invalid @enderror"
                                   value="{{ old('apellido') }}" required>
                            @error('apellido')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- RUT -->
                        <div class="mb-3">
                            <label for="rut" class="form-label">RUT</label>
                            <input type="text" id="rut" name="rut"
                                   class="form-control @error('rut') is-invalid @enderror"
                                   value="{{ old('rut') }}" required>
                            @error('rut')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email oculto -->
                        <input type="hidden" id="email" name="email" value="">

                        <!-- Contraseña -->
                        <div class="mb-3 form-password-toggle">
                            <label for="password" class="form-label">Contraseña</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" name="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       placeholder="••••••••••••" required>
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                            @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Confirmar Contraseña -->
                        <div class="mb-3 form-password-toggle">
                            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                       class="form-control"
                                       placeholder="••••••••••••" required>
                            </div>
                        </div>

                        <!-- Términos -->
                        <div class="my-3">
                            <div class="form-check mb-0 ms-2">
                                <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                                <label class="form-check-label" for="terms">
                                    Acepto la <a href="#">política de privacidad y términos</a>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary d-grid w-100">Registrarse</button>
                    </form>

                    <p class="text-center mt-4">
                        <span>¿Ya tienes una cuenta?</span>
                        <a href="{{ route('login') }}"><span>Inicia sesión aquí</span></a>
                    </p>

                </div>
            </div>
            <!-- /Register Card -->

        </div>
    </div>
</div>

<!-- Core JS -->
<script src="../../assets/vendor/libs/jquery/jquery.js"></script>
<script src="../../assets/vendor/libs/popper/popper.js"></script>
<script src="../../assets/vendor/js/bootstrap.js"></script>
<script src="../../assets/vendor/libs/node-waves/node-waves.js"></script>
<script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="../../assets/vendor/libs/hammer/hammer.js"></script>
<script src="../../assets/vendor/libs/i18n/i18n.js"></script>
<script src="../../assets/vendor/libs/typeahead-js/typeahead.js"></script>
<script src="../../assets/vendor/js/menu.js"></script>

<script src="../../assets/vendor/libs/@form-validation/popular.js"></script>
<script src="../../assets/vendor/libs/@form-validation/bootstrap5.js"></script>
<script src="../../assets/vendor/libs/@form-validation/auto-focus.js"></script>

<script src="../../assets/js/main.js"></script>
<script src="../../assets/js/pages-auth.js"></script>

<script>
    // Generar email automáticamente en el campo oculto antes de enviar el formulario
    const form = document.querySelector('form');
    form.addEventListener('submit', () => {
        const nombre = document.getElementById('nombre').value.trim().toLowerCase();
        const apellido = document.getElementById('apellido').value.trim().toLowerCase();
        document.getElementById('email').value = `${nombre}.${apellido}@ventasfix.cl`;
    });
</script>
</body>
</html>
