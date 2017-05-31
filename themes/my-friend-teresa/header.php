<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <?php wp_head(); ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body <?php body_class(); ?>>



    <header class="navbar navbar-static-top" id="top" role="banner">
      <div class="container">
        <div class="row">
          <div class="navbar-header">
            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <div class="navbar-brand">
              <a href="<?php echo home_url(); ?>" ><img src="<?php bloginfo('template_directory'); ?>/img/logo.svg" alt="My Friend Teresa Studios"></a>
            </div>
            <div class="nav-top">
              <ul class="nav-right-social">
                <li><a href="https://twitter.com/myfriendteresa" class="icon-twitter"></a></li>
                <li><a href="https://www.facebook.com/myfriendteresaphotography" class="icon-facebook"></a></li>
                <li><a href="http://instagram.com/myfriendteresa" class="icon-instagram"></a></li>
              </ul>

            </div>
            <div class="nav-top-collapse">
              <nav class="collapse navbar-collapse bs-navbar-collapse nav-right">

                  <?php
                      wp_nav_menu( array(
                          'menu'              => 'Primary',
                          'theme_location'    => 'primary',
                          'depth'             => 2,
                          'container'         => 'div',
                          'container_class'   => 'collapse navbar-collapse',
                          'container_id'      => 'bs-example-navbar-collapse',
                          'menu_class'        => 'nav navbar-nav',
                          'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                          'walker'            => new wp_bootstrap_navwalker())
                      );
                  ?>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </header>
