<?php
require 'IP_logger.php';
require 'click_tracker.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['template_name'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Template name is required']);
    exit;
}

$ip_logger = new IP_Logger();
$ip_info = $ip_logger->log_ip();

$click_tracker = new ClickTracker();
$result = $click_tracker->logClick($input['template_name'], $ip_info);

if ($result) {
    echo json_encode(['success' => true, 'message' => 'Click tracked successfully']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to track click']);
}
?> 