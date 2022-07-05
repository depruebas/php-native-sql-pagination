<?php

	if ( !isset($_GET['page']))
	{
		header( "location: http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . "?page=" . LIMIT . "-0-1");
	}

	$params = explode( "-", $_GET['page']);

	$limit = $params[0];
	$offset = $params[1];
	$actual_page = $params[2];

	# Obenemos los datos de configuración para conectarse a al base de datos
	# Y nos conectamos
	$_config = ConfigClass::get("config.database")['sakila'];
  PDOManager::Connection( $_config);


  # Obrenemos los regisros de la base de datos ya paginados con el limit y Offset que
  # viene por parametros
  $film = new FilmModel();
  $rows = $film->GetFilms($limit, $offset);


  # Calculamos el numero de paginas que salen dividiendo el total de registros por los
  # registros que se muestran por pantalla.
  $pages = ceil($rows['count'] / $limit);


  # Seteamos las variables que necesita la clase CustomPaging para calcular la pagina actual,
  # siguiente, anterior, ultima y primera, asi como los numeros que siguen.
  $paging = [
    'refer_uri' => 'index.php',
    'total_pages' => $pages,
    'actual_page' => $actual_page,
    'increase' => 3,                  # Number of pages before the current one
    'decrease' => 3,                   # Number of pages after the current one
    'offset' => $offset,
    'limit' => $limit,
  ];


  # Cerramos conexión con la base de datos
  PDOManager::Close();





