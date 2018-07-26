<?php

/**
 * Select on which condition to aggregate
 * @param string $condition
 * @param string $columnName
 * @param array $table
 * @return array
 */
function aggregateAfterCondition(string $condition, string $columnName, array $table, array $options)
{
    $returnArray = array();
    switch ($condition) {
        case 'sum':
            {
                $value                    = aggregateSum($table, $columnName);
                $returnArray[]            = $table[0];
                $returnArray[0]['newSum'] = $value;
            }
            break;
        case 'product':
            {
                $value                     = aggregateProduct($table, $columnName);
                $returnArray[]             = $table[0];
                $returnArray[0]['newProd'] = $value;
            }
            break;
        case 'list':
            {
                aggregateList($table, $columnName, $options);
            }
            break;
    }
    return $returnArray;
}

/**
 * Aggregate columns for sum
 * @param array $table
 * @param string $column
 * @return int
 */
function aggregateSum(array $table, string $column): int
{
    $sum = 0;
    foreach ($table as $row) {
        foreach ($row as $key => $word)
            if ($key === $column)
                $sum += $word;
    }
    return $sum;
}

/**
 * Aggregate columns for product
 * @param array $table
 * @param string $column
 * @return int
 */
function aggregateProduct(array $table, string $column): int
{
    $product = 1;
    foreach ($table as $row) {
        foreach ($row as $key => $word)
            if ($key === $column)
                $product *= $word;
    }
    return $product;
}

/**
 * Aggregate columns for list
 * @param array $table
 * @param string $column
 * @param string $glue
 * @return array
 */
function aggregateList(array $table, string $column, string $glue, string $options): array
{
    $glue                  = $options[AGGREGATE_LIST_GLUE];
    $initialValue          = $table[0];
    $initialValue[$column] = '';
    $glued                 = array_reduce($table, getAggregateList($glue, $column), $initialValue);
    $glued[$column]        = substr($glued[$column], 1);
    return $glued;
}

/**
 * Prepare word list for aggregate-list
 * @param string $glue
 * @param string $column
 * @return Closure
 */
function getAggregateList(string $glue, string $column)
{
    return function (array $row1, array $row2) use ($glue, $column) {
        $row1[$column] = $row1[$column] . $glue . $row2[$column];
        return $row1;
    };
}

/**
 * Figures out on which criterion to aggregate
 * @param array $options
 * @return bool|mixed
 */
function getAggregate(array $options): string
{
    if (isset($options[AGGREGATE_SUM]))
        $aggregation = $options[AGGREGATE_SUM];
    else if (isset($options[AGGREGATE_PRODUCT])) {
        $aggregation = $options[AGGREGATE_PRODUCT];
    } else {
        $aggregation = $options[AGGREGATE_LIST];
    }
    return $aggregation;
}