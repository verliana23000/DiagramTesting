<?php

/** --------------------------- ALL Preprocessing Method ------------------------------ */

/* Method untuk memotong string activity name berdasarkan activity state */
function preprocessingNameActivity($parameter)
{
    $result = str_replace('"', '', trim($parameter, "\t     (object ActivityStateView "));
    $result = str_replace('@', '', trim($result));
    $result = str_replace('$', '', trim($result));
    return $result;
}

/* Method untuk memotong string activity name berdasarkan decision state */
function preprocessingNameDecision($parameter)
{
    $result = str_replace('"', '', trim($parameter, "\t     (object DecisionView "));
    $result = str_replace('@', '', trim($result));
    $result = str_replace('$', '', trim($result));
    return $result;
}

/* Method untuk memotong string activity name berdasarkan Start state & End state */
function preprocessingNameStartEnd($parameter)
{
    $result = str_replace('"', '', trim($parameter, "\t     (object StateView "));
    $result = preg_replace('/StartState/', '', $result);
    $result = preg_replace('/EndState/', '', $result);
    $result = str_replace('@', '', trim($result));
    $result = str_replace('$', '', trim($result));
    return $result;
}

/* Method untuk memotong string activity state berdasarkan Start state & End state */
function preprocessingStateStartEnd($parameter)
{
    $result = str_replace('"', '', trim($parameter, "\t     (object StateView "));
    $result = str_replace('@', '', trim($result));
    $result = str_replace('$', '', trim($result));
    $result = preg_replace('/UNNAMED/i', '', $result);
    $result = preg_replace('/[0-9]+/', '', $result);
    $result = str_replace(' ', '', trim($result));
    return $result;
}

/* Method untuk memotong string id */
function preprocessingID($parameter)
{
    $id = substr($parameter, -2);
    $id = str_replace(' ', '', trim($id, " \n"));
    $id = intval($id);
    return $id;
}

/* Method finalisasi string activity name */
function preprocessingNameFinal($parameter)
{
    return preg_replace('/[0-9]+/', '', $parameter);
}

/* Method untuk menyajikan array tanpa dependency */
function returningArrayWithoutDependency($activity_state, $activity_name, $id)
{
    return array(
        "State" => $activity_state,
        "Activity Name" => $activity_name,
        "ID" => $id,
        "Dependency" => "",
    );
}

/* Method untuk memotong string dependency */
function preprocessingDependency($parameter)
{
    $result = str_replace('"', '', trim($parameter, "\t     client\t@ \n"));
    $result = trim($result, " \n");
    $result = intval(str_replace('\n', '', trim($result)));
    return $result;
}

/* Method untuk memotong string supplier sebagai pembanding terhadap ID */
function preprocessingSupplier($parameter)
{
    $result = str_replace('"', '', trim($parameter, "\t     supplier\t@ \n"));
    return $result;
}

/** --------------------------- END ALL Preprocessing Method ------------------------------ */