<?php get_header(); ?>
    <main>
        <div class="container" style="padding-top: 40px; padding-bottom: 40px">
            <h1><?php the_title()?></h1>
            <?php the_content()?>
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
        </div>
    </main>
<?php get_footer(); ?>