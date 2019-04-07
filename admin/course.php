<?php
//======================================================================
// COURSES
//======================================================================
  /* Quick Paths */
  /* note the 2 after __FILE__, because it's 2 directories deep */
  include_once (realpath(dirname(__FILE__, 2).'/php/session.php'));
  /* Check Role */
  include_once (ROOT_SRC_PATH .'/check_admin.php');
  /* Start The Session */
  session_start();

  /* Page Name */
  $page_name = "admin-course"; 

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
              <h1>Course Administration</h1>
            </div>
            <div class="col-sm-3">
              <form action="" method="post">
              <a href="../admin/course_add.php" class="btn btn-primary">Add Course</a>
              </form>
            </div>
          </div> 
          <div class="row">
            <div class="col-sm-12">
          <!-- table of course list here -->
          <table class="table table-striped">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Course ID</th>
                <th scope="col">Course Name</th>
                <th scope="col">Credits</th>
                <th scope="col">Status</th>
                <th scope="col">Semester</th>
                <th scope="col">Edit</th>
              </tr>
            </thead>
            <tbody>
            <?php
                // Query Reference for Bind
                // Nothing to Reference

                // View Students
                $db_connection->connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                // SQL statment
                $dept_view = $db_connection->prepare("SELECT dept_id, dept_name, status_type 
                FROM department NATURAL JOIN status;");
                // Check Connection
                if ($dept_view === FALSE) {
                  $error = "Connection Failed";
                  die($db_connection->error);
                }
                // bind 
                //$student_view->bind_param();
                // execute
                $dept_view->execute();
                // results
                $result = $dept_view->get_result();

                if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                    echo '<tr>'; 
                    echo '<td scope="row"> [ID] </td>';          
                    echo '<td scope="row"> [Course Name] </td>';
                    echo '<td scope="row"> [Credits] </td>';
                    echo '<td scope="row"> [Status] </td>';
                    echo '<td scope="row"> [Semester] </td>'; 
                    echo '<td><form method="post" action="'.BASE_URL.'/php/#">';
                    echo '<input type="hidden" name="#" value="#">';
                    echo '<button type="submit" class="btn btn-link btn-sm"><i class="fas fa-archway"></i> edit</button>';
                    echo '</form></td>';
                    echo '</tr>';
                  }
                } else {
                  $error = "There was a problem showing the students list.";
                };

                // Always Close the DB Connection
                $dept_view->close();
              ?>

            </tbody>
          </table>
          </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
            <!-- Error Reporting -->
            <?php
              /* Error Message */
              if (isset($error)) {
                // uses bootstrap alert style for error messages
                echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
              }
              /* Message Information */
              if (isset($message)) {
                // uses bootstrap alert style for error messages
                echo '<div class="alert alert-info" role="alert">' . $message . '</div>';
              }
            ?>
            </div>
          </div>
        </div>
      </div>
    </main>
    <?php include_once (ROOT_PATH . '/include/footer.php'); ?>
  </body>
</html>
