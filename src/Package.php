<?php
/**
 * Simple Active Record implementation for pearhunt
 * 
 * PHP version 5
 * 
 * @category  Utilities
 * @package   pearhunt
 * @author    Brett Bieber <brett.bieber@gmail.com>
 * @copyright 2011 Brett Bieber
 * @license   http://www1.unl.edu/wdn/wiki/Software_License BSD License
 * @link      http://pear2.php.net/
 */

/**
 * Simple active record implementation for pearhunt.
 * 
 * PHP version 5
 * 
 * @category  Utilities
 * @package   pearhunt
 * @author    Brett Bieber <brett.bieber@gmail.com>
 * @copyright 2011 Brett Bieber
 * @license   http://www1.unl.edu/wdn/wiki/Software_License BSD License
 * @link      http://pear2.php.net/
 */
class Package extends Record
{
    public $id;
    public $channel_id;
    public $name;
    public $description;

    /**
     * The table where packages are 'hosted'
     *
     * @return string
     */
    public function getTable()
    {
        return 'packages';
    }

    /**
     * @param Channel
     * @param string
     *
     * @return mixed Package or false
     * @uses   parent::getDB()
     */
    public static function getByChannelAndName(Channel $channel, $name)
    {
        $mysqli = self::getDB();

        $sql  = 'SELECT * FROM packages WHERE channel_id = ';
        $sql .= (int)$channel->id;
        $sql .= ' AND name = "' . $mysqli->escape_string($name) . '";';

        if (($result = $mysqli->query($sql))
            && $result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $object = new self();
            $object->synchronizeWithArray($data);
            if (isset($data['channel'])) {
                $object->channel = $data['channel'];
            }
            return $object;
        }
        return false;
    }

    function __get($var)
    {
        if ($var == 'channel') {
            $channel = Channel::getById($this->channel_id);
            $this->channel = $channel->name;
            return $this->channel;
        }
    }
}
