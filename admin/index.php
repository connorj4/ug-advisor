<?php
//======================================================================
// ADMIN DASHBOARD PAGE
//======================================================================
  /* Quick Paths */
  /* note the 2 after __FILE__, because it's 2 directories deep */
  include_once (realpath(dirname(__FILE__, 2).'/php/path.php'));

  /* Page Name */
  $page_name = "admin";

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
        <div class="col-sm-9">
          <!-- Content for the webpage starts here -->
          <h1>Page Title</h1>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec et auctor lectus. Donec a est at orci ultrices finibus. Ut et gravida est. Cras ut pretium mi, et sagittis dui. Nunc facilisis quam nibh, id ornare magna sodales in. Proin viverra elementum odio ut hendrerit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
          
        </div>
      </div>
    </main>
    <?php include_once (ROOT_PATH . '/include/footer.php'); ?>
  </body>
</html>
