<?php

/**
 * Applies user given function to a column
 * @param array $table
 * @param string $columnToMap
 * @param string $function
 * @return array
 */
function functionMapping(array $table, string $columnToMap, string $function): array
{
    require "$function.php";
    return array_map(function (array $row) use ($columnToMap, $function) : array {
        $row[$columnToMap] = $function($row[$columnToMap]);
        return $row;
    }, $table);
}


