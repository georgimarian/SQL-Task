<?php

/**
 * Sort elements after one column
 * @param string $columnName
 * @param string $mode
 * @param string $direction
 * @param array $toSort
 * @return array
 */
function sortColumn(string $columnName, string $mode, string $direction, array $toSort): array
{
    $dir = selectDirection($direction);
    switch ($mode) {
        case 'natural':
            $sorted = sortTableAfterColumn($toSort, $columnName, $dir, SORT_NATURAL);
            break;
        case 'alpha':
            $sorted = sortTableAfterColumn($toSort, $columnName, $dir, SORT_REGULAR);
            break;
        case 'numeric':
            $sorted = sortTableAfterColumn($toSort, $columnName, $dir, SORT_NUMERIC);
            break;
    }
    return $sorted;
}

/**
 * Multi-sort function - sort multiple columns
 * @param array $columns
 * @param array $direction
 * @param array $data
 * @return mixed
 */
function multiSortArray(array $columns, array $direction, array $data)
{
    $multiSortParameters = array();
    foreach ($columns as $index => $columnName) {
        $multiSortParameters[] = array_column($data, $columnName);
        if (isset($direction[$index]) && $direction[$index] == 'desc') {
            $multiSortParameters[] = SORT_DESC;
        } else {
            $multiSortParameters[] = SORT_ASC;
        }
    }
    $multiSortParameters[] =& $data;
    call_user_func_array('array_multisort', $multiSortParameters);
    return $data;
}

/**
 * Sorts the table after a given column
 * @param array $data
 * @param string $columnName
 * @return array $data
 */
function sortTableAfterColumn(array $data, string $columnName, $sortDir, $sortFlag): array
{
    $new = array();
    foreach ($data as $key => $row) {
        $new[$key] = $row[$columnName];
    }
    array_multisort($new, $sortDir, $sortFlag, $data); // Add $data as the last parameter, to sort by the common key
    return $data;
}

/**
 * Select direction of sorting
 * @param string $direction
 * @return int
 */
function selectDirection(string $direction): int
{
    if ($direction === 'asc') {
        $dir = SORT_ASC;
    } else {
        $dir = SORT_DESC;
    }
    return $dir;
}


/**
 * Sort column keys for output display
 * @param array $arr
 * @return array
 */
function sortColumnsToOutput(array $arr): array
{
    $sortedArray = array();
    foreach ($arr as $row) {
        ksort($row, SORT_REGULAR);
        $sortedArray[] = $row;
    }
    return $sortedArray;
}