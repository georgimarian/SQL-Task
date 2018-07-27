<?php

/**
 * Validates the whole Input
 * @param array $options
 * @param array $CSV
 * @return array
 */
function validateInputOptions(array $options, string $file): array
{
    $errorArray = array();
    foreach ($options as $key => $value) {
        if (!in_array($key, AVAILABLE_OPTIONS)) {
            array_push($errorArray, "$key is not set");
        }
    }
    if (!validateFrom($options[FROM])) {
        array_push($errorArray, "Invalid " . INPUT_FILE);
    }
    if (validateHelp($options)) { //Prints instructions if 'help' is found
        $help = 'help.txt';
        readfile($help);
    }
    if (!validateSortMode($options[SORT_MODE])) {
        array_push($errorArray, "Invalid sort-mode " . $options[SORT_MODE]);
    }
    if (!validateSortDirection($options[SORT_DIRECTION])) {
        array_push($errorArray, "Invalid dir ");
    }
    if (!validateSelect($options[SELECT], $file)) {
        array_push($errorArray, "Invalid select ");
    }
    if (!validateWhere(obtainWhere($options[FILTER]))) {
        array_push($errorArray, "Invalid where");
    }
    return $errorArray;

}


/**
 * Validates if a source file exists
 * @param string $input
 * @return bool
 */
function validateFrom(string $input): bool //used for data.csv
{
    return file_exists($input);
}

/**
 * Validates the help feature
 * @param array $options
 * @return bool
 */
function validateHelp(array $options): bool
{
    if (!array_key_exists(HELP, $options)) {
        return false;
    }
    return true;
}

/**
 * Checks if sort-mode is 'natural', 'alpha' or 'numeric'
 * @param string $sortMode
 * @return bool
 */
function validateSortMode(string $sortMode)
{
    return in_array($sortMode, SORT_MODES);
}

/**
 * Checks if sort-direction is 'asc' or 'desc'
 * @param string $sortDir
 * @return bool
 */
function validateSortDirection(string $sortDir)
{
    return in_array($sortDir, SORT_DIRECTIONS);
}

/**
 * Checks if given column name exists in CSV file
 * @param string $column
 * @param array $CSV
 * @return bool
 */
function validateColumnName(string $column, array $CSV): bool
{
    foreach ($CSV as $rowIndex => $row) {
        if (!array_key_exists($column, $row)) {
            return false;
        }
    }
    return true;
}

/**
 * Checks if the given columns can be selected. * means select all
 * @param string $columns
 * @param string $file
 * @return bool
 */
function validateSelect(string $columns, string $file)
{
    if($columns === '*')
        return true;
    $search = explode(",", $columns);
    $handle = fopen($file, "r");
    $data   = fgetcsv($handle);
    foreach ($search as $word) {
        if (!in_array($word, $data)) {
            return false;
        }
    }
    return true;
}

/**
 * Removes first element from an array
 * @param array $array
 * @return array
 */
function removeFirstFromArray(array $array)
{
    $arrayWithFirstRemoved = array();
    $size                  = count($array);
    $key                   = 0;
    for ($i = 1; $i < $size; $i++) {
        $arrayWithFirstRemoved[$key] = $array[$i];
        $key++;
    }
    return $arrayWithFirstRemoved;
}


