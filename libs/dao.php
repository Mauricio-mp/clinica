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
       $this->connVam='';
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
    public function PDOConnect(){
      $contraseña = "";
      $usuario = "sa";
      $nombreBaseDeDatos = "mpsiafi";
      # Puede ser 127.0.0.1 o el nombre de tu equipo; o la IP de un servidor remoto
      $rutaServidor = "172.17.0.162";
      $puerto = "1433";
      try {
          $base_de_datos = new PDO("dblib:host=$rutaServidor;port=$puerto;dbname=$nombreBaseDeDatos", $usuario, $contraseña);
  
          $base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

           return $this->connVam=$base_de_datos;
      } catch (Exception $e) {
          return "Ocurrió un error con la base de datos: " . $e->getMessage();
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
