
    <!DOCTYPE html>

    <html <?php language_attributes(); ?>>
        
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            
            <!-- Fonts -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Inter&display=swap" rel="stylesheet">
            
            <!-- Styles -->
            <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php
      if ( function_exists( 'wp_body_open' ) ) {
        wp_body_open();
      }
    ?>
    <div class="wrapper"  style="min-height: 100vh; display:flex; flex-direction: column; justify-content: space-between">
    <header class="header">
        <div class="container">
            <a href="<?php echo get_site_url() ?>" class="header__logo">
                <img src="<?php echo carbon_get_theme_option('logo')?>">
            </a>
            <div class="header__main">
                <h1 class="header__title"><?php echo carbon_get_theme_option('title')?></h1>
                <p class="header__subtitle"><?php echo carbon_get_theme_option('subtitle')?></p>
                <?php
                wp_nav_menu( array( 
                    'theme_location' => 'main_menu', 
                    'container_class' => 'nav' ) ); 
                ?>
                <form action="<?php bloginfo( 'url' ); ?>" method="get" class="header__form">
                    <input type="search" value="<?php if(!empty($_GET['s'])){echo $_GET['s'];}?>" name="s" class="header__form-input" placeholder="Пошук..." required autocomplete="off">
                    <button type="submit" class="header__form-btn"><img src="<?php echo get_template_directory_uri() ?>/assets/img/loupe.svg"></button>
                </form>
            </div>
        </div>
    </header>
