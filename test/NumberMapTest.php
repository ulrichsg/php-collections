<?php

namespace Ulrichsg\Collections;

/** @covers Ulrichsg\Collections\NumberMap */
class NumberMapTest extends \PHPUnit_Framework_TestCase {

	/**
	* @test
	* @expectedException \InvalidArgumentException
	*/
	public function constructionFailsWhenSomeValueIsNotNumeric() {
		$map = new NumberMap(array('foo' => 1, 'bar' => 'baz'));
	}

	/**
	 * @test
	 * @expectedException \InvalidArgumentException
	 */
	public function constructionFailsWhenDefaultIsNotNumeric() {
		$map = new NumberMap(array(), 'foo');
	}

	/**
	 * @test
	 * @expectedException \InvalidArgumentException
	 */
	public function setFailsWhenValueIsNotNumeric() {
		$map = new NumberMap(array());
		$map->set('foo', 'bar');
	}

	/** @test */
	public function addWorksForExistingAndNonExistingValues() {
		$map = new NumberMap(array('foo' => 1));

		$map->add('foo', 1);
		$this->assertEquals(2, $map->get('foo'));

		$map->add('bar', 1);
		$this->assertEquals(1, $map->get('bar'));
	}

	/** @test */
	public function addUsesCustomDefaultValueIfNecessary() {
		$map = new NumberMap(array(), 5);
		$map->add('foo', 1);
		$this->assertEquals(6, $map->get('foo'));
	}

	/**
	 * @test
	 * @expectedException \InvalidArgumentException
	 */
	public function addFailsWhenValueIsNotNumeric() {
		$map = new NumberMap(array('foo' => 1));
		$map->add('foo', 'bar');
	}

	/** @test */
	public function sumIsCalculatedCorrectly() {
		$map = new NumberMap(array('foo' => 9, 'bar' => 16));
		$this->assertEquals(25, $map->sum());
	}
}
