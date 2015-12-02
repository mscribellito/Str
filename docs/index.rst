.. title:: String, PHP string class/library

Str Documentation
=================

Str is a PHP class that wraps the native string functions in an effort to simplify string handling and manipulation. Str provides methods for examining individual characters of the string, for comparing strings, for searching strings, for extracting substrings, and for creating a copy of a string with all characters translated to uppercase or to lowercase. A Str is immutable (constant) and its value cannot be changed after creation.

.. code-block:: php

    $str = new Str\Str("hello, world.");
    echo $str; // "hello, world."

User Guide
----------

.. toctree::
  :maxdepth: 1

  overview
  quickstart
  handling
  manipulation
