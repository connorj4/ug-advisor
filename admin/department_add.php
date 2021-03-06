<?php
//======================================================================
// DEPARTMENT ADD
//======================================================================
  /* Quick Paths */
  /* note the 2 after __FILE__, because it's 2 directories deep */
  include_once (realpath(dirname(__FILE__, 2).'/php/session.php'));
  /* Check Role */
  include_once (ROOT_SRC_PATH .'/check_admin.php');

  /* Page Name */
  $page_name = "admin-department-add"; 

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
              <h1>Department Administration Addition</h1>
            </div>
            <div class="col-sm-3">
                <a href="<?php echo BASE_URL ?>/admin/department.php" class="btn btn-primary">Back</a>
            </div>
          </div> 
          <div class="row">
            <div class="col-sm-12">
            <form action="<?php echo BASE_URL ?>/php/admin_dept_add.php" method="post">
                    <fieldset>
                      <legend>Department:</legend>
                      <div class="form-row">
                        <div class="form-group col-sm-3">
                          <label for="dept_id">Department ID:</label>
                          <input type="text" class="form-control" id="dept_id" placeholder="Deptarment ID" name="dept_id" maxlength="3">
                        </div>
                        <div class="form-group col-sm-6">
                          <label for="dept_name">Department Name</label>
                          <input type="text" class="form-control" id="dept_name" placeholder="Department Name" name="dept_name">
                        </div>
                        <div class="form-group col-sm-3">
                          <label for="status_id">Status</label>
                          <select class="form-control" id="status_id" name="status_id">
                          <?php 
                            $db_conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                              OR die("Connection failed in retrieving status");
                            $retrieve_status = $db_conn->prepare("SELECT status_id,status_type FROM status;");
                            $retrieve_status->execute();
                                  $retrieve_status->bind_result($result_status_id,$result_status_type);
                            while($retrieve_status->fetch()){      
                              echo "<option value='".$result_status_id."'>".$result_status_type."</option>";
                            }
                            $retrieve_status->close();
                            $db_conn->close();
                            ?>
                          </select>
                        </div>
                      </div>
                    </fieldset>
                    <?php
                      /* Error Message */
                      if (isset($error)) {
                        // uses bootstrap alert style for error messages
                        echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
                      }
                    ?>
                    <button type="submit" class="btn btn-primary">ADD</button>
                    <button type="reset" class="btn btn-warning">reset</button>
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
