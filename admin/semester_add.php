<?php
//======================================================================
// SEMESTER ADD
//======================================================================
  /* Quick Paths */
  /* note the 2 after __FILE__, because it's 2 directories deep */
  include_once (realpath(dirname(__FILE__, 2).'/php/session.php'));
  /* Check Role */
  include_once (ROOT_SRC_PATH .'/check_admin.php');

  /* Page Name */
  $page_name = "admin-semester-add";

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
              <h1>Semester Administration Addition</h1>
            </div>
            <div class="col-sm-3">
                <a href="<?php echo BASE_URL ?>/admin/semester.php" class="btn btn-primary">Back</a>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
            <form action="<?php echo BASE_URL ?>/php/admin_semester_add.php" method="post">
                    <fieldset>
                      <legend>Semester:</legend>
                      <div class="form-row">
                        <div class="form-group col-sm-3">
                          <label for="semester_id">Semester ID:</label>
                          <input type="text" class="form-control" id="semester_id" placeholder="Semester ID" name="semester_id" maxlength="3">
                        </div>
                        <div class="form-group col-sm-6">
                          <label for="semester_name">Semester Name:</label>
                          <input type="text" class="form-control" id="semester_type" placeholder="Semester Type" name="semester_type">
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
