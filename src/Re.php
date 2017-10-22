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
 * @author Spencer Mortensen <spencer@lens.guide>
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL-3.0
 * @copyright 2017 Spencer Mortensen
 */

namespace SpencerMortensen\RegularExpressions;

class Re
{
	/** @var string */
	private static $delimiter = "\x03";

	public static function quote($literal)
	{
		return preg_quote($literal, self::$delimiter);
	}

	public static function split($expression, $input, $flags = '')
	{
		$pattern = self::$delimiter . $expression . self::$delimiter . $flags . 'XDs';

		$matches = preg_split($pattern, $input);

		return self::getChunks($matches);
	}

	private static function getChunks(array $matches)
	{
		$chunks = array();

		foreach ($matches as $match) {
			if (0 < strlen($match)) {
				$chunks[] = $match;
			}
		}

		return $chunks;
	}

	public static function match($expression, $input, &$output, $flags = '')
	{
		$pattern = self::$delimiter . $expression . self::$delimiter . $flags . 'XDs';

		if (preg_match($pattern, $input, $match) !== 1) {
			return false;
		}

		if (1 < count($match)) {
			$output = $match;
		} else {
			$output = $match[0];
		}

		return true;
	}
}
