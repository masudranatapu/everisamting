<div class="loader">
    <div class="loader-icon">
        <img src="{{ setting('loader_image', true)->loader_image_url }}" alt="loader" />
    </div>
</div>

@push('component_script')
    <script>
        const preloader = document.querySelector(".loader")

        // ===== Page Loader ===== \\
        window.addEventListener("load", (event) => {
            preloader.style.display = "none"
        })
    </script>
@endpush
