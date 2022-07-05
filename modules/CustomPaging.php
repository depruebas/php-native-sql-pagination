<?php 



Class CustomPaging
{


  public function GetPagination( $data = [])
  {
    # Es la variable que devolveremos con el cuadro de paginacion completo.
    $html_pagination = "";

    # Calculamos los links de la página anterior y la siguiente
    $anterior =  $data['refer_uri'] . "?page=" . $data['limit'] . "-" . ($data['offset'] -  $data['limit']) . "-" . ($data['actual_page'] - 1);
    $siguiente = $data['refer_uri'] . "?page=" . $data['limit'] . "-" . ($data['offset'] +  $data['limit']) . "-" . ($data['actual_page'] + 1);

    # Calculamos la ultima y la primera
    $primera = $data['refer_uri'] . "?page=" . $data['limit'] . "-0-1";
    $ultima = $data['refer_uri'] . "?page=" . $data['limit'] . "-" . (($data['total_pages'] * $data['limit']) - $data['limit']) . "-" . $data['total_pages'];

    # Ponemos los dos primeros botones de Anterior y Primera
    if ( $data['actual_page'] == 1)
    {
      $html_pagination .= '<li class="page-item disabled"><a class="page-link" href="#">Primera</a></li>';
      $html_pagination .= '<li class="page-item disabled"><a class="page-link" href="#">Anterior</a></li>';
    }
    else
    {
      $html_pagination .= '<li class="page-item"><a class="page-link" href="'.$primera.'">Primera</a></li>';
      $html_pagination .= '<li class="page-item"><a class="page-link" href="'.$anterior.'">Anterior</a></li>';
    }

    # Calculamos el offset que descuenta hacia atras ... 1 2 3 y siempre tiene que ser un valor positivo
    $offset = abs(($data['limit']  * $data['decrease']) - $data['offset']);


    # Calculamos la cantidad de numeros que van antes de la página actual, esta cantidad viene marcada por el valor de decrease
    $decrease = $data['actual_page'] - $data['decrease'];

    if ( $decrease <= 0) $decrease = 1;

    $j = $data['decrease'];

    for ( $ii = $decrease; $ii <  $data['actual_page'] ; $ii++, $j--)
    {
      if ( $ii == 1)
      {
        $offset = 0;
      }

      if ( $ii > 0)
      {
        $html_pagination .= '<li class="page-item">
          <a class="page-link" href="/' . $data['refer_uri'] . "?page=" . $data['limit'] . '-' . $offset . '-' . $ii . '">' . $ii . '</a>
        </li>';
        $offset += LIMIT;
      }
      
      if ( $ii < 0) break;
    }
    

    # Ponemos la página actual y la marcamos como disabled para que no tenga enlace a ella misma
    $html_pagination .= '<li class="page-item disabled">
        <a class="page-link" href="/' . $data['refer_uri'] . "?page=" . $data['limit'].'-'.$offset.'-'.$data['actual_page'].'">'.$data['actual_page'].'</a>
      </li>';

    # Calculamos la cantidad de numeros que van despues de la página actual, esta cantidad viene marcada por el valor de increase
    $offset = $data['offset'];
    $increase = $data['actual_page'] + $data['increase'];

    for( $i = $data['actual_page'] + 1; $i <= ($increase); $i++)
    {

      if ( $i > $data['total_pages']) break;

      $offset += LIMIT;
      $html_pagination .= '<li class="page-item">
        <a class="page-link" href="/' . $data['refer_uri'] . "?page=" . $data['limit'].'-'.$offset.'-'.$i.'">'.$i.'</a>
      </li>';
     
    }
            
    # Añadimos los botones finaes Siguiente y Ultima.
    if ( $data['actual_page'] == $data['total_pages'])
    {
      $html_pagination .= '<li class="page-item disabled"><a class="page-link" href="#">Siguiente</a></li>';
      $html_pagination .= '<li class="page-item disabled"><a class="page-link" href="#">Última</a></li>';
    }
    else
    {
      $html_pagination .= '<li class="page-item"><a class="page-link" href="'.$siguiente.'">Siguiente</a></li>';
      $html_pagination .= '<li class="page-item"><a class="page-link" href="'.$ultima.'">Última</a></li>';
    }

    return ( $html_pagination);
  }

}