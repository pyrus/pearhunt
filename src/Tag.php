<?php
class Tag extends Record
{
    public $package_id;
    public $name;

    public function getTable()
    {
        return 'tags';
    }

    public function keys()
    {
        return array('package_name', 'name');
    }
}