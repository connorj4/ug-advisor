<?php
//======================================================================
// ADVISOR DASHBOARD PAGE
//======================================================================
  /* Quick Paths */
  /* note the 2 after __FILE__, because it's 2 directories deep */
  include_once (realpath(dirname(__FILE__, 2).'/php/session.php'));
  /* Check Role */
  include_once (ROOT_SRC_PATH .'/check_advisor.php');
  /* Page Name */
  $page_name = "advisor";

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
    <main role="main" class="container">
      <div class="row justify-content-sm-center">
        <div class="col-sm-9">
          <!-- Content for the webpage starts here -->
          <h1>Advisor </h1>
          <!-- Students -->
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Permission</th>
                <th scope="col">View Record</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Mike</td>
                <td>Hunt</td>
                <td>@mdo</td>
                <td>
                <form action="//" type="post">
	                <button type="submit" value="DoIt">This</button>
                </form>
</td>

              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Billy bob</td>
                <td>Thornton</td>
                <td>@fat</td>
                <td>@mdo</td>

              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
                <td>@mdo</td>

              </tr>
            </tbody>
          </table>

        </div>
      </div>
    </main>
    <?php include_once (ROOT_PATH . '/include/footer.php'); ?>
  </body>
</html>
