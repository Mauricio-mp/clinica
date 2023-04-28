<div class="row ">
    <div class="col-md-12">
        
        <div class="card">
           
            <!-- FIN TABS-->
            
            <div class="card-header"><h3>Busqueda</h3></div>
            <div class="card-body" >
               <form method="POST" action="index.php?page=generar&op=insert"> 
                <div class="row">
                  
                    {{if dias}}
                    <div class="col-sm-12">
                        
                        <input type="checkbox" id="Habiles" class="js-switch" checked/><span>&nbsp; Dias Habiles</span>
                       
                        
                    </div>
                    {{endif dias}}
                    <br></br><br></br>
                    <div class="col-md-6">
                        
                            <div class="form-group">
                                <label for="">Motivo</label>
                                <select class="form-control select2" id="CbxMotivo">
                                    {{foreach Motivo}}
                                    <option value="{{id_motivos}}">{{descripcion}}</option>
                                    {{endfor Motivo}}
                                </select>
                            </div>
                      
                    </div>
                    {{if dias}}
                    <div class="col-md-6">
                        
                            <div class="form-group">
                                <label for="">Fecha Inicial</label>
                                <input type="date" value="{{FechaInicial}}" class="form-control datetimepicker-input" id="FechaInicio" >
                            </div>
                        
                    </div>
                    <div class="col-md-6">
                        
                            <div class="form-group">
                                <label for="">Fecha Final</label>
                                <input type="date" value="{{FechaFinal}}" class="form-control datetimepicker-input" id="FechaFin" >
                            </div>
                       
                    </div>
                    {{endif dias}}
                    
                    {{if Hora}}
                    <div class="col-md-6">
                        
                            <div class="form-group">
                                <label for="">Ingrese Fecha</label>
                                <input type="text" placeholder="Ingrese Fecha" class="form-control datetimepicker-input" id="datepicker" data-toggle="datetimepicker" data-target="#datepicker">
                            </div>
                        
                    </div>
                    <div class="col-md-6">
                        
                            <div class="form-group">
                                <label for="">Hora Inicio</label>
                                <input type="text" value="08:00 AM"  class="form-control datetimepicker-input" id="timepickerNew1" >
                            </div>
                       
                    </div>  
                    <div class="col-md-6">
                        
                            <div class="form-group">
                                <label for="">Hora Fin</label>
                                <input type="text" value="04:00 PM" class="form-control datetimepicker-input" id="timepickerNew2" >
                            </div>
                        
                    </div>
                    {{endif Hora}}
                   
    
                    <div class="col-md-6">
                        
                        <div class="form-group">
                            <label for="exampleTextarea1">Observacion</label>
                            <textarea class="form-control" id="Observacion" rows="4"></textarea>
                        </div>
                    
                </div>

                </div>
                    <!-- FIN DE DIV DE BUSQUEDA-->
                    <!-- FIN tabla -->
                    <button type="button" class="btn btn-primary mr-2" onclick="GuardarPermiso('{{TipoOpcion}}','{{id}}','{{Codigo}}','{{name}}')" >Guardar</button>
                    <button class="btn btn-light">Cancelar</button>
                    
                </form>
            </div>
        
            
        </div>
    </div>
    <script src="views/ViewJs/Ingreso.js"></script>
</div>