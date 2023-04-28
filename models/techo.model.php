<?php 
session_start();
ob_start();
  require_once("libs/dao.php");

class Datos
{
  public $cantidad;
  public $Descripcion;


    public function __construct($cantidad,$Descripcion)
    {
        $this->cantidad=$cantidad;
        $this->Descripcion=$Descripcion;
        $this->cod='';
    }
    public function Guardar()
    { 
      try{
         //code...
         $dbConn= connect();
         $sql = $dbConn->prepare("INSERT INTO public.tb_techo
         (cantidad, descripcion, fecha_creacion, usuario_creacion, estado)
         VALUES(:cantidad,:descripcion,current_timestamp,:usuario,:estado)");
         
             
              $sql->execute(["cantidad"=>$this->cantidad,"descripcion"=>$this->Descripcion,"usuario"=>"akak","estado"=>true]); 
         
             return ($sql) ? true: $sql->getMessage();
          
     } catch (PDOException $e){
         return $e->getMessage();
       }
    }
   
    
    public function map($id_techo,$cantidad,$descripcion,$fecha_creacion,$estado){
      $clase= ($estado)? "<td class=\"badge badge-success mb-1\">Activo</td>" :"<td class=\"badge badge-danger mb-1\">Inactivo</td>";
      return $arrayName = array('id_techo' =>$id_techo,
      'cantidad' =>$cantidad,
      'descripcion' =>$descripcion,
      'fecha_creacion' =>$fecha_creacion,
      'estado' =>$estado,
      'clase'=>$clase );
    }

    public function getDatos()
    {
       

        try {
            //code...
            $dbConn= connect();
            $sql = $dbConn->prepare("SELECT id_techo,cantidad,descripcion,fecha_creacion,estado FROM public.tb_techo order by fecha_creacion desc ");
            
                
                 $sql->execute(); 
            
                $sql->setFetchMode(PDO::FETCH_ASSOC);
               
                //$filas=$sql->fetchAll();
                return  $sql->fetchAll(PDO::FETCH_FUNC, array($this,'map'));
               // return $filas;
        } catch (PDOException $e){
            return $e->getMessage();
          }
    }

    public function CambiarEstados(){
      try {
         //code...
         $dbConn= connect();
         $sql = $dbConn->prepare("UPDATE public.tb_techo SET estado=false");
         
             
              $sql->execute(); 
         
      
        
              return ($sql) ? true: $sql->getMessage();
      } catch (PDOException $e) {
        return $e->getMessage();
      }
    }

    public function ActalizarFormula($obntecho){

      
        $dbConn= connect();
        for ($i=1; $i <13 ; $i++) { 
          # code...
        
     
        $anio=date('Y');
        $inicio=date('Y-m-01',strtotime($anio.'-'.$i.'-11'."- 3 month"));
        $fin=date('Y-m-t',strtotime($inicio."+ 2 month"));
        $timezone = new DateTimeZone('America/Tegucigalpa');

        $start = new DateTime($inicio,$timezone);
        $end = new DateTime($fin,$timezone);
        
        //de lo contrario, se excluye la fecha de finalización (¿error?)
        $end->modify('+1 day');
    
        $interval = $end->diff($start);
    
        // total dias
        $days = $interval->days;
    
        // crea un período de fecha iterable (P1D equivale a 1 día)
        $period = new DatePeriod($start, new DateInterval('P1D'), $end);
    
        // almacenado como matriz, por lo que puede agregar más de una fecha feriada
        $holidays = array('');
        
    
       $num1= ($obntecho->cantidad*3);
       
       $num2= substr($num1,0,-2);

      $number= number_format((($num1)/$days*0.66),2);



        
        $sql = $dbConn->prepare("UPDATE public.tb_formula_calculo SET pagarihss=:numbero,meses_anteriores=:meses WHERE id_mes=:id");
        $sql->execute(["id"=>$i,"numbero"=>$number,"meses"=>$days]); 
      
        $sql=true;
      
      }
      return ($sql) ? true : $sql->getMessage();
    }

    public function ActualizarFormula()
    { 
      try{
         //code...
         $dbConn= connect();
         $sql = $dbConn->prepare("SELECT * from public.tb_techo tt where estado=true");
         $sql->execute(); 
         $obntecho=$sql->fetch(PDO::FETCH_OBJ);
         $msj=$this->ActalizarFormula($obntecho);




         
             return ($sql) ? $msj : $sql->getMessage();

          
     } catch (PDOException $e){
         return $e->getMessage();
       }
    }

    
}



?>