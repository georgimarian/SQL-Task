<?php


/**
 * Reads options from the command line
 * @param array $longOptions
 * @return array
 */
function readOptions(array $longOptions): array
{
    $options = getopt('', $longOptions, $optInd);
    //print_r($options);
    return $options;
}

/**
 * Parses data from a CSV file
 * @param string $fileName
 * @return array|bool
 */
function readFromCSV(string $fileName)
{
    $lines  = array();
    $handle = fopen($fileName, "r");
    if ($handle) {
        //Reading table header into an array
        $keysArray = fgetcsv($handle);
        while (($line = fgetcsv($handle)) !== false) {
            //Adding data, using keys already read
            if (!validateTableData($line))
                return "Error in $fileName ";
            else
                $lines[] = array_combine($keysArray, $line);

        }
        fclose($handle);
        return $lines;
    }
    return false;
}
