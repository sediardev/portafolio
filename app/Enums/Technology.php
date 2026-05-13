<?php

namespace App\Enums;

enum Technology: string
{
    case Laravel = 'Laravel';
    case PHP = 'PHP';
    case SpringBoot = 'SpringBoot';
    case JavaScript = 'JavaScript';
    case CSharp = 'C#';
    case Vue = 'Vue';
    case Python = 'Python';
    case PostgreSQL = 'PostgreSQL';
    case MySQL = 'MySQL';
    case MongoDB = 'MongoDB';
    case Docker = 'Docker';
    case GitHubActions = 'GitHub Actions';
	case Redis = 'Redis';
	case Typescript = 'TypeScript';
	case React = 'React';
	case AWS = 'AWS';
	case Oracle = 'Oracle';
	case TailwindCSS = 'Tailwind CSS';

    public function icon(): string
    {
        return match ($this) {
            self::Laravel => 'devicon-laravel-plain colored',
            self::PHP => 'devicon-php-plain colored',
            self::SpringBoot => 'devicon-spring-plain colored',
            self::JavaScript => 'devicon-javascript-plain colored',
            self::CSharp => 'devicon-csharp-plain colored',
            self::Vue => 'devicon-vuejs-plain colored',
            self::Python => 'devicon-python-plain colored',
            self::PostgreSQL => 'devicon-postgresql-plain colored',
            self::MySQL => 'devicon-mysql-plain colored',
            self::MongoDB => 'devicon-mongodb-plain colored',
            self::Docker => 'devicon-docker-plain colored',
            self::GitHubActions => 'devicon-githubactions-plain colored',
			self::Redis => 'devicon-redis-plain colored',
			self::Typescript => 'devicon-typescript-plain colored',
			self::React => 'devicon-react-original colored',
			self::AWS => 'devicon-amazonwebservices-plain colored',
			self::Oracle => 'devicon-oracle-plain colored',
			self::TailwindCSS => 'devicon-tailwindcss-plain colored',
        };
    }

    public static function fromLabel(string $label): ?self
    {
        foreach (self::cases() as $technology) {
            if ($technology->value === $label) {
                return $technology;
            }
        }

        return null;
    }

    public static function keyIconMap(): array
    {
        $technologies = [];

        foreach (self::cases() as $technology) {
            $technologies[$technology->value] = $technology->icon();
        }

        return $technologies;
    }
}
