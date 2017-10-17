<div id="bus" class="awm-block">
    BUS -timetables
</div>
<div id="filters" class="awm-block">
    <ul class="list-group">
    <?php 
    $cats = get_categories(array(
        'orderby' => 'name',
        'parent' => 0
      ));
    foreach ($cats as $cat) {
        $childs = get_categories(array(
            'orderby' => 'name',
            'parent' => $cat->term_id,
        ));
        $link = get_category_link( $cat->term_id );
        ?>
        <div class="card-header bg-light container" >
            <div class="row">
            <div class="col-11">
            <a href="<?php echo $link; ?>"><?php echo $cat->name; ?></a>
            </div>
            <span style="cursor: pointer;" data-toggle="collapse" href="#collapse-<?php echo $cat->term_id; ?>" class="oi oi-caret-left"></span>
            </div>
        </div>
        <div class='collapse' id="collapse-<?php echo $cat->term_id; ?>">
        <?php foreach ($childs as $child) { 
            $child_link = get_category_link( $child->term_id );
            ?>
            <p class="card-header"><a href="<?php echo $child_link; ?>"><?php echo $child->name ?></a></p>
        <?php } ?>
        </div>
        <?php
        }  
        ?>
        <p class="card-header bg-light">
            <a href="/devserv/?post_type=study_abroad" >Link to SA</a>
        </p>
    </ul>
</div>