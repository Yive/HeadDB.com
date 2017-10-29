<?
    // Credit to https://gist.github.com/games647/2b6a00a8fc21fd3b88375f03c9e2e603
    // Edited to work with HeadDB though.
    function constructOfflinePlayerUuid($username) {
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x30);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        $striped = bin2hex($data);
        $components = array(
            substr($striped, 0, 8),
            substr($striped, 8, 4),
            substr($striped, 12, 4),
            substr($striped, 16, 4),
            substr($striped, 20),
        );
        return implode('-', $components);
    }
?>