<?php

/**
 * Returns the likes by the $id.
 *
 * @param mysqli $db
 * @param mixed $id
 * @return array
 */
function likesGetById($db, $id)
{
    $id = mysqli_real_escape_string($db, $id);
    $query = "SELECT f.* FROM followers f WHERE f.id_user = '" . $id . "'";

    $res = mysqli_query($db, $query);

    $output = [];

    while ($row = mysqli_fetch_assoc($res)) {
        $output[] = $row;
    }

    return $output;
}
