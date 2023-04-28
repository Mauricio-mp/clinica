<div class="kt-portlet">
	<div class="kt-portlet__head">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">
				Ingreso de Incapacidad
			</h3>
		</div>
	</div>
	<!--begin::Form-->
	<div id="myDIV"></div>
	<form class="kt-form kt-form--fit kt-form--label-right" id="FormBuscarIncapacidad" method="POSt" action="index.php?page=reporte&op=BuscarIncapacidad&id={{id}}">
		
		<div class="kt-portlet__body">
			
			
           
			<div class="form-group row">
				<label class="col-lg-2 col-form-label">Seleccione rango de fecha</label>
				<div class="col-lg-3">
					<div class="kt-input-icon">
						<input type="text" class="form-control" id="kt_daterangepicker_1" name="rango" readonly placeholder="Select time"/>
						<!-- <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-map-marker"></i></span></span> -->
					</div>
					<!-- <span class="form-text text-muted">Please enter your address</span> -->
				</div>
				
				
				
			</div>	    
		
			  <div class="kt-portlet__foot kt-portlet__foot--fit-x">
				<div class="kt-form__actions">
					<div class="row">
						<div class="col-lg-4"></div>
						<div class="col-lg-3">
							<button style="padding-inline:105px;" type="submit" id="btnAceptar" class="btn btn-primary">Buscar Lotes</button>
						</div>
					</div>
				</div>
			</div>

			<div class="kt-portlet__head kt-portlet__head--lg">
				<div class="kt-portlet__head-label">
				
				</div>
				<div class="kt-portlet__head-toolbar">
						<div class="kt-portlet__head-wrapper">
			  <div class="kt-portlet__head-actions">
				<div class="dropdown dropdown-inline">
				  <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="la la-download"></i> Exportar   
				  </button>
				  <div class="dropdown-menu dropdown-menu-right">
					<ul class="kt-nav">
					  
					  <li class="kt-nav__item">
						<a href="javascript:MyFunction('{{fechainicio}}','{{fechafin}}');" class="kt-nav__link">
						  <i class="kt-nav__link-icon la la-file-pdf-o"></i>
						  <span class="kt-nav__link-text">PDF</span>
						</a>
					  </li>
					</ul>
				  </div>
				</div>
				&nbsp;
				
			  </div>  
			</div>    </div>
			  </div>
			 

			<table class="table table-striped- table-bordered table-hover table-checkable" id="pruebas_tabla">
				<thead>
				  <tr>
					<th>nombre_completo</th>
					<th>Certificado</th>
						  <th>Codigo Patronal</th>
						  
				
						  <th>dias</th>
						  <th>Total</th>
						 
					</tr>
				 </thead>
	  
			  <tbody>
				{{foreach Mostrar}}
			  <tr>
						<th>{{nombre_completo}}</th>
						  <td>{{certificado}}</td>
						  <td>{{codigo_patronal}}</td>
						
						  <td>{{dias}}</td>
				
						  <td nowrap>{{total}}</td>
					</tr>
			  {{endfor Mostrar}}
				
				  
			  </tbody>
	  
		</table>

			<!--
			<div class="form-group row">
				<label class="col-lg-2 col-form-label">Group:</label>
				<div class="col-lg-3">
					<div class="kt-radio-inline">
						<label class="kt-radio kt-radio--solid">
							<input type="radio" name="example_2" checked value="2"> Sales Person
							<span></span>
						</label>
						<label class="kt-radio kt-radio--solid">
							<input type="radio" name="example_2" value="2"> Customer
							<span></span>
						</label>
					</div>
					 <span class="form-text text-muted">Please select user group</span> 
				</div>
			</div>	  
		-->
		<div style="text-align: right;">
			<span>L.<h1 id="labeltotal"></h1></span>
		</div>
		
		</div>
		
	</form>

	<!--end::Form-->
	<script src="views/ViewJs/reporte.js"></script>
</div>