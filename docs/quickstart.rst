Quick Start
===========

This page provides a quick introduction to Str and some introductory examples. 
If you have not already installed, Str, head over to the :ref:`installation` page.

Creating Strings
----------------

The easiest way to create a string is to write:

.. code-block:: php

    $str = new Str("asdf");

String Length
-------------

The ``length()`` method returns the number of characters in the string object.

.. code-block:: php

    $str = new Str("asdf");
    echo $str->length(); // 4

Concatenating Strings
---------------------

The ``Str`` class provides a method for concatenating two strings:

.. code-block:: php

    $str1 = $str1->concat($str2);

This returns a new string that is str1 with str2 added to the end of it.

Example:

.. code-block:: php

    $str = new Str("asdf");
    $str = $str->concat("qwerty"); // "asdfqwerty"

Get Character by Index
----------------------

You can access the character at a particular index within a string by using the ``charAt()`` method  or the ``string[index]`` syntax. The index of the first character is 0, while the index of the last character is ``length()``-1.

With ``charAt()``:

.. code-block:: php

    $str = new Str("asdf");
    echo $str->charAt(0); // "a"

With ``str[index]`` syntax:

.. code-block:: php

    $str = new Str("asdf");
    echo $str[0]; // "a"

Outputting a String
-------------------

Outputting a string is as simple as pairing it with an ``echo`` construct.

.. code-block:: php

    $str = new Str("asdf");
    echo $str; // "asdf"

This is made possible by the ``__toString()`` magic method.

Method | Description
------ | -----------
__construct([mixed $original="", [int $offset=null, [int $count=null]]]) | Instantiates a new Str that contains characters from a string. The offset argument is the index of the first character of the string and the count argument specifies the length of the string.
__toString() | The value of this string is returned.
charAt(int $index) | Returns the character at the specified index.
charCodeAt(int $index) | Returns the character ASCII value at the specified index.
compareTo(string $str) | Compares two strings lexicographically.
compareToIgnoreCase(string $str) | Compares two strings lexicographically, ignoring case differences.
concat() | Concatenates the specified string(s) to the end of this string.
contains(string $str) | Returns true if and only if this string contains the specified string.
endsWith(string $suffix) | Tests if this string ends with the specified suffix.
equals(string $str) | Compares this string to the specified string.
equalsIgnoreCase(string $str) | Compares this string to the specified string, ignoring case considerations. 
format(string $format) | Returns a formatted string using the specified format string and arguments.
indexOf(string $str, [int $fromIndex=0]) | Returns the index within this string of the first occurrence of the specified string, optionally starting the search at the specified index.
isEmpty() | Returns true if and only if length() is 0.
join(string $delimiter, mixed[] $elements) | Returns a new string composed of array elements joined together with the specified delimiter.
lastIndexOf(string $str, [int $fromIndex=0]) | Returns the index within this string of the last occurrence of the specified character, optionally starting the search at the specified index.
length() | Returns the length of this string.
matches(string $regex) | Tells whether or not this string matches the given regular expression.
regionMatches(int $toffset, string $str, int $ooffset, int $length, [bool $ignoreCase=false]) | Tests if two string regions are equal.
replace(string $target, string $replacement) | Returns a string resulting from replacing all occurrences of target in this string with replacement.
replaceAll(string $regex, string $replacement) | Replaces each substring of this string that matches the given regular expression with the given replacement.
replaceFirst(string $regex, string $replacement) | Replaces the first substring of this string that matches the given regular expression with the given replacement.
split(string $regex, [int $limit=null]) | Splits this string around matches of the given regular expression.
startsWith(string $prefix, [int $toffset=0]) | Tests if this string starts with the specified prefix, optionally starting the search at the specified index.
substring(int $beginIndex, [int $endIndex=null]) | Returns a string that is a substring of this string.
toCharArray() | Converts this string to a new character array.
toLowerCase() | Converts all of the characters in this string to lower case.
toUpperCase() | Converts all of the characters in this string to upper case.
trim([string $characterMask=" \t\n\r\0\x0B"]) | Returns a string whose value is this string, with any leading and trailing whitespace removed.
