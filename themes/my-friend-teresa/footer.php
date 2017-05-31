<section id="about">
      <div class="container">
        <div class="row">
          <div class="blog-posts">
            <div class="row">
              <h4>Recent Blog Posts</h4>
              <ul>
                <?php

                    // WP_Query arguments
                    $args = array (
                      'post_type'              => 'portfolio',
                      'posts_per_page'            => 3
                    );

                    // The Query
                    $query = new WP_Query( $args );

                    // The Loop
                    if ( $query->have_posts() ) {
                      while ( $query->have_posts() ) {
                        $query->the_post();
                        ob_start(); ?>
                        <li>
                          <a href="<?php echo get_permalink(); ?>">
                          <div class="post-img">
                            <?php
                              $image = get_field('image');
                            ?>
                            <img src="<?php echo $image['sizes']['thumbnail']; ?>">
                          </div>
                          <div class="post-title">
                            <h5><?php the_title(); ?></h5>
                            <em><?php echo get_the_date('F j, Y'); ?></em>
                          </div>
                          </a>
                        </li>
                        <?php
                        echo ob_get_clean();

                      }
                    } else {
                      // no posts found
                    }

                    // Restore original Post Data
                    wp_reset_postdata();

                ?>


              </ul>
            </div>
          </div>
          <div class="about-teresa">
            <h4>About My Friend Teresa</h4>
            <img class="pull-left" style="margin-right:15px;
            margin-bottom:15px;" src="<?php bloginfo('template_directory'); ?>/img/teresa.jpg" alt="Teresa Porter">
            <p>My Friend Teresa Studios is a boutique portrait studio in Cary, NC specializing in high school, teen, family and child photography that shows everyone from the camera-shy to the goof-ball at their best.  Principle photographer, Teresa, has been recognized by Rolling Stone Magazine and published on The Huffington Post.</p>
            <h4>Subscribe to our mailing listing</h4>
            <form action="" method="post" class="form-inline">
                <input type="text" class="input-large form-control" name="email" placeholder="Your Email" />
                <?php wp_nonce_field( 'mailchimp_subscribe', 'mailchimp_subscribe' ); ?>
                <button type="submit" class="btn btn-primary">Subscribe</button>
            </form>

          </div>
          <div class="instagram-feed">
            <h4>Instagram Feed</h4>
            <h5><span class="icon-instagram"></span>@myfriendteresa</h5>
            <p>#MyFriendTeresaStudios #MFTStudios</p>
            <?php if ( is_active_sidebar( 'home_right_footer' ) ) : ?>
                <?php dynamic_sidebar( 'home_right_footer' ); ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>

    <footer>
      <div class="container">
        <div class="row">
          <div class="footer-top">
            <p class="pull-left">
              All RIGHTS RESERVED &copy; <?php echo date('Y'); ?> by My Friend Teresa Studios<br>
              Site managed by <a href="https://www.unitymakes.us/" target="_blank">Unity Digital Agency</a>
            </p>

            <img class="pull-right" src="<?php bloginfo('template_directory'); ?>/img/logo-footer.png" alt="My Friend Teresa Studios">
          </div>

          <div class="footer-bottom">
              <ul class="pull-left">
                <li><a href="https://twitter.com/myfriendteresa" class="icon-twitter"></a></li>
                <li><a href="https://www.facebook.com/myfriendteresaphotography" class="icon-facebook"></a></li>
                <li><a href="http://instagram.com/myfriendteresa" class="icon-instagram"></a></li>
              </ul>

          </div>
        </div>
      </div>
    </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <?php wp_footer(); ?>

  </body>
</html>
