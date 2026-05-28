<?php 
/* Template Name: Nosotros */
get_header(); 
?>
<main class="flex-grow-1">

        <!-- Hero Section Generalista -->
        <section class="bg-primary text-white py-5 text-center shadow-sm position-relative overflow-hidden">
            <div class="position-absolute w-100 h-100 top-0 start-0 opacity-25" style="background-image: url('<?php echo get_template_directory_uri(); ?>/imagenes/clean3.jpg'); background-size: cover; background-position: center;"></div>
            <div class="container py-5 position-relative z-1">
                <h1 class="display-4 fw-bold mb-3"><i class="bi bi-cpu text-light me-3"></i>Tu Destino Tecnológico Global</h1>
                <p class="lead fw-normal mx-auto" style="max-width: 800px;">
                    Desde laptops y smartphones, hasta servidores en la nube, gaming gear y herramientas de desarrollo. MegaMartTech es tu tienda tecnológica global con las soluciones más innovadoras para tu negocio y entretenimiento.
                </p>
            </div>
        </section>

        <!-- Nuestra Historia y Misión -->
        <section class="container my-5 py-4">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="bg-white p-2 shadow-sm rounded-4 border-start border-5 border-primary">
                        <img src="<?php echo get_template_directory_uri(); ?>/imagenes/clean2.jpg" 
                            alt="MegaMartTech Technology" class="img-fluid rounded-3">
                    </div>
                </div>
                <div class="col-lg-6">
                    <h6 class="text-primary fw-bold text-uppercase tracking-wider">Nuestra Historia</h6>
                    <h2 class="fw-bold mb-4">De una startup de tech a líder global en innovación</h2>
                    <p class="text-muted mb-4 text-justify">
                        Comenzamos con la visión de democratizar la tecnología llevando productos innovadores directamente a manos de desarrolladores, gamers y empresas. Con el tiempo y gracias a la confianza de nuestros clientes tecnológicos, crecimos para incluir servidores en la nube, herramientas de desarrollo, gaming gear y soluciones empresariales. Hoy en día, MegaMartTech conecta miles de productos tecnológicos premium directamente con tu negocio.
                    </p>
                    <div class="d-flex gap-3 mb-3">
                        <div class="text-primary fs-2"><i class="bi bi-rocket-fill"></i></div>
                        <div>
                            <h5 class="fw-bold mb-1">Nuestra Misión</h5>
                            <p class="text-muted small">Empoderar a empresas, desarrolladores y gamers con acceso a tecnología de vanguardia, ofreciendo precios competitivos, soporte técnico experto y soluciones innovadoras garantizadas.</p>
                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        <div class="text-primary fs-2"><i class="bi bi-cpu-fill"></i></div>
                        <div>
                            <h5 class="fw-bold mb-1">Nuestra Visión</h5>
                            <p class="text-muted small">Ser la plataforma de e-commerce tecnológico más grande y confiable del mundo, acelerando la transformación digital de negocios y comunidades globales.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sección Antes y Después (Slider) -->
        <section class="bg-light py-5 border-top border-bottom">
            <div class="container py-4">
                <div class="text-center mb-4">
                    <h6 class="text-primary fw-bold text-uppercase">La Diferencia</h6>
                    <h2 class="fw-bold">Antes y Después del Upgrade</h2>
                    <p class="text-muted">Desliza para ver la transformación de un setup básico a uno profesional.</p>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <!-- Contenedor general usando el CSS personalizado de style.css -->
                        <div class="comparison-slider-wrapper shadow-lg border border-4 border-white">
                            <!-- Imagen Antes -->
                            <img src="<?php echo get_template_directory_uri(); ?>/imagenes/clean.jpg"
                                alt="Antes">
                            
                            <!-- Imagen Después -->
                            <img src="<?php echo get_template_directory_uri(); ?>/imagenes/configuracion-escritorio-vintage-escritorio-antiguo-adornado-articulos-vintage-como-libros-viejos-maquinas-escribir-retro-o-vi_630290-34281.avif"  
                                class="img-after" 
                                id="imgAfter" 
                                alt="Después">
                            
                            <!-- Rango (Slider Invisible) -->
                            <input type="range" min="0" max="100" value="50" 
                                class="comparison-range" 
                                id="sliderRange">
                            
                            <!-- Línea y Botón visual -->
                            <div class="comparison-line shadow" id="sliderLine">
                                <div class="comparison-button bg-primary rounded-circle d-flex justify-content-center align-items-center shadow-lg border border-2 border-white text-white">
                                    <i class="bi bi-arrows-expand"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const slider = document.getElementById('sliderRange');
                const imgAfter = document.getElementById('imgAfter');
                const sliderLine = document.getElementById('sliderLine');
                
                if(slider && imgAfter && sliderLine) {
                    slider.addEventListener('input', (e) => {
                        let value = e.target.value;
                        imgAfter.style.clipPath = `polygon(0 0, ${value}% 0, ${value}% 100%, 0 100%)`;
                        sliderLine.style.left = `${value}%`;
                    });
                }
            });
        </script>

        <!-- Por qué elegirnos -->
        <section class="bg-white py-5">
            <div class="container py-4">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Razones para elegir MegaMartTech</h2>
                    <p class="text-muted">Garantizamos calidad, soporte experto y las mejores soluciones tecnológicas del mercado.</p>
                </div>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 text-center">
                    
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm card-hover p-4 bg-light">
                            <div class="text-primary display-4 mb-3"><i class="bi bi-shield-check"></i></div>
                            <h5 class="fw-bold">Productos Certificados</h5>
                            <p class="text-muted small mb-0">Seleccionamos los mejores productos tecnológicos de marcas certificadas y confiables a nivel mundial.</p>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm card-hover p-4 bg-light">
                            <div class="text-primary display-4 mb-3"><i class="bi bi-cash-coin"></i></div>
                            <h5 class="fw-bold">Precios Competitivos</h5>
                            <p class="text-muted small mb-0">Acceso directo a mayoristas y fabricantes con descuentos especiales en equipos, software y servicios cloud.</p>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm card-hover p-4 bg-light">
                            <div class="text-primary display-4 mb-3"><i class="bi bi-lightning-charge"></i></div>
                            <h5 class="fw-bold">Envío Expresivo</h5>
                            <p class="text-muted small mb-0">Nuestra red logística garantiza que tu equipo tecnológico llegue en perfecto estado y con la mayor rapidez.</p>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm card-hover p-4 bg-light">
                            <div class="text-primary display-4 mb-3"><i class="bi bi-headset"></i></div>
                            <h5 class="fw-bold">Soporte Técnico</h5>
                            <p class="text-muted small mb-0">Equipo de expertos disponible 24/7 para ayudarte con configuración, instalación y soporte postventa.</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Sección de Estadísticas -->
        <section class="container my-5 py-4 text-center">
            <div class="bg-primary text-white rounded-4 shadow p-5 position-relative overflow-hidden">                
                <div class="row row-cols-2 row-cols-md-4 g-4 position-relative z-1">
                    <div class="col">
                        <h2 class="display-5 fw-bold mb-0">15M+</h2>
                        <p class="text-white-50 mb-0">Pedidos Entregados</p>
                    </div>
                    <div class="col">
                        <h2 class="display-5 fw-bold mb-0">50k+</h2>
                        <p class="text-white-50 mb-0">Productos en Catálogo</p>
                    </div>
                    <div class="col">
                        <h2 class="display-5 fw-bold mb-0">100%</h2>
                        <p class="text-white-50 mb-0">Frescura Garantizada</p>
                    </div>
                    <div class="col">
                        <h2 class="display-5 fw-bold mb-0">24/7</h2>
                        <p class="text-white-50 mb-0">Atención al Cliente</p>
                    </div>
                </div>
            </div>
        </section>
    
</main>
<?php get_footer(); ?>