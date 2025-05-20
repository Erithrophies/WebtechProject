<?php

    //session_start();
    //session_destroy();
    setcookie('status', 'true', time()-10, '/');
    setcookie('emp', 'true', time()-10, '/');
    setcookie('hr', 'true', time()-10, '/');
    setcookie('mng', 'true', time()-10, '/');

    header('location: ../view/UserAuth.html');

?>