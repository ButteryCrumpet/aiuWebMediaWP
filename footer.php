<footer class="fdb-block footer-small">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-12 col-md-8">
        <ul class="nav justify-content-center justify-content-md-start">
          <li class="nav-item">
            <a class="nav-link active" href="<?php echo get_home_url(); ?>"><?php echo awm_tr('Home'); ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo get_post_type_archive_link('timetable'); ?>"><?php echo awm_tr('Timetables'); ?></a>
          </li>
          <li class="nav-item">
          <?php 
            $about = get_page_by_path('about');
            if ($about) :
          ?>
            <a class="nav-link" href="<?php echo $about->the_permalink; ?>"><?php echo awm_tr('About'); ?></a>
            <?php endif; ?>
          </li>
          <li class="nav-item">
            <?php 
            $otherID = (get_current_blog_id() === 2) ? 3 : 2; 
            $otherlang = ($otherID == 3) ? 'Japanese Site' : '英語のサイト'; 
            ?>
            <a class="nav-link" href="<?php echo get_site_url($otherID)?>" ><?php echo $otherlang ?></a>
          </li>
        </ul>
      </div>

      <div class="col-12 col-md-4 mt-4 mt-md-0 text-center text-md-right">
        &copy; 2017 AWM. All Rights Reserved
      </div>
    </div>
  </div>
</footer>
</div>
<!-- .content-all -->
<?php wp_footer(); ?>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-109863972-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments)};
  gtag('js', new Date());

  gtag('config', 'UA-109863972-1');
</script>
</body>