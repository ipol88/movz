    <footer class="footer">
        <div class="container">
            <div class="footer_wrapper d-flex flex-column flex-md-row">
                <div class="copyright">Copyright © <?php echo date('Y') ?> <span class="text-capitalize"><?php echo site_path() ?></span> | All rights
                    reserved</div>
                <div class="footer_links">
                    <a href="<?php echo view_page( 'dmca-notice' );?>">DMCA</a>
                    <a href="<?php echo view_page( 'privacy-policy' );?>">Privacy Policy</a>
                    <a href="<?php echo view_page( 'contact-us' );?>">Contact</a>
                </div>
            </div>
        </div>
    </footer>
<?php echo histats_write() ?>
</body>
</html>