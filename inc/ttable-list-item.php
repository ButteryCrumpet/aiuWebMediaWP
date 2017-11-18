<div class="awm-block container">
    <div class="bus-time row align-items-center flex-row justify-content-between">

                <div class="fa-stack fa-lg bus-icon align-middle">
                    <i class="fa fa-square-o fa-stack-2x" style="color: <?php echo get_field('icon_border_color'); ?>"></i>
                    <i class="fa fa-bus fa-stack-1x"></i>
                </div>

        <div class="bus-info col-7">
            <h3>
                <?php echo get_field('from'); ?> &rArr;
                <?php echo get_field('to'); ?>
            </h3>
        </div>
        <div class="col-1" data-toggle="collapse" href="#ttable-collapse-<?php echo get_the_ID(); ?>">
            <span class="fa fa-2x fa-angle-down menu-icon" aria-hidden="true"></span>
        </div>
    </div>
    <div class="collapse" id="ttable-collapse-<?php echo get_the_ID(); ?>">
        <table class="table">
            <tr><th>Departure</th><th>Arrival</th><th>Availability</th></tr>
            <?php
            $times = get_post_meta(get_the_ID(), 'formated_ttable', true);
            $day_types = get_day_types();
            foreach($times as $time) {
            $avail = check_available($time, $day_types);
            $availability = printable_availablity($time);
            ?>
            <tr>
            <td class="<?php echo ($avail) ? 'tt-available' : ''; ?>"><?php echo $time['departure']; ?></td>
            <td class="<?php echo ($avail) ? 'tt-available' : ''; ?>"><?php echo $time['arrival']; ?></td>
            <td><?php echo $availability; ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>