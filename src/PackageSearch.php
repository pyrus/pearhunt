<?php
class PackageSearch extends Packages
{
    function getSQL()
    {
        $mysqli = Record::getDB();
        $sql = 'SELECT packages.* FROM packages';
        if (isset($this->options['q']) && !empty($this->options['q'])) {
            $sql .= ' WHERE name LIKE "%';
            $sql .= $mysqli->escape_string($this->options['q']);
            $sql .= '%" OR description LIKE "%';
            $sql .= $mysqli->escape_string($this->options['q']);
            $sql .= '%"';
        }
        return $sql;
    }
}
