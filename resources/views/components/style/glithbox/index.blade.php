<a {{ $attributes }} x-data="{
        lightbox: null,
        init() {
            this.lightbox = GLightbox({
                selector: '.glightbox'
            });

            Livewire.on('reinitGlithbox', (message) => {
                if (this.lightbox) {
                    // this.lightbox.destroy();
                    // Clear any internal state
                    this.lightbox = null; // Reset the reference
                    // Wait until DOM updates are completed by Livewire
                    //this.$nextTick(() => {
                        // Ensure the DOM has been updated before re-initializing GLightbox
                    //    if (message[0] != undefined) {
                            // Update GLightbox with the new elements (DOM elements or array of objects)
                    //        this.lightbox = GLightbox({
                                elements: message[0] // Pass new content
                    //        });
                    //    }
                    // });
                }



            });
        }
    }"
    x-init="init()">

    {{ $slot }}
</a>
