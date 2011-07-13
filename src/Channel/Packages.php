<?php
class Channel_Packages extends Packages
{
    protected $channel;

    function __construct(Channel $channel, $options)
    {
        $this->channel = $channel;

        parent::__construct($options);
    }

    function getSQL()
    {
        $sql = 'SELECT packages.* FROM packages LEFT JOIN channels ON channel_id';
        return $sql;
    }

}