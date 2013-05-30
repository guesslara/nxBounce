// JavaScript Document
var contadorGrid=0;
var contadorTxt=0;

function ajaxApp(divDestino,url,parametros,metodo){	
	$.ajax({
	async:true,
	type: metodo,
	dataType: "html",
	contentType: "application/x-www-form-urlencoded",
	url:url,
	data:parametros,
	beforeSend:function(){ 
		$("#cargadorGeneral").show(); 
	},
	success:function(datos){ 
		$("#cargadorGeneral").hide();
		$("#"+divDestino).show().html(datos);		
	},
	timeout:90000000,
	error:function() { $("#"+divDestino).show().html('<center>Error: El servidor no responde. <br>Por favor intente mas tarde. </center>'); }
	});
}
function verificaTeclaImeiEmpaque(evento){
	if(evento.which==13){		
		//registrarDatos();
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
function verificaTeclaSimEmpaque(evento){
	if(evento.which==13){
		//try{
			/*
			var imei=document.getElementById("txtImeiEmpaque").value;
			var sim=document.getElementById("txtSimEmpaque").value;
			var id_empaque=document.getElementById("idEmpaqueCaptura").value;
			var id_caja=document.getElementById("txtIdCaja").value;
			parametros="action=guardaItemsEmpaque&imei="+imei+"&sim="+sim+"&id_caja="+id_caja+"&id_empaque="+id_empaque;
			alert(parametros);
			//se envian a la base de datos
			ajaxApp("erroresCaptura","controladorEnsamble.php","action=guardaItemsEmpaque&imei="+imei+"&sim="+sim+"&id_caja="+id_caja+"&id_empaque="+id_empaque,"POST");
			*/
			registrarDatos();
		//}catch(e){ alert("Error Aplicacion: Datos nulos");}
	}
}
function armarGridCaptura(imei,sim){
	contadorTxt+=1;
	//$("#div_grid").append("<br><input type='text' size='2' value='"+contadorTxt+"' /><input type='text' id='"+idCode+"' value='"+bdCode+"' size='60' /><input type='text' id='"+idImei+"' value='"+imei+"' /><input type='text' id='"+idSerial+"' value='"+serial+"' />");
	/*$("#capturados").html("");
	$("#capturados").html("<p style='font-size:14px;'>Equipos: "+contadorTxt+"</p>");
	$("#div_grid_ensamble").append("<div style='float:left;width:10px;background:#CCC;border:1px solid #CCC;height:15px;padding:4px;'>&nbsp;</div><div style='float:left;width:200px; height:15px;border:1px solid #CCC;background:#FFF;padding:4px;'>"+imei+"</div><div style='float:left;width:200px;height:15px;border:1px solid #CCC;background:#FFF;padding:4px;'>"+sim+"</div><div style='clear:both;'></div>");
	*/
	limpiaCajas();
}
function listarEquiposReparar(idUsuario){
	if(idUsuario==""){
		alert("Su sesion finalizo, entrar de nueva cuenta al Sistema.");
		window.location.href="../mod_login/index.php";
	}
	ajaxApp("detalleEmpaque","controlador.php","action=listarEquipos&idUsuario="+idUsuario,"POST");
	mostrarEquiposReparacion(idUsuario);
}
function mostrarEquiposReparacion(idUsuario){	
	filtro=$("#filtro").val();
	if(filtro==null || filtro==undefined){
		filtro="todos";
	}	
	ajaxApp("listadoEquiposReparacion","controlador.php","action=mostrarEquiposAReparar&idUsuario="+idUsuario+"&filtro="+filtro+"&imei=N/A","POST");
}
function buscarImei(evento,idUsuario){
	//alert(evento);
	if(evento.which==13){	
		texto=$("#esn").val();
		if(texto.length<15){
			alert("Verifique el Imei");
		}else{			
			ajaxApp("listadoEquiposReparacion","controlador.php","action=mostrarEquiposAReparar&idUsuario="+idUsuario+"&filtro=todos&imei="+texto,"POST");
		}
		$("#esn").attr("value","");
	}	
}
function cerrarVentana(div){
	$("#transparenciaGeneral1").hide();
}
function mostrarVentanaReparacion(serial,status,ot){
	$("#transparenciaGeneral1").show();
	parametros="action=mostrar&esn="+serial+"&status="+status+"&ot="+ot;
	ajaxApp("divReparaciones","repeqpo.php",parametros,"GET");
}