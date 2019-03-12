<?php
//======================================================================
// ADMIN DASHBOARD PAGE
//======================================================================
  /* Quick Paths */
  /* note the 2 after __FILE__, because it's 2 directories deep */
  include_once (realpath(dirname(__FILE__, 2).'/php/session.php'));
  /* Check Role */
  include_once (ROOT_SRC_PATH .'/check_admin.php');

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
          
          <div class="row">
            <div class="col-sm-9">
              <h1>Welcome <?php echo $user_name; ?></h1>
            </div>
            <div class="col-sm-3">
              Notification
            </div>
          </div>  
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
                <i class="fas fa-book-reader"></i> Student
                </div>
                <div class="card-body">
                  <a href="<?php echo BASE_URL ?>/admin/student.php" class="btn btn-primary">View</a>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card">
                <div class="card-header">
                <i class="fas fa-user-tie"></i> Faculty
                </div>
                <div class="card-body">
                  <a href="#" class="btn btn-primary">View</a>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card">
                <div class="card-header">
                <i class="fas fa-user-friends"></i> Advisior
                </div>
                <div class="card-body">
                  <a href="#" class="btn btn-primary">View</a>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card">
                <div class="card-header">
                <i class="fas fa-book"></i> Course
                </div>
                <div class="card-body">
                  <a href="#" class="btn btn-primary">View</a>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card">
                <div class="card-header">
                <i class="fas fa-clipboard-check"></i> Prerequisit
                </div>
                <div class="card-body">
                  <a href="#" class="btn btn-primary">View</a>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card">
                <div class="card-header">
                <i class="fas fa-clipboard-list"></i> Program
                </div>
                <div class="card-body">
                  <a href="#" class="btn btn-primary">View</a>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card">
                <div class="card-header">
                <i class="fas fa-archway"></i> Department
                </div>
                <div class="card-body">
                  <a href="<?php echo BASE_URL ?>/admin/department.php" class="btn btn-primary">View</a>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card">
                <div class="card-header">
                <i class="fas fa-calendar-alt"></i> Semester
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
