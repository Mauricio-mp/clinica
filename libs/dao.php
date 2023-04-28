<?php
   //data access object

  // require_once("libs/parameters.php");

   // ------------------------

   class Conexion 
   {
    public $conn;
    function __construct()
    {
       $this->conn='';
    }
    public function connect()
    {
        try {
           $db=[
                "host"=>"172.17.0.138",
                "database" => "clinica",
                "username"=> "postgres",
                "password"=> "mp-adm1n"
                ];
          /*
                $db=[
                "host"=>"localhost",
                "database" => "permisos",
                "username"=> "postgres",
                "password"=> "db.ministerio"
                ];
 */
            $conn = new PDO("pgsql:host={$db['host']};port=5432;dbname={$db['database']}; user= {$db['username']};password={$db['password']}");
            ;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
         /*
            $sth = $conn->query('SELECT * from public.usuarios');
            $sth->execute(); 

            return $this->conn= $sth->fetchAll();
*/
                return $this->conn=$conn;
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
    }
    public function SQLServer()
    {
      try {
         $server = '172.17.0.152:1433';
         $username='sa';
         $password ='';
         $conexion= mssql_connect($server,$username,$password);
     
     if (!$conexion || !mssql_select_db('mpsiafi', $conexion)) {
       die("Error al conectar con  mpsiafi");
         
        }
        
        return $conexion;
      } catch (PDOException $exception) {
         exit($exception->getMessage());
     }
        
    }
   

   }

   


   
?>
