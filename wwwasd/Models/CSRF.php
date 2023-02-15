<?php

include "Session.php";
use Models\Session;



class CSRF {
    
    public static function setToken():void {
        
        $token = $_SESSION['csrf'] = hash('sha384', rand());
        
        echo(
            "<script>
                document.getElementById('tokenCSRF').value = '$token';
            </script>"
        );
    }

    public static function verifyToken(string $tokenInSession, string $tokenInField): bool
    {
        return hash_equals($tokenInSession, $tokenInField);
    }
}