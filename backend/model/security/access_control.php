<?php


class AccessControl {
    private $bannedIpFile = 'banned_ips.txt';
    private $visitCountFile = 'visit_counts.json';

    public function hasAccess() {
        $userIp = $this->getClientIp();
        
        if ($this->isIpBanned($userIp)) {
            return false;
            $this->incrementVisitCount($userIp);
        }


        return true;
    }

    private function getClientIp() {
        return $_SERVER['REMOTE_ADDR'];
    }

    private function isIpBanned($ip) {
        $bannedIps = file($this->bannedIpFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        return in_array($ip, $bannedIps);
    }

    private function incrementVisitCount($ip) {
        $visitCounts = $this->loadVisitCounts();
        $visitCounts[$ip] = isset($visitCounts[$ip]) ? $visitCounts[$ip] + 1 : 1;
        $this->saveVisitCounts($visitCounts);
    }

    private function loadVisitCounts() {
        if (file_exists($this->visitCountFile)) {
            $json = file_get_contents($this->visitCountFile);
            return json_decode($json, true);
        }
        return [];
    }

    private function saveVisitCounts($visitCounts) {
        $json = json_encode($visitCounts, JSON_PRETTY_PRINT);
        file_put_contents($this->visitCountFile, $json);
    }
}

$accessControl = new AccessControl();
if ($accessControl->hasAccess()) {
    echo "Access granted!";
} else {
    echo "Access denied!";
}
