// JavaScript Document
function ajaxApp(divDestino,url,parametros,metodo){	
	$.ajax({
	async:true,
	type: metodo,
	dataType: "html",
	contentType: "application/x-www-form-urlencoded",
	url:url,
	data:parametros,
	beforeSend:function(){ 
		$("#"+divDestino).show().html("Cargando..."); 
	},
	success:function(datos){ 		
		$("#"+divDestino).show().html(datos);		
	},
	timeout:90000000,
	error:function() { $("#"+divDestino).show().html('<center>Error: El servidor no responde. <br>Por favor intente mas tarde. </center>'); }
	});
}
function verificaTeclaImeiEmpaque(evento){
	if(evento.which==13){		
		//se valida la longitud de la cadena capturada
		var imei=document.getElementById("txtImeiEmpaque").value;
		if(imei.length < 15){
			$("#erroresCaptura").html("");
			$("#erroresCaptura").append("Error: verifique que haya introducido en el Imei la informacion correcta.");
			
		}else{
			document.getElementById("txtSimEmpaque").focus();
		}
		
	}
}
function cerrarVentana(div){
	$("#"+div).hide();
}
function registrarEquipo(){
	ajaxApp("detalleEmpaque","regeqpo.php","action=nuevo","GET");
}
function asignarEquipo(){
	ajaxApp("detalleEmpaque","asignaeqpo.php","action=asignarEquipos","POST");
}
function listarAsignaciones(){
	ajaxApp("detalleEmpaque","asignaeqpo.php","action=listarAsignaciones","POST");
}