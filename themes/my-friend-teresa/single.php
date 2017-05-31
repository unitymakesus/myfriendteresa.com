<?php get_header(); ?>

    <section id="content">
      <div class="container">
        <div class="row">
          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <div class="hero-title">
              <p class="h3">Focusing on the best years of your life:  high school, college, career, and (of course) family.</p>
            </div>
            <div class="content-data">
              <h1><?php the_title(); ?></h1>
              <?php the_content(); ?>


                <?php comments_template('',true); ?>
            </div>
          <?php endwhile; else : ?>
            <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
          <?php endif; ?>
        </div>
      </div>
    </section>

<?php get_footer(); ?>
