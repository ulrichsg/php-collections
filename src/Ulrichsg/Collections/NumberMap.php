<?php

namespace Ulrichsg\Collections;

/**
 * A map that contains only numeric values, and supports mathematical operations.
 *
 * @version 1.0.0
 * @license MIT
 * @link https://github.com/ulrichsg/php-collections
 */
class NumberMap extends Map {

	/** @internal */
	private $default;

	/**
	 * Creates a new NumberMap with the given array as its contents. Omitting the argument creates an empty map.
	 * @param array $data
	 * @param mixed $default
	 * @throws \InvalidArgumentException if $default or one of the array values is not numeric
	 */
	public function __construct(array $data = array(), $default = 0) {
		parent::__construct();
		foreach ($data as $key => $value) {
			$this->set($key, $value);
		}
		if (is_numeric($default)) {
			$this->default = $default;
		} else {
			throw new \InvalidArgumentException("Expected number, found ".gettype($default));
		}
	}

	/**
	 * Puts the given key-value pair into the map.
	 * @param mixed $key
	 * @param mixed $value
	 * @throws \InvalidArgumentException if $value is not numeric
	 */
	public function set($key, $value) {
		$this->assertIsNumeric($value);
		parent::set($key, $value);
	}

	/**
	 * Adds the given value to the one associated to the given key.
	 * If the key is not in the map yet, put it in and assume the map-wide default value.
	 * @param mixed $key
	 * @param mixed $value
	 * @throws \InvalidArgumentException if $value is not numeric
	 */
	public function add($key, $value) {
		$this->assertIsNumeric($value);
		$oldValue = $this->hasKey($key) ? $this->get($key) : $this->default;
		$this->set($key, $oldValue + $value);
	}

	/**
	 * Returns the sum of all values in the map.
	 * @return mixed
	 */
	public function sum() {
		return array_sum($this->data);
	}

	/** @internal */
	private function assertIsNumeric($value) {
		if (!is_numeric($value)) {
			throw new \InvalidArgumentException("Expected number, found ".gettype($value));
		}
	}
}
