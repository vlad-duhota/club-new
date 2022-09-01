<?php
/*
Template Name: Study directions page
*/
?>

<?php 
    $page_id = get_the_ID();
?>

<?php get_header(); ?>

<main class="main">
        <section class="projects">
            <div class="container">
            <p class="projects__text"><?php echo carbon_get_theme_option('page_text_1')?>
                </p>
                <p class="projects__text"><?php echo carbon_get_theme_option('page_text_2')?></p>
                    <div class="projects__slider">                         
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
                                    <?php $counter = 0;?>
                                <?php for ($b=0; $b < round(count($projects_categories) / 6 ) + 1; $b++) : ?>
                                    <div>      
                                        <ul class="projects__list">

                     <?php for ($i=0; $i < 6; $i++) : ?>
                            <?php 
                            if(($counter % 6)==0){
                                $category = $projects_categories[$i + (($counter / 6) * 6)];
                            } else{
                                $category = $projects_categories[$i];
                            }
                            if($counter>count($projects_categories) - 2){
                                $i = 6;
                                $b = round(count($projects_categories) / 6 ) + 1;
                            }
                                $cat_id = $category -> term_id;
                                $args = [
                                    'post_type' => 'project',
                                    'tax_query' => [
                                        [
                                            'taxonomy' => 'project-categories',
                                            'field' => 'id',
                                            'posts_per_page' => 1,
                                            'terms' => $cat_id,
                                        ]
                                    ],
                                ];
                                $query = new WP_Query;
                                $projects = $query->query($args);
                                foreach( $projects as $project ) : ?>
                                <?php $counter++;?>
                                  <li class="projects__item">
                                <h3 class="projects__item-title"><?php echo $category->name?></h3>
                                
                                <div class="card">
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
                                </div>
                                <button data-projects="<?php echo $counter?>" class="projects__btn">See more projects</button>
                            </li>
                            <?php break;?>
                                <?php endforeach ?>
                                <?php endfor ?>
                            </ul>
                        </div>
                        <?php endfor?>
                    </div>
            </div>
        </section>
        <section class="more-projects">
            <div class="container">
                    <?php $counter2 = 0;?>
                    <?php foreach($projects_categories as $category) : ?>                                
                        <?php $counter2++;?>
                        <?php $counter3 = 0;?>
                            <?php 
                                $cat_id = $category -> term_id;
                                $args = [
                                    'post_type' => 'project',
                                    'tax_query' => [
                                        [
                                            'taxonomy' => 'project-categories',
                                            'field' => 'id',
                                            'terms' => $cat_id,
                                        ]
                                    ],
                                ];
                                $query = new WP_Query;
                                $projects = $query->query($args);
                                ?>
                                <div class="more-projects__block" data-projects="<?php echo $counter2?>">
                                <h2 class="more-projects__title"><?php echo $category -> name?> projects</h2>
                                <div class="more-projects__slider">
                                    
                                    <?php for ($b=0; $b < round(count($projects) / 6 ) + 1; $b++) : ?>
                                        <div class="more-projects__slider-item">
                                        <ul class="more-projects__list">

                     <?php for ($i=0; $i < 6; $i++) : ?>
                            <?php 
                               if(($counter3 % 6)==0){
                                $project =  $projects[$i + (($counter3 / 6) * 6)];
                            } else{
                                $project = $projects[$i];
                            }
                            
                            if($counter3>count($projects) - 2){
                                $i = 6;
                                $b = round(count($projects) / 6 ) + 1;
                            }
                            $counter3++;
                                ?>
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
                                <?php endfor ?>
                            </ul>
                            </div>
                            <?php endfor ?>
                            </div>
                            </div>
                                <?php endforeach ?>
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