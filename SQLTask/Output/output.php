<?php

/**
 * Outputs data on screen in JSON format
 * @param array $table
 */
function outputOnScreen(array $table)
{
    //TODO aranjare
    echo PHP_EOL;
   // echo json_encode($table);
    foreach ($table as $key => $line) {
        echo json_encode($line) . PHP_EOL;
    }
    echo PHP_EOL;
}

/**
 * Outputs data to CSV file
 * @param string $fileName
 * @param array $table
 */
function outputInFile(string $fileName, array $table)
{
    $filePointer = fopen($fileName, "w");
    $keys        = array_keys($table[0]);
    fputcsv($filePointer, $keys);
    foreach ($table as $fields) {
        fputcsv($filePointer, $fields);
    }
    fclose($filePointer);
}

/**
 * Selects where to output the result
 * @param array $options
 * @param array $data
 */
function outputSelection(array $options, array $data)
{
    $output = $options[OUTPUT];
    if ($output === 'screen') {
        outputOnScreen($data);
    } else {
        outputInFile($options[OUTPUT_FILE], $data);
    }
}