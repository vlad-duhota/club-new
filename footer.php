
<footer class="footer">
        <div class="container">
             <div class="footer__col">
                <a href="<?php echo get_site_url() ?>" class="footer__logo">
                <img src="<?php echo carbon_get_theme_option('logo')?>">
                </a>
                <select class="footer__select">
                    <option value="Ukrainian">UA</option>
                    <option value="English">EN(not availabled yet)</option>
                </select>
             </div>
             <?php
             wp_nav_menu( array( 
                    'theme_location' => 'footer_menu', 
                    'container_class' => 'footer__menu footer__col' ) ); 
                ?>
                <?php $tels = carbon_get_theme_option('tels')?>
                    <?php if(!empty($tels)) :?>
                        <ul class="footer__col">
                            <?php foreach($tels as $tel) : ?>
                                <li class="footer__tel-item">
                                    <a href="tel:<?php echo $tel['tel']?>" class="footer__tel-link"><?php echo $tel['tel']?></a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    <?php endif ?>
                    <?php $socials = carbon_get_theme_option('socials')?>
                    <?php if(!empty($socials)) :?>
                        <ul class="footer__socials-list">
                            <?php foreach($socials as $social) : ?>
                                <li class="footer__socials-item">
                                    <a href="<?php echo $social['socials_url']?>" class="footer__socials-link">
                                        <img class="footer__socials-img" src="<?php echo $social['socials_img']?>">
                                    </a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    <?php endif ?>
        </div>
    </footer>
</div>
<div class="loader">
    <div class="logo">
    <img src="<?php echo carbon_get_theme_option('logo')?>">
    </div>
    
</div>
<?php wp_footer()?>
  <script>
      $('body').css("overflow", "hidden");
    $(document).ready(function() {
        $('.footer__select').niceSelect();
        setTimeout(() => {
            $('body').css("overflow", "auto");
            $('.loader').css("top", "-100vh");
        }, 3000);
    });
  </script>
</body>
</html>