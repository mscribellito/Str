<?php

namespace mscribellito;

use PHPUnit\Framework\TestCase;
use ArrayAccess;
use Exception;
use OutOfBoundsException;

class StrTest extends TestCase
{
    const LIPSUM = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.';
    const LIPSUM_EXTRA = 'Donec sed vestibulum massa.';
    const LOREM_IPSUM = 'Lorem ipsum';

    public function testConstructor()
    {
        $lipsum = new Str(self::LIPSUM);
        $this->assertInstanceOf("mscribellito\Str", $lipsum);
    }

    public function testConstructorWithOffsetAndLength()
    {
        $lipsum1 = new Str(self::LIPSUM, 0, 5);
        $this->assertInstanceOf("mscribellito\Str", $lipsum1);

        $lipsum2 = new Str(self::LIPSUM);
        $this->assertEquals(56, $lipsum2->length());

        $lipsum3 = new Str(self::LIPSUM, 0, 5);
        $this->assertEquals(5, $lipsum3->length());
    }

    public function testConstructorWithOffsetLessThanZero()
    {
        $this->expectException(OutOfBoundsException::class);
        new Str(self::LIPSUM, -1, 0);
    }

    public function testConstructorWithLengthLessThanZero()
    {
        $this->expectException(OutOfBoundsException::class);
        new Str(self::LIPSUM, 0, -1);
    }

    public function testConstructorWithOffsetGreaterThanLength()
    {
        $this->expectException(OutOfBoundsException::class);
        new Str(self::LIPSUM, 57, 0);
    }

    public function testToString()
    {
        $lipsum = new Str(self::LIPSUM);
        $null = new Str();
        $empty = new Str('');

        $this->assertEquals(self::LIPSUM, $lipsum);
        $this->assertEquals('', $null);
        $this->assertEquals('', $empty);
    }

    public function testCharAt()
    {
        $lipsum = new Str(self::LIPSUM);

        $this->assertEquals('L', $lipsum->charAt(0));
        $this->assertNotEquals('O', $lipsum->charAt(1));
        $this->assertEquals('.', $lipsum->charAt($lipsum->length() - 1));

        $this->expectException(OutOfBoundsException::class);
        $lipsum->charAt(-1);
        $lipsum->charAt($lipsum->length());
    }

    public function testCharCodeAt()
    {
        $lipsum = new Str(self::LIPSUM);

        $this->assertEquals(ord('L'), $lipsum->charCodeAt(0));
        $this->assertNotEquals(ord('O'), $lipsum->charCodeAt(1));
        $this->assertEquals(ord('.'), $lipsum->charCodeAt($lipsum->length() - 1));

        $this->expectException(OutOfBoundsException::class);
        $lipsum->charCodeAt(-1);
        $lipsum->charCodeAt($lipsum->length());
    }

    public function testCompareTo()
    {
        $lorem = new Str('lorem');
        $ipsum = new Str('ipsum');
        $dolor = new Str('dolor');

        $this->assertGreaterThanOrEqual(1, $lorem->compareTo($ipsum));
        $this->assertGreaterThanOrEqual(1, $lorem->compareTo($dolor));
        $this->assertGreaterThanOrEqual(1, $ipsum->compareTo($dolor));

        $this->assertLessThanOrEqual(-1, $ipsum->compareTo($lorem));
        $this->assertLessThanOrEqual(-1, $dolor->compareTo($lorem));
        $this->assertLessThanOrEqual(-1, $dolor->compareTo($ipsum));

        $this->assertEquals(0, $lorem->compareTo('lorem'));
        $this->assertEquals(0, $lorem->compareTo($lorem));

        $this->assertEquals(0, $ipsum->compareTo('ipsum'));
        $this->assertEquals(0, $ipsum->compareTo($ipsum));

        $this->assertEquals(0, $dolor->compareTo('dolor'));
        $this->assertEquals(0, $dolor->compareTo($dolor));
    }

    public function testCompareToIgnoreCase()
    {
        $lowerLorem = new Str('lorem');
        $upperLorem = new Str('LOREM');
        $lowerIpsum = new Str('ipsum');
        $upperIpsum = new Str('IPSUM');

        $this->assertGreaterThanOrEqual(1, $lowerLorem->compareToIgnoreCase($upperIpsum));
        $this->assertGreaterThanOrEqual(1, $upperLorem->compareToIgnoreCase($lowerIpsum));

        $this->assertLessThanOrEqual(-1, $lowerIpsum->compareToIgnoreCase($lowerLorem));
        $this->assertLessThanOrEqual(-1, $upperIpsum->compareToIgnoreCase($upperLorem));

        $this->assertEquals(0, $lowerLorem->compareToIgnoreCase($upperLorem));
        $this->assertEquals(0, $lowerLorem->compareToIgnoreCase('LOREM'));
        $this->assertEquals(0, $upperLorem->compareToIgnoreCase('lorem'));

        $this->assertEquals(0, $lowerIpsum->compareToIgnoreCase($upperIpsum));
        $this->assertEquals(0, $lowerIpsum->compareToIgnoreCase('ipsum'));
        $this->assertEquals(0, $upperIpsum->compareToIgnoreCase('IPSUM'));

        $str = new Str('1234');
        $this->assertEquals(0, $str->compareToIgnoreCase(1234));
    }

    public function testConcat()
    {
        $lipsum = new Str(self::LIPSUM);
        $extra = new Str(self::LIPSUM_EXTRA);

        $this->assertEquals(self::LIPSUM.' '.self::LIPSUM_EXTRA, $lipsum->concat(' ')->concat($extra));
        $this->assertEquals(self::LIPSUM.' '.self::LIPSUM_EXTRA, $lipsum->concat(' ')->concat(self::LIPSUM_EXTRA));
    }

    public function testContains()
    {
        $lipsum = new Str(self::LIPSUM);

        $this->assertTrue($lipsum->contains('Lorem'));
        $this->assertFalse($lipsum->contains('Donec'));
    }

    public function testEndsWith()
    {
        $lipsum = new Str(self::LIPSUM);

        $this->assertTrue($lipsum->endsWith('.'));
        $this->assertTrue($lipsum->endsWith('t.'));
        $this->assertFalse($lipsum->endsWith('L'));
        $this->assertFalse($lipsum->endsWith('Lo'));
    }

    public function testEquals()
    {
        $lowerLipsum = new Str(strtolower(self::LIPSUM));
        $upperLipsum = new Str(strtoupper(self::LIPSUM));

        $this->assertTrue($lowerLipsum->equals($lowerLipsum));
        $this->assertTrue($lowerLipsum->equals(strtolower(self::LIPSUM)));

        $this->assertFalse($lowerLipsum->equals($upperLipsum));
        $this->assertFalse($upperLipsum->equals($lowerLipsum));

        $this->assertTrue($upperLipsum->equals($upperLipsum));
        $this->assertTrue($upperLipsum->equals(strtoupper(self::LIPSUM)));
    }

    public function testEqualsIgnoreCase()
    {
        $lowerLipsum = new Str(strtolower(self::LIPSUM));
        $upperLipsum = new Str(strtoupper(self::LIPSUM));

        $this->assertTrue($lowerLipsum->equalsIgnoreCase($lowerLipsum));
        $this->assertTrue($lowerLipsum->equalsIgnoreCase(strtoupper(self::LIPSUM)));

        $this->assertTrue($lowerLipsum->equalsIgnoreCase($upperLipsum));
        $this->assertTrue($upperLipsum->equalsIgnoreCase($lowerLipsum));

        $this->assertTrue($upperLipsum->equalsIgnoreCase($upperLipsum));
        $this->assertTrue($upperLipsum->equalsIgnoreCase(strtolower(self::LIPSUM)));
    }

    public function testFormat()
    {
        $args = explode(' ', self::LIPSUM);
        $format = implode(' ', array_fill(0, count($args), '%s'));
        array_unshift($args, $format);

        $lipsum = call_user_func_array([__NAMESPACE__."\Str", 'format'], $args);

        $this->assertTrue($lipsum->equals(self::LIPSUM));
    }

    public function testIndexOf()
    {
        $lipsum = new Str(self::LIPSUM);

        $this->assertEquals(-1, $lipsum->indexOf('L', -1));
        $this->assertEquals(-1, $lipsum->indexOf('.', 56));

        $this->assertEquals(0, $lipsum->indexOf('L'));
        $this->assertEquals(-1, $lipsum->indexOf('L', 1));
        $this->assertEquals(55, $lipsum->indexOf('.'));
        $this->assertEquals(-1, $lipsum->indexOf('.', 56));
    }

    public function testIndexOfFromIndexLessThanZero()
    {
        $lipsum = new Str(self::LIPSUM);

        $this->assertEquals(-1, $lipsum->indexOf('L', -1));
    }

    public function testIndexOfFromIndexGreaterThanOrEqualToLength()
    {
        $lipsum = new Str(self::LIPSUM);

        $this->assertEquals(-1, $lipsum->indexOf('L', $lipsum->length()));
    }

    public function testInterfaceArrayAccessOffsetExists()
    {
        $lipsum = new Str(self::LIPSUM);

        $this->assertTrue(isset($lipsum[0]), true);
        $this->assertTrue(isset($lipsum[55]), true);
        $this->assertFalse(isset($lipsum[-1]), false);
        $this->assertFalse(isset($lipsum[56]), false);
    }

    public function testInterfaceArrayAccessOffsetGet()
    {
        $lipsum = new Str(self::LIPSUM);

        $this->assertEquals('L', $lipsum[0]);
        $this->assertEquals('.', $lipsum[55]);

        $this->expectException(OutOfBoundsException::class);
        $this->assertEquals(null, $lipsum[-1]);
    }

    public function testInterfaceArrayAccessOffsetSet()
    {
        $lipsum = new Str(self::LIPSUM);

        $this->expectException(Exception::class);
        $lipsum[0] = ' ';
    }

    public function testInterfaceArrayAccessOffsetUnset()
    {
        $lipsum = new Str(self::LIPSUM);

        $this->expectException(Exception::class);
        unset($lipsum[0]);
    }

    public function testIsEmpty()
    {
        $lipsum = new Str(self::LIPSUM);
        $null = new Str();
        $empty = new Str('');

        $this->assertFalse($lipsum->isEmpty());
        $this->assertTrue($null->isEmpty());
        $this->assertTrue($empty->isEmpty());
    }

    public function testJoin()
    {
        $lipsum = Str::join(' ', explode(' ', self::LIPSUM));

        $this->assertEquals(self::LIPSUM, $lipsum);
    }

    public function testLastIndexOf()
    {
        $lipsum = new Str(self::LIPSUM);

        $this->assertEquals(-1, $lipsum->lastIndexOf('L', -1));
        $this->assertEquals(-1, $lipsum->lastIndexOf('.', 56));
        $this->assertEquals(0, $lipsum->lastIndexOf('L'));
        $this->assertEquals(54, $lipsum->lastIndexOf('t'));
        $this->assertEquals(36, $lipsum->lastIndexOf('t', 20));
    }

    public function testLastIndexOfFromIndexLessThanZero()
    {
        $lipsum = new Str(self::LIPSUM);

        $this->assertEquals(-1, $lipsum->lastIndexOf('z', -1));
    }

    public function testLastIndexOfFromIndexGreaterThanOrEqualToLength()
    {
        $lipsum = new Str(self::LIPSUM);

        $this->assertEquals(-1, $lipsum->lastIndexOf('z', $lipsum->length()));
    }

    public function testLength()
    {
        $lipsum = new Str(self::LIPSUM);
        $null = new Str();
        $empty = new Str('');

        $this->assertEquals(56, $lipsum->length());
        $this->assertEquals(0, $null->length());
        $this->assertEquals(0, $empty->length());
    }

    public function testMatches()
    {
        $lipsum = new Str(self::LIPSUM);

        $this->assertTrue($lipsum->matches("/^[A-Z\.,\s]+$/i"));
        $this->assertFalse($lipsum->matches('/^[0-9]+$/'));
    }

    public function testRegionMatches()
    {
        $lipsum = new Str(self::LIPSUM);
        $lipsumExtra = new Str(self::LIPSUM_EXTRA);

        $this->assertTrue($lipsum->regionMatches(55, $lipsumExtra, 26, 1));
        $this->assertFalse($lipsum->regionMatches(0, $lipsumExtra, 0, 5));
    }

    public function testRegionMatchesIgnoringCase()
    {
        $lipsum = new Str(self::LIPSUM);
        $lipsumExtra = new Str(self::LIPSUM_EXTRA);

        $this->assertTrue($lipsum->regionMatches(0, $lipsumExtra, 17, 1, true));
        $this->assertFalse($lipsum->regionMatches(0, $lipsumExtra, 0, 5, true));
    }

    public function testReplace()
    {
        $lipsum = new Str(self::LOREM_IPSUM);
        $lipsum = $lipsum->replace('Lorem ipsum', 'Lipsum');

        $this->assertEquals('Lipsum', $lipsum);
    }

    public function testReplaceAll()
    {
        $lipsum = new Str(self::LOREM_IPSUM.' '.self::LOREM_IPSUM);
        $lipsum = $lipsum->replaceAll('/Lorem ipsum/', 'Lipsum');

        $this->assertEquals('Lipsum Lipsum', $lipsum);
    }

    public function testReplaceFirst()
    {
        $lipsum = new Str(self::LOREM_IPSUM.' '.self::LOREM_IPSUM);
        $lipsum = $lipsum->replaceFirst('/Lorem ipsum/', 'Lipsum');

        $this->assertEquals('Lipsum Lorem ipsum', $lipsum);
    }

    public function testSplit()
    {
        $lipsum = new Str(self::LIPSUM);

        $this->assertEquals(explode(' ', self::LIPSUM), $lipsum->split('/ /'));
    }

    public function testStartsWith()
    {
        $lipsum = new Str(self::LIPSUM);

        $this->assertTrue($lipsum->startsWith('L'));
        $this->assertTrue($lipsum->startsWith('Lo'));
        $this->assertFalse($lipsum->startsWith('.'));
        $this->assertFalse($lipsum->startsWith('t.'));
    }

    public function testStartsWithFromIndex()
    {
        $lipsum = new Str(self::LIPSUM);

        $this->assertTrue($lipsum->startsWith('o', 1));
        $this->assertTrue($lipsum->startsWith('or', 1));
        $this->assertFalse($lipsum->startsWith('.', 1));
        $this->assertFalse($lipsum->startsWith('t.', 1));
    }

    public function testStartsWithFromIndexLessThanZero()
    {
        $lipsum = new Str(self::LIPSUM);

        $this->expectException(OutOfBoundsException::class);
        $lipsum->startsWith('L', -1);
    }

    public function testStartsWithFromIndexGreaterThanLength()
    {
        $lipsum = new Str(self::LIPSUM);

        $this->expectException(OutOfBoundsException::class);
        $lipsum->startsWith('L', $lipsum->length() + 1);
    }

    public function testSubstringBeginIndexLessThanZero()
    {
        $lipsum = new Str(self::LIPSUM);

        $this->expectException(OutOfBoundsException::class);
        $lipsum->substring(-1);
    }

    public function testSubstringBeginIndexEqualsLength()
    {
        $lipsum = new Str(self::LIPSUM);

        $this->assertEquals('', $lipsum->substring($lipsum->length()));
    }

    public function testSubstringNoEndIndexAndBeginIndexGreaterThanLength()
    {
        $lipsum = new Str(self::LIPSUM);

        $this->expectException(OutOfBoundsException::class);
        $lipsum->substring($lipsum->length() + 1);
    }

    public function testSubstringNoEndIndexAndBeginIndexEqualsZero()
    {
        $lipsum = new Str(self::LIPSUM);

        $this->assertEquals(self::LIPSUM, $lipsum->substring(0));
    }

    public function testSubstringNoEndIndexAndBeginIndexNotEqualZero()
    {
        $lipsum = new Str(self::LIPSUM);

        $this->assertEquals('elit.', $lipsum->substring(51));
    }

    public function testSubstringEndIndexAndEndIndexGreaterThanLength()
    {
        $lipsum = new Str(self::LIPSUM);

        $this->expectException(OutOfBoundsException::class);
        $lipsum->substring(0, $lipsum->length() + 1);
    }

    public function testSubstringEndIndexAndLengthLessThanZero()
    {
        $lipsum = new Str(self::LIPSUM);

        $this->expectException(OutOfBoundsException::class);
        $lipsum->substring(1, 0);
    }

    public function testSubstringEndIndexAndBeginIndexEqualsZeroAndEndIndexEqualsLength()
    {
        $lipsum = new Str(self::LIPSUM);

        $this->assertEquals(self::LIPSUM, $lipsum->substring(0, $lipsum->length()));
    }

    public function testSubstringEndIndexAndBeginNotEqualZeroOrEndIndexNotEqualLength()
    {
        $lipsum = new Str(self::LIPSUM);

        $this->assertEquals('elit.', $lipsum->substring(51, $lipsum->length()));
    }

    public function testToCharArray()
    {
        $lipsum = new Str(self::LIPSUM);

        $this->assertEquals(str_split(self::LIPSUM), $lipsum->toCharArray());
    }

    public function testToLowerCase()
    {
        $lipsum = new Str(self::LIPSUM);

        $this->assertEquals(strtolower(self::LIPSUM), $lipsum->toLowerCase());
    }

    public function testToUpperCase()
    {
        $lipsum = new Str(self::LIPSUM);

        $this->assertEquals(strtoupper(self::LIPSUM), $lipsum->toUpperCase());
    }

    public function testTrim()
    {
        $lipsum = new Str(' '.self::LIPSUM.' ');

        $this->assertEquals(self::LIPSUM, $lipsum->trim());
    }
}
