<?php
abstract class DBResultIterator extends LimitIterator implements Countable
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

        parent::__construct($this->getIterator(), $this->options['offset'], $this->options['limit']);
    }

    /**
     * Get the list of items to iterate over
     *
     * @return Iterator
     */
    protected function getIterator()
    {
        $mysqli = Record::getDB();
        
        $records = array();
        if ($result = $mysqli->query($this->getSQL())) {
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $records[] = $row;
                }
                $result->free();
            }
        }
        
        if (count($records) == 0) {
            return new EmptyIterator();
        }

        return new ArrayIterator($records);

    }

    /**
     * Get the SQL for the Database result
     * @return string
     */
    abstract function getSQL();

    /**
     * Return the count of all items
     *
     * @see Countable::count()
     */
    function count()
    {
        $iterator = $this->getInnerIterator();
        if ($iterator instanceof EmptyIterator) {
            return 0;
        }

        return count($this->getInnerIterator());
    }
}