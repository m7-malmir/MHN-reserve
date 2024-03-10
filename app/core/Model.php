<?php
/**
* Main class model
*/
trait Model 
{
    protected $table='users';
    protected $limit=1;
    protected $offset=0;
    use Database;
    public function where($data)
    {
        $keys=array_keys($data);
        $query="select * from $this->table where ";

        foreach ($keys as $key) {
            $query .= "$key" ." = :"."$key "." && ";
        }
        $query=trim($query," && ");
        $query .=" limit $this->limit offset $this->offset";
        //echo $query;
        return $this->query($query,$data);

    }
    public function first($data)
    {
    }


    public function insert($data)
    {
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
         
        }
        $keys = array_keys($data);
        $query = "INSERT INTO $this->table (" . implode(',', $keys) . ") VALUES (:" . implode(',:', $keys) . ")";
        $this->query($query, $data);      
    }


    public function update($id, $data, $id_column = '')
    {
    }



    public function delete( $id, $id_column = '')
    {
        $data[$id_column]=$id;
        $query="DELETE FROM $this->table WHERE $id_column=:$id_column";
       // echo $query;
        $this->query($query,$data);
         //return false;
         
    }
}