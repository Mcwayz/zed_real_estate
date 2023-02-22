<?php

class Session
{

    //Function that automatically calls the check session function


    public function __construct()
    {
        $this->init();
        $this->checkSession();
    }


    //Function that initiates the sessions
    

    public function init()
    {
        if (!PHP_SESSION_ACTIVE) :
            session_start();
        endif;
    }



    // Function that gets authentication sessions

    

    public function getAuthSession()
    {
        if (isset($_SESSION['id'])) {
            return $_SESSION['id'];
        } else {
            echo $this->redirectNonAuth();
        }
    }



    //Function that checks if Session is Active



    public function checkSession()
    {
        $this->init();
        $this->getAuthSession();
        if (isset($_SESSION['id'])) {
            return true;
        } else {
            echo $this->redirectNonAuth();
        }
    }


    //Function that logs out users if the session expires
    

    public function redirectNonAuth()
    {
        return "<script>
        alert('Session Has Expired, Kindly Login To Continue...');
        window.location.href = '../authentication/sign-in.php';
        </script>";
    }



    //Function that logs out users and expires all session 



    public function logout()
    {
        session_start();
        if (isset($_SESSION['id'])) {
            session_destroy();
        }
        echo $this->redirectNonAuth();
    }

}
?> 