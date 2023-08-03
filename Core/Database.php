<?php

namespace Core;

use PDO;

class Database{
    public $connection;
    public $statement;

    public function __construct($config, $username = 'root', $password = ''){   // web/o2mRm734%
        $dsn = 'mysql:' . http_build_query($config, '', ';');

        $this->connection = new PDO($dsn, $username, $password, [
           PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
    public function query($query, $params = []){
        $this->statement = $this->connection->prepare($query);

        $this->statement->execute($params);

        return $this;
    }
    public function insert($table, $data){
        $fields = array_keys($data);
        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            $table,
            implode(', ', $fields),
            ':' . implode(', :', $fields)
        );

        $this->query($sql, $data);

        return $this;
    }
    public function updateID($table, $id, $data){
        $data['id'] = $id;
        $fields = array_keys($data);
        $update_fields = [];    
        foreach ($fields as $field) {
            $update_fields[] = $field . '=:' . $field;
        }

        // Crear sentencia SQL
        $sql = sprintf(
            'UPDATE %s SET %s WHERE id=:id',
            $table,
            implode(', ', $update_fields)
        );

        $this->query($sql, $data);
        return $this;
    }

    public function update($table, $data)
    {
        $fields = array_keys($data);
        $update_fields = [];
        foreach ($fields as $field) {
            $update_fields[] = $field . '=:' . $field; // para cada campo se agrega el formato "campo=:campo" al array
        }
        // crear sentencia SQL
        $sql = sprintf(
            'UPDATE %s SET %s WHERE %s', 
            $table,
            implode(', ', $update_fields),
            implode(' AND ', array_map(fn($field) => "$field=:$field", $fields))
        );
        $this->query($sql, $data); // Pasamos el array $data que contiene los valores
        return $this;
    }

    public function get(){
        return $this->statement->fetchAll();
    }
    public function find(){
        return $this->statement->fetch();
    }
    public function findOrFail(){
        $result = $this->find();

        if (! $result) {
            abort();
        }

        return $result;
    }
}