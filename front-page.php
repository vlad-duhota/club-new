<?php
/*
Template Name: Home page
*/
?>

<?php 
    $page_id = get_the_ID();
?>

<?php get_header(); ?>
  
<main class="main">
        <section class="last-projects">
            <div class="container">
                <p class="projects__text"><?php echo carbon_get_theme_option('page_text_1')?>
                </p>
                <p class="projects__text"><?php echo carbon_get_theme_option('page_text_2')?></p>
                <h2 class="last-projects__title">Недавні проекти</h3>
                    <div class="last-projects__slider">
                    <?php $args = array(
                    'numberposts' => 18,
                    'post_type'   => 'project',
                    'orderby'=> 'post_date', 
                    );
            $projects = get_posts( $args );?>
            <?php if ($projects) : ?>
                <?php $counter = 0;?>
                <?php for ($b=0; $b < round(count($projects) / 6 ) + 1; $b++) : ?>
                    <div class="last-projects__item">
                        <ul class="last-projects__list">
                        <?php for ( $i = 0; $i < 6; $i++ ) : ?>
                        <?php 
                            if(($counter % 6)==0){
                                $project = $projects[$i + (($counter / 6) * 6)];
                            } else{
                                $project = $projects[$i];
                            }
                            if($counter>count($projects) - 2){
                                $i = 6;
                                $b = round(count($projects) / 6 );
                            }
                            $counter++;
                            setup_postdata( $project ); 
                            ?>
                            <div class="last-projects__list-item">
                                    <li class="card">
                                    <h3 class="card__title">
                                        <a href="<?php echo get_permalink($project) ?>"><?php echo $project -> post_title ?><a>
                                    </h3>
                                    <time class="card__date" datetime="<?php echo get_the_time('d.m.Y')?>"><?php echo get_the_time('d.m.Y')?></time>
                                    <p class="card__content">
                                    <?php echo get_the_post_thumbnail($project->ID, array(900, 900)) ?>
                                       <?php echo carbon_get_post_meta($project->ID, 'project_desc')?>
                                    </p>
                                    <a href="<?php echo get_permalink($project) ?>" class="card__more">
                                        Learn more
                                        <img src="<?php echo get_template_directory_uri()?>/assets/img/right-arrow.png">
                                    </a>
                                </li>
                            </div>
                        <?php endfor; wp_reset_postdata(); ?>
                        </ul>
                    </div>
                    <?php endfor;?>
                <?php endif; ?>
                </div>   
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