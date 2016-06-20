Str, PHP String Class
=====================

What is Str?
------------

Str is a PHP class that wraps the native string functions in an effort to simplify string handling and manipulation. Str provides methods for examining individual characters of the string, for comparing strings, for searching strings, for extracting substrings, and for creating a copy of a string with all characters translated to uppercase or to lowercase. A Str is immutable (constant) and its value cannot be changed after creation.

Usage
-----

```php
require 'path/to/Str.php';
use mscribellito\Str\Str;
echo new Str("pizza!"); // pizza!
```

Constructor Summary
-------------------

Constructor and Description |
--------------------------- |
`Str()`<br>Initializes a newly created Str object so that it represents an empty character sequence. |
`Str(mixed $original)`<br>Initializes a newly created Str object so that it represents the same sequence of characters as the argument; in other words, the newly created string is a copy of the argument string. |
`Str(mixed $original, int $offset, int $count)`<br>Initializes a newly created Str object so that it contains characters from a substring of the argument string. |

Method Summary
--------------

Modifier and Type | Method and Description
----------------- | ----------------------
`string` | `__toString()`<br>The value of this string is returned.
`string` | `charAt(int $index)`<br>Returns the character at the specified index.
`int` | `charCodeAt(int $index)`<br>Returns the character ASCII value at the specified index.
`int` | `compareTo(string $str)`<br>Compares two strings lexicographically.
`int` | `compareToIgnoreCase(string $str)`<br>Compares two strings lexicographically, ignoring case differences.
`Str` | `concat()`<br>Concatenates the specified string(s) to the end of this string.
`bool` | `contains(string $str)`<br>Returns true if and only if this string contains the specified string.
`bool` | `endsWith(string $suffix)`<br>Tests if this string ends with the specified suffix.
`bool` | `equals(string $str)`<br>Compares this string to the specified string.
`bool` | `equalsIgnoreCase(string $str)`<br>Compares this string to the specified string, ignoring case considerations. 
`static` `Str` | `format(string $format)`<br>Returns a formatted string using the specified format string and arguments.
`int` | `indexOf(string $str, [int $fromIndex=0])`<br>Returns the index within this string of the first occurrence of the specified string, optionally starting the search at the specified index.
`bool` | `isEmpty()`<br>Returns true if and only if `length()` is 0.
`static` `Str` | `join(string $delimiter, mixed[] $elements)`<br>Returns a new string composed of array elements joined together with the specified delimiter.
`int` | `lastIndexOf(string $str, [int $fromIndex=0])`<br>Returns the index within this string of the last occurrence of the specified character, optionally starting the search at the specified index.
`int` | `length()`<br>Returns the length of this string.
`bool` | `matches(string $regex)`<br>Tells whether or not this string matches the given regular expression.
`bool` | `regionMatches(int $toffset, string $str, int $ooffset, int $length, [bool $ignoreCase=false])`<br>Tests if two string regions are equal.
`Str` | `replace(string $target, string $replacement)`<br>Returns a string resulting from replacing all occurrences of target in this string with replacement.
`Str` | `replaceAll(string $regex, string $replacement)`<br>Replaces each substring of this string that matches the given regular expression with the given replacement.
`Str` | `replaceFirst(string $regex, string $replacement)`<br>Replaces the first substring of this string that matches the given regular expression with the given replacement.
`Str[]` | `split(string $regex, [int $limit=null])`<br>Splits this string around matches of the given regular expression.
`bool` | `startsWith(string $prefix, [int $toffset=0])`<br>Tests if this string starts with the specified prefix, optionally starting the search at the specified index.
`Str` | `substring(int $beginIndex, [int $endIndex=null])`<br>Returns a string that is a substring of this string.
`string[]` | `toCharArray()`<br>Converts this string to a new character array.
`Str` | `toLowerCase()`<br>Converts all of the characters in this string to lower case.
`Str` | `toUpperCase()`<br>Converts all of the characters in this string to upper case.
`Str` | `trim([string $characterMask=" \t\n\r\0\x0B"])`<br>Returns a string whose value is this string, with any leading and trailing whitespace removed.

Requirements
------------
PHP version 5.3 or newer is required.

License
-------
Released under the [MIT License](https://opensource.org/licenses/MIT). See [LICENSE](LICENSE) for details.
