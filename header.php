<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
  <div class="container">
    <nav id="awm-header" class="awm-block navbar navbar-expand-md no-gutters">

      <div id="logo" class="col-4 col-md-2 text-right text-md-center order-lg-6">
        <a href="/">
          <h3>AWM Logo<h3>
        </a>
      </div>
    </nav>
  </div>
</header>

<body>
  <div id="fb-root"></div>
  <script>
    (function (d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s);
      js.id = id;
      js.async=true;
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
      js.async=true;
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