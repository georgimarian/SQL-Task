<?php

require_once './Parsing/reading.php';
require_once './Validation/validateInput.php';
require_once './Validation/validateTable.php';
require_once './Output/output.php';
require_once './DataTransformation/sort.php';
require_once './DataTransformation/function.php';
require_once './Data Reducing/filter.php';
require_once './Aggregation/aggregate.php';
require_once './DataTransformation/case.php';
require_once './Output/select.php';
require_once './Declarations/constantsDeclaration.php';


//Get options and table data
$options = readOptions(LONG_OPTIONS);
$file    = $options[FROM];
$CSV     = readFromCSV($file);

//Either print errors or get things done
if (!empty(validateInputOptions($options, $file))) {
    print_r(validateInputOptions($options, $file));
} else {
    //Select
    $selectedColumns = selectColumns($CSV, $options[SELECT]);
    //Where
    if (isset($options[FILTER])) {
        $selectedColumns = filterWhere($selectedColumns, $options[FILTER]);
    }
    //Unique
    if (isset($options[UNIQUE])) {
        $selectedColumns = uniqueInTable($options[UNIQUE], $selectedColumns);
    }
    //Sort one column
    if (isset($options[SORT_COLUMN])) {
        $selectedColumns = sortColumn($options[SORT_COLUMN], $options[SORT_MODE], $options[SORT_DIRECTION], $selectedColumns);
    }
    //Sort multiple columns
    if (isset($options[SORT_MULTIPLE])) {
        $cols            = explode(",", $options[SORT_MULTIPLE]);
        $dir             = explode(",", $options[SORT_MULTIPLE_DIRECTION]);
        $selectedColumns = multiSortArray($cols, $dir, $selectedColumns);
    }
    //Aggregate
    if (isset($options[AGGREGATE])) {
        $selectedColumns = aggregateAfterCondition($options[AGGREGATE], getAggregate($options), $selectedColumns, $options);
    }
    //Sort for output
    if (isset($options[COLUMN_SORT])) {
        $selectedColumns = sortColumnsToOutput($selectedColumns);
    }
    //Display
    outputSelection($options, $selectedColumns);
}





