<?php

/**
 * Selects given columns from a table
 * @param array $table
 * @param string $columns
 * @return array
 */
function selectColumns(array $table, string $columns): array
{
    if($columns ==='*')
        return $table;
    $columns       = explode(",", $columns);
    $selectedArray = array();
    foreach ($table as $key => $row)
        foreach ($columns as $index => $column) {
            $selectedArray[$key][$column] = $row[$column];
        }
    return $selectedArray;
}
