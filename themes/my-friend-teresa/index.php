<?php get_header(); ?>
<section id="content">
      <div class="container">
        <div class="row">
            <div class="hero-title">
              <h3>Focusing on the best years of your life:  high school, college, career, and (of course) family.</h3>
            </div>
            <div class="content-blog">
            <?php
	            if(is_category()) {
	            	echo '<h2>';
	            	single_cat_title();
	            	echo '</h2>';
	            } else {
	            	echo '<h2>Blog</h2>';
	            }
	        ?>


              <div class="row">
                  <div class="col-md-12 categories">
                      <?php
                      $categories = get_categories();
                      $i = 0;
                      $len = count($categories);
                      foreach($categories as $cat) { ?>

                          <a href="<?php echo esc_url(get_term_link($cat, 'category')); ?>"><?php echo $cat->name; ?></a>
                      <?php
                          if ($i != $len - 1) {
                              echo ', ';
                          }
                          $i++;
                      }
                      ?>
                  </div>
              	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>


	                <article>
	                  <div class="blog-img">
	                  	<a href="<?php the_permalink(); ?>">
		                    <?php the_post_thumbnail(300); ?>
		                </a>
	                  </div>
	                  <div class="blog-info">
	                    <h3>
	                    	<a href="<?php the_permalink(); ?>">
		                    	<?php the_title(); ?>
		                    </a>
		                </h3>
	                    <p><?php the_excerpt(); ?></p>

	                    <p class="text-right"><a href="<?php the_permalink(); ?>" class="link-blog">{ CONTINUE READING } </a></p>

	                    <p class="blog-date">
	                      <?php the_time('M j, Y'); ?> | Categories:<span> <?php the_category(', '); ?></span>
	                      <a class="pull-right link-comment">Leave a Comment »</a>
	                    </p>
	                  </div>
	                </article>
                <?php endwhile; else : ?>
                	<article>
						<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
					</article>
				<?php endif; ?>
				<div style="text-align:center;">
				<?php posts_nav_link( ' &#183; ', 'previous page', 'next page' ); ?>
				</div>
              </div>
            </div>
        </div>
      </div>
    </section>

<?php get_footer(); ?>
