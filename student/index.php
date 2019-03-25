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
            $student_map = $db_connection->prepare("SELECT first_name, last_name 
                FROM user NATURAL JOIN student
                WHERE user_id = ?;");
            // Check Connection
            if ($student_map === FALSE) {
              $error = "Connection Failed";
              die($db_connection->error);
            }
            // bind
            $student_map->bind_param("s", $user_id);
            $student_map->execute();
            // results
            $result = $student_map->get_result();

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

            $student_map->close();
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
