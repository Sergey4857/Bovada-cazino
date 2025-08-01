<?php
require 'click_tracker.php';

$click_tracker = new ClickTracker();
$stats = $click_tracker->getClickStats();

$template_stats = [];
$total_clicks = 0;

foreach ($stats as $click) {
    $template = $click['template'];
    if (!isset($template_stats[$template])) {
        $template_stats[$template] = 0;
    }
    $template_stats[$template]++;
    $total_clicks++;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Click Statistics</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .stats-container { max-width: 800px; margin: 0 auto; }
        .stat-card { background: #f5f5f5; padding: 20px; margin: 10px 0; border-radius: 5px; }
        .total { background: #e3f2fd; font-weight: bold; }
        .template-stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 10px; margin: 20px 0; }
        .template-card { background: #fff; padding: 15px; border-radius: 5px; border: 1px solid #ddd; }
        .click-list { max-height: 400px; overflow-y: auto; }
        .click-item { background: #fff; padding: 10px; margin: 5px 0; border-radius: 3px; border-left: 3px solid #2196f3; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f5f5f5; }
    </style>
</head>
<body>
    <div class="stats-container">
        <h1>Click Statistics</h1>
        
        <div class="stat-card total">
            <h2>Total Statistics</h2>
            <p>Total Clicks: <strong><?php echo $total_clicks; ?></strong></p>
        </div>
        
        <div class="template-stats">
            <?php foreach ($template_stats as $template => $count): ?>
            <div class="template-card">
                <h3><?php echo htmlspecialchars($template); ?></h3>
                <p>Clicks: <strong><?php echo $count; ?></strong></p>
                <p>Percentage: <strong><?php echo $total_clicks > 0 ? round(($count / $total_clicks) * 100, 1) : 0; ?>%</strong></p>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="stat-card">
            <h2>Detailed Click History</h2>
            <div class="click-list">
                <?php if (empty($stats)): ?>
                    <p>No click data yet</p>
                <?php else: ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Date/Time</th>
                                <th>Template</th>
                                <th>IP</th>
                                <th>Region</th>
                                <th>Country</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (array_reverse($stats) as $click): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($click['timestamp']); ?></td>
                                <td><?php echo htmlspecialchars($click['template']); ?></td>
                                <td><?php echo htmlspecialchars($click['ip']); ?></td>
                                <td><?php echo htmlspecialchars($click['region']); ?></td>
                                <td><?php echo htmlspecialchars($click['country']); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html> 