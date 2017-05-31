<?php get_header(); ?>

    <section id="hero">
      <div class="container">
        <div class="row">
            <div class="hero-title">
              <h3>Focusing on the best years of your life:  high school, college, career, and (of course) family.</h3>
            </div>
            <div id="hero-squares">

              <?php

                  // check if the flexible content field has rows of data
                  if( have_rows('masonry') ):
                       // loop through the rows of data
                      while ( have_rows('masonry') ) : the_row();

                          if( get_row_layout() == 'image_small_hover' ):

                            $regular = get_sub_field('image_regular');
                            $hover = get_sub_field('image_hover');
                            $imgtext = get_sub_field('image_text');
                            $link = get_sub_field('link');

                            echo '
                            <div class="item item-small cursor">
                              <a href="' . $link . '">
                                <img src="' . $hover['url'] . '" alt="My Friend Teresa Studios" class="bottom">
                                <img src="' . $regular['url'] . '" alt="My Friend Teresa Studios" class="top">
                                <div class="item-inner">
                                  ' . $imgtext . '
                                </div>
                              </a>
                            </div>';

                          elseif( get_row_layout() == 'image_no_hover' ): 

                            $image = get_sub_field('image');
                            $type = get_sub_field('type');
                            $type = strtolower($type);
                            
                            echo '
                              <div class="item item-' . $type . '">
                                <img src="' . $image['url'] . '" alt="My Friend Teresa Studios">
                              </div>';
                            

                          endif;

                      endwhile;

                  else :

                      // no layouts found

                  endif;

              ?>


              <?php /*
              <div class="item item-tall">
                <img src="<?php bloginfo('template_directory'); ?>/img/hero-tall-01.jpg" alt="My Friend Teresa Studios" class="bottom">
                <img src="<?php bloginfo('template_directory'); ?>/img/hero-tall-01.jpg" alt="My Friend Teresa Studios" class="top">
              </div>
              <div class="item item-small">
                <img src="<?php bloginfo('template_directory'); ?>/img/hero-small-01.jpg" alt="My Friend Teresa Studios" class="bottom">
                <img src="<?php bloginfo('template_directory'); ?>/img/hero-small-01.jpg" alt="My Friend Teresa Studios" class="top">
              </div>
              <div class="item item-tall">
                <img src="<?php bloginfo('template_directory'); ?>/img/hero-tall-02.jpg" alt="My Friend Teresa Studios" class="bottom">
                <img src="<?php bloginfo('template_directory'); ?>/img/hero-tall-02.jpg" alt="My Friend Teresa Studios" class="top">
              </div>
              <div class="item item-small cursor">
                <a href="">
                  <img src="<?php bloginfo('template_directory'); ?>/img/hero-small-02-o.jpg" alt="My Friend Teresa Studios" class="bottom">
                  <img src="<?php bloginfo('template_directory'); ?>/img/hero-small-02.jpg" alt="My Friend Teresa Studios" class="top">
                  <div class="item-inner">
                    meet<br>the team
                  </div>
                </a>
              </div>
              <div class="item item-small cursor">
                <img src="<?php bloginfo('template_directory'); ?>/img/hero-small-03-o.jpg" alt="My Friend Teresa Studios" class="bottom">
                <img src="<?php bloginfo('template_directory'); ?>/img/hero-small-03.jpg" alt="My Friend Teresa Studios" class="top">
                <div class="item-inner">
                  book a<br>session
                </div>
              </div>
              <div class="item item-small cursor">
                <img src="<?php bloginfo('template_directory'); ?>/img/hero-small-04-o.jpg" alt="My Friend Teresa Studios" class="bottom">
                <img src="<?php bloginfo('template_directory'); ?>/img/hero-small-04.jpg" alt="My Friend Teresa Studios" class="top">
                <div class="item-inner">
                  portfolio
                </div>
              </div>
              <div class="item item-big">
                <img src="<?php bloginfo('template_directory'); ?>/img/hero-big-01.jpg" alt="My Friend Teresa Studios" class="bottom">
                <img src="<?php bloginfo('template_directory'); ?>/img/hero-big-01.jpg" alt="My Friend Teresa Studios" class="top">
              </div>
              <div class="item item-small cursor">
                <img src="<?php bloginfo('template_directory'); ?>/img/hero-small-05-o.jpg" alt="My Friend Teresa Studios" class="bottom">
                <img src="<?php bloginfo('template_directory'); ?>/img/hero-small-05.jpg" alt="My Friend Teresa Studios" class="top">
                <div class="item-inner">
                  for clients
                </div>
              </div>
              <div class="item item-big">
                <img src="<?php bloginfo('template_directory'); ?>/img/hero-big-02.jpg" alt="My Friend Teresa Studios" class="bottom">
                <img src="<?php bloginfo('template_directory'); ?>/img/hero-big-02.jpg" alt="My Friend Teresa Studios" class="top">
              </div>
              <div class="item item-tall">
                <img src="<?php bloginfo('template_directory'); ?>/img/hero-tall-03.jpg" alt="My Friend Teresa Studios" class="bottom">
                <img src="<?php bloginfo('template_directory'); ?>/img/hero-tall-03.jpg" alt="My Friend Teresa Studios" class="top">
              </div>
              <div class="item item-tall">
                <img src="<?php bloginfo('template_directory'); ?>/img/hero-tall-04.jpg" alt="My Friend Teresa Studios" class="bottom">
                <img src="<?php bloginfo('template_directory'); ?>/img/hero-tall-04.jpg" alt="My Friend Teresa Studios" class="top">
              </div>
              <div class="item item-small cursor">
                <img src="<?php bloginfo('template_directory'); ?>/img/hero-small-08-o.jpg" alt="My Friend Teresa Studios" class="bottom">
                <img src="<?php bloginfo('template_directory'); ?>/img/hero-small-08.jpg" alt="My Friend Teresa Studios" class="top">
                <div class="item-inner">
                  pricing &<br>packages
                </div>
              </div>
              <div class="item item-small cursor">
                <img src="<?php bloginfo('template_directory'); ?>/img/hero-small-06-o.jpg" alt="My Friend Teresa Studios" class="bottom">
                <img src="<?php bloginfo('template_directory'); ?>/img/hero-small-06.jpg" alt="My Friend Teresa Studios" class="top">
                <div class="item-inner">
                  the blog
                </div>
              </div>
              <div class="item item-small">
                <img src="<?php bloginfo('template_directory'); ?>/img/hero-small-07.jpg" alt="My Friend Teresa Studios" class="bottom">
                <img src="<?php bloginfo('template_directory'); ?>/img/hero-small-07.jpg" alt="My Friend Teresa Studios" class="top">
              </div>
              <div class="item item-small cursor">
                <img src="<?php bloginfo('template_directory'); ?>/img/hero-small-09-o.jpg" alt="My Friend Teresa Studios" class="bottom">
                <img src="<?php bloginfo('template_directory'); ?>/img/hero-small-09.jpg" alt="My Friend Teresa Studios" class="top">
                <div class="item-inner">
                  lessons &<br>tutoring
                </div>
              </div>*/ ?>
            </div>
        </div>
      </div>
    </section>

    <?php get_footer(); ?>