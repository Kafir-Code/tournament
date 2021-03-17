<?php
include_once 'src/round-robin.php';

$teams = ['Player 1', 'Player 2', 'Player 3', 'Player 4', 'Player 5'];
$scheduleBuilder = new ScheduleBuilder($teams);
$schedule = $scheduleBuilder->build();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Schedule Example</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Example</h1>
        <p>
            This example generates a schedule where each contestant meets each
            other once.
        </p>
        <h2>Sample Schedule</h2>
        <?php foreach($schedule as $round => $matchups){ ?>
        <h3>Round <?=$round?></h3>
        <ul>
        <?php foreach($matchups as $matchup) { ?>
            <li><?=$matchup[0] ?? '*BYE*'?> vs. <?=$matchup[1] ?? '*BYE*'?></li>
        <?php } ?>
        </ul>
        <?php } ?>
    </body>
</html>
