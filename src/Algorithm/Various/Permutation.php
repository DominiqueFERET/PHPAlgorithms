<?php
/**
 * MIT License
 *
 * Copyright (c) 2018 Dogan Ucar, <dogan@dogan-ucar.de>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace doganoo\PHPAlgorithms\Algorithm\Various;

use doganoo\PHPUtil\Util\NumberUtil;
use doganoo\PHPUtil\Util\StringUtil;

/**
 * Class Permutation
 *
 * @package doganoo\PHPAlgorithms\Algorithm\Various
 */
class Permutation {
    /**
     * returns all permutations of a given string
     *
     * @param string $string
     * @return array
     */
    public function stringPermutations(string $string): array {
        $result = [];
        $strLen = \strlen($string);
        if (0 === $strLen) {
            return $result;
        }
        if (1 === $string) {
            $result[] = $string;
            return $result;
        }

        $array = StringUtil::stringToArray($string);
        $result = $this->permute($array, "", $result);
        return $result;
    }

    /**
     * returns all permutations of an given array of objects
     *
     * @param array $objects
     * @param       $prefix
     * @param array $result
     * @return array
     */
    private function permute(array $objects, $prefix, array $result) {
        $length = \count($objects);
        if (0 === $length) {
            $result[] = $prefix;
        } else {
            for ($i = 0; $i < $length; $i++) {
                $newObjects = \array_merge(
                    \array_slice($objects, 0, $i),
                    \array_slice($objects, $i + 1)
                );
                $newPrefix = $prefix . $objects[$i];

                $result = $this->permute($newObjects, $newPrefix, $result);
            }
        }
        return $result;
    }

    /**
     * returns all permutations of a given string
     *
     * @param int $number
     * @return array
     */
    public function numberPermutations(int $number) {
        $result = [];
        $array = NumberUtil::intToArray($number);
        $result = $this->permute($array, "", $result);
        foreach ($result as &$item) {
            \settype($item, "integer");
        }
        return $result;
    }
}