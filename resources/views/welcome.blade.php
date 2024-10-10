<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agronova - Información Agrícola en Tiempo Real</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4CAF50;
            --secondary-color: #45a049;
            --dark-color: #2c3e50;
            --light-color: #f1f8e9;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-color);
            color: var(--dark-color);
        }

        .navbar {
    position: fixed; /* Fija la navbar en la parte superior */
    top: 0;
    width: 100%;
    background-color: rgba(255, 255, 255, 0.95);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    z-index: 1000; 
    padding: 0;
    height: 70px;
}

.navbar.scroll {
    background-color: rgba(255, 255, 255, 0.95); 
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}


        .navbar-brand {
            height: 100%;
            display: flex;
            align-items: center;
        }

        .navbar-brand img {
            height: 70px !important;
            width: auto !important;
            max-height: none !important;
            margin: 0;
            padding: 0;
        }

        .navbar-toggler {
            margin-top: auto;
            margin-bottom: auto;
        }

        .nav-link {
            color: var(--dark-color) !important;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
        }

        .hero-section {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('images/presentation.png?height=1080&width=1920');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }

        .hero-content {
            max-width: 800px;
            padding: 20px;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 2rem;
        }

        .section {
            padding: 100px 0;
        }

        .icon {
            font-size: 4rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        .card:hover .icon {
            transform: scale(1.1);
        }

        .card-body {
            padding: 2rem;
        }

        .card-body h4 {
            color: var(--primary-color);
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 10px 30px;
            font-size: 1.1rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .footer {
            background: #2c5e2e;
            color: white;
            text-align: center;
            padding: 30px 0;
        }

        .footer a {
            color: var(--light-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: var(--secondary-color);
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }

        .floating {
            animation: float 6s ease-in-out infinite;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 991px) {
            .navbar-collapse {
                position: fixed;
                top: 70px;
                left: 0;
                padding-left: 15px;
                padding-right: 15px;
                padding-bottom: 15px;
                width: 100%;
                height: calc(100% - 70px);
                background-color: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(10px);
                transition: all 0.3s ease-in-out;
                transform: translateX(-100%);
                z-index: 1000;
            }

            .navbar-collapse.show {
                transform: translateX(0);
            }

            .navbar-nav {
                align-items: center;
            }

            .nav-item {
                margin: 10px 0;
            }

            .nav-link {
                font-size: 1.2rem;
                padding: 10px 0;
                color: var(--dark-color) !important;
            }

            .nav-link:hover {
                color: var(--primary-color) !important;
                background-color: rgba(76, 175, 80, 0.1);
                border-radius: 5px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="images/Loguito.png" alt="Logo" class="floating">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#servicios">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contacto">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">Agronova: Innovación Agrícola</h1>
            <p class="hero-subtitle">Transformando la agricultura con tecnología de vanguardia</p>
        </div>
    </section>

    <!-- Services Section -->
    <section id="servicios" class="section">
        <div class="container">
            <h2 class="text-center mb-5" data-aos="fade-up">Nuestros Servicios Innovadores</h2>
            <div class="row">
                <?php
                $services = [
                    [
                        'icon' => 'bi-clock',
                        'title' => 'Consultas en tiempo real',
                        'description' => 'Obtén respuestas inmediatas sobre tu cultivo, desde cómo plantar hasta la gestión de plagas y enfermedades.'
                    ],
                    [
                        'icon' => 'bi-cloud-sun',
                        'title' => 'Información sobre clima y suelo',
                        'description' => 'Accede a recomendaciones basadas en las condiciones locales de tu terreno, con el clima y la calidad del suelo.'
                    ],
                    [
                        'icon' => 'bi-tree',
                        'title' => 'Técnicas Modernas y Sostenibles',
                        'description' => 'Aprende sobre métodos agrícolas innovadores para optimizar tus recursos y mejorar tus rendimientos de manera ecológica.'
                    ]
                ];

                foreach ($services as $index => $service) {
                    echo '<div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="' . ($index * 100) . '">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="bi ' . $service['icon'] . ' icon"></i>
                                <h4>' . $service['title'] . '</h4>
                                <p>' . $service['description'] . '</p>
                            </div>
                        </div>
                    </div>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contacto" class="section bg-light">
        <div class="container">
            <h2 class="text-center mb-5" data-aos="fade-up">Contáctanos</h2>
            <div class="row justify-content-center">
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Mensaje</label>
                            <textarea class="form-control" id="message" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Enviar Mensaje</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> Agronova. Todos los derechos reservados. <a href="#">Política de privacidad</a></p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                document.querySelector('.navbar').style.padding = '5px 0';
                document.querySelector('.navbar-brand img').style.height = '40px';
            } else {
                document.querySelector('.navbar').style.padding = '10px 0';
                document.querySelector('.navbar-brand img').style.height = '50px';
            }
        });

        // Mejorar la interacción del menú responsive
        document.querySelectorAll('.navbar-nav a').forEach(link => {
            link.addEventListener('click', () => {
                const navbarCollapse = document.querySelector('.navbar-collapse');
                const navbarToggler = document.querySelector('.navbar-toggler');
                if (navbarCollapse.classList.contains('show')) {
                    navbarCollapse.classList.remove('show');
                    navbarToggler.classList.add('collapsed');
                    navbarToggler.setAttribute('aria-expanded', 'false');
                }
            });
        });
    </script>
</body>
</html>