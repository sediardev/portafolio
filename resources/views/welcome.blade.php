<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Portafolio de Servicios | Desarrollador Full-Stack</title>
	<meta name="description" content="Portafolio profesional de servicios de desarrollo de software: proyectos, habilidades técnicas y experiencia full-stack.">
	<meta name="author" content="Sebastian Diaz Arrieta">
	<meta name="robots" content="index, follow">
	<meta name="theme-color" content="#05070f">
	<link rel="canonical" href="{{ $appUrl }}">

	<meta property="og:type" content="website">
	<meta property="og:title" content="Portafolio de Servicios | Desarrollador Full-Stack">
	<meta property="og:description" content="Servicios de desarrollo de software, proyectos destacados y stack tecnológico.">
	<meta property="og:url" content="{{ $appUrl }}">
	<meta property="og:image" content="{{ versioned_asset('img/favicon.png') }}">

	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="Portafolio de Servicios | Desarrollador Full-Stack">
	<meta name="twitter:description" content="Servicios de desarrollo de software, proyectos destacados y stack tecnológico.">
	<meta name="twitter:image" content="{{ versioned_asset('img/favicon.png') }}">

	<link rel="icon" type="image/x-icon" href="{{ versioned_asset('img/favicon.ico') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ versioned_asset('img/favicon.png') }}">
	<link rel="apple-touch-icon" href="{{ versioned_asset('img/favicon.png') }}">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">
	<link rel="stylesheet" href="{{ versioned_asset('css/welcome.css') }}">

	<script type="application/ld+json">
		{!! json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
	</script>
</head>
<body>
	<header class="site-header" id="inicio">
		<div class="container nav-wrap">
			<a class="brand" href="#inicio" aria-label="Ir al inicio del portafolio">
				<img src="{{ versioned_asset('img/favicon.png') }}" alt="Logotipo del portafolio" width="28" height="28" loading="eager" decoding="async">
				<span>Sediar Dev</span>
			</a>

			<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="nav-menu" aria-label="Abrir menú de navegación">
				<span class="sr-only">Abrir menú</span>
				<span class="hamburger" aria-hidden="true"></span>
			</button>

			<nav aria-label="Navegación principal">
				<div class="nav-menu" id="nav-menu">
					<a href="#sobre-mi">Sobre mí</a>
					<a href="#proyectos">Proyectos</a>
					<a href="#habilidades">Habilidades</a>
					<a href="#tecnologias">Tecnologías</a>
					<a href="#contacto">Contacto</a>
				</div>
			</nav>
		</div>
	</header>

	<main id="contenido-principal">
		<section class="hero" aria-labelledby="titulo-principal">
			<div class="container hero-grid">
				<div>
					<p class="kicker">Servicios de desarrollo web</p>
					<h1 id="titulo-principal">Construyo productos digitales <strong>rapidos, escalables y mantenibles</strong></h1>
					<p class="lead"><span id="typewriter-text" class="lead-dynamic" aria-live="polite" aria-atomic="true"></span><span class="tw-cursor" aria-hidden="true"></span></p>

					<div class="actions" role="group" aria-label="Acciones principales">
						<a class="btn btn-primary" href="#proyectos">Ver proyectos</a>
						<a class="btn btn-secondary" href="#contacto">Solicitar propuesta</a>
					</div>

					<p class="stats" aria-label="Datos destacados del perfil">
						<span><b>+{{ $yearsOfExperience }}</b> años programando</span>
						<span><b>+{{ $numberOfProjects }}</b> proyectos</span>
						<span><b>99%</b> satisfacción del cliente</span>
					</p>
				</div>

				<aside class="hero-card" aria-label="Especialidad profesional" data-reveal data-delay="1">
					<h2>Especialidad</h2>
					<p>Arquitectura web moderna, APIs, automatización de procesos con ia y maquetado de bases de datos.</p>
				</aside>
			</div>
		</section>

		<section class="section" id="sobre-mi" aria-labelledby="titulo-sobre-mi">
			<div class="container">
				<h2 class="section-title" id="titulo-sobre-mi">Sobre mí</h2>
				<p class="section-subtitle">Soy ingeniero de sistemas con más de 6 años de experiencia en el desarrollo de soluciones digitales orientadas a mejorar procesos y facilitar la operación de las organizaciones.</p>

				<div class="about-grid">
					<article class="card" data-reveal data-delay="1">
						<p>A lo largo de los proyectos en los que he participado, he contribuido al análisis de necesidades, diseño de soluciones y desarrollo de aplicaciones, buscando siempre que las herramientas implementadas sean útiles, sostenibles y realmente adoptadas por los usuarios.</p>
					</article>
					<article class="card" data-reveal data-delay="2">
						<p>Me interesa comprender el problema antes de plantear una solución, evaluando alternativas y priorizando aquellas que aporten valor práctico. He trabajado en entornos donde es necesario equilibrar lo técnico con lo operativo, colaborando con equipos multidisciplinarios y adaptando las soluciones al contexto real.</p>
					</article>
					<article class="card" data-reveal data-delay="3">
						<p>Trabajo bajo enfoques ágiles cuando aportan claridad al proceso, manteniendo una visión flexible y orientada a resultados.</p>
					</article>
				</div>
			</div>
		</section>

		<section class="section" id="proyectos" aria-labelledby="titulo-proyectos">
			<div class="container">
				<h2 class="section-title" id="titulo-proyectos">Proyectos</h2>

				<div class="projects-grid">
					@foreach ($projects as $project)
					<article class="project-card" data-reveal data-delay="{{ $loop->iteration }}">
						<div class="project-card-inner">
							<div class="project-face project-face-front">
								<div class="project-cover">
									<img src="{{ versioned_asset($project['image']) }}" alt="{{ $project['alt'] }}" loading="lazy" decoding="async">
								</div>
								<div class="project-body">
									<h3>{{ $project['name'] }}</h3>
									<p>{{ $project['description'] }}</p>
									<div class="project-actions">
										<a class="project-link" href="{{ $project['url'] }}" target="_blank" rel="noopener noreferrer">Visitar proyecto</a>
										<button class="project-flip-btn" type="button" data-flip-card aria-label="Ver tecnologias usadas en {{ $project['name'] }}">Ver stack</button>
									</div>
								</div>
							</div>

							<div class="project-face project-face-back" inert>
								<div class="project-body project-back-body">
									<h3>{{ $project['name'] }}</h3>
									<p class="project-back-label">Tecnologias usadas</p>
									<ul class="project-tech-list" aria-label="Tecnologias del proyecto {{ $project['name'] }}">
										@foreach ($project['stack'] as $technology)
										<li class="project-tech-item">
											<i class="{{ $technology->icon() }}" aria-hidden="true"></i>
											<span>{{ $technology->value }}</span>
										</li>
										@endforeach
									</ul>
									<button class="project-flip-btn" type="button" data-flip-card aria-label="Volver a la vista principal de {{ $project['name'] }}">Volver</button>
								</div>
							</div>
						</div>
					</article>
					@endforeach
				</div>
			</div>
		</section>

		<section class="section" id="habilidades" aria-labelledby="titulo-habilidades">
			<div class="container">
				<h2 class="section-title" id="titulo-habilidades">Habilidades</h2>
				<p class="section-subtitle">Fortalezas construidas desde la migración de sistemas, la automatización de procesos y el desarrollo de soluciones que deben operar con estabilidad en contextos reales.</p>

				<div class="skill-list" role="list" aria-label="Listado de habilidades">
					<div class="skill-item" role="listitem" data-reveal data-delay="1">Migración progresiva de sistemas legacy</div>
					<div class="skill-item" role="listitem" data-reveal data-delay="2">Diseño de procesos backend sostenibles</div>
					<div class="skill-item" role="listitem" data-reveal data-delay="3">Integración de plataformas y servicios externos</div>
					<div class="skill-item" role="listitem" data-reveal data-delay="4">Automatización de flujos y sincronización de datos</div>
					<div class="skill-item" role="listitem" data-reveal data-delay="5">Desarrollo orientado a operación crítica</div>
					<div class="skill-item" role="listitem" data-reveal data-delay="6">Colaboración técnica y decisiones de arquitectura</div>
				</div>
			</div>
		</section>

		<section class="section" id="tecnologias" aria-labelledby="titulo-tecnologias">
			<div class="container">
				<h2 class="section-title" id="titulo-tecnologias">Tecnologías que he usado</h2>

				<div class="tech-carousel" data-reveal>
					<div class="swiper tech-swiper" aria-label="Carrusel de tecnologías">
						<div class="swiper-wrapper">
							@foreach ($technologies as $techName => $techIcon)
							<div class="swiper-slide" aria-label="{{ $techName }}">
								<div class="tech-item">
									<i class="{{ $techIcon }}" aria-hidden="true"></i>
									<span>{{ $techName }}</span>
								</div>
							</div>
							@endforeach
						</div>
						<div class="swiper-pagination"></div>
					</div>
				</div>
			</div>
		</section>
	</main>

	<footer class="site-footer" id="contacto">
		<div class="container contact-wrap">
			<div>
				<h2 class="section-title contact-title">Contacto</h2>
				<p class="contact-text">Si quieres conversar sobre un proyecto, una mejora técnica o una colaboración, puedes escribirme o contactarme por mis redes profesionales.</p>
			</div>

			<div class="contact-links" aria-label="Canales de contacto">
				<div class="contact-link contact-link-mail" data-email="sediardev@gmail.com">
					<span>Correo</span>
					<strong>sediardev@gmail.com</strong>
					<div class="contact-actions">
						<a class="contact-mailto" href="mailto:sediardev@gmail.com">Escribirme</a>
						<button class="copy-button" type="button" aria-label="Copiar correo electrónico">
							<span class="copy-button-text">Copiar</span>
						</button>
					</div>
				</div>
				<a class="contact-link" href="https://github.com/sediardev" target="_blank" rel="noopener noreferrer" aria-label="GitHub de Sebastian Diaz Arrieta">
					<i class="devicon-github-original" aria-hidden="true"></i>
					<span>GitHub</span>
					<strong>@sediardev</strong>
				</a>
				<a class="contact-link" href="https://www.linkedin.com/in/sebastian-diaz-arrieta-859384209/" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn de Sebastian Diaz Arrieta">
					<i class="devicon-linkedin-plain colored" aria-hidden="true"></i>
					<span>LinkedIn</span>
					<strong>Sebastian Diaz Arrieta</strong>
				</a>
			</div>
		</div>
	</footer>

	<script id="tw-phrases" type="application/json">{!! json_encode($typewriterPhrases, JSON_UNESCAPED_UNICODE) !!}</script>
	<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
	<script src="{{ versioned_asset('js/welcome.js') }}"></script>
</body>
</html>

