// JavaScript Ajax
//Funcion para crear el componente para trabajar con ajax
function crearInstancia(){
	XMLHttp=false;
	if(window.XMLHttpRequest){
		return new XMLHttpRequest();
	}else{
		var versiones=["Msxml2.XMLHTTP.7.0","Msxml2.XMLHTTP.6.0","Msxml2.XMLHTTP.5.0","Msxml2.XMLHTTP.4.0","Msxml2.XMLHTTP.3.0","Msxml2.XMLHTTP","Microsoft.XMLHTTP"];
		for(var i=0;i<versiones.length;i++){
			try{
				XMLHttp=new ActiveXObject(versiones[i]);
				if(XMLHttp){
					return XMLHttp;
					break;
				}
			}catch(e){};
		}
	}
}
//funcion para visualizar la informacion de acuerdo al perfil del usuario
function cargarInformacion(){
	if(XMLHttp){
		XMLHttp.abort();
		XMLHttp=crearInstancia();
		if(XMLHttp){
			var url="findeqprep.php";
			XMLHttp.open("GET",url,true);
			XMLHttp.onreadystatechange=cambiaEstado;
			XMLHttp.send(null);
		}else{
			alert('No se pudo crear la instancia');
		}		
	}
}
/*funcion para verificar y mandar directamente el listado de los equipos*/
/*Este es el listado de equipos*/
function consultas(esn,status,ot){	
	if((esn=="")||(status=="")||(ot=="")){
		alert('Este equipo aun no puede ser procesado'+'\n'+'\n'+'Intentelo mas tarde');
	}else{
		if(XMLHttp){		
			XMLHttp.abort();
			XMLHttp=crearInstancia();
			if(XMLHttp){
			var url="repeqpo.php?action=mostrar&esn="+esn+"&status="+status+"&ot="+ot;
			XMLHttp.open("GET",url,true);
			XMLHttp.onreadystatechange=cambiaEstado2;
			XMLHttp.send(null);
			}else{
				alert('No se pudo crear la instancia');
			}
		}
	}	
}
/*Esta es la funcion para la busqueda individual de los equipos*/
function busqueda(){
	/*busqueda individual de equipos*/	
	if(XMLHttp){
		XMLHttp.abort();
		XMLHttp=crearInstancia();
		/*recuperamos el valor introducido*/
		if(XMLHttp){
			var esn=document.getElementById("esn").value;		
			var url="repeqpo.php?action=busqueda&esn="+esn;
			XMLHttp.open("GET",url,true);
			XMLHttp.onreadystatechange=cambiaEstado3;
			XMLHttp.send(null);
		}else{
			alert('No se pudo crear la instancia');
		}
	}
}
/*Funcion para los filtros que se encuentran en el listado*/
function filtros(valor,usuario,nivel){
	/*filtros del formulario*/
	if(XMLHttp){
		XMLHttp.abort();
		XMLHttp=crearInstancia();
		if(XMLHttp){
		/*recuperamos el valor seleccionado*/
			var url="findeqprep.php?action=filtrar&filtro="+valor;		
			XMLHttp.open("GET",url,true);
			XMLHttp.onreadystatechange=cambiaEstado4;
			XMLHttp.send(null);
		}else{
			alert('No se pudo crear la instancia');
		}
	}
}
/*Funcion que espera la seleccion del usuario cuando se busca directamente el equipo*/
function seleccionReparacion(esn,status_rep,ot){
	if((status_rep=="")||(esn=="")||(ot=="")){
		alert('Este equipo aun no puede ser procesado'+'\n'+'\n'+'Intentelo mas tarde');
	}else{
		if(XMLHttp){
			/*recuperamos el valor seleccionado*/
			XMLHttp.abort();
			XMLHttp=crearInstancia();
			if(XMLHttp){
				var url="repeqpo.php?action=mostrar&esn="+esn+"&status="+status_rep+"&ot="+ot;
				XMLHttp.open("GET",url,true);
				XMLHttp.onreadystatechange=cambiaEstado5;
				XMLHttp.send(null);
			}else{
				alert('No se pudo crear la instancia');
			}
		}
	}	
}
function buscarEquipo(){
	var esn=prompt("Introduzca el ESN del equipo a buscar", "");
	XMLHttp=crearInstancia();
	if(XMLHttp){
		var url="repeqpo.php?action=busqueda&esn="+esn;
		XMLHttp.open("GET",url,true);
		XMLHttp.onreadystatechange=cambiaEstado6;
		XMLHttp.send(null);
	}else{
		alert('No se pudo crear la instancia');
	}
}
function creaObjeto(){
	XMLHttp=crearInstancia();
}
function cambiaEstado(){
	if(XMLHttp.readyState==4){
		document.getElementById("texto").innerHTML="<strong>"+XMLHttp.responseText+"</strong>"
	}else{
		document.getElementById("texto").innerHTML="<br /><br /><br /><table width='400' border='1' cellpadding='1' cellspacing='0' bordercolor='#990000' align='center'><tr><td bgcolor='#FFFFCC' width='244' align='center'><div align='center'><b>Espere un momento. Cargando...</b><img src='../img/indicator.gif' /></div></td></tr></table>"
	}
}
function cambiaEstado2(){
	if(XMLHttp.readyState==4){
		document.getElementById("texto").innerHTML="<strong>"+XMLHttp.responseText+"</strong>"
	}else{
		document.getElementById("texto").innerHTML="<br /><br /><br /><table width='400' border='1' cellpadding='1' cellspacing='0' bordercolor='#990000' align='center'><tr><td bgcolor='#FFFFCC' width='244' align='center'><div align='center'><b>Espere un momento. Cargando...</b><img src='../img/indicator.gif' /></div></td></tr></table>"
	}
}
function cambiaEstado3(){
	if(XMLHttp.readyState==4){
		document.getElementById("texto").innerHTML="<strong>"+XMLHttp.responseText+"</strong>"
	}else{
		document.getElementById("texto").innerHTML="<br /><br /><br /><table width='400' border='1' cellpadding='1' cellspacing='0' bordercolor='#990000' align='center'><tr><td bgcolor='#FFFFCC' width='244' align='center'><div align='center'><b>Espere un momento. Cargando...</b><img src='../img/indicator.gif' /></div></td></tr></table>"
	}
}
function cambiaEstado4(){
	if(XMLHttp.readyState==4){
		document.getElementById("texto").innerHTML="<strong>"+XMLHttp.responseText+"</strong>"
	}else{
		document.getElementById("texto").innerHTML="<br /><br /><br /><table width='400' border='1' cellpadding='1' cellspacing='0' bordercolor='#990000' align='center'><tr><td bgcolor='#FFFFCC' width='244' align='center'><div align='center'><b>Espere un momento. Cargando...</b><img src='../img/indicator.gif' /></div></td></tr></table>"
	}
}
function cambiaEstado5(){
	if(XMLHttp.readyState==4){
		document.getElementById("texto").innerHTML="<strong>"+XMLHttp.responseText+"</strong>"
	}else{
		document.getElementById("texto").innerHTML="<br /><br /><br /><table width='400' border='1' cellpadding='1' cellspacing='0' bordercolor='#990000' align='center'><tr><td bgcolor='#FFFFCC' width='244' align='center'><div align='center'><b>Espere un momento. Cargando...</b><img src='../img/indicator.gif' /></div></td></tr></table>"
	}
}
function cambiaEstado6(){
	if(XMLHttp.readyState==4){
		document.getElementById("texto").innerHTML="<strong>"+XMLHttp.responseText+"</strong>"
	}else{
		document.getElementById("texto").innerHTML="<br /><br /><br /><table width='400' border='1' cellpadding='1' cellspacing='0' bordercolor='#990000' align='center'><tr><td bgcolor='#FFFFCC' width='244' align='center'><div align='center'><b>Espere un momento. Cargando...</b><img src='../img/indicator.gif' /></div></td></tr></table>"
	}
}