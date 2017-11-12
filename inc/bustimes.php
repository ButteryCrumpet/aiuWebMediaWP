
<div class="container">
<div class="awm-title">Next Busses</div>

<?php
$times = get_next_bus();
foreach ($times as $time) {
    $to = get_field('to', $time['id']);
    $from = get_field('from', $time['id']);
    $color = get_field('icon_border_color', $time['id']);
    $now = current_time('Hi');
    $in = ($time['time'] > $now) ? $time['time'] - $now : (2359 - $now) + $time['time'];
    $in = convertToHoursMins($in);
    $departure = $time['time'] ? $time['time'] : 'No more service';
    ?>
    
    <div class="row bus-time">
        <div class="col-3 offset-xl-2 container">
            <div class="row align-items-center justify-content-center">
                <div class="fa-stack fa-lg bus-icon align-middle">
                    <i class="fa fa-square-o fa-stack-2x" style="color: <?php echo $color; ?>"></i>
                    <i class="fa fa-bus fa-stack-1x"></i>
                </div>
            </div>
        </div>
        <div class="bus-info col">
            <h6><?php echo $from; ?> &rArr; <?php echo $to; ?></h6>
            <p><?php echo $departure; ?></p>
        </div>
    </div>
        
    <?php
}
?>
</div>