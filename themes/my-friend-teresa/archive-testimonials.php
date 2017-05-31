<?php get_header(); ?>

    <section id="content">
        <div class="container">
            <div class="row">
                <div class="hero-title">
                    <h3>Focusing on the best years of your life:  high school, college, career, and (of course) family.</h3>
                </div>
                <div class="content-data">
                    <h2>Testimonials</h2>
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <blockquote>
                        <?php
                        $image = get_field('photo');
                        if ($image != NULL && array_key_exists('url', $image)) {
                            echo '<img style="max-width:100px;height:auto;margin-right:10px;margin-top:35px;" class="pull-left" src="' . $image['sizes']['thumbnail'] . '">';
                        }
                        ?>
                        <div style="margin-left:110px" >
                        <p class="p1"><?php echo get_field('testimonial'); ?></p>
                        <p class="p1"><?php echo get_field('testimonial_by'); ?></p>
                        </div>
                    </blockquote>
                    <?php endwhile; else : ?>
                        <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php get_footer(); ?>