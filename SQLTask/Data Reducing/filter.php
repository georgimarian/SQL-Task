<?php


/**
 * Eliminates duplicates from an array of arrays
 * @param string $item
 * @param array $table
 * @return array
 */
function uniqueInTable(string $item, array $table): array
{
    $newArray  = array();//The array in which I will keep everything but the duplicates
    $newIndex  = 0;      // Index used to walk in the new array
    $itemArray = array();//Array in which only the values that need to be compared with $item are kept
    foreach ($table as $line) {
        if (!in_array($line[$item], $itemArray)) { //If I do not find a duplicate of the $item's value in the $itemArray
            $itemArray[$newIndex] = $line[$item]; //I add item's value to the item array
            $newArray[$newIndex]  = $line;   //I add the sub array to the array having unique elements
        }
        $newIndex++;
    }
    return $newArray;
}

function obtainWhere(string $str): array
{
    $expr = "/([a-zA-z]+)([=<>]+)([a-zA-z]+)/";
    preg_match($expr, $str, $matches);
    return (removeFirstFromArray($matches));
}

function validateWhere(array $arr): bool
{
    $signs = array("=", "<>", ">", "<");
    if (empty($arr)) {
        return false;
    }
    if (!in_array($arr[1], $signs)) {
        return false;
    }
    return true;
}

/**
 * Filters columns according to condition contained in WHERE
 * @param array $table
 * @param string $condition
 * @return array
 */
function filterWhere(array $table, string $condition)
{
    $filteredArray = array();
    $where         = obtainWhere($condition);
    $column        = $where[0];
    $sign          = $where[1];
    $wordToCompare = $where[2];
    foreach ($table as $key => $row) {
        $compare = strcmp($row[$column], $wordToCompare);
        switch ($sign) {
            case '<>':
                if ($compare > 0 || $compare < 0)
                    $filteredArray[] = $row;
                break;
            case '>':
                if ($compare > 0)
                    $filteredArray[] = $row;
                break;
            case '<':
                if ($compare < 0)
                    $filteredArray[] = $row;
                break;
            case '=';
                if ($compare == 0)
                    $filteredArray[] = $row;
                break;
        }
    }
    return $filteredArray;

}
