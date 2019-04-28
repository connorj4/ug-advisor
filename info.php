<?php
//======================================================================
// LOGIN PAGE
//======================================================================
  /* Quick Paths */
  include_once (realpath(dirname(__FILE__).'/php/path.php'));

  /* Page Name */
  $page_name = "home";

  /* Start The Session */
  session_start(); 

?>
<!doctype html>
<html lang="en">
  <head>
  <?php include_once (ROOT_PATH . '/include/head.php'); ?>
  </head>
  <body class="<?php echo $page_name; ?>">
  <?php include_once (ROOT_PATH . '/include/header.php'); ?>
    <main role="main" class="container">
      <div class="row justify-content-sm-center">
        <div class="col-sm-4">
          <h1>Undergraduate Advisor</h1><br>
          <p>Undergraduate Advisor (UA) is a web application designed to streamline the course selection experience for undergraduate students attending Southern Connecticut State University (SCSU).</p>
          <p> The aim of the application is twofold: 
          <ol> 1) to provide a clear course selection path for undergraduates, and </ol>
          <ol> 2) to increase communication between undergraduate students and their advisors.</ol>
          <p>Undergraduate Advisor is built on a foundation of SCSU catalog requirements. It makes use of an adaptive ‘Academic Maps’ function to build out student roadmaps toward the academic major, minor, and liberal arts requirements.</p>


          
        </div>
      </div>
    </main>
    <?php include_once (ROOT_PATH . '/include/footer.php'); ?>
  </body>
</html>
