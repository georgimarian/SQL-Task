<?php

/**
 * Big function for the change case feature
 * Changes case according to the filter found
 * @param string $condition
 * @param array $table
 * @param string $column
 * @return array
 */
function changeCaseOfWord(string $condition, array $table, string $column): array
{
    switch ($condition) {
        case 'uppercase-column':
            array_walk($table, covertWordToUppercase($column));
            echo 'mama';
            print_r($table);
            break;
        case 'lowercase-column':
            array_walk($table, convertWordToLowercase($column));
            break;
        case 'titlecase-column':
            array_walk($table, convertWordToTitleCase($column));
            break;
        case 'power-values':
            {
                $cond   = explode(",", $column);
                $column = $cond[0];
                $power  = $cond[1];
                array_walk($table, powervalues($column, $power));
            }
            break;

    }
    return $table;
}

/**
 * Converts word to uppercase
 * @param string $column
 * @return Closure
 */
function covertWordToUppercase(string $column)
{
    return function (&$row) use ($column) {
        $row[$column] = strtoupper($row[$column]);
        return $row;
    };
}

/**
 * Converts word to lowercase
 * @param string $column
 * @return Closure
 */
function convertWordToLowercase(string $column)
{
    return function (&$row) use ($column) {
        $row[$column] = strtolower($row[$column]);
        return $row;
    };
}

/**
 * Converts word to title case
 * @param string $column
 * @return Closure
 */
function convertWordToTitleCase(string $column)
{
    return function (&$row) use ($column) {
        $row[$column] = ucwords($row[$column]);
        return $row;
    };
}

/**
 * Returns the power of a numerical value
 * @param string $column
 * @param string $pow
 * @return Closure
 */
function powerValues(string $column, string $pow)
{
    return function (&$row) use ($column, $pow) {
        $row[$column] = pow(intval($row[$column]), intval($pow));
        return $row;
    };
}
