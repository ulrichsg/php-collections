<?php

namespace Ulrichsg\Collections;

/** @covers Ulrichsg\Collections\Map */
class MapTest extends \PHPUnit_Framework_TestCase {

	/** @test */
	public function emptyMapIsEmpty() {
		$map = new Map();
		$this->assertEquals(0, $map->count());
	}

	/** @test */
	public function preFilledMapHasEntries() {
		$map = new Map(array(1 => 'foo', 2 => 'bar'));
		$this->assertEquals(2, $map->count());
	}

	/** @test */
	public function hasKeyReturnsExpectedValue() {
		$map = new Map(array('foo' => 'bar'));
		$this->assertTrue($map->hasKey('foo'));
		$this->assertFalse($map->hasKey('bar'));
	}

	/** @test */
	public function getReturnsAssignedValueOrDefault() {
		$map = new Map(array('foo' => 'bar'));
		$this->assertEquals('bar', $map->get('foo'));
		$this->assertNull($map->get('bar'));
		$this->assertEquals(1337, $map->get('bar', 1337));
	}

	/** @test */
	public function setAssignsNewValue() {
		$map = new Map(array('foo' => 'bar'));

		$map->set('foo', 'baz');
		$this->assertEquals('baz', $map->get('foo'));

		$map->set('ping', 'pong');
		$this->assertEquals('pong', $map->get('ping'));
	}

	/** @test */
	public function removeAffectsGivenKeyOnly() {
		$map = new Map(array('foo' => 42, 'bar' => 1337));
		$map->remove('foo');
		$this->assertFalse($map->hasKey('foo'));
		$this->assertEquals(1337, $map->get('bar'));
	}

	/** @test */
	public function iteratorHoldsExpectedValues() {
		$map = new Map(array('foo' => 42, 'bar' => 1337));
		foreach ($map as $key => $value) {
			switch ($key) {
				case 'foo':
					$this->assertEquals(42, $value);
					break;
				case 'bar':
					$this->assertEquals(1337, $value);
					break;
				default:
					$this->fail();
			}
		}
	}
}
