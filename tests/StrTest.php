<?php

namespace mscribellito;

use PHPUnit_Framework_TestCase;

require __DIR__ . "/../src/Str.php";

class StrTest extends PHPUnit_Framework_TestCase {

    public function testConstructor() {

        $pepperoniPizza = new Str("pepperoni pizza");
        $this->assertInstanceOf("mscribellito\Str", $pepperoniPizza);

    }

    public function testConstructorWithOffsetAndLength() {

        $pepperoniPizza = new Str(" pepperoni pizza ", 1, 15);
        $this->assertInstanceOf("mscribellito\Str", $pepperoniPizza);

    }

    public function testConstructorWithOffsetLessThanZero() {

        $this->setExpectedException("mscribellito\StrIndexOutOfBoundsException");
        new Str("pizza", -1, 0);

    }

    public function testConstructorWithLengthLessThanZero() {

        $this->setExpectedException("mscribellito\StrIndexOutOfBoundsException");
        new Str("pizza", 0, -1);

    }

    public function testConstructorWithOffsetGreaterThanLength() {

        $this->setExpectedException("mscribellito\StrIndexOutOfBoundsException");
        $pepperoniPizza = new Str("pepperoni pizza", 16, 15);

    }

    public function testToString() {

        $pizza = new Str("pizza");
        $nullPizza = new Str();
        $emptyPizza = new Str("");

        $this->assertEquals("pizza", $pizza);
        $this->assertEquals("", $nullPizza);
        $this->assertEquals("", $emptyPizza);

    }

    public function testCharAt() {

        $pizza = new Str("pizza");

        $this->assertEquals("p", $pizza->charAt(0));
        $this->assertNotEquals("Z", $pizza->charAt(2));
        $this->assertEquals("a", $pizza->charAt($pizza->length() - 1));

        $this->setExpectedException("mscribellito\StrIndexOutOfBoundsException");
        $pizza->charAt(-1);
        $pizza->charAt($pizza->length());

    }

    public function testCharCodeAt() {

        $pizza = new Str("pizza");

        $this->assertEquals(ord("p"), $pizza->charCodeAt(0));
        $this->assertNotEquals(ord("Z"), $pizza->charCodeAt(2));
        $this->assertEquals(ord("a"), $pizza->charCodeAt($pizza->length() - 1));

        $this->setExpectedException("mscribellito\StrIndexOutOfBoundsException");
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

        $this->assertTrue($smallPizza->equalsIgnoreCase($smallPizza));
        $this->assertTrue($smallPizza->equalsIgnoreCase("PIZZA"));

        $this->assertTrue($smallPizza->equalsIgnoreCase($largePizza));
        $this->assertTrue($largePizza->equalsIgnoreCase($smallPizza));

        $this->assertTrue($largePizza->equalsIgnoreCase($largePizza));
        $this->assertTrue($largePizza->equalsIgnoreCase("pizza"));

        $str = new Str("1234");
        $this->assertTrue($str->equalsIgnoreCase(1234));

    }

    public function testFormat() {

        $pepperoniPizza = Str::format("%s %s", "pepperoni", "pizza");

        $this->assertTrue($pepperoniPizza->equals("pepperoni pizza"));

    }

    public function testIndexOf() {

        $pizza = new Str("pizza");

        $this->assertEquals(0, $pizza->indexOf("p"));
        $this->assertEquals(4, $pizza->indexOf("a"));
        $this->assertEquals(3, $pizza->indexOf("z", 3));
        $this->assertEquals(-1, $pizza->indexOf(" "));

    }

    public function testIndexOfFromIndexLessThanZero() {

        $pizza = new Str("pizza");

        $this->assertEquals(0, $pizza->indexOf("p", -1));

    }

    public function testIndexOfFromIndexGreaterThanOrEqualToLength() {

        $pizza = new Str("pizza");

        $this->assertEquals(-1, $pizza->indexOf("p", $pizza->length()));

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

        $this->setExpectedException('mscribellito\StrIndexOutOfBoundsException');
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
        $emptyPizza = new Str("");

        $this->assertFalse($pizza->isEmpty());
        $this->assertTrue($nullPizza->isEmpty());
        $this->assertTrue($emptyPizza->isEmpty());

    }

    public function testJoin() {

        $pepperoniPizza = Str::join(" ", array("pepperoni", "pizza"));
        $pepperoniPizzaIngredients = Str::join(", ", array("crust", "sauce", "cheese", "pepperoni"));

        $this->assertEquals("pepperoni pizza", $pepperoniPizza);
        $this->assertEquals("crust, sauce, cheese, pepperoni", $pepperoniPizzaIngredients);

    }

    public function testLastIndexOf() {

        $pizza = new Str("pizza");

        $this->assertEquals(3, $pizza->lastIndexOf("z"));
        $this->assertEquals(4, $pizza->lastIndexOf("a"));
        $this->assertEquals(3, $pizza->lastIndexOf("z", 3));
        $this->assertEquals(-1, $pizza->lastIndexOf(" "));

        $pizzaPizza = new Str("pizza pizza");

    }

    public function testLastIndexOfFromIndexLessThanZero() {

        $pizza = new Str("pizza");

        $this->assertEquals(3, $pizza->lastIndexOf("z", -1));

    }

    public function testLastIndexOfFromIndexGreaterThanOrEqualToLength() {

        $pizza = new Str("pizza");

        $this->assertEquals(-1, $pizza->lastIndexOf("z", $pizza->length()));

    }

    public function testLength() {

        $pizza = new Str("pizza");
        $nullPizza = new Str();
        $emptyPizza = new Str("");

        $this->assertEquals(5, $pizza->length());
        $this->assertEquals(0, $nullPizza->length());
        $this->assertEquals(0, $emptyPizza->length());

    }

    public function testMatches() {

        $pizza = new Str("pizza");

        $this->assertTrue($pizza->matches("/[a-z]/"));
        $this->assertFalse($pizza->matches("/[0-9]/"));

    }

    public function testRegionMatches() {

        $cheesePizza = new Str("chz pizza");
        $pepperoniPizza = new Str("pep pizza");

        $this->assertTrue($cheesePizza->regionMatches(4, $pepperoniPizza, 4, 5));
        $this->assertFalse($cheesePizza->regionMatches(0, $pepperoniPizza, 0, 3));

    }

    public function testRegionMatchesIgnoringCase() {

        $cheesePizza = new Str("chz PIZZA");
        $pepperoniPizza = new Str("PEP pizza");

        $this->assertTrue($cheesePizza->regionMatches(4, $pepperoniPizza, 4, 5, true));
        $this->assertFalse($cheesePizza->regionMatches(0, $pepperoniPizza, 0, 3, true));

    }

    public function testReplace() {

        $lie = new Str("pizza sucks");
        $truth = $lie->replace("sucks", "is life");

        $this->assertEquals("pizza is life", $truth);

    }

    public function testReplaceAll() {

        $pizza = new Str("1 pizza 2 pizza 3 pizza");
        $pizza = $pizza->replaceAll("/[0-9]\s/", "");

        $this->assertEquals("pizza pizza pizza", $pizza);

    }

    public function testReplaceFirst() {

        $pizza = new Str("pizza pizza");
        $pizza = $pizza->replaceFirst("/\w+\s?/", "");

        $this->assertEquals("pizza", $pizza);

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

        $this->setExpectedException("mscribellito\StrIndexOutOfBoundsException");
        $pizza->startsWith("p", -1);

    }

    public function testStartsWithFromIndexGreaterThanLength() {

        $pizza = new Str("pizza");

        $this->setExpectedException("mscribellito\StrIndexOutOfBoundsException");
        $pizza->startsWith("p", $pizza->length() + 1);

    }

    public function testSubstringBeginIndexLessThanZero() {

        $pepperoniPizza = new Str("pepperoni pizza");

        $this->setExpectedException("mscribellito\StrIndexOutOfBoundsException");
        $pepperoniPizza->substring(-1);

    }

    public function testSubstringBeginIndexEqualsLength() {

        $pepperoniPizza = new Str("pepperoni pizza");

        $this->assertEquals("", $pepperoniPizza->substring($pepperoniPizza->length()));

    }

    public function testSubstringBeginIndexGreaterThanLength() {

        $pepperoniPizza = new Str("pepperoni pizza");

        $this->setExpectedException("mscribellito\StrIndexOutOfBoundsException");
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

        $this->setExpectedException("mscribellito\StrIndexOutOfBoundsException");
        $pepperoniPizza->substring(0, $pepperoniPizza->length() + 1);

    }

    public function testSubstringEndIndexLengthLessThanZero() {

        $pepperoniPizza = new Str("pepperoni pizza");

        $this->setExpectedException("mscribellito\StrIndexOutOfBoundsException");
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

}
