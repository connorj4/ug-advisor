<?php
//======================================================================
// ADMIN DASHBOARD PAGE
//======================================================================
  /* Quick Paths */
  /* note the 2 after __FILE__, because it's 2 directories deep */
  include_once (realpath(dirname(__FILE__, 2).'/php/session.php'));

  /* Page Name */
  $page_name = "admin";

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
          <h1>Welcome <?php echo $user_name; ?></h1>

          <div class="row">
            <div class="col-sm-6">
              <div class="card">
                <div class="card-header">
                  <strong>Students Without Advisors</strong>
                </div>
                <div class="card-body">
                  <p class="card-text bigger-icon"><i class="fas fa-user-friends"></i> [count]</p>
                  <a href="#" class="btn btn-primary">Update</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card">
              <div class="card-header">
                Courses without programs
              </div>
                <div class="card-body">
                  <p class="card-text bigger-icon"><i class="fas fa-user-graduate"></i> [count]</p>
                  <a href="#" class="btn btn-primary">Update</a>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <h5>Aministration</h5>
          <div class="row">
            <div class="col-md-3">
              <div class="card">
                <div class="card-header">
                Student
                </div>
                <div class="card-body">
                  <a href="#" class="btn btn-primary">View</a>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card">
                <div class="card-header">
                Faculty
                </div>
                <div class="card-body">
                  <a href="#" class="btn btn-primary">View</a>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card">
                <div class="card-header">
                Advisior
                </div>
                <div class="card-body">
                  <a href="#" class="btn btn-primary">View</a>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card">
                <div class="card-header">
                Course
                </div>
                <div class="card-body">
                  <a href="#" class="btn btn-primary">View</a>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card">
                <div class="card-header">
                Prerequisit
                </div>
                <div class="card-body">
                  <a href="#" class="btn btn-primary">View</a>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card">
                <div class="card-header">
                Program
                </div>
                <div class="card-body">
                  <a href="#" class="btn btn-primary">View</a>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card">
                <div class="card-header">
                Department
                </div>
                <div class="card-body">
                  <a href="#" class="btn btn-primary">View</a>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card">
                <div class="card-header">
                Semester
                </div>
                <div class="card-body">
                  <a href="#" class="btn btn-primary">View</a>
                </div>
              </div>
            </div>

            </div>

             
                  
          
        </div>
      </div>
    </main>
    <?php include_once (ROOT_PATH . '/include/footer.php'); ?>
  </body>
</html>
