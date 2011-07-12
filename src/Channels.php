<?php
/**
 * Channel object for pearhunt
 * 
 * PHP version 5
 * 
 * @category  Utilities
 * @package   pearhunt
 * @author    Till Klampaeckel <till@php.net>
 * @copyright 2011 Till Klampaeckel
 * @license   http://www1.unl.edu/wdn/wiki/Software_License BSD License
 * @link      http://pear2.php.net/
 */

/**
 * Channel object for pearhunt.
 * 
 * PHP version 5
 * 
 * @category  Utilities
 * @package   pearhunt
 * @author    Till Klampaeckel <till@php.net>
 * @copyright 2011 Till Klampaeckel
 * @license   http://www1.unl.edu/wdn/wiki/Software_License BSD License
 * @link      http://pear2.php.net/
 */
class Channels extends LimitIterator
{
    public $options = array('offset' => 0,
                            'limit'  => -1);

    /**
     * __construct
     *
     * @param array $options
     *
     * @return $this
     * @uses   Record::getDB()
     */
    public function __construct($options)
    {
        $this->options = $options + $this->options;

        $mysqli = Record::getDB();

        $sql = 'SELECT * FROM channels';

        $records = array();
        if ($result = $mysqli->query($sql)) {
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $records[] = $row;
                }
                $result->free();
            }
        }
        parent::__construct(new ArrayIterator($records), $this->options['offset'], $this->options['limit']);
    }
}
