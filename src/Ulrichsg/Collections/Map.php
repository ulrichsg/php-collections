<?php

namespace Ulrichsg\Collections;

/**
 * A simple key-value map. Its main advantage over plain arrays is that you never have to call isset() to avoid
 * warnings. Supports square-bracket syntax and foreach loops.
 *
 * @version 1.0.0
 * @license MIT
 * @link https://github.com/ulrichsg/php-collections
 */
class Map implements \Countable, \ArrayAccess, \IteratorAggregate {

	/** @internal */
	protected $data;

	/**
	 * Creates a new map with the given array as its contents. Omitting the argument creates an empty map.
	 * @param array $data
	 */
	public function __construct(array $data = array()) {
		$this->data = $data;
	}

	/**
	 * Returns true if the map contains the given key, false otherwise.
	 * @param mixed $key
	 * @return bool
	 */
	public function hasKey($key) {
		return isset($this->data[$key]);
	}

	/**
	 * If the map contains the given key, returns the associated value. Otherwise, returns the default value.
	 * @param mixed $key
	 * @param mixed $default
	 * @return mixed
	 */
	public function get($key, $default = null) {
		return $this->hasKey($key) ? $this->data[$key] : $default;
	}

	/**
	 * Puts the given key-value pair into the map.
	 * @param mixed $key
	 * @param mixed $value
	 */
	public function set($key, $value) {
		$this->data[$key] = $value;
	}

	/**
	 * Removes the given key and its associated value from the map. Does nothing if the key is not in the map.
	 * @param mixed $key
	 */
	public function remove($key) {
		if ($this->hasKey($key)) {
			unset($this->data[$key]);
		}
	}

	/**
	 * Returns an iterator over the map.
	 * @return \ArrayIterator
	 */
	public function getIterator() {
		return new \ArrayIterator($this->data);
	}

	/**
	 * Returns the number of values in the map.
	 * @return int
	 */
	public function count() {
		return count($this->data);
	}

	/* ArrayAccess functions */

	/** @internal */
	public function offsetExists($offset) {
		return $this->hasKey($offset);
	}

	/** @internal */
	public function offsetGet($offset) {
		return $this->get($offset);
	}

	/** @internal */
	public function offsetSet($offset, $value) {
		$this->set($offset, $value);
	}

	/** @internal */
	public function offsetUnset($offset) {
		$this->remove($offset);
	}
}
