<?php
//======================================================================
// STUDENT TERM PAGE
//======================================================================
  /* Quick Paths */
  /* note the 2 after __FILE__, because it's 2 directories deep */
  include_once (realpath(dirname(__FILE__, 2).'/php/session.php'));
  /* Check Role */
  include_once (ROOT_SRC_PATH .'/check_student.php');
  /* Page Name */
  $page_name = "term";

  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $year_type = $_POST['term_year'];
    $semester_type = $_POST['term_semester'];
  } else {
    $error = 'No Department ID selected.';
  }

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
          <h1>Student <?php echo $user_name ?></h1>
          <div class="row">
          <!-- CURRENT TERM-->
          <?php
            $db_connection->connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $student_term_detail = $db_connection->prepare("SELECT 
              take_id,
              course_id,
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
                NATURAL JOIN course
              WHERE student_id = ? AND year_id = ? AND semester_id = ?;");
            // Check Connection
            if ($student_term_detail === FALSE) {
              $error = "Connection Failed";
              die($db_connection->error);
            }
            // bind
            $student_term_detail->bind_param('iii', $_SESSION['student_id'], $year_type, $semester_type);
            $student_term_detail->execute(); 

            $result = $student_term_detail->get_result();
            $rowcount = mysqli_num_rows($result);
            $credit_total = 0;
            $counter = 1;

            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {

                if ($counter == 1) {
                  echo '<div class="col-sm-6">';
                  echo '<form method="post" action="'.BASE_URL.'/student/term.php">';
                  echo '<input type="hidden" name="take_id" value="'.$row["take_id"].'">';
                  echo '<div class="card">';
                  echo '<div class="card-header">';
                  echo '<strong>' . $row["semester"] . ' - ' . $row["year"] . '</strong><br>';
                  echo '<small>Number of Courses:' . $rowcount . '</small>';
                  echo '</div>';
                  echo '<div class="card-body">';
                }
                
                echo '<div class="form-group form-check text-left">';
                echo '<input type="checkbox" class="form-check-input" id="'.$row["course_id"].'" name="course_id" value="'.$row["course_id"].'">';
                echo '<label class="form-check-label small" for="'.$row["course_id"].'">';
                echo $row["dept"] . ' ';
                echo $row["course"] . ' - ';
                echo $row["course_name"] . ' - ';
                echo $row["credits"];
                echo '</label>'; // end form-check-label
                echo '</div>'; // end form-group
                $credit_total += $row["credits"];

                if ($counter == $rowcount) {
                  //echo '</ul>'; // end list-group
                  echo '</div>'; // end card-body
                  echo '<div class="card-footer">';
                  echo 'Total Credits: '. $credit_total . '<br>';
                  echo '<a href="#" class="btn btn-primary">Remove Class</a>';
                  echo '</div>'; // end card-footer
                  echo '</div>'; // end card
                  echo '</form>'; // end form
                  echo '</div>'; // end col
                }
                
                $counter += 1;
            
            }
          }
            $student_term_detail->close();
          ?>

            <div class="col-sm-6">
              <div class="card">
                <div class="card-header">
                   Select Course
                </div><div class="card-body">
                <div class="form-group form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Course Name 3</label>
                </div>
                </div>
                <div class="card-footer">
                <a href="#" class="btn btn-primary">Add Course</a>
                </div>
              </div><!-- /card -->
            </div><!-- /col 6 -->

          </div> <!-- end row -->
          
          <div class="row justify-content-sm-center">
            <div class="col-sm-12">
            <a href="<?php echo BASE_URL ?>/select/check-term.php" class="btn btn-primary">Update Term</a>
            </div>
          </div>
          <hr>
        </div>
      </div>
    </main>
    <?php include_once (ROOT_PATH . '/include/footer.php'); ?>
  </body>
</html>
