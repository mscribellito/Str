<?php

require __DIR__ . "/../src/Str.php";

use Str\Str;
use Str\StrIndexOutOfBoundsException;

function Str($str) {

    return new Str($str);

}

class StrTest extends PHPUnit_Framework_TestCase {

    public function testConstructor() {

        $str1 = new Str("Hello, world.");

        $this->assertEquals($str1, "Hello, world.");

        $str2 = new Str("asdf", 1, 2);

        $this->assertEquals($str2, "sd");

    }

    public function testToString() {

        $str = new Str("asdf");

        $this->assertEquals($str, "asdf");

    }

    public function testCharAt() {

        $str = new Str("Hello, world.");

        $this->assertEquals($str->charAt(0), "H");
        $this->assertNotEquals($str->charAt(5), " ");
        $this->assertEquals($str->charAt($str->length() - 1), ".");

        try {
            $str->charAt(-1);
        }
        catch (StrIndexOutOfBoundsException $ex1) {
            $this->assertEquals(get_class($ex1), 'Str\StrIndexOutOfBoundsException');
        }

        try {
            $str->charAt($str->length());
        }
        catch (StrIndexOutOfBoundsException $ex2) {
            $this->assertEquals(get_class($ex2), 'Str\StrIndexOutOfBoundsException');
        }

    }

    public function testCharCodeAt() {

        $str = new Str("Hello, world.");

        $this->assertEquals($str->charCodeAt(0), ord("H"));
        $this->assertNotEquals($str->charCodeAt(5), ord(" "));
        $this->assertEquals($str->charCodeAt($str->length() - 1), ord("."));

        try {
            $str->charCodeAt(-1);
        }
        catch (StrIndexOutOfBoundsException $ex1) {
            $this->assertEquals(get_class($ex1), 'Str\StrIndexOutOfBoundsException');
        }

        try {
            $str->charCodeAt($str->length());
        }
        catch (StrIndexOutOfBoundsException $ex2) {
            $this->assertEquals(get_class($ex2), 'Str\StrIndexOutOfBoundsException');
        }

    }

    public function testCompareTo() {

        $str1 = new Str("Apple");
        $str2 = new Str("Banana");
        $str3 = new Str("Cherry");

        $this->assertLessThanOrEqual(-1, $str1->compareTo($str2));
        $this->assertLessThanOrEqual(-1, $str2->compareTo($str3));
        $this->assertEquals(0, $str1->compareTo($str1));
        $this->assertEquals(0, $str2->compareTo("Banana"));
        $this->assertEquals(0, $str3->compareTo($str3));
        $this->assertGreaterThanOrEqual(1, $str2->compareTo($str1));
        $this->assertGreaterThanOrEqual(1, $str3->compareTo($str2));

        $str4 = new Str("1234");
        $this->assertEquals(0, $str4->compareTo(1234));

    }

    public function testCompareToIgnoreCase() {

        $str1 = new Str("apple");
        $str2 = new Str("APPLE");
        $str3 = new Str("banana");
        $str4 = new Str("BANANA");

        $this->assertLessThanOrEqual(-1, $str1->compareToIgnoreCase($str3));
        $this->assertLessThanOrEqual(-1, $str2->compareToIgnoreCase($str4));
        $this->assertEquals(0, $str1->compareToIgnoreCase($str2));
        $this->assertEquals(0, $str3->compareToIgnoreCase($str4));
        $this->assertGreaterThanOrEqual(1, $str4->compareToIgnoreCase($str1));
        $this->assertGreaterThanOrEqual(1, $str4->compareToIgnoreCase($str2));

        $str5 = new Str("1234");
        $this->assertEquals(0, $str5->compareTo(1234));

    }

    public function testConcat() {

        $str1 = new Str("Hello, ");
        $str2 = new Str("world.");

        $this->assertTrue($str1->concat($str2)->equals("Hello, world."));

        $digits = new Str();
        foreach (range(0, 9) as $n) {
            $digits = $digits->concat($n);
        }

        $this->assertTrue($digits->equals("0123456789"));

    }

    public function testContains() {

        $str = new Str("Hello, world.");

        $this->assertTrue($str->contains("Hello,"));
        $this->assertFalse($str->contains(" WORLD."));

    }

    public function testEndsWith() {

        $str = new Str("Hello, world.");

        $this->assertTrue($str->endsWith("."));
        $this->assertTrue($str->endsWith("world."));
        $this->assertTrue($str->endsWith("LD.", true));
        $this->assertFalse($str->endsWith("H"));
        $this->assertFalse($str->endsWith("Hello,"));
        $this->assertFalse($str->endsWith("HE"));

    }

    public function testEquals() {

        $str1 = new Str("Hello, world.");
        $str2 = new Str("HELLO, WORLD.");
        $str3 = new Str("HELLO, WORLD.");

        $this->assertTrue($str1->equals($str1));
        $this->assertFalse($str1->equals($str2));
        $this->assertTrue($str2->equals($str3));

        $str4 = new Str("1234");

        $this->assertTrue($str4->equals(1234));

        $this->assertTrue($str1->equalsIgnoreCase(new Str("HELLO, WORLD.")));
        $this->assertTrue($str2->equalsIgnoreCase(new Str("Hello, world.")));

    }

    public function testEqualsIgnoreCase() {

        $str1 = new Str("Hello, world.");
        $str2 = new Str("HELLO, WORLD.");

        $this->assertTrue($str1->equalsIgnoreCase($str1));

        $str3 = new Str("ABCD");

        $this->assertTrue($str3->equalsIgnoreCase("abcd"));

        $str4 = new Str("1234");

        $this->assertTrue($str4->equalsIgnoreCase(1234));

    }

    public function testFormat() {

        $str = Str::format("%s, %s.", "Hello", "world");

        $this->assertTrue($str->equals("Hello, world."));

    }

    public function testIndexOf() {

        $str = new Str("Hello, world.");

        $this->assertEquals($str->indexOf("H"), 0);
        $this->assertEquals($str->indexOf("."), 12);
        $this->assertNotEquals($str->indexOf(" "), 5);
        $this->assertEquals($str->indexOf("x"), -1);

    }

    public function testIndexOfIgnoreCase() {

        $str = new Str("Hello, world.");

        $this->assertEquals($str->indexOfIgnoreCase("h"), 0);
        $this->assertEquals($str->indexOfIgnoreCase("D"), 11);
        $this->assertEquals($str->indexOfIgnoreCase("x"), -1);

    }

    public function testInterfaceArrayAccess() {

        $str = new Str("Hello, world.");

        $this->assertTrue(isset($str[0]), true);
        $this->assertTrue(isset($str[12]), true);
        $this->assertFalse(isset($str[-1]), false);
        $this->assertFalse(isset($str[13]), false);

        try {
            $str[0] = "a";
        }
        catch (Exception $ex1) {
            $this->assertEquals($ex1->getMessage(), "Strings are immutable");
        }

        try {
            unset($str[0]);
        }
        catch (Exception $ex2) {
            $this->assertEquals($ex2->getMessage(), "Strings are immutable");
        }

    }

    public function testIsEmpty() {

        $str1 = new Str("");
        $str2 = new Str("Hello, world.");
        $str3 = new Str();

        $this->assertTrue($str1->isEmpty());
        $this->assertFalse($str2->isEmpty());
        $this->assertTrue($str3->isEmpty());

    }

    public function testJoin() {

        $separator = ", ";
        $elements = array("A", "B", "C");

        $str = Str::join($separator, $elements);

        $this->assertTrue($str->equals("A, B, C"));

    }

    public function testLastIndexOf() {

        $str = new Str("Hello, world.");

        $this->assertEquals($str->lastIndexOf("o"), 8);
        $this->assertNotEquals($str->lastIndexOf("o"), 4);
        $this->assertEquals($str->lastIndexOf("x"), -1);

    }

    public function testLastIndexOfIgnoreCase() {

        $str = new Str("RACECAR");

        $this->assertEquals($str->lastIndexOfIgnoreCase("r"), 6);
        $this->assertNotEquals($str->lastIndexOfIgnoreCase("R"), 0);
        $this->assertEquals($str->lastIndexOfIgnoreCase("x"), -1);

    }

    public function testLength() {

        $str = new Str("Hello, world.");

        $this->assertEquals($str->length(), 13);
        $this->assertNotEquals($str->length(), 12);

    }

    public function testMatches() {

        $this->assertTrue(Str("abcdEFGH")->matches("/^[a-zA-Z]*$/"));
        $this->assertTrue(Str("abcdEFGH1234")->matches("/^[a-zA-Z0-9]*$/"));
        $this->assertFalse(Str("abcd")->matches("/^[0-9]*$/"));

    }

    public function testPadLeft() {

        $str = new Str("1234");

        $this->assertTrue($str->padLeft(8, "0")->equals("00001234"));

    }

    public function testPadRight() {

        $str = new Str("1234");

        $this->assertTrue($str->padRight(8, "0")->equals("12340000"));

    }

    public function testRegionCompare() {

        $str1 = new Str("asdfqwerty");
        $str2 = new Str("qwertyasdf");

        $this->assertLessThanOrEqual(-1, $str1->regionCompare(0, $str2, 0, 4));
        $this->assertEquals($str1->regionCompare(0, $str2, 6, 4), 0);
        $this->assertGreaterThanOrEqual(1, $str2->regionCompare(0, $str1, 0, 4));

    }

    public function testRegionCompareIgnoreCase() {

        $str1 = new Str("ASDFqwerty");
        $str2 = new Str("QWERTYasdf");

        $this->assertLessThanOrEqual(-1, $str1->regionCompareIgnoreCase(0, $str2, 0, 4));
        $this->assertEquals($str1->regionCompareIgnoreCase(0, $str2, 6, 4), 0);
        $this->assertGreaterThanOrEqual(1, $str2->regionCompareIgnoreCase(0, $str1, 0, 4));

    }

    public function testRegionMatches() {

        $str1 = new Str("asdfqwerty");
        $str2 = new Str("qwertyasdf");

        $this->assertTrue($str1->regionMatches(0, $str2, 6, 4));
        $this->assertTrue($str1->regionMatches(4, $str2, 0, 6));

    }

    public function testRegionMatchesIgnoreCase() {

        $str1 = new Str("ASDFqwerty");
        $str2 = new Str("QWERTYasdf");

        $this->assertTrue($str1->regionMatchesIgnoreCase(0, $str2, 6, 4));
        $this->assertTrue($str1->regionMatchesIgnoreCase(4, $str2, 0, 6));

    }

    public function testReplace() {

        $str = new Str("Hello, world.");

        $count = 0;

        $this->assertTrue($str->replace("o", "_", $count)->equals("Hell_, w_rld."));
        $this->assertEquals($count, 2);

    }

    public function testReplaceAll() {

        $str = new Str("Hello, world.");

        $count = 0;

        $this->assertTrue($str->replaceAll("/o/", "O", -1, $count)->equals("HellO, wOrld."));
        $this->assertEquals($count, 2);

    }

    public function testReplaceFirst() {

        $str = new Str("Hello, world.");

        $this->assertTrue($str->replaceFirst("/o/", "O")->equals("HellO, world."));

    }

    public function testReplaceIgnoreCase() {

        $str = new Str("HELLO, world.");

        $count = 0;

        $this->assertTrue($str->replaceIgnoreCase("o", "_", $count)->equals("HELL_, w_rld."));
        $this->assertEquals($count, 2);

    }

    public function testReverse() {

        $this->assertTrue(Str("Hello, world.")->reverse()->equals(".dlrow ,olleH"));
        $this->assertTrue(Str("racecar")->reverse()->equals("racecar"));
        $this->assertFalse(Str("palindrome")->reverse()->equals("palindrome"));

    }

    public function testSplit() {

        $helloworld = new Str("Hello, world.");
        $hello = $helloworld->substring(0, 6);
        $world = $helloworld->substring(7);

        $this->assertEquals($helloworld->split("/ /"), array($hello, $world));

    }

    public function testStartsWith() {

        $str = new Str("Hello, world.");

        $this->assertTrue($str->startsWith("H"));
        $this->assertTrue($str->startsWith("Hello,"));
        $this->assertTrue($str->startsWith("HE", 0, true));
        $this->assertTrue($str->startsWith("HE", null, true));
        $this->assertFalse($str->startsWith("."));
        $this->assertFalse($str->startsWith("world."));
        $this->assertFalse($str->startsWith("LD."));

    }

    public function testSubstring() {

        $this->assertTrue(Str("Hello, world.")->substring(0, 6)->equals("Hello,"));
        $this->assertTrue(Str("unhappy")->substring(2)->equals("happy"));
        $this->assertTrue(Str("Harbison")->substring(3)->equals("bison"));
        $this->assertTrue(Str("emptiness")->substring(9)->equals(""));
        $this->assertTrue(Str("hamburger")->substring(4, 8)->equals("urge"));
        $this->assertTrue(Str("smiles")->substring(1, 5)->equals("mile"));

    }

    public function testToCharArray() {

        $str = new Str("string");

        $this->assertEquals($str->toCharArray(), array("s", "t", "r", "i", "n", "g"));

    }

    public function testToLowerCase() {

        $str = new Str("Hello");

        $this->assertTrue($str->toLowerCase()->equals("hello"));

    }

    public function testToUpperCase() {

        $str = new Str("Hello");

        $this->assertTrue($str->toUpperCase()->equals("HELLO"));

    }

    public function testTrim() {

        $str = new Str("   Hello   ");

        $this->assertTrue($str->trim()->equals("Hello"));

    }

    public function testTrimLeft() {

        $str = new Str("   Hello   ");

        $this->assertTrue($str->trimLeft()->equals("Hello   "));

    }

    public function testTrimRight() {

        $str = new Str("   Hello   ");

        $this->assertTrue($str->trimRight()->equals("   Hello"));

    }

}
