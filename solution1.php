<?php

$matrix = new MatrixProblem(rand(0, 10),rand(0, 10));
$matrix->drawTable();
echo "<br>";
echo "The result is: " . $matrix->solve();

/*
 * Interface for problems.
 */
interface ProblemInterface
{
    /**
     * Solve the problem.
     *
     * @return mixed $solution
     */
    public function solve();
}

/**
 * This class contains solution to the problem.
 *
 * Дана матрица А (двумерный массив) размерностью MxN.
 * Входящие параметры: int m; int n;
 * Результат float $sum;
 * Задача: 1. Заполнить матрицу случайными числами
 * 2. Найти факториал суммы элементов матрицы отвечающих следующим требованиям:
 * а) Элемент должен лежать на главной либо побочной диагонали матрицы б)
 * Элемент лежит на главной диагонали матрицы если номер столбца элемента равен номеру строки элемента матрицы и не
 * превышает номера среднего столбца матрицы в) Элемент лежит на побочной диагонали матрицы если он является зеркальным
 * отражением элемента лежащего на главной диагонали относительно центральной вертикальной оси матрицы
 * г) Если элемент находится одновременно на двух диагоналях, он должен быть включен в сумму один раз
 * Язык исполнения - PHP
 */
class MatrixProblem implements ProblemInterface
{
    /*
     * Size of the matrix(y axis).
     */
    private $m;

    /*
    * Size of the matrix(x axis).
    */
    private $n;

    /**
     * Representation of the matrix.
     *
     * @var array
     */
    private $matrix = [];

    /**
     * @param int $m
     * @param int $n
     */
    public function __construct(int $m = 1, int $n = 1)
    {
        $this->m = $m;
        $this->n = $n;
        for ($i = 0; $i < $m; $i++) {
            for ($j = 0; $j < $n; $j++) {
                $this->matrix[$i][$j] = rand(0, 10);
            }
        }
    }

    /**
     * Calculates factorial of the sum of accepted elements of the matrix.
     *
     * @return int
     */
    public function solve() : int
    {
        $valueArray = $this->formArrayForFactorialCalculation('isInSolution');
        return $this->factorial(array_sum($valueArray));
    }

    /**
     * Calculate factorial of the passed value.
     *
     * @param int $n
     * @return int
     */
    private function factorial(int $n)
    {
        $result = 1;
        for ($i = 1; $i <= $n; $i++)
            $result *= $i;
        return $result;
    }

    /**
     * Return true if a particular member of the matrix at [$m, $n] should be included into further calculations.
     *
     * @param $m
     * @param $n
     * @return bool
     */
    private function isInSolution(int $m, int $n) : bool
    {
        if ($m < $this->n / 2) {
            if ($m == $n) return true;
            if ($m == ($this->n - $n - 1)) return true;
        }
        return false;
    }

    /**
     * Visualize the matrix by drawing a table.
     * This function serves debugging purposes.
     */
    public function drawTable()
    {
        echo "<table border='1'>";
        for ($i = 0; $i < $this->m; $i++) {
            echo "<tr>";
            for ($j = 0; $j < $this->n; $j++) {
                if ($this->isInSolution($i, $j, $this->matrix)) {
                    echo "<td bgcolor='#9acd32'>";
                } else {
                    echo "<td>";
                }
                echo $this->matrix[$i][$j];
                echo "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    /**
     * Call the callback function to form the array of accepted values.
     *
     * @param string $checkMethod
     * @return array
     */
    private function formArrayForFactorialCalculation(string $checkMethod) : array
    {
        $result = [];
        for ($i = 0; $i < $this->m; $i++) {
            for ($j = 0; $j < $this->n; $j++) {
                if (call_user_func(array($this, $checkMethod), $i, $j)) {
                    $result[] = $this->matrix[$i][$j];
                }
            }
        }
        return $result;
    }
}
