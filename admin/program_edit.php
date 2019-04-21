<?php
//======================================================================
// PROGRAM EDIT
//======================================================================
  /* Quick Paths */
  /* note the 2 after __FILE__, because it's 2 directories deep */
  include_once (realpath(dirname(__FILE__, 2).'/php/session.php'));
  /* Check Role */
  include_once (ROOT_SRC_PATH .'/check_admin.php');

  /* Page Name */
  $page_name = "admin-program-add";

  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $_SESSION['edit_program'] = $_POST['edit_program_id'];
  } else {
    $error = 'No Program ID selected.';
  }

?>
<!doctype html>
<html lang="en">
  <head>
  <?php include_once (ROOT_PATH . '/include/head.php'); ?>
  </head>
  <body class="<?php echo $page_name; ?>">
  <?php //include_once (ROOT_PATH . '/include/header.php'); ?>
    <main role="main" class="container">
      <div class="row justify-content-sm-center">
        <div class="col-sm-9">
          <!-- Content for the webpage starts here -->
          <div class="row">
            <div class="col-sm-9">
              <h1>Program Edits</h1>
            </div>
            <div class="col-sm-3">
                <a href="<?php echo BASE_URL ?>/admin/program.php" class="btn btn-primary">Back</a>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
            <?php

              $db_connection->connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
              $editdept = $db_connection->prepare("SELECT program_id, program_name, dept_id, status_id FROM program WHERE program_id = ?");
              if ($editdept === FALSE) {
                echo "Connection Failed";
                die($db_connection->error);
              }
              $editdept->bind_param('s', $_SESSION['edit_program']);
              $editdept->execute();
              $result = $editdept->get_result();
              if($result->num_rows === 0) exit('No rows');
              while($row = $result->fetch_assoc()) {
                $program_id = $row['program_id'];
                $program_name = $row['program_name'];
                $dept_id = $row['dept_id'];
                $status_id = $row['status_id'];
              }
              $editdept->close();
            ?>

              <form action="<?php echo BASE_URL ?>/php/admin_program_edit.php" method="post">
                <fieldset>
                  <legend>Program:</legend>

                  <div class="form-group">
                    <label for="program_id">Program ID:</label>
                    <input type="text" class="form-control" id="program_id" name="program_id" value="<?php echo $program_id; ?>">
                  </div>

                  <div class="form-group">
                    <label for="program_name">Program Name:</label>
                    <input type="text" class="form-control" id="program_name" name="program_name" value="<?php echo $program_name; ?>">
                  </div>

                  <div class="form-group">
                    <label for="dept_id">Department ID:</label>
                    <input type="text" class="form-control" id="dept_id" name="dept_id" value="<?php echo $dept_id; ?>">
                  </div>

                  <div class="form-group">
                    <label for="status_id">Status ID:</label>
                    <input type="text" class="form-control" id="status_id" name="status_id" value="<?php echo $status_id; ?>">
                  </div>

                </fieldset>
                <button type="submit" class="btn btn-primary">UPDATE</button>
              </form>

              <?php include_once (ROOT_SRC_PATH . '/error_rprt.php'); ?>

            </div>
          </div>
        </div>
      </div>
    </main>
    <?php include_once (ROOT_PATH . '/include/footer.php'); ?>
  </body>
</html>
