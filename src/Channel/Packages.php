<?php
class Channel_Packages extends Packages
{
	public $options = array('offset' => 0,
                            'limit'  => -1);

	function __construct(Channel $channel, $options)
	{
        $this->options = $options + $this->options;
        $records = array();
        $mysqli = Record::getDB();
        $sql = 'SELECT packages.* FROM packages LEFT JOIN channels ON channel_id';
        if ($result = $mysqli->query($sql)) {
            $records = $result->fetch_all(MYSQL_ASSOC);
        }
        parent::__construct(new ArrayIterator($records), $this->options['offset'], $this->options['limit']);
    }

}