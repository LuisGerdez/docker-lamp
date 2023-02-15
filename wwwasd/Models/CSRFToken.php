<?php


class CSRFToken {
    
    public static function setToken():void {
        
        $token = $_SESSION['csrf'] = hash('sha384', rand());
        
        echo(
            "<script>
                document.getElementById('tokenCSRF').value = '$token';
            </script>"
        );
    }

    public static function setToken2() {
        
        $token = hash('sha384', rand());
        $_SESSION['csrf'] = $token;
        return $token;
    }

    public static function verifyToken(string $tokenInSession, string $tokenInField): bool
    {
        return hash_equals($tokenInSession, $tokenInField);
    }
}

?>