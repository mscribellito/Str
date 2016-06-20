<?php

/**
 * Str
 *
 * This content is released under the The MIT License (MIT)
 *
 * Copyright (c) 2016 Michael Scribellito
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace mscribellito\Str;

use ArrayAccess,
    Exception;

/**
 * Str
 *
 * Str is a PHP class that wraps the native string functions in an effort to 
 * simplify string handling and manipulation. Str provides methods for examining 
 * individual characters of the string, for comparing strings, for searching 
 * strings, for extracting substrings, and for creating a copy of a string with 
 * all characters translated to uppercase or to lowercase. A Str is immutable 
 * (constant) and its value cannot be changed after creation.
 *
 * @author Michael Scribellito <mscribellito@gmail.com>
 * @copyright (c) 2016, Michael Scribellito
 * @link https://github.com/mscribellito/Str
 */
class Str implements ArrayAccess {

    /**
     * Length of the string
     *
     * @var int
     */
    protected $length = 0;

    /**
     * Value of the string
     *
     * @var string
     */
    protected $value = "";

    /**
     * Instantiates a new Str that contains characters from a string. The offset 
     * argument is the index of the first character of the string and the count 
     * argument specifies the length of the string.
     *
     * @param mixed $original a string
     * @param int $offset the initial offset
     * @param int $count the length
     * @throws StrIndexOutOfBoundsException
     */
    public function __construct($original = "", $offset = null, $count = null) {

        $value = (string) $original;
        $length = strlen($value);

        if ($offset !== null && $count !== null) {
            if ($offset < 0) {
                throw new StrIndexOutOfBoundsException($offset);
            }
            if ($count < 0) {
                throw new StrIndexOutOfBoundsException($count);
            }
            if ($offset > $length - $count) {
                throw new StrIndexOutOfBoundsException($offset + $count);
            }
            $value = substr($value, $offset, $count);
        }

        $this->value = $value;
        $this->length = $length;

    }

    /**
     * The value of this string is returned.
     *
     * @return string the string itself.
     */
    public function __toString() {

        return $this->value;

    }

    /**
     * Returns the character at the specified index.
     *
     * @param int $index the index of the character
     * @return string the character at the specified index of this string.
     * @throws StrIndexOutOfBoundsException
     */
    public function charAt($index) {

        if ($index < 0 || $index >= $this->length) {
            throw new StrIndexOutOfBoundsException($index);
        }

        return $this->value[$index];

    }

    /**
     * Returns the character ASCII value at the specified index.
     *
     * @param int $index the index to the character
     * @return int the ASCII value of the character at the index.
     * @throws StrIndexOutOfBoundsException
     */
    public function charCodeAt($index) {

        return ord($this->charAt($index));

    }

    /**
     * Compares two strings lexicographically.
     *
     * @param string $str the string to be compared
     * @return int a negative integer, zero, or a positive integer as the specified
     * string is greater than, equal to, or less than this string.
     */
    public function compareTo($str) {

        return strcmp($this->value, (string) $str);

    }

    /**
     * Compares two strings lexicographically, ignoring case differences.
     *
     * @param string $str the string to be compared
     * @return int a negative integer, zero, or a positive integer as the specified
     * string is greater than, equal to, or less than this string.
     */
    public function compareToIgnoreCase($str) {

        return strcasecmp($this->value, (string) $str);

    }

    /**
     * Concatenates the specified string(s) to the end of this string.
     *
     * @return \Str a string that represents the concatenation of this string
     * followed by the string argument(s).
     */
    public function concat() {

        $value = $this->value;

        for ($i = 0; $i < func_num_args(); $i++) {
            $value .= (string) func_get_arg($i);
        }

        return new static($value);

    }

    /**
     * Returns true if and only if this string contains the specified string.
     *
     * @param string $str the string to search for
     * @return bool true if this string contains str, false otherwise.
     */
    public function contains($str) {

        return $this->indexOf($str) >= 0;

    }

    /**
     * Tests if this string ends with the specified suffix.
     *
     * @param string $suffix the suffix
     * @return bool true if the string ends with the specified suffix.
     */
    public function endsWith($suffix) {

        return $this->matches("/" . preg_quote($suffix) . "$/");

    }

    /**
     * Compares this string to the specified string.
     *
     * @param string $str the string to compare this string against
     * @return bool true if the specified string is equivalent to this string,
     * false otherwise.
     */
    public function equals($str) {

        return $this->compareTo($str) === 0;

    }

    /**
     * Compares this string to the specified string, ignoring case considerations. 
     *
     * @param string $str the string to compare this string against
     * @return bool true if the specified string is equivalent to this string,
     * false otherwise.
     */
    public function equalsIgnoreCase($str) {

        return $this->compareToIgnoreCase($str) === 0;

    }

    /**
     * Returns a formatted string using the specified format string and arguments.
     *
     * @param string $format a format string
     * @param mixed $args arguments referenced by the format specifiers in the format string.
     * @return \Str a formatted string.
     */
    public static function format($format) {

        if (func_num_args() === 1) {
            return new static($format);
        }

        return new static(call_user_func_array("sprintf", func_get_args()));

    }

    /**
     * Returns the index within this string of the first occurrence of the specified
     * string, optionally starting the search at the specified index.
     *
     * @param string $str a string
     * @param int $fromIndex the index to start the search from
     * @return int the index of the first occurrence of the string, or -1 if the
     * string does not occur.
     */
    public function indexOf($str, $fromIndex = 0) {

        if ($fromIndex < 0) {
            $fromIndex = 0;
        } else if ($fromIndex >= $this->length) {
            return -1;
        }

        $index = strpos($this->value, (string) $str, $fromIndex);

        return $index === false ? -1 : $index;

    }

    /**
     * Returns true if and only if length() is 0.
     *
     * @return bool true if length() is 0, otherwise false.
     */
    public function isEmpty() {

        return $this->length === 0;

    }

    /**
     * Returns a new string composed of array elements joined together with the
     * specified delimiter.
     *
     * @param string $delimiter the delimiter that separates each element
     * @param mixed[] $elements the elements to join together
     * @return \Str a new string that is composed of the elements separated
     * by the delimiter.
     */
    public static function join($delimiter, $elements) {

        return new static(implode($delimiter, $elements));

    }

    /**
     * Returns the index within this string of the last occurrence of the specified
     * character, optionally starting the search at the specified index.
     *
     * @param string $str a string
     * @param int $fromIndex the index to start the search from
     * @return int the index of the last occurrence of the string, or -1 if the
     * string does not occur.
     */
    public function lastIndexOf($str, $fromIndex = 0) {

        if ($fromIndex < 0) {
            $fromIndex = 0;
        } else if ($fromIndex >= $this->length) {
            return -1;
        }

        $index = strrpos($this->value, (string) $str, $fromIndex);

        return $index === false ? -1 : $index;

    }

    /**
     * Returns the length of this string.
     *
     * @return int the length of the string.
     */
    public function length() {

        return $this->length;

    }

    /**
     * Tells whether or not this string matches the given regular expression.
     *
     * @param string $regex the regular expression to which this string is to be matched
     * @return bool true if and only if this string matches the given regular expression.
     */
    public function matches($regex) {

        $match = preg_match($regex, $this->value);

        return $match === 1;

    }

    /**
     * Returns whether or not a character exists at the specified index.
     * Implements part of the ArrayAccess interface.
     *
     * @param int $offset the index
     * @return bool true if character exists at the specified index.
     */
    public function offsetExists($offset) {

        return $offset >= 0 && $this->length > $offset;

    }

    /**
     * Returns the character at the specified index. Implements part of the
     * ArrayAccess interface.
     *
     * @param int $offset the index
     * @return string the character at the specified index.
     * @throws StrIndexOutOfBoundsException
     */
    public function offsetGet($offset) {

        return $this->charAt($offset);

    }

    /**
     * Implements part of the ArrayAccess interface. Throws an exception because
     * Strings are immutable.
     *
     * @param int $offset n/a
     * @param string $value n/a
     * @throws Exception
     */
    public function offsetSet($offset, $value) {

        throw new Exception("Strings are immutable");

    }

    /**
     * Implements part of the ArrayAccess interface. Throws an exception because
     * Strings are immutable.
     *
     * @param int $offset n/a
     * @throws Exception
     */
    public function offsetUnset($offset) {

        throw new Exception("Strings are immutable");

    }

    /**
     * Tests if two string regions are equal.
     *
     * @param int $toffset the starting offset of the subregion in this string
     * @param string $str the string argument
     * @param int $ooffset the starting offset of the subregion in the string argument
     * @param int $length the number of characters to compare
     * @param bool $ignoreCase if true, ignore case
     * @return bool true if the specified subregion of this string matches the
     * specified subregion of the string argument; false otherwise.
     * @throws StrIndexOutOfBoundsException
     */
    public function regionMatches($toffset, $str, $ooffset, $length, $ignoreCase = false) {

        $other = new static($str);

        if ($ignoreCase === true) {
            return strncasecmp($this->substring($toffset), $other->substring($ooffset), $length) === 0;
        }

        return strncmp($this->substring($toffset), $other->substring($ooffset), $length) === 0;

    }

    /**
     * Returns a string resulting from replacing all occurrences of target in this
     * string with replacement.
     *
     * @param string $target the string to be replaced
     * @param string $replacement the replacement string
     * @return \Str the resulting string.
     */
    public function replace($target, $replacement) {

        return new static(str_replace($target, $replacement, $this->value));

    }

    /**
     * Replaces each substring of this string that matches the given regular
     * expression with the given replacement.
     *
     * @param string $regex the regular expression to which this string is to be matched
     * @param string $replacement the string to be substituted for each match
     * @return \Str the resulting string.
     */
    public function replaceAll($regex, $replacement) {

        return new static(preg_replace($regex, $replacement, $this->value));

    }

    /**
     * Replaces the first substring of this string that matches the given regular
     * expression with the given replacement.
     *
     * @param string $regex the regular expression to which this string is to be matched
     * @param string $replacement the string to be substituted for each match
     * @return \Str the resulting string.
     */
    public function replaceFirst($regex, $replacement) {

        return new static(preg_replace($regex, $replacement, $this->value, 1));

    }

    /**
     * Splits this string around matches of the given regular expression.
     *
     * @param string $regex the delimiting regular expression
     * @param int $limit the result threshold
     * @return \Str[] the array of strings computed by splitting this string around
     * matches of the given regular expression.
     */
    public function split($regex, $limit = null) {

        if ($limit === null) {
            $limit = -1;
        }

        $parts = preg_split($regex, $this->value, $limit);

        for ($i = 0, $l = count($parts); $i < $l; $i++) {
            $parts[$i] = new static($parts[$i]);
        }

        return $parts;

    }

    /**
     * Tests if this string starts with the specified prefix, optionally starting 
     * the search at the specified index.
     *
     * @param string $prefix the prefix
     * @param int $toffset the index to start the search from
     * @return bool true if the string starts with the specified prefix.
     * @throws StrIndexOutOfBoundsException
     */
    public function startsWith($prefix, $toffset = 0) {

        return $this->substring($toffset)->matches("/^" . preg_quote($prefix) . "/");

    }

    /**
     * Returns a string that is a substring of this string.
     *
     * @param int $beginIndex the beginning index, inclusive
     * @param int $endIndex the ending index, exclusive
     * @return \Str the specified substring.
     * @throws StrIndexOutOfBoundsException
     */
    public function substring($beginIndex, $endIndex = null) {

        if ($beginIndex < 0) {
            throw new StrIndexOutOfBoundsException($beginIndex);
        } else if ($beginIndex === $this->length) {
            return new static("");
        }

        if ($endIndex === null) {
            $length = $this->length - $beginIndex;
            if ($length < 0) {
                throw new StrIndexOutOfBoundsException($length);
            }
            if ($beginIndex === 0) {
                return $this;
            } else {
                return new static($this->value, $beginIndex, $length);
            }
        } else {
            if ($endIndex > $this->length) {
                throw new StrIndexOutOfBoundsException($endIndex);
            }
            $length = $endIndex - $beginIndex;
            if ($length < 0) {
                throw new StrIndexOutOfBoundsException($length);
            }
            if ($beginIndex === 0 && $endIndex === $this->length) {
                return $this;
            } else {
                return new static($this->value, $beginIndex, $length);
            }
        }

    }

    /**
     * Converts this string to a new character array.
     *
     * @return string[] a character array whose length is the length of this string
     * and whose contents are initialized to contain the character sequence
     * represented by this string.
     */
    public function toCharArray() {

        return str_split($this->value, 1);

    }

    /**
     * Converts all of the characters in this string to lower case.
     *
     * @return \Str the string, converted to lowercase.
     */
    public function toLowerCase() {

        return new static(strtolower($this->value));

    }

    /**
     * Converts all of the characters in this string to upper case.
     *
     * @return \Str the string, converted to uppercase.
     */
    public function toUpperCase() {

        return new static(strtoupper($this->value));

    }

    /**
     * Returns a string whose value is this string, with any leading and trailing
     * whitespace removed.
     *
     * @param string $characterMask characters to strip
     * @return \Str a string whose value is this string, with any leading and
     * trailing white space removed, or this string if it has no leading or trailing
     * white space.
     */
    public function trim($characterMask = " \t\n\r\0\x0B") {

        return new static(trim($this->value, $characterMask));

    }

}

/**
 * Thrown by String methods to indicate that an index is either negative or
 * greater than the size of the string.
 */
class StrIndexOutOfBoundsException extends Exception {

    /**
     * Constructs a new StrIndexOutOfBoundsException class with an argument
     * indicating the illegal index.
     *
     * @param int $index the illegal index
     */
    public function __construct($index) {

        parent::__construct("String index out of range: " . $index, 0, null);

    }

}
