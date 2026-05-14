<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    @php
        $statePath = $getStatePath();
    @endphp

    <div
        x-data="{
            state: $wire.{{ $applyStateBindingModifiers("\$entangle('{$statePath}')") }},
            uploadUrl: @js($getUploadUrl()),
            csrfToken: @js(csrf_token()),
            mediaRecorder: null,
            stream: null,
            chunks: [],
            audioBlob: null,
            previewUrl: null,
            isRecording: false,
            isUploading: false,
            statusMessage: '',

            get hasPreview() {
                return !!this.audioBlob;
            },

            init() {
                if (this.state) {
                    this.previewUrl = this.state;
                    this.statusMessage = 'Hay un audio cargado. Puedes reemplazarlo grabando de nuevo.';
                }
            },

            async toggleRecording() {
                if (this.isUploading) {
                    return;
                }

                if (this.isRecording) {
                    this.stopRecording();
                    return;
                }

                await this.startRecording();
            },

            async startRecording() {
                this.clearPreview();
                this.statusMessage = '';

                if (!navigator.mediaDevices || !window.MediaRecorder) {
                    this.statusMessage = 'Tu navegador no soporta grabacion de audio.';
                    return;
                }

                try {
                    this.stream = await navigator.mediaDevices.getUserMedia({ audio: true });
                    this.chunks = [];
                    this.mediaRecorder = new MediaRecorder(this.stream);
                    this.mediaRecorder.ondataavailable = (event) => {
                        if (event.data.size > 0) {
                            this.chunks.push(event.data);
                        }
                    };
                    this.mediaRecorder.onstop = () => {
                        this.audioBlob = new Blob(this.chunks, { type: this.mediaRecorder.mimeType || 'audio/webm' });
                        this.previewUrl = URL.createObjectURL(this.audioBlob);
                        this.stopStreamTracks();
                        this.uploadRecording();
                    };

                    this.mediaRecorder.start();
                    this.isRecording = true;
                    this.state = null;
                    this.statusMessage = 'Grabando...';
                } catch (error) {
                    this.statusMessage = 'No fue posible iniciar la grabacion.';
                }
            },

            stopRecording() {
                if (!this.mediaRecorder || this.mediaRecorder.state === 'inactive') {
                    return;
                }

                this.mediaRecorder.stop();
                this.isRecording = false;
            },

            async uploadRecording() {
                if (!this.audioBlob) {
                    this.statusMessage = 'Primero graba un audio.';
                    return;
                }

                this.isUploading = true;
                this.statusMessage = 'Subiendo audio...';

                const extension = this.audioBlob.type.includes('ogg')
                    ? 'ogg'
                    : this.audioBlob.type.includes('wav')
                        ? 'wav'
                        : this.audioBlob.type.includes('mpeg')
                            ? 'mp3'
                            : this.audioBlob.type.includes('mp4')
                                ? 'm4a'
                                : 'webm';

                const file = new File([this.audioBlob], `recording.${extension}`, { type: this.audioBlob.type || 'audio/webm' });
                const formData = new FormData();
                formData.append('audio', file);

                try {
                    const response = await fetch(this.uploadUrl, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': this.csrfToken,
                            'Accept': 'application/json',
                        },
                        body: formData,
                        credentials: 'same-origin',
                    });

                    const payload = await response.json().catch(() => ({}));

                    if (!response.ok) {
                        const message = payload.message || payload.errors?.audio?.[0] || 'No fue posible subir el audio.';
                        throw new Error(message);
                    }

                    this.state = payload.url ?? payload.path;
                    this.statusMessage = 'Audio guardado correctamente.';
                } catch (error) {
                    this.statusMessage = error.message || 'No fue posible subir el audio. Intenta nuevamente.';
                } finally {
                    this.isUploading = false;
                }
            },

            resetState() {
                this.state = null;
                this.clearPreview();
                this.statusMessage = '';
            },

            clearPreview() {
                if (this.previewUrl) {
                    URL.revokeObjectURL(this.previewUrl);
                }

                this.previewUrl = null;
                this.audioBlob = null;
                this.chunks = [];
            },

            stopStreamTracks() {
                if (!this.stream) {
                    return;
                }

                this.stream.getTracks().forEach((track) => track.stop());
                this.stream = null;
            },
        }"
        x-init="init()"
        {{ $getExtraAttributeBag() }}
        class="space-y-3"
    >
        <input
            type="hidden"
            x-model="state"
            {{ $applyStateBindingModifiers('wire:model') }}="{{ $statePath }}"
        />

        <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-white/10 dark:bg-gray-900">
            <div class="flex flex-wrap items-center gap-3">
                <x-filament::button
                    type="button"
                    color="primary"
                    size="sm"
                    x-show="! isRecording"
                    x-bind:disabled="isUploading"
                    x-on:click="toggleRecording"
                >
                    Grabar audio
                </x-filament::button>

                <x-filament::button
                    type="button"
                    color="danger"
                    size="sm"
                    x-show="isRecording"
                    x-bind:disabled="isUploading"
                    x-on:click="toggleRecording"
                >
                    Detener grabacion
                </x-filament::button>

                <x-filament::button
                    type="button"
                    color="gray"
                    size="sm"
                    x-show="hasPreview || state"
                    x-bind:disabled="isUploading"
                    x-on:click="resetState"
                >
                    Limpiar
                </x-filament::button>
            </div>

            <p x-show="statusMessage" x-text="statusMessage" class="mt-3 text-sm text-gray-600 dark:text-gray-300"></p>

            <template x-if="previewUrl">
                <div class="mt-4 rounded-lg border border-gray-200 bg-gray-50 p-3 dark:border-white/10 dark:bg-white/5">
                    <p class="mb-2 text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Vista previa</p>
                    <audio controls x-bind:src="previewUrl" class="w-full"></audio>
                </div>
            </template>
        </div>
    </div>

</x-dynamic-component>
