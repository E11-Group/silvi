document.addEventListener("DOMContentLoaded", () => {
    const lazyIframes = document.querySelectorAll(".vimeo-video-frame[data-src]");

    if ("IntersectionObserver" in window) {
        const iframeObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const iframe = entry.target;

                    // Check if the iframe already has a src to avoid resetting
                    if (!iframe.src) {
                        iframe.src = iframe.dataset.src;
                        iframe.removeAttribute("data-src");

                        // Initialize Vimeo Player API and play the video
                        const player = new Vimeo.Player(iframe);
                        var isPlaying = player.currentTime > 0 && !player.paused && !player.ended 
                            && player.readyState > player.HAVE_CURRENT_DATA;

                        if (!isPlaying) {
                            player.play().catch((error) => {
                                console.error("Vimeo autoplay failed:", error);
                            });
                        }
                    }

                    // Stop observing this iframe as it's already loaded
                    observer.unobserve(iframe);
                }
            });
        });

        lazyIframes.forEach((iframe) => {
            iframeObserver.observe(iframe);
        });
    } else {
        // Fallback for older browsers: Load and autoplay immediately
        lazyIframes.forEach((iframe) => {
            if (!iframe.src) {
                iframe.src = iframe.dataset.src;
                iframe.removeAttribute("data-src");

                const player = new Vimeo.Player(iframe);
                var isPlaying = player.currentTime > 0 && !player.paused && !player.ended 
                    && player.readyState > player.HAVE_CURRENT_DATA;
                if (!isPlaying) {
                    player.play().catch((error) => {
                        console.error("Vimeo autoplay failed:", error);
                    });
                }
            }
        });
    }
});