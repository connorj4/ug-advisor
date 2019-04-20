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

                echo '<div class="row justify-content-sm-center">';
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
            $student_term_map = $db_connection->prepare("SELECT 
              year_type AS year, 
              semester_type AS semester, 
              take_status_type AS status, 
              dept_id AS dept, 
              course_num AS course, 
              course_name,
              grade_type AS grade,
              credits
              FROM take 
                NATURAL JOIN semester 
                NATURAL JOIN years 
                NATURAL JOIN take_status
                NATURAL JOIN grade 
                NATURAL JOIN course;");
            // Check Connection
            if ($student_term_map === FALSE) {
              $error = "Connection Failed";
              die($db_connection->error);
            }
            // bind
            // $student_term_map->bind_param("s", $user_id);
            $student_term_map->execute();
            // results
            $result = $student_term_map->get_result();
            $rowcount = mysqli_num_rows($result);

            $array = array();
            if ($result->num_rows > 0) {
              //$row = $result->fetch_assoc();
              while($row = $result->fetch_assoc()) {
                $array[] = $row;
              }
            }
            $previousYear = null;
            $previousSemester = null;
            

            echo count($array);
            for($i=0; $i<=count($array); $i++){
            
                if ($previousYear == null and $previousSemester == null or $previousYear == $array[$i]["year"] and $previousSemester != $array[$i]["semester"]) {
                  echo '<div class="row justify-content-sm-center">';
                } 
                // echo $previousSemester . " : " . $array[$i]["semester"];
                if ($previousSemester == null or $previousSemester != $array[$i]["semester"]) {
                  echo '<div class="col-sm-6">';
                  echo '<div class="card">';
                  echo '<div class="card-header">';
                  echo $array[$i]["year"] . ' | ' . $array[$i]["semester"] . ' | <span class="badge badge-primary badge-pill text-uppercase">' . $array[$i]["status"] . '</span>' ;
                  echo '</div>'; // end card-header
                  echo '<ul class="list-group list-group-flush">'; 
                }
                
                echo '<li class="list-group-item">';
                echo '<div class="d-flex flex-nowrap justify-content-between">';
                echo '<div class="p-2 align-self-center">' . $array[$i]["dept"] . '</div>';
                echo '<div class="p-2 align-self-center">' . $array[$i]["course"] . '</div>';
                echo '<div class="p-2 align-self-center">' . $array[$i]["course_name"] . '</div>'; 
                echo '<div class="p-2 align-self-center"><span class="badge badge-info badge-pill pill-big">' . $array[$i]["credits"] . '</span></div>';
                echo '<div class="p-2 align-self-center"><span class="badge badge-secondary badge-pill pill-big ">' . $array[$i]["grade"] . '</span></div>';
                echo '</div>'; // end list-group-item
                echo '</li>'; // end list-group-item

                if ($previousSemester == null) {
                  // do nothing
                } elseif ($previousSemester != $array[$i]["semester"] or $rowcount == $i) {
                  echo '</ul>'; // end list-group
                  echo '<div class="card-footer">';
                  echo '<a href="'. BASE_URL .'/student/term.php" class="btn btn-primary">View</a>';
                  echo '</div>'; // end card-footer
                  echo '</div>'; // end card
                  echo '</div>'; // end col
                }
                
                if ($rowcount == $i or $previousYear == $array[$i]["year"] and $previousSemester != $array[$i]["semester"] ) {
                  echo '</div>'; // end row
                } else {
                }

                $previousYear = $array[$i]["year"];
                $previousSemester = $array[$i]["semester"];
                
              } 
             
            // Close the mysql connection
            mysqli_close($db_connection);
            
          ?>

          <?php include_once (ROOT_SRC_PATH . '/error_rprt.php'); ?>

          <!-- GRADUATION  MAP -->

          
          <hr>
        </div>
      </div>
    </main>
    <?php include_once (ROOT_PATH . '/include/footer.php'); ?>
  </body>
</html>
