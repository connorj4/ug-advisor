<?php

//======================================================================
// CHECK ADVISOR ROLL
//======================================================================

if($user_role == 2){
  $_SESSION['message'] = "Access Granted";
} else {
  $_SESSION['message'] = "Access Denied";
  header("location: " . SRC_PATH . "/logout.php");
}

?>