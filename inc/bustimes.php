<?php

$times = get_next_bus();

foreach ($times as $time) {
    $to = get_field('to', $time['id']);
    $from = get_field('from', $time['id']);
    $now = current_time('Hi');
    $in = ($time['time'] > $now) ? $time['time'] - $now : (2359 - $now) + $time['time'];
    $in = convertToHoursMins($in);
    ?>
    
    <div>
        <div class="busthing"></div>
        <div class="inliney">
            <p><?php echo $from; ?> - <?php echo $to; ?></p>
            <p><?php echo $time['time']; ?></p>
        </div>
    </div>
        
    <?php
}
?>
</table>