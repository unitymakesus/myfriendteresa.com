<?php get_header(); ?>

    <section id="content">
      <div class="container">
        <div class="row">
          
            <div class="hero-title">
              <h3>Focusing on the best years of your life:  high school, college, career, and (of course) family.</h3>
            </div>
            <div class="content-data">
              <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
               <div class="col-md-3 col-sm-4 col-xs-12 team-member">
                  <?php $image = get_field('photo');?>
                  <a href="<?php echo get_permalink(); ?>">
                    <img src="<?php echo $image['url']; ?>">
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo get_field('title'); ?></p>
                  </a>
               </div>
              <?php endwhile; else : ?>
                <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
              <?php endif; ?>
            </div>
          
        </div>
      </div>
    </section>

<?php get_footer(); ?>