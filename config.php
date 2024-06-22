<?php 
class Database{
    private $host;
    private $username ;
    private $password ;
    private $dbname ;
    private $conn;
    public function __construct($host = "localhost", $username = "root", $password ="", $dbname ="data"){
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }
//! PHP 5+
//! Hàm kết nói vs database
    public function connect(){
        if(!$this->conn){
            $this->conn = mysqli_connect($this->host, $this->username, $this->password);
            if($this->conn){
                $result =  mysqli_select_db($this->conn, $this->dbname);
                if(!$result) return false;
            }
            else false; 
        }
        return true;
    }
//! ngăt kết nối database
    public function disconnect(){
        if($this->conn){
            if(mysqli_close($this->conn)) {
                $this->conn = false;
                return true;
            }
            else return false;
            
        }
        return true;
    }

 public function insert($table,$values,$row = null){
    if(mysqli_num_rows(mysqli_query($this->conn,"SHOW TABLES LIKE '$table'")) == 0) return false;
    $insert = "INSERT INTO " .$table;

    if( $row != null ){
     $insert = $insert." (".$row." )";
    }

    for( $i = 0; $i <count($values);$i++){
      
        $values[$i] = mysqli_real_escape_string($this->conn,$values[$i]);
        if(is_string($values[$i])){
            $values[$i] = "'".$values[$i]."'";
        }
    }
        
        $values = implode(',', $values);
    
        $insert .= ' VALUES ('.$values.')';
       
        $ins = mysqli_query($this->conn,$insert);
        
      
        return $ins !== false ? mysqli_insert_id($this->conn) : false;
    
 }
 public function Remove($table,$where = null){
   
    if(mysqli_num_rows(mysqli_query($this->conn,"SHOW TABLES LIKE '$table'")) == 0) return false;
    $delete = 'DELETE FROM ';
    if ($where == null) {
        $delete = $delete.$table; 
    } else {
        $delete = $delete.$table.' WHERE '.$where; 
    }
    $del = mysqli_query($this->conn, $delete);
    return $del !== false ? true : false;
}

 public function Update($table, $rows, $where = null){
    if(mysqli_num_rows(mysqli_query($this->conn,"SHOW TABLES LIKE '$table'")) == 0) return false;
    $update = "UPDATE " . $table . " SET ";
    $keys = array_keys($rows);
   
    $setValues = [];
        foreach ($keys as $key) {
            $value = $rows[$key];
            $setValues[] = "`$key` = '" . mysqli_real_escape_string($this->conn, $value) . "'";
        }
        $update .= implode(', ', $setValues);
        $update .= ' WHERE ' . $where;
        $up = mysqli_query($this->conn, $update);
        return $up !== false ? true : false;
 }  
 public function select($Name = null,$table =null,$row = array("*"),$where = null,$order = null){
    $row_oop = $row;
    $row = implode(",",$row);
    
    $query = "SELECT " .$row ." FROM ".$table;
    if($where){
        $query = $query." Where " . $where;
    }
    if($order){
        $query = $query ." ORDER BY ".$order;
        }
    
    if(mysqli_num_rows(mysqli_query($this->conn,"SHOW TABLES LIKE '$table'")) == 0){ 
       
            return false;
        }
    $request = mysqli_query($this->conn, $query);
   
    if(!$request) {
       
        return false;
    }
   
    $result = [];
    while($product = mysqli_fetch_assoc($request)){
       
        $params = [];
        foreach ($row_oop as $col) {
            $params[] = $product[$col];
        }
        $result[] = new $Name(...$params);
     }
     
    return $result;
}

}
?>
