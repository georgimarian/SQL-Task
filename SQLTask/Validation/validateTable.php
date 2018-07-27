<?php
/**
 * Created by PhpStorm.
 * User: georgianamarian
 * Date: 24.07.2018
 * Time: 14:34
 */
function validateTableData(array $table): bool
{
    foreach ($table as $row => $line) {
        if ($line == null)
            return false;
        if (count($table) !== 3)
            return false;
    }
    return true;
}
