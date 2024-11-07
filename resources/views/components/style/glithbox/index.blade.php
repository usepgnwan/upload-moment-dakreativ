
<a {{ $attributes }} x-data="{
        init() {
            let lightbox = GLightbox({
                selector: '.glightbox'
            });

            Livewire.hook('message.processed', (message, component) => {
                lightbox.destroy();
                lightbox = GLightbox({ selector: '.glightbox' });
            });
        }
    }"
    x-init="init()">

        {{ $slot }}

</a>
