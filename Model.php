<?php

require_once 'Conexion.php';

abstract class Model extends Conexion
{
    protected $table;

    protected $resul;

    protected $url;
    protected $primaryKey;

    public $itemsForPage = 10;

    public function all()
    {
        $data = $this->pdo->prepare("SELECT * FROM {$this->table}");
        if ($data->execute()) {
            if ($data->rowCount() > 1) {
                $this->result = $data->fetchAll(PDO::FETCH_OBJ);
                return $this->result;
            } else {
                $this->result = $data->fetch(PDO::FETCH_OBJ);
                return $this->result;
            }
        }
    }

    public function find($id)
    {
        $data = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = {$id}");
        if ($data->execute()) {
            return $data->fetch(PDO::FETCH_OBJ);
        }
        return false;
    }

    public function destroy($id)
    {
        $data = $this->pdo->prepare("DELETE FROM {$this->table} WHERE {$this->primaryKey} = {$id}");
        if ($data->execute()) {
            return true;
        }
        return false;
    }

    public function create($fields)
    {
        $sql_parts = [];
        $attributes = [];

        foreach ($fields as $k => $v) {
            $sql_parts[] = "$k = ?";
            $attributes[] = $v;
        }

        $sql_parts = implode(',', $sql_parts);

        $data = $this->pdo->prepare("INSERT INTO {$this->table} SET {$sql_parts}");
        
        return $data->execute($attributes); 
    }

    public function update (array $fields, $id)
    {
        $sql_parts = [];
        $attributes = [];

        foreach ($fields as $k => $v) {
            $sql_parts[] = "$k = ?";
            $attributes[] = $v;
        }
        $sql_parts = implode(',', $sql_parts);

        $data = $this->pdo->prepare("UPDATE {$this->table} SET {$sql_parts} WHERE {$this->primaryKey} = {$id}");
        
        return $data->execute($attributes); 
    }

    public function paginationRender($currentPage, $search)
    {
        if ( $this->totalPages($search) > 1 ) {

            if ($currentPage !== $this->totalPages($search)){
                if (($currentPage - 1) > 0 ) {
                    echo "<a href='{$this->url}".($currentPage - 1)."&search={$search}'>".($currentPage - 1)."</a>";
                }
                echo $currentPage;

                if (($currentPage + 1) <= $this->totalPages($search) ) {
                    echo "<a href='{$this->url}".($currentPage + 1)."&search={$search}'>".($currentPage + 1)."</a>";
                }
            
            }
        }
    }

    public function paginateItems($currentPage, $search)
    {   
        $i = ($this->itemsForPage * $currentPage) - $this->itemsForPage;
        $result = $this->pdo->query("SELECT * FROM {$this->table} WHERE nombreAuxiliar LIKE '%{$search}%' LIMIT {$i}, 10");
        $items = $result->fetchAll(PDO::FETCH_OBJ);
        return $items;
    }

    private function totalItems($search)
    {
        $query = $this->pdo->query("SELECT COUNT(*) AS total FROM {$this->table} WHERE nombreAuxiliar LIKE '%{$search}%'", PDO::FETCH_OBJ);
        $result = $query->fetch();
        return $result->total;
    }

    private function totalPages($search)
    {
        return ceil($this->totalItems($search)/$this->itemsForPage);
    }

}