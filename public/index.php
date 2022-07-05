<?php

	define( "LIMIT", 10);

	function debug( $var)
	{
		$debug = debug_backtrace();
		echo "<pre>" . $debug[0]['file']." ".$debug[0]['line']."<br><br>";
		print_r($var);
		echo "</pre>" . "<br>";
	}

	include dirname( dirname(__FILE__)) . "/lib/ConfigClass.php";
	include dirname( dirname(__FILE__)) . "/lib/CustomErrorLog.php";
	include dirname( dirname(__FILE__)) . "/lib/PDOManager.php";
	include dirname( dirname(__FILE__)) . "/models/FilmModel.php";
	include dirname( dirname(__FILE__)) . "/modules/CustomPaging.php";
	include dirname( dirname(__FILE__)) . "/modules/Pagination.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- <link rel="icon" href="/favicon.ico"> -->

  <title>Pagination Example</title>

  <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">

  <!-- Bootstrap core CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1/dist/css/bootstrap.min.css" rel="stylesheet">


  <link href="/css/styles.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/fontawesome.min.css"  />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />

</head>

<body  class="">

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
          <a class="navbar-brand" href="/?page=10-0-1">Ejemplo paginación</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                  <li class="nav-item"><a class="nav-link active" aria-current="page" href="/?page=10-0-1">Home</a></li>
                  <li class="nav-item"><a class="nav-link" href="#">Link</a></li>

              </ul>
          </div>
      </div>
  </nav>
  <!-- Page content-->
  <div class="container">
      <div class="text-center mt-5">
          <h1>List of table records: </h1>
          <p>Show <?php echo count($rows['rows']['data']); ?> records from <?php echo $rows['count']; ?></p>

          <table class="table table-striped">
				    <thead>
				      <tr>
				      	<th class='text-center'>film_id</th>
				      	<th class='text-center'>title</th>
				      	<th class='text-center'>release_year</th>
				      	<th class='text-center'>last_update</th>

				      </tr>
				    </thead>
				    <tbody>
				          <?php

				            foreach( $rows['rows']['data'] as $value)
				            {

				              echo "<tr>";
				              echo "<td>" . $value['film_id'] . "</td>";
				              echo "<td>" . $value['title'] . "</td>";
				              echo "<td class='text-center'>" . $value['release_year'] . "</td>";
				              echo "<td class='text-center'>" . date("d/m/Y H:s:i", strtotime( $value['last_update'])) . "</td>";
				              echo "</tr>";

				            }

				          ?>

				    </tbody>
				  </table>

				  <nav aria-label="Page navigation example" style="padding-top:20px; padding-bottom:100px; display:flex; justify-content: center;">
			    <ul class="pagination">

			      <?php

			      		$custom_paging = new CustomPaging();
			      		$html = $custom_paging->GetPagination( $paging);
			      		echo $html;

			      ?>

			    </ul>
			  </nav>


      </div>
  </div>


  <!-- Bootstrap core JavaScript -->
    <script
      src="https://code.jquery.com/jquery-3.6.0.min.js">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" >
    </script>

</body>

</html>