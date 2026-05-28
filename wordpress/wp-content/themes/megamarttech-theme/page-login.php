<?php
/* Template Name: Login Page*/
// Archivo independiente - SÍ incluye todo el header y footer en duro.

$error_message = '';
$success_message = '';

// Procesar login
if (isset($_POST['login_submit'])) {
    $username = sanitize_user($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['rememberme']);
    
    if (!empty($username) && !empty($password)) {
        $credentials = array(
            'user_login'    => $username,
            'user_password' => $password,
            'remember'      => $remember,
        );
        $user = wp_signon($credentials);
        
        if (is_wp_error($user)) {
            $error_message = $user->get_error_message();
        } else {
            wp_redirect(home_url('/'));
            exit;
        }
    } else {
        $error_message = 'Por favor ingresa tu usuario y contraseña.';
    }
}

// Procesar registro
if (isset($_POST['register_submit'])) {
    $username = sanitize_user($_POST['reg_username'] ?? '');
    $email = sanitize_email($_POST['reg_email'] ?? '');
    $password = $_POST['reg_password'] ?? '';
    $password_confirm = $_POST['reg_password_confirm'] ?? '';
    
    if (empty($username) || empty($email) || empty($password)) {
        $error_message = 'Todos los campos son obligatorios.';
    } elseif ($password !== $password_confirm) {
        $error_message = 'Las contraseñas no coinciden.';
    } elseif (strlen($password) < 8) {
        $error_message = 'La contraseña debe tener mínimo 8 caracteres.';
    } elseif (!is_email($email)) {
        $error_message = 'Correo electrónico no válido.';
    } elseif (username_exists($username)) {
        $error_message = 'El nombre de usuario ya existe.';
    } elseif (email_exists($email)) {
        $error_message = 'El correo electrónico ya está registrado.';
    } else {
        $user_id = wp_create_user($username, $password, $email);
        if (is_wp_error($user_id)) {
            $error_message = $user_id->get_error_message();
        } else {
            $credentials = array(
                'user_login'    => $username,
                'user_password' => $password,
                'remember'      => true,
            );
            wp_signon($credentials);
            $success_message = 'Registro exitoso. Bienvenido ' . $username;
            echo '<meta http-equiv="refresh" content="1;url=' . home_url('/') . '">';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión / Registrarse - MegaMartTech</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/style.css" />
    <?php wp_head(); ?>
</head>
<body class="bg-light d-flex flex-column min-vh-100">

    <header>
        <div class="bg-primary text-white py-1 px-3 d-flex justify-content-between align-items-center" style="font-size:0.8rem;">
            <span>¡Bienvenido a MegaMartTech mundial!</span>
            <div class="d-flex gap-3">
                <span><i class="bi bi-geo-alt me-1"></i>Entregar a 423651</span>
                <span><i class="bi bi-truck me-1"></i>Rastrear pedido</span>
                <span><i class="bi bi-tag me-1"></i>Todas las Ofertas</span>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light bg-white py-2 border-bottom shadow-sm">
            <div class="container align-items-center">
                <a class="navbar-brand text-primary fs-3 me-auto d-flex align-items-center gap-2" href="<?php echo home_url('/'); ?>">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/imagenes/logo.png" alt="Logo MegaMartTech" height="40">
                    MegaMartTech
                </a>
                
                <div class="d-none d-lg-flex flex-grow-1 mx-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input class="form-control border-start-0 ps-0" type="search" placeholder="Buscar teléfonos, laptops y más...">
                    </div>
                </div>

                <div class="d-flex gap-3 align-items-center">
                    <a href="#" class="text-decoration-none text-dark d-lg-none d-flex align-items-center gap-1" data-bs-toggle="collapse" data-bs-target="#mobileSearch" aria-expanded="false" aria-controls="mobileSearch">
                        <i class="bi bi-search fs-5"></i>
                    </a>

                    <a href="<?php echo home_url('/nosotros/'); ?>" class="text-decoration-none text-primary d-flex align-items-center gap-1 border border-primary rounded-pill px-3 py-1 bg-primary bg-opacity-10">
                        <i class="bi bi-info-circle-fill fs-6"></i>
                        <span class="d-none d-lg-inline small fw-bold">Nosotros</span>
                    </a>
                    
                    <?php if (is_user_logged_in()) : 
                        $cu = wp_get_current_user(); ?>
                        <a href="<?php echo admin_url('profile.php'); ?>" class="text-decoration-none text-dark d-flex align-items-center gap-1">
                            <i class="bi bi-person-circle fs-5"></i>
                            <span class="d-none d-lg-inline small">Hola, <?php echo esc_html($cu->display_name ?: $cu->user_login); ?></span>
                        </a>
                        <a href="<?php echo wp_logout_url(home_url()); ?>" class="text-decoration-none text-danger d-flex align-items-center gap-1 ms-2 d-none d-lg-flex">
                            <i class="bi bi-box-arrow-right fs-5"></i>
                            <span class="small">Salir</span>
                        </a>
                    <?php else : ?>
                        <a href="<?php echo home_url('/login/'); ?>" class="text-decoration-none text-dark d-flex align-items-center gap-1">
                            <i class="bi bi-person fs-5"></i>
                            <span class="d-none d-lg-inline small">Registrarse / Iniciar Sesión</span>
                        </a>
                    <?php endif; ?>
                    
                    <?php
                    $cart_url = '#';
                    if (function_exists('wc_get_cart_url') && wc_get_cart_url()) {
                        $cart_url = wc_get_cart_url();
                    }
                    ?>
                    <a href="<?php echo $cart_url; ?>" class="text-decoration-none text-dark d-flex align-items-center gap-1">
                        <span class="position-relative d-inline-block">
                            <i class="bi bi-cart fs-5"></i>
                            <span data-cart-count class="badge bg-danger rounded-circle" style="display:none; font-size:0.65rem; position:absolute; top:-8px; right:-10px; padding:4px 6px;"></span>
                        </span>
                        <span class="d-none d-lg-inline small">Carrito</span>
                    </a>
                </div>
            </div>
        </nav>
        
        <div class="collapse d-lg-none border-bottom px-3 py-2 bg-light" id="mobileSearch">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                <input class="form-control border-start-0 ps-0" type="search" placeholder="Buscar...">
            </div>
        </div>

        <nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm py-1">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#categoriesNav" aria-controls="categoriesNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="categoriesNav">
                    <ul class="navbar-nav gap-1 flex-wrap">
                        <li class="nav-item dropdown">
                            <a class="btn btn-primary text-white rounded-pill px-3 py-1 dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size:0.85rem;">
                                <i class="bi bi-controller me-1"></i>Accesorios Inteligentes
                            </a>
                            <ul class="dropdown-menu shadow border-0">
                                <li><a class="dropdown-item" href="<?php echo home_url('/auriculares/'); ?>"><i class="bi bi-headset me-2 text-primary"></i>Auriculares</a></li>
                                <li><a class="dropdown-item" href="<?php echo home_url('/teclados/'); ?>"><i class="bi bi-keyboard me-2 text-primary"></i>Teclados</a></li>
                                <li><a class="dropdown-item" href="<?php echo home_url('/ratones-y-alfombrillas/'); ?>"><i class="bi bi-mouse me-2 text-primary"></i>Ratones y Alfombrillas</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link btn btn-outline-secondary rounded-pill px-3 py-1 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size:0.85rem;">Laptops & Computadoras</a>
                            <ul class="dropdown-menu shadow border-0">
                                <li><a class="dropdown-item" href="#">Laptops Gaming</a></li>
                                <li><a class="dropdown-item" href="#">Estaciones de trabajo</a></li>
                                <li><a class="dropdown-item" href="#">Monitores</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link btn btn-outline-secondary rounded-pill px-3 py-1 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size:0.85rem;">Teléfonos Móviles</a>
                            <ul class="dropdown-menu shadow border-0">
                                <li><a class="dropdown-item" href="#">Gama Alta</a></li>
                                <li><a class="dropdown-item" href="#">Gama Media</a></li>
                                <li><a class="dropdown-item" href="#">Económicos</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link btn btn-outline-secondary rounded-pill px-3 py-1 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size:0.85rem;">Nube & Redes</a>
                            <ul class="dropdown-menu shadow border-0">
                                <li><a class="dropdown-item" href="#">Servicios en la Nube</a></li>
                                <li><a class="dropdown-item" href="#">Routers</a></li>
                                <li><a class="dropdown-item" href="#">Servidores</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link btn btn-outline-secondary rounded-pill px-3 py-1 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size:0.85rem;">Software & Des.</a>
                            <ul class="dropdown-menu shadow border-0">
                                <li><a class="dropdown-item" href="#">Herramientas Dev</a></li>
                                <li><a class="dropdown-item" href="#">Productividad</a></li>
                                <li><a class="dropdown-item" href="#">Licencias</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="flex-grow-1 d-flex align-items-center justify-content-center py-5">
        <div class="w-100" style="max-width: 500px; padding: 0 15px;">
            
            <?php if (!empty($error_message)) : ?>
                <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i><?php echo $error_message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($success_message)) : ?>
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i><?php echo $success_message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="card border-0 shadow-lg">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h1 class="fw-bold mb-2"><i class="bi bi-bag-check me-2"></i>MegaMartTech</h1>
                    <p class="mb-0 opacity-75">Tu tienda tecnológica de confianza</p>
                </div>

                <div class="card-body p-4">
                    <ul class="nav nav-tabs border-bottom mb-4" id="authTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active fw-semibold" id="login-tab" data-bs-toggle="tab"
                                data-bs-target="#login-pane" type="button" role="tab" aria-controls="login-pane"
                                aria-selected="true">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fw-semibold" id="register-tab" data-bs-toggle="tab"
                                data-bs-target="#register-pane" type="button" role="tab" aria-controls="register-pane"
                                aria-selected="false">
                                <i class="bi bi-person-plus me-2"></i>Registrarse
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="authTabsContent">
                        <div class="tab-pane fade show active" id="login-pane" role="tabpanel" aria-labelledby="login-tab">
                            <form id="loginForm" method="POST" action="">
                                <div class="mb-3">
                                    <label for="loginEmail" class="form-label fw-semibold">Usuario o Correo</label>
                                    <input type="text" class="form-control" id="loginEmail" name="username"
                                        placeholder="Tu usuario o email" required>
                                </div>

                                <div class="mb-3">
                                    <label for="loginPassword" class="form-label fw-semibold">Contraseña</label>
                                    <input type="password" class="form-control" id="loginPassword" name="password"
                                        placeholder="Ingresa tu contraseña" required>
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="rememberMe" name="rememberme">
                                    <label class="form-check-label" for="rememberMe">
                                        Recuérdame
                                    </label>
                                </div>

                                <button type="submit" name="login_submit" class="btn btn-primary w-100 fw-semibold mb-2">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
                                </button>

                                <div class="text-center">
                                    <a href="<?php echo wp_lostpassword_url(); ?>" class="text-decoration-none text-primary small fw-semibold">
                                        ¿Olvidaste tu contraseña?
                                    </a>
                                </div>
                            </form>

                            <hr class="my-4">

                            <p class="text-center text-muted small fw-semibold mb-3">O CONTINÚA CON</p>

                            <div class="d-flex gap-3 justify-content-center">
                                <button class="btn btn-outline-secondary btn-sm rounded-circle p-2" title="Google">
                                    <i class="bi bi-google"></i>
                                </button>
                                <button class="btn btn-outline-secondary btn-sm rounded-circle p-2" title="Facebook">
                                    <i class="bi bi-facebook"></i>
                                </button>
                                <button class="btn btn-outline-secondary btn-sm rounded-circle p-2" title="Twitter">
                                    <i class="bi bi-twitter"></i>
                                </button>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="register-pane" role="tabpanel" aria-labelledby="register-tab">
                            <form id="registerForm" method="POST" action="">
                                <div class="mb-3">
                                    <label for="registerName" class="form-label fw-semibold">Nombre de Usuario</label>
                                    <input type="text" class="form-control" id="registerName" name="reg_username"
                                        placeholder="Un nombre de usuario único" required>
                                </div>

                                <div class="mb-3">
                                    <label for="registerEmail" class="form-label fw-semibold">Correo Electrónico</label>
                                    <input type="email" class="form-control" id="registerEmail" name="reg_email"
                                        placeholder="tu@email.com" required>
                                </div>

                                <div class="mb-3">
                                    <label for="registerPassword" class="form-label fw-semibold">Contraseña</label>
                                    <input type="password" class="form-control" id="registerPassword" name="reg_password"
                                        placeholder="Mínimo 8 caracteres" required>
                                </div>

                                <div class="mb-3">
                                    <label for="registerPasswordConfirm" class="form-label fw-semibold">Confirmar Contraseña</label>
                                    <input type="password" class="form-control" id="registerPasswordConfirm" name="reg_password_confirm"
                                        placeholder="Repite tu contraseña" required>
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="agreeTerms" required>
                                    <label class="form-check-label" for="agreeTerms">
                                        Acepto los <a href="#" class="text-decoration-none text-primary">términos y condiciones</a>
                                    </label>
                                </div>

                                <button type="submit" name="register_submit" class="btn btn-primary w-100 fw-semibold mb-2">
                                    <i class="bi bi-person-plus me-2"></i>Crear Cuenta
                                </button>
                            </form>

                            <hr class="my-4">

                            <p class="text-center text-muted small fw-semibold mb-3">O REGÍSTRATE CON</p>

                            <div class="d-flex gap-3 justify-content-center">
                                <button class="btn btn-outline-secondary btn-sm rounded-circle p-2" title="Google">
                                    <i class="bi bi-google"></i>
                                </button>
                                <button class="btn btn-outline-secondary btn-sm rounded-circle p-2" title="Facebook">
                                    <i class="bi bi-facebook"></i>
                                </button>
                                <button class="btn btn-outline-secondary btn-sm rounded-circle p-2" title="Twitter">
                                    <i class="bi bi-twitter"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mt-4">
                        <a href="<?php echo home_url('/'); ?>" class="btn btn-outline-primary fw-semibold">
                            <i class="bi bi-arrow-left me-1"></i>Volver al inicio
                        </a>
                        <a href="<?php echo home_url('/nosotros/'); ?>" class="btn btn-primary fw-semibold">
                            <i class="bi bi-info-circle me-1"></i>Conocer nosotros
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-primary text-white py-5 mt-4">
        <div class="container">
            <div class="row g-4">

                <div class="col-12 col-md-4">
                    <h4 class="fw-bold mb-3">MegaMartTech</h4>
                    <p class="fw-semibold mb-2">Contáctanos</p>
                    <p class="mb-1 small">
                        <i class="bi bi-whatsapp me-2"></i>WhatsApp<br>
                        <span class="ms-4">+51 912 345 678</span>
                    </p>
                    <p class="mb-3 small">
                        <i class="bi bi-telephone me-2"></i>Llámanos<br>
                        <span class="ms-4">+51 912 345 678</span>
                    </p>
                    <p class="fw-semibold mb-2">Descargar Aplicación</p>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="#"><img src="https://upload.wikimedia.org/wikipedia/commons/3/3c/Download_on_the_App_Store_Badge.svg" alt="App Store" height="36"></a>
                        <a href="#"><img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" alt="Google Play" height="36"></a>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <p class="fw-semibold mb-3">Categorías Más Populares</p>
                    <ul class="list-unstyled small">
                        <li class="mb-1"><a href="#" class="text-white text-decoration-none">› Accesorios</a></li>
                        <li class="mb-1"><a href="#" class="text-white text-decoration-none">› Laptops</a></li>
                        <li class="mb-1"><a href="#" class="text-white text-decoration-none">› Teléfonos Móviles</a></li>
                        <li class="mb-1"><a href="#" class="text-white text-decoration-none">› Redes</a></li>
                        <li class="mb-1"><a href="#" class="text-white text-decoration-none">› Software</a></li>
                    </ul>
                </div>

                <div class="col-12 col-md-4">
                    <p class="fw-semibold mb-3">Servicio al Cliente</p>
                    <ul class="list-unstyled small">
                        <li class="mb-1"><a href="#" class="text-white text-decoration-none">› Acerca de Nosotros</a></li>
                        <li class="mb-1"><a href="#" class="text-white text-decoration-none">› Términos y Condiciones</a></li>
                        <li class="mb-1"><a href="#" class="text-white text-decoration-none">› Preguntas Frecuentes</a></li>
                        <li class="mb-1"><a href="#" class="text-white text-decoration-none">› Política de Privacidad</a></li>
                        <li class="mb-1"><a href="#" class="text-white text-decoration-none">› Política de Cancelación y Devolución</a></li>
                    </ul>
                </div>

            </div>
            <hr class="border-white mt-4">
            <p class="text-center small mb-0">© <?php echo date('Y'); ?> Todos los derechos reservados. MegaMartTech.</p>
        </div>
    </footer>

    <a href="https://wa.me/51912345678" target="_blank"
        class="position-fixed bottom-0 end-0 m-4 btn btn-success rounded-circle shadow-lg d-flex align-items-center justify-content-center"
        style="width:56px; height:56px; z-index:1050;">
        <i class="bi bi-whatsapp fs-4"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.querySelectorAll('.btn-outline-secondary').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const platform = this.getAttribute('title');
                alert(`Conectar con ${platform} (funcionalidad en desarrollo)`);
            });
        });
    </script>

    <?php wp_footer(); ?>
</body>
</html>