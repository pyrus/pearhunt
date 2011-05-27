<?php
class PackageSearch extends Packages
{
    public $options = array('offset' => 0,
                            'limit'  => -1);

    function __construct($options)
    {
        $this->options = $options + $this->options;
        $records = array();
        $mysqli = Record::getDB();
        $sql = 'SELECT packages.* FROM packages WHERE name LIKE "%'.$mysqli->escape_string($options['q']).'%" OR description LIKE "%'.$mysqli->escape_string($options['q']).'%"';
        if ($result = $mysqli->query($sql)) {
            $records = $result->fetch_all(MYSQL_ASSOC);
        }
        parent::__construct(new ArrayIterator($records), $this->options['offset'], $this->options['limit']);
    }
}