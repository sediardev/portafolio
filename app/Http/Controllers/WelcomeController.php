<?php

namespace App\Http\Controllers;

use App\Enums\Technology;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        $appUrl = rtrim(config('app.url'), '/') . '/';

        $yearsOfExperience = now()->year - 2020;

        $typewriterPhrases = [
            'Ayudo a empresas y emprendedores a convertir ideas en aplicaciones web robustas.',
            'Diseno soluciones backend estables para procesos criticos y equipos exigentes.',
            'Construyo APIs y plataformas escalables que soportan crecimiento real.',
            'Conecto sistemas, automatizo flujos y acelero operaciones de negocio.',
            'Transformo necesidades tecnicas en productos web mantenibles y confiables.',
        ];

        $technologies = Technology::keyIconMap();

        $projects = [
            [
                'name'        => 'BedViajes',
                'description' => 'Plataforma para publicar y gestionar propiedades vacacionales. Desarrolle modulos clave como CRUD de alojamientos y reservas, busqueda de propiedades en mapa, reportes operativos e integracion de pasarela de pagos para reservas confiables.',
                'url'         => 'https://bedviajes.com/',
                'image'       => 'img/clientes/bedviajes.png',
                'alt'         => 'Vista previa del proyecto Bed Viajes',
                'stack'       => [
					Technology::Laravel, 
					Technology::PHP, 
					Technology::MySQL,
					Technology::JavaScript,
					Technology::Vue,
					Technology::AWS,
					Technology::Redis,
					Technology::TailwindCSS
				],
            ],
            [
                'name'        => 'BestBooking',
                'description' => 'Solucion web que conecta clientes con hoteles, tours y alojamientos. Aunque no lo desarrolle desde cero, implemente mejoras y correcciones en modulos administrativos, integre pasarela de pagos, optimice reportes y agregue edicion en vivo del PDF de reserva.',
                'url'         => 'https://bestbooking.com.co/',
                'image'       => 'img/clientes/bestbooking.webp',
                'alt'         => 'Vista previa del proyecto Best Booking',
                'stack'       => [
					Technology::Laravel, 
					Technology::PHP, 
					Technology::PostgreSQL,
					Technology::JavaScript,
					Technology::Redis,
				],
            ],
            [
                'name'        => 'Transito App',
                'description' => 'Aplicacion web robusta para modernizar la gestion del transito en Colombia. Trabaje en componentes base del sistema, especialmente en proceso contravencional, proceso coactivo, fotomultas y gestion de titulos judiciales y mandamientos de pago.',
                'url'         => 'https://transitoapp.co/',
                'image'       => 'img/clientes/transito_app.png',
                'alt'         => 'Vista previa del proyecto Transito App',
                'stack'       => [
					Technology::Laravel, 
					Technology::PHP, 
					Technology::SpringBoot,
					Technology::JavaScript,
					Technology::CSharp,
					Technology::Python,
					Technology::MySQL,
					Technology::GitHubActions,
					Technology::Redis,
					Technology::AWS,
				],
            ],
            [
                'name'        => 'Diez Equis',
                'description' => 'Proyecto corporativo para el sector Food Service, institucional y HORECA. Mi aporte se centro en integrar la API oficial de WhatsApp con respuestas asistidas por IA y desarrollar una interfaz completa de mensajeria para recibir y enviar mensajes en multiples formatos.',
                'url'         => 'https://diezequis.com/',
                'image'       => 'img/clientes/diez_equis.png',
                'alt'         => 'Vista previa del proyecto Diez Equis',
                'stack'       => [
					Technology::Laravel, 
					Technology::PHP, 
					Technology::MySQL,
					Technology::PostgreSQL, 
					Technology::React,
					Technology::Oracle,
					Technology::TailwindCSS,
					Technology::Typescript, 
					Technology::Redis,
					Technology::Docker,
					Technology::MongoDB,
				],
            ],
            [
                'name'        => 'Ticworks',
                'description' => 'Plataforma de contratacion de talento tecnologico tipo LinkedIn o Computrabajo. Aunque no lo desarrolle desde cero, realice ajustes visuales en modulos clave e integre una pasarela de pagos con suscripciones en USD.',
                'url'         => 'https://ticworks.tech/',
                'image'       => 'img/clientes/ticworks.svg',
                'alt'         => 'Vista previa del proyecto Ticworks',
                'stack'       => [
					Technology::PHP,
					Technology::JavaScript,
					Technology::MySQL,
				],
            ],
        ];

        $numberOfProjects = count($projects);

        $schema = [
            '@context'    => 'https://schema.org',
            '@type'       => 'Person',
            'name'        => 'Sebastian Diaz Arrieta',
            'jobTitle'    => 'Desarrollador Full-Stack',
            'description' => 'Programador especializado en desarrollo web full-stack y soluciones digitales.',
            'url'         => $appUrl,
            'image'       => versioned_asset('img/favicon.png'),
            'knowsAbout'  => array_map(static fn (Technology $technology): string => $technology->value, Technology::cases()),
        ];

        return view('welcome', compact(
            'appUrl',
            'yearsOfExperience',
            'typewriterPhrases',
            'technologies',
            'projects',
            'numberOfProjects',
            'schema'
        ));
    }
}
