<?php

use mscribellito\Str;

if (!function_exists('Str')) {
    /**
   * Instantiates a new Str.
   *
   * @param mixed $original a string
   * @param int $offset the initial offset
   * @param int $count the length
   *
   * @throws OutOfBoundsException
   */
  function Str($original = '', $offset = null, $count = null)
  {
      return new Str($original, $offset, $count);
  }
}
