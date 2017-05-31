<?php get_header(); ?>

    <section id="content">
      <div class="container">
        <div class="row">
            <div class="hero-title">
              <h3>This is not the page you're looking for.</h3>
            </div>
            <div class="content-data">
              <h2><?php the_title(); ?></h2>
              <?php the_content(); ?>
            </div>
        </div>
      </div>
    </section>

<?php get_footer(); ?>
