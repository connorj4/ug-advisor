<?php
//======================================================================
// STUDENT DASHBOARD PAGE
//======================================================================
  /* Quick Paths */
  /* note the 2 after __FILE__, because it's 2 directories deep */
  include_once (realpath(dirname(__FILE__, 2).'/php/path.php'));

  /* Page Name */
  $page_name = "student";

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
          <h1>Student [NAME] Advisor [NAME] </h1>
          <p>Lorem ipsum dolor sit amet,</p> 

          <!-- GRADUATION  MAP -->

          <!-- YEAR -->
          <div class="row">
            <!-- TERM -->
            <div class="col-sm-6">
              <div class="card">
                <div class="card-header">
                  [YEAR] - Fall
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">[course]</li>
                  <li class="list-group-item">[course]</li>
                  <li class="list-group-item">[course]</li>
                  <li class="list-group-item">[course]</li>
                </ul>
                <div class="card-footer">
                <a href="#" class="btn btn-primary">View</a>
                </div>
              </div><!-- /card -->
            </div><!-- /col 6 -->
            <!-- TERM -->
            <div class="col-sm-6">
              <div class="card">
                <div class="card-header">
                  [YEAR] - Spring
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">[course]</li>
                  <li class="list-group-item">[course]</li>
                  <li class="list-group-item">[course]</li>
                  <li class="list-group-item">[course]</li>
                </ul>
                <div class="card-footer">
                <a href="#" class="btn btn-primary">View</a>
                </div>
              </div><!-- /card -->
            </div><!-- /col 6 -->
          </div><!-- /row -->
          <hr>
          <div class="row">
            <!-- TERM -->
            <div class="col-sm-6">
              <div class="card">
                <div class="card-header">
                  [YEAR] - Fall
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">[course]</li>
                  <li class="list-group-item">[course]</li>
                  <li class="list-group-item">[course]</li>
                  <li class="list-group-item">[course]</li>
                </ul>
                <div class="card-footer">
                <a href="#" class="btn btn-primary">View</a>
                </div>
              </div><!-- /card -->
            </div><!-- /col 6 -->
            <!-- TERM -->
            <div class="col-sm-6">
              <div class="card">
                <div class="card-header">
                  [YEAR] - Spring
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">[course]</li>
                  <li class="list-group-item">[course]</li>
                  <li class="list-group-item">[course]</li>
                  <li class="list-group-item">[course]</li>
                </ul>
                <div class="card-footer">
                <a href="#" class="btn btn-primary">View</a>
                </div>
              </div><!-- /card -->
            </div><!-- /col 6 -->
          </div><!-- /row -->
          <hr>
          <div class="row">
            <!-- TERM -->
            <div class="col-sm-6">
              <div class="card">
                <div class="card-header">
                  [YEAR] - Fall
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">[course]</li>
                  <li class="list-group-item">[course]</li>
                  <li class="list-group-item">[course]</li>
                  <li class="list-group-item">[course]</li>
                </ul>
                <div class="card-footer">
                <a href="#" class="btn btn-primary">View</a>
                </div>
              </div><!-- /card -->
            </div><!-- /col 6 -->
            <!-- TERM -->
            <div class="col-sm-6">
              <div class="card">
                <div class="card-header">
                  [YEAR] - Spring
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">[course]</li>
                  <li class="list-group-item">[course]</li>
                  <li class="list-group-item">[course]</li>
                  <li class="list-group-item">[course]</li>
                </ul>
                <div class="card-footer">
                <a href="#" class="btn btn-primary">View</a>
                </div>
              </div><!-- /card -->
            </div><!-- /col 6 -->
          </div><!-- /row -->
          <hr>
          <div class="row">
            <!-- TERM -->
            <div class="col-sm-6">
              <div class="card">
                <div class="card-header">
                  [YEAR] - Fall
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">[course]</li>
                  <li class="list-group-item">[course]</li>
                  <li class="list-group-item">[course]</li>
                  <li class="list-group-item">[course]</li>
                </ul>
                <div class="card-footer">
                <a href="#" class="btn btn-primary">View</a>
                </div>
              </div><!-- /card -->
            </div><!-- /col 6 -->
            <!-- TERM -->
            <div class="col-sm-6">
              <div class="card">
                <div class="card-header">
                  [YEAR] - Spring
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">[course]</li>
                  <li class="list-group-item">[course]</li>
                  <li class="list-group-item">[course]</li>
                  <li class="list-group-item">[course]</li>
                </ul>
                <div class="card-footer">
                <a href="#" class="btn btn-primary">View</a>
                </div>
              </div><!-- /card -->
            </div><!-- /col 6 -->
          </div><!-- /row -->
          <hr>
        </div>
      </div>
    </main>
    <?php include_once (ROOT_PATH . '/include/footer.php'); ?>
  </body>
</html>
