<?php

    function checkPerm(array $perms, int $perm) {
        for($i = 0; $i < sizeof($perms); $i++) {
            if($i == $perm) return true;
        }
        return false;
}

?>