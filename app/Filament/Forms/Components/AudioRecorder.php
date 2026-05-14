<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\Field;

class AudioRecorder extends Field
{
    protected string $view = 'filament.forms.components.audio-recorder';

    public function getUploadUrl(): string
    {
        return route('filament.audio-recorder.upload');
    }
}
