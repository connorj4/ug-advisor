<?php
//======================================================================
// STUDENT TERM PAGE
//======================================================================
  /* Quick Paths */
  /* note the 2 after __FILE__, because it's 2 directories deep */
  include_once (realpath(dirname(__FILE__, 2).'/php/path.php'));

  /* Page Name */
  $page_name = "term";

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
    <main role="main" class="container text-center">
      <div class="row justify-content-sm-center">
        <div class="col-sm-9">
          <!-- Content for the webpage starts here -->
          <h1>Student [NAME] YEAR [YEAR] </h1>
          <p>Lorem ipsum dolor sit amet,</p>

          <!-- CURRENT TERM-->

          <div class="row">
            <div class="col-sm-8">
              <div class="card">
                <div class="card-header">
                   [CURRENT SEMESTER]
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item text-left">[class] <a href="#" class="btn btn-primary float-right">Remove Class</a></li>
                  <li class="list-group-item text-left">[class] <a href="#" class="btn btn-primary float-right">Remove Class</a></li>
                  <li class="list-group-item text-left">[class] <a href="#" class="btn btn-primary float-right">Remove Class</a></li>
                  <li class="list-group-item text-left">[class] <a href="#" class="btn btn-primary float-right">Remove Class</a></li>
                </ul>
                <div class="card-footer">
                <a href="#" class="btn btn-primary">Add New Class</a>
                </div>
              </div><!-- /card -->
            </div><!-- /col 12 -->
          <hr>
        </div>
      </div>
    </main>
    <?php include_once (ROOT_PATH . '/include/footer.php'); ?>
  </body>
</html>
