<?php

function createReferenceHSBC($code, $year, $month, $day, $amount, $constant)
{

//Referencia Alfanumérica
    $R = $code;

//Rutina de cálculo

    $YEAR = ($year - 2014) * 372;
    $MONTH = ($month - 1) * 31;
    $DAY = $day - 1;

    $F = (string)($YEAR + $MONTH + $DAY);

    if (strlen($F) < 4) {
        $FAULTS = 4 - strlen($F);
        for ($i = 0; $i < $FAULTS; $i++) {
            $F = '0' . $F;
        }
    }

//Rutina de condensación de monto a pagar
    $COST = $amount;
    $MULTIPLIERS_COST = array(7, 3, 1, 7, 3, 1, 7, 3, 1, 7, 3, 1, 7);

//Array Invert
    $INVERTCOST = strrev($COST);

    $M = 0;

    for ($i = 0; $i < strlen($INVERTCOST); $i++) {
        $M += strval($INVERTCOST[$i]) * $MULTIPLIERS_COST[$i];
    }

    $M = (string)(($M) % 10);

//Constante
    $C = $constant;

//Dígitos Verificadores
    $BEFORE = $R . $F . $M . $C;

    $MULTIPLIERS_DV = array(11, 13, 17, 19, 23, 11, 13, 17, 19, 23, 11, 13, 17, 19, 23, 11, 13, 17, 19, 23);

//Array Invert
    $AFTER = strrev($BEFORE);

    $DV = 0;

    for ($i = 0; $i < strlen($AFTER); $i++) {
        $DV += strval($AFTER[$i]) * $MULTIPLIERS_DV[$i];
    }

    $DV = (string)((($DV) % 97) + 1);

    if (strlen($DV) < 2) {
        $FAULTS = 2 - strlen($DV);
        for ($i = 0; $i < $FAULTS; $i++) {
            $DV = '0' . $DV;
        }
    }

    $FINAL = $R . $F . $M . $C . $DV;

    return $FINAL;

}

?>
