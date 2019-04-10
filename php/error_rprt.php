<?php
//======================================================================
// ERROR AND MESSAGE REPORTS
//======================================================================

  /* Error Report */
  if (isset($error)) {
    // uses bootstrap alert style for error messages
    echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
  }
  /* Message Report */
  if (isset($message)) {
    // uses bootstrap alert style for error messages
    echo '<div class="alert alert-warning" role="warning">' . $message . '</div>';
  }
?>