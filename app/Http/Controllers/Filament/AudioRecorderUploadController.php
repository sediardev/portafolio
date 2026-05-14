<?php

namespace App\Http\Controllers\Filament;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AudioRecorderUploadController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'audio' => ['required', 'file', 'max:20480'],
        ]);

        $audio = $validated['audio'];
        $extension = $audio->getClientOriginalExtension();
        $mimeType = (string) $audio->getMimeType();

        if ($extension === '') {
            $extension = match (true) {
                str_contains($mimeType, 'wav') => 'wav',
                str_contains($mimeType, 'mpeg'), str_contains($mimeType, 'mp3') => 'mp3',
                str_contains($mimeType, 'mp4'), str_contains($mimeType, 'm4a') => 'm4a',
                str_contains($mimeType, 'ogg') => 'ogg',
                default => 'webm',
            };
        }

        $path = 'audio-recordings/'.now()->format('Y/m/d').'/'.Str::uuid().'.'.$extension;

        Storage::disk('public')->putFileAs(
            dirname($path),
            $audio,
            basename($path),
        );

        return response()->json([
            'path' => $path,
        ]);
    }
}
