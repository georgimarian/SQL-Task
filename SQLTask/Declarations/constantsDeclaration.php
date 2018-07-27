<?php


const AGGREGATE               = 'aggregate';
const HELP                    = 'help';
const INPUT_FILE              = 'input-file';
const SELECT                  = 'select';
const FROM                    = 'from';
const OUTPUT                  = 'output';
const OUTPUT_FILE             = 'output-file';
const SORT_COLUMN             = 'sort-column';
const SORT_MODE               = 'sort-mode';
const SORT_DIRECTION          = 'sort-direction';
const SORT_MULTIPLE           = 'multi-sort';
const SORT_MULTIPLE_DIRECTION = 'multi-sort-dir';
const UNIQUE                  = 'unique';
const FILTER                  = 'where';
const AGGREGATE_SUM           = 'aggregate-sum';
const AGGREGATE_PRODUCT       = 'aggregate-product';
const AGGREGATE_LIST          = 'aggregate-list';
const AGGREGATE_LIST_GLUE     = 'aggregate-list-glue';
const UPPERCASE               = 'uppercase-column';
const LOWERCASE               = 'lowercase-column';
const TITLECASE               = 'titlecase-column';
const POWER_VALUES            = 'power-values';
const MAP_FUNCTION            = 'map-function';
const MAP_FUNCTION_COLUMN     = 'map-function-column';
const COLUMN_SORT             = 'column-sort';
const NATURAL                 = 'natural';
const ALPHA                   = 'alpha';
const NUMERIC                 = 'numeric';
const ASCENDANT               = 'asc';
const DESCENDANT              = 'desc';
const LONG_OPTIONS            = array(HELP, INPUT_FILE . ":", SELECT . ":", FROM . ":", OUTPUT . ":", OUTPUT_FILE . ":", SORT_COLUMN . ":",
    SORT_MODE . ":", SORT_DIRECTION . ":", SORT_MULTIPLE . ":", SORT_MULTIPLE_DIRECTION . ":", UNIQUE . ":", FILTER . ":",
    AGGREGATE_LIST . ":", AGGREGATE_LIST_GLUE . ":", AGGREGATE_PRODUCT . ":", AGGREGATE_SUM . ":", MAP_FUNCTION . ":", MAP_FUNCTION_COLUMN . ":",
    COLUMN_SORT . ":", UPPERCASE . ":", LOWERCASE . ":", TITLECASE . ":", POWER_VALUES . ":", AGGREGATE . ":");
const AVAILABLE_OPTIONS       = array(HELP, INPUT_FILE, SELECT, FROM, OUTPUT, OUTPUT_FILE, SORT_COLUMN, SORT_MODE, SORT_DIRECTION, SORT_MULTIPLE,
    SORT_MULTIPLE_DIRECTION, UNIQUE, FILTER, AGGREGATE_LIST, AGGREGATE_LIST_GLUE, AGGREGATE_PRODUCT, AGGREGATE_SUM, MAP_FUNCTION, MAP_FUNCTION_COLUMN,
    COLUMN_SORT, UPPERCASE, LOWERCASE, TITLECASE, POWER_VALUES, AGGREGATE);
const DEPENDENCY              = array(SORT_MULTIPLE => SORT_MULTIPLE_DIRECTION, AGGREGATE_LIST => AGGREGATE_LIST_GLUE);
const SORT_MODES              = array(NATURAL, ALPHA, NUMERIC);
const SORT_DIRECTIONS         = array(ASCENDANT, DESCENDANT);