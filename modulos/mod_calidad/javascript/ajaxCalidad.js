// documento ajax calidad
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
function listarRadiosCC(usuario,filtro,esn){
	XMLHttp=crearInstancia();
	if(XMLHttp){
		if(filtro=="buscar"){
			esn=document.getElementById("esn").value;
		}
		var url="funcionesCalidad.php?action=listarRadiosCCalidad&user="+usuario+"&filtro="+filtro+"&esn="+esn;
		//alert(url);
		XMLHttp.open("GET",url,true);
		if((filtro=="todos")||(filtro=="buscar")){
			XMLHttp.onreadystatechange=cambiaEstado1
		}else if(filtro=="NOK"){
			XMLHttp.onreadystatechange=cambiaEstado2
		}else if(filtro=="PDC"){
			XMLHttp.onreadystatechange=cambiaEstado3
		}		
		XMLHttp.send(null);
	}else{
		alert('No se pudo crear la instancia');
	}
}
function Pagina(nropagina,usuario,filtro,esn){
	XMLHttp=crearInstancia();
	if(XMLHttp){
		var url="funcionesCalidad.php?action=listarRadiosCCalidad&pag="+nropagina+"&user="+usuario+"&filtro="+filtro+"&esn="+esn;		
		//alert(url);
		XMLHttp.open("POST",url,true);
		XMLHttp.onreadystatechange=cambiaEstado1
		XMLHttp.send(null);
	}else{
		alert('No se pudo crear la instancia');
	}	
}
function cambiaEstado1(){
	if(XMLHttp.readyState==4){
		document.getElementById("listado").innerHTML=XMLHttp.responseText
	}else{
		document.getElementById("listado").innerHTML="<br /><br /><br /><div align='center'><strong>Espere un momento. Cargando...</strong></div>"
	}	
}
function cambiaEstado2(){
	if(XMLHttp.readyState==4){
		document.getElementById("listadoNOK").innerHTML=XMLHttp.responseText
	}else{
		document.getElementById("listadoNOK").innerHTML="<br /><br /><br /><div align='center'><strong>Espere un momento. Cargando...</strong></div>"
	}	
}
function cambiaEstado3(){
	if(XMLHttp.readyState==4){
		document.getElementById("listadoPDC").innerHTML=XMLHttp.responseText
	}else{
		document.getElementById("listadoPDC").innerHTML="<br /><br /><br /><div align='center'><strong>Espere un momento. Cargando...</strong></div>"
	}	
}