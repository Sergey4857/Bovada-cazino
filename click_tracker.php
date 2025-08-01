<?php
class ClickTracker {
    private $log_file = 'click_logs.txt';
    
    public function logClick($template_name, $ip_info) {
        $timestamp = date('Y-m-d H:i:s');
        $ip = $ip_info['ip'] ?? 'unknown';
        $region = $ip_info['region'] ?? 'unknown';
        $country = $ip_info['country'] ?? 'unknown';
        
        $log_entry = sprintf(
            "[%s] Template: %s | IP: %s | Region: %s | Country: %s\n",
            $timestamp,
            $template_name,
            $ip,
            $region,
            $country
        );
        
        file_put_contents($this->log_file, $log_entry, FILE_APPEND | LOCK_EX);
        
        return true;
    }
    
    public function getClickStats() {
        if (!file_exists($this->log_file)) {
            return [];
        }
        
        $content = file_get_contents($this->log_file);
        $lines = explode("\n", $content);
        $stats = [];
        
        foreach ($lines as $line) {
            if (empty(trim($line))) continue;
            
            if (preg_match('/\[(.*?)\] Template: (.*?) \| IP: (.*?) \| Region: (.*?) \| Country: (.*?)$/', $line, $matches)) {
                $stats[] = [
                    'timestamp' => $matches[1],
                    'template' => $matches[2],
                    'ip' => $matches[3],
                    'region' => $matches[4],
                    'country' => $matches[5]
                ];
            }
        }
        
        return $stats;
    }
}
?> 