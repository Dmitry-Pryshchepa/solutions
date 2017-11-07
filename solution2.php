<?php

$array = [1,2,3,0];
$n = 4;
echo solve($array, $n);

/**
 * Solve the problem.
 *
 * Существует одномерный массив, от 1 до N элементов. В массиве храняться все числа, от 1 до N, но упорядочены они
 * случайным образом (массив не отсортирован). Один из элементов массива заменен на число 0. Напишите код позвозволяющий
 * определить вместо какого числа стоит 0. Количество итераций должно быть наименьшим на столько на сколько
 * это возможно.
 * @param array $array
 * @param int $n
 * @return int
 */
function solve(array $array, int $n) : int
{
    $expectedSum = (1 + $n) * ($n / 2);
    $sumOfArray = array_sum($array);
    return $expectedSum - $sumOfArray;
}
