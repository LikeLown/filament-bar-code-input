<script src="https://unpkg.com/html5-qrcode"></script>

@php
    $id = $getId() . '-bar-code';
    $isDisabled = $isDisabled();
    $qrBoxWidth = $getQrBoxWidth();
    $qrBoxHeight = $getQrBoxHeight();
    $fps = $getFps();
@endphp

<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div x-data="{
    cameraErrorMessage: '{{ trans('filament-bar-code-input::bar-code-input.unable_to_access_camera') }}',
            state: $wire.{{ $applyStateBindingModifiers("\$entangle('{$getStatePath()}')") }},
            fps : @js($fps),
            qrBoxWidth : @js($qrBoxWidth),
            qrBoxHeight : @js($qrBoxHeight),
            scanning: false,
            html5QrCode: null,
            modalId : @js($id) + '-modal',
            startScanner() {
                this.scanning = true;
                this.$nextTick(() => {
                    this.html5QrCode = new Html5Qrcode('reader');
                    const config = {
                        fps: this.fps,
                        qrbox: { width: this.qrBoxWidth, height: this.qrBoxHeight },
                    };
                    
                    this.html5QrCode.start(
                        { facingMode: 'environment' },
                        config,
                        (decodedText) => {
                            this.state = decodedText;
                            this.stopScanner();
                            this.closeModal();
                        },
                        (error) => {
                            // error
                        }
                    ).catch((err) => {
                        alert(this.cameraErrorMessage);
                        this.closeModal();
                    });
                });
            },
            
            stopScanner() {
                if (this.html5QrCode) {
                    this.html5QrCode.stop().catch((err) => {
                        console.error('Error stopping scanner:', err);
                    });
                    this.html5QrCode = null;
                }
                this.scanning = false;
            },
            
            openModal() {
                $dispatch('open-modal', { id: this.modalId });
                this.startScanner();
            },
            
            closeModal() {
                this.stopScanner();
                $dispatch('close-modal', { id: this.modalId });
            }
        }" @barcode-scanned.window="state = $event.detail" @keydown.escape.window="if (scanning) closeModal()">
        <x-filament::input.wrapper :disabled="$isDisabled" class="relative">
            <x-filament::input :disabled="$isDisabled" id="{{ $id }}" x-model="state" type="text" />
            <button {{ $isDisabled ? 'disabled' : '' }} type="button" x-on:click="openModal()"
                class="flex absolute inset-y-0 right-0 items-center pr-3 focus:outline-none" aria-label="Scan Barcode">
                @if($getExtraAttributes()['icon'] ?? null)
                    <span class="text-gray-400 dark:text-gray-200">
                        <x-dynamic-component :component="$getExtraAttributes()['icon']" class="w-5 h-5" />
                    </span>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 dark:text-gray-200"
                        viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M3 4h2v16H3V4zm4 0h2v16H7V4zm4 0h2v16h-2V4zm4 0h2v16h-2V4zm4 0h2v16h-2V4z" />
                    </svg>
                @endif
            </button>
        </x-filament::input.wrapper>

        <x-filament::modal id="{{ $id }}-modal" @close="stopScanner()">
            <x-slot name="header">
                <h2 class="text-lg font-semibold">
                    {{  trans('filament-bar-code-input::bar-code-input.scan_bar_code')  }}
                </h2>
            </x-slot>

            <div class="p-4">
                <div id="reader" class="rounded-lg shadow" style="width: 100%;"></div>
            </div>

            <x-slot name="footer">
                <x-filament::button x-on:click="closeModal()" color="danger">
                    {{ trans('filament-bar-code-input::bar-code-input.close')  }}
                </x-filament::button>
            </x-slot>
        </x-filament::modal>
    </div>
</x-dynamic-component>