<?php
//======================================================================
// STUDENT DASHBOARD PAGE
//======================================================================
  /* Quick Paths */
  /* note the 2 after __FILE__, because it's 2 directories deep */
  include_once (realpath(dirname(__FILE__, 2).'/php/session.php'));
  /* Check Role */
  include_once (ROOT_SRC_PATH .'/check_student.php');

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
          <h1>Graduation Map</h2>

          <?php
            //-----------------------------------------------------
            // Student Graduation Map
            //-----------------------------------------------------

            $db_connection->connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $student_detail = $db_connection->prepare("SELECT first_name, last_name 
                FROM user NATURAL JOIN student
                WHERE user_id = ?;");
            // Check Connection
            if ($student_detail === FALSE) {
              $error = "Connection Failed";
              die($db_connection->error);
            }
            // bind
            $student_detail->bind_param("s", $user_id);
            $student_detail->execute();
            // results
            $result = $student_detail->get_result();

            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {

                echo '<div class="row">';
                echo '<div class="col-md-6">';
                echo '<h3 class="student_name">'. $row["first_name"] . ' ' . $row["last_name"] . '</h3>';
                echo '</div>';
                echo '<div class="col-md-6">';
                echo 'Advisor: <a href="mailto:#"><i class="far fa-envelope"></i></a>';
                echo '</div>';
                echo '</div>';

              }
            }

            $student_detail->close();

            // create the first term map
            $student_term_map = $db_connection->prepare("SELECT * 
              FROM take NATURAL JOIN student
              WHERE user_id = ?;");
            // Check Connection
            if ($student_term_map === FALSE) {
              $error = "Connection Failed";
              die($db_connection->error);
            }
            // bind
            $student_term_map->bind_param("s", $user_id);
            $student_term_map->execute();
            // results
            $result = $student_term_map->get_result();

            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                echo '<div class="row">';
                echo '<div class="col-sm-6">';
                echo '<div class="card">';
                echo '<div class="card-header">';
                echo '</div>'; // end card-header
                echo '<ul class="list-group list-group-flush">'; 
                echo '<li class="list-group-item">';
                echo '';
                echo '</li>'; // end list-group-item
                echo '</ul>'; // end list-group
                echo '<div class="card-footer">';
                echo '<a href="#" class="btn btn-primary">View</a>';
                echo '</div>'; // end card-footer
                echo '</div>'; // end card
                echo '</div>'; // end col
                echo '</div>'; // end row
              }
            }
            // Close the mysql connection
            mysqli_close($db_connection);
            
          ?>

          <?php include_once (ROOT_SRC_PATH . '/error_rprt.php'); ?>

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
