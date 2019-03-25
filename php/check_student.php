<?php

//======================================================================
// CHECK STUDENT ROLL
//======================================================================

if($user_role == 3){
  $_SESSION['message'] = "Access Granted";
} else {
  $_SESSION['message'] = "Access Denied";
  header("location: " . SRC_PATH . "/logout.php");
}

?>