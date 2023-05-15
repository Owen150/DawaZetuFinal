<?php
  
function active_class($path, $active = 'active') {
  return call_user_func_array('Request::is', (array)$path) ? $active : '';
}

function is_active_route($path) {
  return call_user_func_array('Request::is', (array)$path) ? 'true' : 'false';
}

function show_class($path) {
  return call_user_func_array('Request::is', (array)$path) ? 'show' : '';
}


function getFinacialPeriod()
{
    $period = '';

    switch (date('m')) {
      case '7':
        $period = 1;
        break;
      case '8':
        $period = 1;
        break;
      case '9':
        $period = 1;
        break;
      case '10':
        $period = 2;
        break;
      case '11':
        $period = 2;
        break;
      case '12':
        $period = 2;
        break;
      case '1':
        $period = 3;
        break;
      case '2':
        $period = 3;
        break;
      case '3':
        $period = 3;
        break;
      case '4':
          $period = 4;
          break;
      case '5':
          $period = 4;
          break;
      case '6':
          $period = 4;
          break;
      default:
        # code...
        break;
    }

    //return $period;
    return 1;
}