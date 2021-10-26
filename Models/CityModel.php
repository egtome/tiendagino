<?php
/**
 * Description of Cities Model
 *
 * @author gino
 */
class CityModel extends Model { 
    private $tableName = 'cities';

    public function getAll(): array
    {
        $sql = "SELECT * FROM {$this->tableName} ORDER BY name DESC;";

        return $this->getQuery($sql);
    }
}
