<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * DD
 *
 * Dump a value and die.
 *
 * @param value => The value for dump (*)
 *
 * @return void
 */
if(!function_exists('dd')){

  function dd( $value = '' )
  {
    var_dump($value);
    die();
  }

}
