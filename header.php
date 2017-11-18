<!DOCTYPE HTML>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Akita Web Media: Information and events around Akita Int. University and Akita Prefecture">
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta property="fb:app_id" content="1159304874214007" />
  <meta property="og:url" content="<?php echo get_the_permalink(); ?>" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="<?php echo get_the_title(); ?>" />
  <meta property="og:description" content="<?php echo get_the_excerpt(); ?>" />
  <meta property="og:image" content="<?php echo get_the_post_thumbnail_url(); ?>" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
    crossorigin="anonymous"></script>
  <?php wp_head(); ?>
</head>
<header>
  <div id="awm-header" class="container-fluid" style="background-image: url(<?php header_image(); ?>)">
    <div id="logo" class="">
      <a href="/">
        <h3>
          <h3>
      </a>
    </div>
  </div>
</header>
<div class="d-md-none awm-mobmenu-wrapper">
  <nav class="awm-mobile-menu">
    <a href="<?php echo get_home_url(); ?>" >
      <i class="fa fa-lg fa-home" aria-hidden="true"></i>
    </a>
    <a data-toggle="collapse" href="#menu-collapse">
      <i class="fa fa-bars fa-lg menu-icon"></i>
    </a>
    <a class="smooth-scroll" href="#bus-times">
      <i class="fa fa-lg fa-bus"></i>
    </a>
  </nav>
  <div class="collapse" id="menu-collapse">
    <?php include 'inc/mob-menu.php'; ?>
  </div>
</div>

<body>
  <div id="fb-root"></div>
  <script>
    (function (d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s);
      js.id = id;
      //js.async = true;
      js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.11&appId=1159304874214007';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script>
  <script>
    window.twttr = (function (d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0],
        t = window.twttr || {};
      if (d.getElementById(id)) return t;
      js = d.createElement(s);
      js.id = id;
      //js.async = true;
      js.src = "https://platform.twitter.com/widgets.js";
      fjs.parentNode.insertBefore(js, fjs);

      t._e = [];
      t.ready = function (f) {
        t._e.push(f);
      };

      return t;
    }(document, "script", "twitter-wjs"));
  </script>
  <div class="content-all">