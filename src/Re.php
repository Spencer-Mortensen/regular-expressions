<?php

/**
 * Copyright (C) 2017 Spencer Mortensen
 *
 * This file is part of regular-expressions.
 *
 * Regular-expressions is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Regular-expressions is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with regular-expressions. If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Spencer Mortensen
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL-3.0
 * @copyright 2017 Spencer Mortensen
 */

namespace SpencerMortensen\RegularExpressions;

class Re
{
	private static $delimiter = "\x03";

	public static function pattern(string $expression, string $modifiers = '')
	{
		$modifiers .= 'DusX';

		return self::$delimiter . $expression . self::$delimiter . $modifiers;
	}

	public static function match(string $pattern, string $input, &$output = null, int &$i = 0, bool $showOffsets = false): bool
	{
		$flags = PREG_OFFSET_CAPTURE;

		if (preg_match($pattern, $input, $match, $flags, $i) !== 1) {
			return false;
		}

		$output = self::getMatch($match, $showOffsets);
		$i = $match[0][1] + strlen($match[0][0]);
		return true;
	}

	public static function matches(string $pattern, string $input, array &$output = null, int &$i = 0, bool $showOffsets = false): bool
	{
		$flags = PREG_SET_ORDER | PREG_OFFSET_CAPTURE;

		$count = preg_match_all($pattern, $input, $matches, $flags, $i);

		if (!is_int($count) || ($count < 1)) {
			return false;
		}

		$output = [];

		foreach ($matches as $match) {
			$output[] = self::getMatch($match, $showOffsets);
		}

		$match = end($matches);
		$i = $match[0][1] + strlen($match[0][0]);
		return true;
	}

	private static function getMatch(array $values, bool $showOffset)
	{
		switch (count($values)) {
			case 1:
				return self::getValue($values[0], $showOffset);

			case 2:
				return self::getValue($values[1], $showOffset);
		}

		for ($i = 0; array_key_exists($i, $values); ++$i) {
			unset($values[$i]);
		}

		foreach ($values as &$value) {
			$value = self::getValue($value, $showOffset);
		}

		return $values;
	}

	private static function getValue($value, bool $showOffset)
	{
		if (!is_array($value) || $showOffset) {
			return $value;
		}

		return $value[0];
	}

	public static function replace(string $pattern, string $replacement, string $input): string
	{
		return preg_replace($pattern, $replacement, $input);
	}

	public static function escape(string $literal)
	{
		return preg_quote($literal, self::$delimiter);
	}
}
