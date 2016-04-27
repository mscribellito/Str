What is Str?
============

Str is a PHP class that wraps the native string functions in an effort to simplify string handling and manipulation. Str provides methods for examining individual characters of the string, for comparing strings, for searching strings, for extracting substrings, and for creating a copy of a string with all characters translated to uppercase or to lowercase. A Str is immutable (constant) and its value cannot be changed after creation.

Requirements
------------
PHP version 5.3 or newer is required.

Example
-------

```php
require 'src/Str.php';
use Str\Str;

$str = new Str('pizza!');
echo $str; // pizza!
```

API
---

Method | Description
------ | -----------
__construct([original="", [offset=null, [count=null]]]) | Instantiates a new Str that contains characters from a string. The offset argument is the index of the first character of the string and the count argument specifies the length of the string.
__toString() | The value of this string is returned.
charAt(index) | Returns the character at the specified index.
charCodeAt(index) | Returns the character ASCII value at the specified index.
compareTo(str) | Compares two strings lexicographically.
compareToIgnoreCase(str) | Compares two strings lexicographically, ignoring case differences.
concat() | Concatenates the specified string(s) to the end of this string.
contains(str) | Returns true if and only if this string contains the specified string.
endsWith(suffix) | Tests if this string ends with the specified suffix.
equals(str) | Compares this string to the specified string.
equalsIgnoreCase(str) | Compares this string to the specified string, ignoring case considerations. 
format(format) | Returns a formatted string using the specified format string and arguments.
indexOf(str, [fromIndex=0]) | Returns the index within this string of the first occurrence of the specified string, optionally starting the search at the specified index.
isEmpty() | Returns true if and only if length() is 0.
join(delimiter, elements) | Returns a new string composed of array elements joined together with the specified delimiter.
lastIndexOf(str, [fromIndex=0]) | Returns the index within this string of the last occurrence of the specified character, optionally starting the search at the specified index.
length() | Returns the length of this string.
matches(regex) | Tells whether or not this string matches the given regular expression.
regionMatches(toffset, str, ooffset, length, [ignoreCase=false]) | Tests if two string regions are equal.
replace(target, replacement) | Returns a string resulting from replacing all occurrences of target in this string with replacement.
replaceAll(regex, replacement) | Replaces each substring of this string that matches the given regular expression with the given replacement.
replaceFirst(regex, replacement) | Replaces the first substring of this string that matches the given regular expression with the given replacement.
split(regex, [limit=null]) | Splits this string around matches of the given regular expression.
startsWith(prefix, [toffset=0]) | Tests if this string starts with the specified prefix, optionally starting the search at the specified index.
substring(beginIndex, [endIndex=null]) | Returns a string that is a substring of this string.
toCharArray() | Converts this string to a new character array.
toLowerCase() | Converts all of the characters in this string to lower case.
toUpperCase() | Converts all of the characters in this string to upper case.
trim([characterMask=" \t\n\r\0\x0B"]) | Returns a string whose value is this string, with any leading and trailing whitespace removed.

License
-------
Released under the [MIT License](https://opensource.org/licenses/MIT). See [LICENSE](LICENSE) for details.
