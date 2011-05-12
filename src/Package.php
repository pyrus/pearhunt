<?php
class Package extends Record
{
	public $id;
	public $channel_id;
	public $name;
	public $description;

	public function getTable()
	{
		return 'packages';
	}

    public static function getByChannelAndName($channel, $name)
    {
        $mysqli = self::getDB();
        $sql = 'SELECT * FROM packages WHERE channel_id = '.(int)$channel->id.' AND name = "'.$mysqli->escape_string($name).'";';
        if (($result = $mysqli->query($sql))
            && $result->num_rows > 0) {
            $object = new self();
            $object->synchronizeWithArray($result->fetch_assoc());
            return $object;
        }
        return false;
    }
}