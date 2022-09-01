<?php get_header(); ?>

    <main>
        <div class="container" style="padding-top: 40px; padding-bottom: 40px">
        <h2 class="page-title">Результати пошуку <?php echo get_search_query(); ?> :</h2>
            <?php if ( have_posts() ): ?>
                <ul class="search__list">
                <?php while( have_posts() ): ?>
                    <?php the_post(); ?>
                    <li class="card" style="max-width: 290px">
                            <h3 class="card__title">
                                <a href="#"><?php the_title(); ?></a>
                            </h3>
                            <time class="card__date" datetime="<?php echo get_the_time('d.m.Y')?>"><?php echo get_the_time('d.m.Y')?></time>
                            <p class="card__content">
                            <?php $img         = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail_735x354' );
                    $image_alt   = get_post_meta($img, '_wp_attachment_image_alt', true);
                    $image_alt   = ( $image_alt ? $image_alt : get_the_title() );
                    $src         = ( isset( $img[0] ) ?$img[0] :jy_slice_http_path . 'img/noimage.jpg' ); ?>
                    <img src="<?php echo( $img[0] ?? esc_url( jy_slice_http_path ) . 'img/noimage.jpg' ) ?>" alt="<?php echo esc_attr( $image_alt ) ?>" class="card__img">
                             <?php echo carbon_get_post_meta(get_the_ID(), 'project_desc')?>
                            </p>
                            <a href="#" class="card__more">
                                Learn more
                                <img src="<?php echo get_template_directory_uri() ?>/assets/img/right-arrow.png">
                            </a>
                        </li>
                <?php endwhile; ?>
            <?php else: ?>
                <p style="text-align: center; margin-top: 20px">Результатів не знайдено</p>
                <a href="<?php echo get_site_url()?>" style="color: #000; display: block; text-align: center;text-decoration: underline; margin-top: 20px" class="href">Повернутись на головну сторінку</a>
                </ul>
            <?php endif; ?>
            </div>
    </main>

<?php get_footer(); ?>