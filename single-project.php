

<?php 
    $page_id = get_the_ID();
?>

<?php get_header(); ?>

<main class="main">


            <section class="project">
                <div class="container">
                    <h2 class="project__title"><?php the_title()?></h2>
                    <?php
                    $category = get_the_terms($post->ID, 'project-categories');
                    $current_cat_name = $category[0]->name;
                    ?>
                    <p class="project__subtitle"><time class="project__date" datetime="<?php echo get_the_time('d.m.Y')?>"><?php echo get_the_time('d.m.Y')?></time> | <?php echo $current_cat_name?></p>
                    <?php $img         = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail_735x354' );
                    $image_alt   = get_post_meta($img, '_wp_attachment_image_alt', true);
                    $image_alt   = ( $image_alt ? $image_alt : get_the_title() );
                    $src         = ( isset( $img[0] ) ?$img[0] :jy_slice_http_path . 'img/noimage.jpg' ); ?>
                    <img src="<?php echo( $img[0] ?? esc_url( jy_slice_http_path ) . 'img/noimage.jpg' ) ?>" alt="<?php echo esc_attr( $image_alt ) ?>" class="project__img">
                    <p class="project__desc"><?php echo carbon_get_post_meta($page_id, 'project_desc')?></p>
                        <p class="project__link">Посилання на проєкт: <a href="<?php echo carbon_get_post_meta($page_id, 'project_link')?>"><?php echo carbon_get_post_meta($page_id, 'project_link')?></a></p>
                        <p class="project__author">Виконав: <?php echo carbon_get_post_meta($page_id, 'project_author')?></p>
                        <p class="project__age">Вік: <?php echo carbon_get_post_meta($page_id, 'project_age')?></p>
                        <img src="<?php echo carbon_get_post_meta($page_id, 'project_author_img')?>" class="project__img">
                </div>
            </section>
            <section class="grid">
            <div class="container">
                <div class="grid__item">
                    <h3 class="grid__item-title">Недавні проекти</h3>
                    <?php $args = array(
                    'numberposts' => 6,
                    'post_type'   => 'project',
                    'orderby'=> 'post_date', 
                    );
            $lastProjects = get_posts( $args );?>
                    <?php if(!empty($lastProjects)) :?>
                    <ul class="grid__list">
                        <?php foreach($lastProjects as $projectItem) :?>
                        <li class="grid__list-item"><img src="<?php echo get_template_directory_uri()?>/assets/img/label.png">
                            <a href="<?php echo get_permalink($projectItem) ?>"><?php echo $projectItem -> post_title ?></a>
                        </li>
                        <?php endforeach?>
                    </ul>
                    <?php endif?>
                </div>
                <div class="grid__item">
                    <h3 class="grid__item-title">Напрямки навчання</h3>
                    <?php $projects_cat_args = [
                'taxonomy'     => 'project-categories',
                'type'         => 'project',
                'orderby'      => 'name',
                'order'        => 'ASC',
                'hide_empty'   => 1,
                'exclude'      => '',
                'include'      => '',
                'number'       => 0,
                'pad_counts'   => false,
            ];
            $projects_categories = get_categories( $projects_cat_args );
            ?>
            <?php if(!empty($projects_categories)) :?>
                    <ul class="grid__list">
                    <?php foreach($projects_categories as $projects_category) : setup_postdata( $projects_category ); ?>
                        <li class="grid__list-item"><img src="<?php echo get_template_directory_uri()?>/assets/img/label.png">
                            <a href="<?php echo get_site_url()?>/project-categories/<?php echo $projects_category -> slug?>"><?php echo $projects_category -> name?></a>
                        </li>
                        <?php endforeach ?>
                    </ul>
                    <?php endif ?>
                </div> 
            </div>
        </section>
        </main>
        <?php get_footer() ?>