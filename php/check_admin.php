<?php

//======================================================================
// CHECK ADMIN ROLL
//======================================================================

if($user_role == 1){
  $_SESSION['message'] = "Access Granted";
} else {
  $_SESSION['message'] = "Access Denied";
  header("location: " . BASE_URL);
}

?>