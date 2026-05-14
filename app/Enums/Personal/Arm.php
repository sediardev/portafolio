<?php

namespace App\Enums\Personal;

enum Arm: string
{
	case Left = 'left';
	case Right = 'right';

	public function label(): string
	{
		return match ($this) {
			self::Left => 'Izquierdo',
			self::Right => 'Derecho',
		};
	}
}