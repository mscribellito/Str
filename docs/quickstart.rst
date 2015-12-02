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

API
---

__construct(original, offset, length)

__toString()

charAt(index)

charCodeAt(index)

compareTo(str, ignoreCase)

compareToIgnoreCase(str)

concat()

contains(str)

endsWith(suffix, ignoreCase)

equals(str, ignoreCase)

equalsIgnoreCase(str)

format(format)

fromCharCode(code)

indexOf(str, fromIndex, ignoreCase)

indexOfIgnoreCase(str, fromIndex)

isEmpty()

join(delimiter, elements)

lastIndexOf(str, fromIndex, ignoreCase)

lastIndexOfIgnoreCase(str, fromIndex)

length()

matches(regex, matches)

offsetExists(offset)

offsetGet(offset)

offsetSet(offset, value)

offsetUnset(offset)

padLeft(length, str)

padRight(length, str)

regionCompare(toffset, str, ooffset, length, ignoreCase)

regionCompareIgnoreCase(toffset, str, ooffset, length)

regionMatches(toffset, str, ooffset, length)

regionMatchesIgnoreCase(toffset, str, ooffset, length)

replace(old, new, count)

replaceAll(regex, replacement, limit, count)

replaceFirst(regex, replacement)

replaceIgnoreCase(old, new, count)

reverse()

split(regex, limit)

startsWith(prefix, fromIndex, ignoreCase)

substring(beginIndex, endIndex)

toCharArray()

toLowerCase()

toUpperCase()

trim(characterMask)

trimLeft(characterMask)

trimRight(characterMask)

valueOf()
