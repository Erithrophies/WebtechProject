<?php

    // session_start();
    // session_destroy();
    setcookie('status', 'true', time()-10, '/');
    setcookie('emp', 'true', time()-10, '/');
    setcookie('hr', 'true', time()-10, '/');
    setcookie('mng', 'true', time()-10, '/');
    setcookie('emp_doc', 'true', time()-10, '/');
    setcookie('emp_emp', 'true', time()-10, '/');
    setcookie('emp_leave', 'true', time()-10, '/');
    setcookie('hr_d', 'true', time()-10, '/');
    setcookie('hr_emp', 'true', time()-10, '/');
    setcookie('hr_leave', 'true', time()-10, '/');
    setcookie('hr_perfomance', 'true', time()-10, '/');
    setcookie('mng_leave', 'true', time()-10, '/');
    setcookie('mng_doc', 'true', time()-10, '/');
    setcookie('mng_emp', 'true', time()-10, '/');

    header('location: ../view/UserAuth.html');

?>