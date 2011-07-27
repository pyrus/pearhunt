<?php
class PackageSearch extends Packages
{
    function getSQL()
    {
        $mysqli = Record::getDB();
        $sql = 'SELECT channels.name as channel, packages.* FROM packages
        INNER JOIN channels ON channels.id = packages.channel_id
        ';
        if (isset($this->options['q']) && !empty($this->options['q'])) {
            $sql .= ' WHERE packages.name LIKE "%';
            $sql .= $mysqli->escape_string($this->options['q']);
            $sql .= '%" OR packages.description LIKE "%';
            $sql .= $mysqli->escape_string($this->options['q']);
            $sql .= '%"';
        }
        return $sql;
    }
}
