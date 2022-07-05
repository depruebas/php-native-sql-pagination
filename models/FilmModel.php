<?php


Class FilmModel
{

	public function GetFilms( $limit = null, $offset = null)
  {
    # Si no vienen limites paramos la ejecución, aqui estaria bien mostrar
    # Aqui devolvemos un error controlado, en el ejemplo para el programa
    if ( $limit == null && $offset == null) die("Faltan limites");

    # Primero extraemos en total de registros que tenemos
    $params_count['query'] = "SELECT count(*) as total FROM film";
    $params_count['params'] = [];
    $rows_count = PDOManager::ExecuteQuery( $params_count);

    # Obtenemos solo los registros que queremos de n en n, lo que diga el limit y
    # el offset es por la página que vamos empezando por el 0
    $params['query'] = "SELECT film_id, title, release_year, last_update
                        FROM film order by film_id desc limit " . $limit . " offset " . $offset;
    $params['params'] = [];
    $rows = PDOManager::ExecuteQuery( $params);

    return(
      [
        'count' => $rows_count['data'][0]['total'],
        'rows' => $rows,
      ]
    );

  }

}