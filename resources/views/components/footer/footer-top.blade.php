<footer  class="footer {{ $bg }}">
    <div class="footer__top">
        <div class="container">
            <div class="row">
                @php
                    $logotype = $bg == 'footer--dark' ? 'dark':'white';
                @endphp
               <x-footer.footer-info :logotype="$logotype"/>
               <x-footer.footer-support/>
               <x-footer.footer-links/>
               <x-footer.footer-category/>
               <!-- <x-footer.footer-app/> -->
            </div>
        </div>
    </div>
    <x-footer.footer-bottom/>
</footer>
