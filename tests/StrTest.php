<?php

namespace Str;

use PHPUnit_Framework_TestCase;

require __DIR__ . "/../src/Str.php";

class StrTest extends PHPUnit_Framework_TestCase {

    public function testConstructor() {

        $pepperoniPizza = new Str("pepperoni pizza");
        $this->assertInstanceOf("Str\Str", $pepperoniPizza);

    }

    public function testConstructorWithOffsetAndLength() {

        $pepperoniPizza = new Str(" pepperoni pizza ", 1, 15);
        $this->assertInstanceOf("Str\Str", $pepperoniPizza);

    }

    public function testConstructorWithOffsetLessThanZero() {

        $this->setExpectedException("Str\StrIndexOutOfBoundsException");
        new Str("pizza", -1, 0);

    }

    public function testConstructorWithLengthLessThanZero() {

        $this->setExpectedException("Str\StrIndexOutOfBoundsException");
        new Str("pizza", 0, -1);

    }

    public function testConstructorWithOffsetGreaterThanLength() {

        $this->setExpectedException("Str\StrIndexOutOfBoundsException");
        $pepperoniPizza = new Str("pepperoni pizza", 16, 15);

    }

    public function testToString() {

        $pizza = new Str("pizza");
        $nullPizza = new Str();
        $emptyPizza = new Str();

        $this->assertEquals("pizza", $pizza);
        $this->assertEquals("", $nullPizza);
        $this->assertEquals("", $emptyPizza);

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

        $pepperoniPizza = new Str("pepperoni pizza");
        $cheesePizza = new Str("cheese pizza");
        $bananaPepperPizza = new Str("banana pepper pizza");

        $this->assertGreaterThanOrEqual(1, $pepperoniPizza->compareTo($cheesePizza));
        $this->assertGreaterThanOrEqual(1, $pepperoniPizza->compareTo($bananaPepperPizza));
        $this->assertGreaterThanOrEqual(1, $cheesePizza->compareTo($bananaPepperPizza));

        $this->assertLessThanOrEqual(-1, $cheesePizza->compareTo($pepperoniPizza));
        $this->assertLessThanOrEqual(-1, $bananaPepperPizza->compareTo($pepperoniPizza));
        $this->assertLessThanOrEqual(-1, $bananaPepperPizza->compareTo($cheesePizza));

        $this->assertEquals(0, $pepperoniPizza->compareTo("pepperoni pizza"));
        $this->assertEquals(0, $pepperoniPizza->compareTo($pepperoniPizza));

        $this->assertEquals(0, $cheesePizza->compareTo("cheese pizza"));
        $this->assertEquals(0, $cheesePizza->compareTo($cheesePizza));

        $this->assertEquals(0, $bananaPepperPizza->compareTo("banana pepper pizza"));
        $this->assertEquals(0, $bananaPepperPizza->compareTo($bananaPepperPizza));

        $str = new Str("1234");
        $this->assertEquals(0, $str->compareTo(1234));

    }

    public function testCompareToIgnoreCase() {

        $smallPepperoniPizza = new Str("pepperoni pizza");
        $largePepperoniPizza = new Str("PEPPERONI PIZZA");
        $smallCheesePizza = new Str("cheese pizza");
        $largeCheesePizza = new Str("CHEESE PIZZA");

        $this->assertGreaterThanOrEqual(1, $smallPepperoniPizza->compareToIgnoreCase($largeCheesePizza));
        $this->assertGreaterThanOrEqual(1, $largePepperoniPizza->compareToIgnoreCase($smallCheesePizza));

        $this->assertLessThanOrEqual(-1, $smallCheesePizza->compareToIgnoreCase($smallPepperoniPizza));
        $this->assertLessThanOrEqual(-1, $largeCheesePizza->compareToIgnoreCase($largePepperoniPizza));

        $this->assertEquals(0, $smallPepperoniPizza->compareToIgnoreCase($largePepperoniPizza));
        $this->assertEquals(0, $smallPepperoniPizza->compareToIgnoreCase("PEPPERONI PIZZA"));
        $this->assertEquals(0, $largePepperoniPizza->compareToIgnoreCase("pepperoni pizza"));

        $this->assertEquals(0, $smallCheesePizza->compareToIgnoreCase($largeCheesePizza));
        $this->assertEquals(0, $smallCheesePizza->compareToIgnoreCase("CHEESE PIZZA"));
        $this->assertEquals(0, $largeCheesePizza->compareToIgnoreCase("cheese pizza"));

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
        $this->assertFalse($pizza->endsWith("p"));
        $this->assertFalse($pizza->endsWith("pi"));

    }

    public function testEndsWithIgnoreCase() {

        $pizza = new Str("pizza");

        $this->assertTrue($pizza->endsWith("a", true));
        $this->assertTrue($pizza->endsWith("A", true));

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

    public function testInterfaceArrayAccessOffsetExists() {

        $pepperoniPizza = new Str("pepperoni pizza");

        $this->assertTrue(isset($pepperoniPizza[0]), true);
        $this->assertTrue(isset($pepperoniPizza[14]), true);
        $this->assertFalse(isset($pepperoniPizza[-1]), false);
        $this->assertFalse(isset($pepperoniPizza[15]), false);

    }

    public function testInterfaceArrayAccessOffsetGet() {

        $pepperoniPizza = new Str("pepperoni pizza");

        $this->assertEquals("p", $pepperoniPizza[0]);
        $this->assertEquals(" ", $pepperoniPizza[9]);
        $this->assertEquals("a", $pepperoniPizza[14]);

        $this->setExpectedException('Str\StrIndexOutOfBoundsException');
        $this->assertEquals(null, $pepperoniPizza[-1]);

    }

    public function testInterfaceArrayAccessOffsetSet() {

        $pepperoniPizza = new Str("pepperoni pizza");

        $this->setExpectedException('Exception');
        $pepperoniPizza[0] = "a";

    }

    public function testInterfaceArrayAccessOffsetUnset() {

        $pepperoniPizza = new Str("pepperoni pizza");

        $this->setExpectedException('Exception');
        unset($pepperoniPizza[0]);

    }

    public function testIsEmpty() {

        $pizza = new Str("pizza");
        $nullPizza = new Str();
        $emptyPizza = new Str();

        $this->assertFalse($pizza->isEmpty());
        $this->assertTrue($nullPizza->isEmpty());
        $this->assertTrue($emptyPizza->isEmpty());

    }

    public function testJoin() {

        $str = Str::join(" ", array("pepperoni", "pizza"));

        $this->assertEquals("pepperoni pizza", $str);

    }

    public function testLastIndexOf() {
        
    }

    public function testLastIndexOfIgnoreCase() {
        
    }

    public function testLength() {

        $pizza = new Str("pizza");
        $nullPizza = new Str();
        $emptyPizza = new Str();

        $this->assertEquals(5, $pizza->length());
        $this->assertEquals(0, $nullPizza->length());
        $this->assertEquals(0, $emptyPizza->length());

    }

    public function testMatches() {

        $pizza = new Str("pizza");

        $this->assertTrue($pizza->matches("/[a-z]/"));
        $this->assertFalse($pizza->matches("/[0-9]/"));

    }

    public function testPadLeft() {

        $pizza = new Str("pizza");

        $this->assertEquals("___pizza", $pizza->padLeft(8, "_"));

    }

    public function testPadRight() {

        $pizza = new Str("pizza");

        $this->assertEquals("pizza___", $pizza->padRight(8, "_"));

    }

    public function testRegionCompare() {

        $cheesePizza = new Str("chz pizza");
        $pepperoniPizza = new Str("pep pizza");

        $this->assertLessThanOrEqual(-1, $cheesePizza->regionCompare(0, $pepperoniPizza, 0, 3));
        $this->assertEquals(0, $cheesePizza->regionCompare(4, $pepperoniPizza, 4, 5));
        $this->assertGreaterThanOrEqual(1, $pepperoniPizza->regionCompare(0, $cheesePizza, 0, 3));

    }

    public function testRegionCompareIgnoreCase() {

        $cheesePizza = new Str("chz PIZZA");
        $pepperoniPizza = new Str("PEP pizza");

        $this->assertLessThanOrEqual(-1, $cheesePizza->regionCompareIgnoreCase(0, $pepperoniPizza, 0, 3));
        $this->assertEquals(0, $cheesePizza->regionCompareIgnoreCase(4, $pepperoniPizza, 4, 5));
        $this->assertGreaterThanOrEqual(1, $pepperoniPizza->regionCompareIgnoreCase(0, $cheesePizza, 0, 3));

    }

    public function testRegionMatches() {

        $cheesePizza = new Str("chz pizza");
        $pepperoniPizza = new Str("pep pizza");

        $this->assertTrue($cheesePizza->regionMatches(4, $pepperoniPizza, 4, 5));
        $this->assertFalse($cheesePizza->regionMatches(0, $pepperoniPizza, 0, 3));

    }

    public function testRegionMatchesIgnoreCase() {

        $cheesePizza = new Str("chz PIZZA");
        $pepperoniPizza = new Str("PEP pizza");

        $this->assertTrue($cheesePizza->regionMatchesIgnoreCase(4, $pepperoniPizza, 4, 5));
        $this->assertFalse($cheesePizza->regionMatches(0, $pepperoniPizza, 0, 3));

    }

    public function testReplace() {

        $lie = new Str("pizza sucks");
        $truth = $lie->replace("sucks", "is life");

        $this->assertEquals("pizza is life", $truth);

    }

    public function testReplaceWithCount() {

        $count = 0;
        $lie = new Str("pizza is gross gross gross");
        $truth = $lie->replace("gross", "great", $count);

        $this->assertEquals("pizza is great great great", $truth);
        $this->assertEquals(3, $count);

    }

    public function testReplaceAll() {

        $pizza = new Str("1 pizza 2 pizza 3 pizza");
        $pizza = $pizza->replaceAll("/[0-9]\s/", "");

        $this->assertEquals("pizza pizza pizza", $pizza);

    }

    public function testReplaceAllWithLimit() {

        $pizza = new Str("1 pizza 2 pizza 3 pizza");
        $pizza = $pizza->replaceAll("/[0-9]\s/", "", 2);

        $this->assertEquals("pizza pizza 3 pizza", $pizza);

    }

    public function testReplaceAllWithCount() {

        $count = 0;
        $pizza = new Str("1 pizza 2 pizza 3 pizza");
        $pizza = $pizza->replaceAll("/[0-9]\s/", "", null, $count);

        $this->assertEquals("pizza pizza pizza", $pizza);
        $this->assertEquals(3, $count);

    }

    public function testReplaceAllWithLimitAndCount() {

        $count = 0;
        $pizza = new Str("1 pizza 2 pizza 3 pizza");
        $pizza = $pizza->replaceAll("/[0-9]\s/", "", 2, $count);

        $this->assertEquals("pizza pizza 3 pizza", $pizza);
        $this->assertEquals(2, $count);

    }

    public function testReplaceFirst() {

        $pizza = new Str("pizza pizza");
        $pizza = $pizza->replaceFirst("/\w+\s?/", "");

        $this->assertEquals("pizza", $pizza);

    }

    public function testReplaceIgnoreCase() {

        $lie = new Str("pizza SUCKS");
        $truth = $lie->replaceIgnoreCase("sucks", "is life");

        $this->assertEquals("pizza is life", $truth);

    }

    public function testReplaceIgnoreCaseWithCount() {

        $count = 0;
        $lie = new Str("pizza is gross GROSS gross");
        $truth = $lie->replaceIgnoreCase("gross", "great", $count);

        $this->assertEquals("pizza is great great great", $truth);
        $this->assertEquals(3, $count);

    }

    public function testReverse() {

        $backwardsPizza = new Str("azzip");

        $this->assertEquals("pizza", $backwardsPizza->reverse());

    }

    public function testSplit() {

        $pepperoniPizza = new Str("pepperoni pizza");
        $pepperoniPizzaIngredients = new Str("crust, sauce, cheese, pepperoni");

        $this->assertEquals(array("pepperoni", "pizza"), $pepperoniPizza->split("/ /"));
        $this->assertEquals(array("crust", "sauce", "cheese", "pepperoni"), $pepperoniPizzaIngredients->split("/, /"));

    }

    public function testStartsWith() {

        $pizza = new Str("pizza");

        $this->assertTrue($pizza->startsWith("p"));
        $this->assertTrue($pizza->startsWith("pi"));
        $this->assertFalse($pizza->startsWith("a"));
        $this->assertFalse($pizza->startsWith("za"));

    }

    public function testStartsWithFromIndex() {

        $pizza = new Str("pizza");

        $this->assertTrue($pizza->startsWith("i", 1));
        $this->assertTrue($pizza->startsWith("iz", 1));
        $this->assertFalse($pizza->startsWith("a", 1));
        $this->assertFalse($pizza->startsWith("za", 1));

    }

    public function testStartsWithFromIndexLessThanZero() {

        $pizza = new Str("pizza");

        $this->setExpectedException("Str\StrIndexOutOfBoundsException");
        $pizza->startsWith("p", -1);

    }

    public function testStartsWithFromIndexGreaterThanLength() {

        $pizza = new Str("pizza");

        $this->setExpectedException("Str\StrIndexOutOfBoundsException");
        $pizza->startsWith("p", $pizza->length() + 1);

    }

    public function testStartsWithIgnoreCase() {

        $pizza = new Str("pizza");

        $this->assertTrue($pizza->startsWith("P", 0, true));
        $this->assertTrue($pizza->startsWith("P", null, true));
        $this->assertTrue($pizza->startsWith("p", 0, true));
        $this->assertTrue($pizza->startsWith("p", null, true));

    }

    public function testSubstringBeginIndexLessThanZero() {

        $pepperoniPizza = new Str("pepperoni pizza");

        $this->setExpectedException("Str\StrIndexOutOfBoundsException");
        $pepperoniPizza->substring(-1);

    }

    public function testSubstringBeginIndexEqualsLength() {

        $pepperoniPizza = new Str("pepperoni pizza");

        $this->assertEquals("", $pepperoniPizza->substring($pepperoniPizza->length()));

    }

    public function testSubstringBeginIndexGreaterThanLength() {

        $pepperoniPizza = new Str("pepperoni pizza");

        $this->setExpectedException("Str\StrIndexOutOfBoundsException");
        $pepperoniPizza->substring($pepperoniPizza->length() + 1);

    }

    public function testSubstringBeginIndexEqualsZero() {

        $pepperoniPizza = new Str("pepperoni pizza");

        $this->assertEquals("pepperoni pizza", $pepperoniPizza->substring(0));

    }

    public function testSubstringBeginIndexEqualsZeroElse() {

        $pepperoniPizza = new Str("pepperoni pizza");

        $this->assertEquals("epperoni pizza", $pepperoniPizza->substring(1));

    }

    public function testSubstringEndIndexGreaterThanLength() {

        $pepperoniPizza = new Str("pepperoni pizza");

        $this->setExpectedException("Str\StrIndexOutOfBoundsException");
        $pepperoniPizza->substring(0, $pepperoniPizza->length() + 1);

    }

    public function testSubstringEndIndexLengthLessThanZero() {

        $pepperoniPizza = new Str("pepperoni pizza");

        $this->setExpectedException("Str\StrIndexOutOfBoundsException");
        $pepperoniPizza->substring(8, 4);

    }

    public function testSubstringBeginIndexEqualsZeroAndEndIndexEqualsLength() {

        $pepperoniPizza = new Str("pepperoni pizza");

        $this->assertEquals("pepperoni pizza", $pepperoniPizza->substring(0, $pepperoniPizza->length()));

    }

    public function testSubstringBeginIndexEqualsZeroAndEndIndexEqualsLengthElse() {

        $pepperoniPizza = new Str("pepperoni pizza");

        $this->assertEquals("pizza", $pepperoniPizza->substring(10, $pepperoniPizza->length()));

    }

    public function testToCharArray() {

        $pizza = new Str("pizza");

        $this->assertEquals(array("p", "i", "z", "z", "a"), $pizza->toCharArray());

    }

    public function testToLowerCase() {

        $pizza = new Str("PIZZA");

        $this->assertEquals("pizza", $pizza->toLowerCase());

    }

    public function testToUpperCase() {

        $pizza = new Str("pizza");

        $this->assertEquals("PIZZA", $pizza->toUpperCase());

    }

    public function testTrim() {

        $pizza = new Str(" pizza ");

        $this->assertEquals("pizza", $pizza->trim());

    }

    public function testTrimLeft() {

        $pizza = new Str(" pizza ");

        $this->assertEquals("pizza ", $pizza->trimLeft());

    }

    public function testTrimRight() {

        $pizza = new Str(" pizza ");

        $this->assertEquals(" pizza", $pizza->trimRight());

    }

}
