<?php

namespace Str;

require __DIR__ . "/../src/Str.php";

function Str($str) {

    return new Str($str);

}

class StrTest extends \PHPUnit_Framework_TestCase {

    public function testConstructor() {

        $pepperoniPizza = new Str("pepperoni pizza");
        $this->assertInstanceOf("Str\Str", $pepperoniPizza);

        $cheesePizza = new Str(" cheese pizza ", 1, 12);
        $this->assertInstanceOf("Str\Str", $cheesePizza);

        $this->setExpectedException("Str\StrIndexOutOfBoundsException");
        new Str("hawaiian pizza", -1, 0);
        new Str("anchovy pizza", 0, -1);
        new Str("spam pizza", 11, 0);

    }

    public function testToString() {

        $pizza = new Str("pizza");
        $this->assertEquals("pizza", $pizza);

    }

    public function testCharAt() {

        $pizza = new Str("pizza");

        $this->assertEquals("p", $pizza->charAt(0));
        $this->assertNotEquals("Z", $pizza->charAt(2));
        $this->assertEquals("a", $pizza->charAt($pizza->length() - 1));

        $this->setExpectedException("Str\StrIndexOutOfBoundsException");
        $pizza->charAt(-1);
        $pizza->charAt($pizza->length());

    }

    public function testCharCodeAt() {

        $pizza = new Str("pizza");

        $this->assertEquals(ord("p"), $pizza->charCodeAt(0));
        $this->assertNotEquals(ord("Z"), $pizza->charCodeAt(2));
        $this->assertEquals(ord("a"), $pizza->charCodeAt($pizza->length() - 1));

        $this->setExpectedException("Str\StrIndexOutOfBoundsException");
        $pizza->charCodeAt(-1);
        $pizza->charCodeAt($pizza->length());

    }

    public function testCompareTo() {

        $pepperoniPizza = new Str("pepperoni");
        $cheesePizza = new Str("cheese");
        $bananaPepperPizza = new Str("banana pepper");

        $this->assertGreaterThanOrEqual(1, $pepperoniPizza->compareTo($cheesePizza));
        $this->assertGreaterThanOrEqual(1, $pepperoniPizza->compareTo($bananaPepperPizza));
        $this->assertGreaterThanOrEqual(1, $cheesePizza->compareTo($bananaPepperPizza));

        $this->assertLessThanOrEqual(-1, $cheesePizza->compareTo($pepperoniPizza));
        $this->assertLessThanOrEqual(-1, $bananaPepperPizza->compareTo($pepperoniPizza));
        $this->assertLessThanOrEqual(-1, $bananaPepperPizza->compareTo($cheesePizza));

        $this->assertEquals(0, $pepperoniPizza->compareTo("pepperoni"));
        $this->assertEquals(0, $pepperoniPizza->compareTo($pepperoniPizza));

        $this->assertEquals(0, $cheesePizza->compareTo("cheese"));
        $this->assertEquals(0, $cheesePizza->compareTo($cheesePizza));

        $this->assertEquals(0, $bananaPepperPizza->compareTo("banana pepper"));
        $this->assertEquals(0, $bananaPepperPizza->compareTo($bananaPepperPizza));

        $str = new Str("1234");
        $this->assertEquals(0, $str->compareTo(1234));

    }

    public function testCompareToIgnoreCase() {

        $smallPepperoniPizza = new Str("pepperoni");
        $largePepperoniPizza = new Str("PEPPERONI");
        $smallCheesePizza = new Str("cheese");
        $largeCheesePizza = new Str("CHEESE");

        $this->assertGreaterThanOrEqual(1, $smallPepperoniPizza->compareToIgnoreCase($largeCheesePizza));
        $this->assertGreaterThanOrEqual(1, $largePepperoniPizza->compareToIgnoreCase($smallCheesePizza));

        $this->assertLessThanOrEqual(-1, $smallCheesePizza->compareToIgnoreCase($smallPepperoniPizza));
        $this->assertLessThanOrEqual(-1, $largeCheesePizza->compareToIgnoreCase($largePepperoniPizza));

        $this->assertEquals(0, $smallPepperoniPizza->compareToIgnoreCase($largePepperoniPizza));
        $this->assertEquals(0, $smallPepperoniPizza->compareToIgnoreCase("PEPPERONI"));
        $this->assertEquals(0, $largePepperoniPizza->compareToIgnoreCase("pepperoni"));

        $this->assertEquals(0, $smallCheesePizza->compareToIgnoreCase($largeCheesePizza));
        $this->assertEquals(0, $smallCheesePizza->compareToIgnoreCase("CHEESE"));
        $this->assertEquals(0, $largeCheesePizza->compareToIgnoreCase("cheese"));

        $str = new Str("1234");
        $this->assertEquals(0, $str->compareToIgnoreCase(1234));

    }

    public function testConcat() {

        $pepperoni = new Str("pepperoni");
        $pizza = new Str("pizza");

        $this->assertEquals("pepperoni pizza", $pepperoni->concat(" ")->concat($pizza));

    }

    public function testContains() {

        $pepperoniPizza = new Str("pepperoni pizza");

        $this->assertTrue($pepperoniPizza->contains("pepperoni"));
        $this->assertFalse($pepperoniPizza->contains("anchovies"));

    }

    public function testEndsWith() {

        $pizza = new Str("pizza");

        $this->assertTrue($pizza->endsWith("a"));
        $this->assertTrue($pizza->endsWith("za"));
        $this->assertTrue($pizza->endsWith("A", true));
        $this->assertFalse($pizza->endsWith("p"));
        $this->assertFalse($pizza->endsWith("pi"));
        $this->assertFalse($pizza->endsWith("PI"));

    }

    public function testEquals() {

        $smallPizza = new Str("pizza");
        $largePizza = new Str("PIZZA");

        $this->assertTrue($smallPizza->equals($smallPizza));
        $this->assertTrue($smallPizza->equals("pizza"));

        $this->assertFalse($smallPizza->equals($largePizza));
        $this->assertFalse($largePizza->equals($smallPizza));

        $this->assertTrue($largePizza->equals($largePizza));
        $this->assertTrue($largePizza->equals("PIZZA"));

        $str = new Str("1234");

        $this->assertTrue($str->equals(1234));

    }

    public function testEqualsIgnoreCase() {

        $smallPizza = new Str("pizza");
        $largePizza = new Str("PIZZA");

        $this->assertTrue($smallPizza->equals($smallPizza));
        $this->assertTrue($smallPizza->equalsIgnoreCase("PIZZA"));

        $this->assertTrue($smallPizza->equalsIgnoreCase($largePizza));
        $this->assertTrue($largePizza->equalsIgnoreCase($smallPizza));

        $this->assertTrue($largePizza->equals($largePizza));
        $this->assertTrue($largePizza->equalsIgnoreCase("pizza"));

        $str = new Str("1234");

        $this->assertTrue($str->equalsIgnoreCase(1234));

    }

    public function testFormat() {

        $pepperoniPizza = Str::format("%s %s", "pepperoni", "pizza");

        $this->assertTrue($pepperoniPizza->equals("pepperoni pizza"));

    }

    public function testIndexOf() {

        $pepperoniPizza = new Str("pepperoni pizza");

        $this->assertEquals(0, $pepperoniPizza->indexOf("p"));
        $this->assertEquals(2, $pepperoniPizza->indexOf("p", 1));
        $this->assertEquals(1, $pepperoniPizza->indexOf("e"));
        $this->assertEquals(4, $pepperoniPizza->indexOf("e", 2));
        $this->assertEquals(9, $pepperoniPizza->indexOf(" "));
        $this->assertEquals(5, $pepperoniPizza->indexOf("r"));

        $this->assertEquals(0, $pepperoniPizza->indexOf("p", -1));
        $this->assertEquals(-1, $pepperoniPizza->indexOf("p", $pepperoniPizza->length()));

    }

    public function testIndexOfIgnoreCase() {

        $pepperoniPizza = new Str("pepperoni pizza");

        $this->assertEquals(0, $pepperoniPizza->indexOfIgnoreCase("P"));
        $this->assertEquals(2, $pepperoniPizza->indexOfIgnoreCase("P", 1));
        $this->assertEquals(1, $pepperoniPizza->indexOfIgnoreCase("E"));
        $this->assertEquals(4, $pepperoniPizza->indexOfIgnoreCase("E", 2));
        $this->assertEquals(9, $pepperoniPizza->indexOfIgnoreCase(" "));
        $this->assertEquals(5, $pepperoniPizza->indexOfIgnoreCase("R"));

        $this->assertEquals(0, $pepperoniPizza->indexOfIgnoreCase("P", -1));
        $this->assertEquals(-1, $pepperoniPizza->indexOfIgnoreCase("P", $pepperoniPizza->length()));

    }

    public function testInterfaceArrayAccess() {

        $pepperoniPizza = new Str("pepperoni pizza");

        $this->assertTrue(isset($pepperoniPizza[0]), true);
        $this->assertTrue(isset($pepperoniPizza[14]), true);
        $this->assertFalse(isset($pepperoniPizza[-1]), false);
        $this->assertFalse(isset($pepperoniPizza[15]), false);

        $this->assertEquals("p", $pepperoniPizza[0]);
        $this->assertEquals(" ", $pepperoniPizza[9]);
        $this->assertEquals("a", $pepperoniPizza[14]);

        $this->setExpectedException('Exception');
        $pepperoniPizza[-1];
        $pepperoniPizza[15];
        $pepperoniPizza[0] = "a";
        unset($pepperoniPizza[0]);

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

        $pizza = new Str("pizza");

        $this->assertTrue($pizza->startsWith("p"));
        $this->assertTrue($pizza->startsWith("pi"));
        $this->assertTrue($pizza->startsWith("P", 0, true));
        $this->assertTrue($pizza->startsWith("P", null, true));
        $this->assertFalse($pizza->startsWith("a"));
        $this->assertFalse($pizza->startsWith("za"));
        $this->assertFalse($pizza->startsWith("ZA"));

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
