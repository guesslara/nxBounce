// funcion que devuelve el indice del combo seleccionado
function arreglo(){
	var indice=this.document.form1.cap.selectedIndex;
	this.document.form1.cap.options[indice].value=indice;
	return true;
}
//esta fucnion mostrara al usuario un mensaje con los datos introducidos
function mensaje(){
	var valores=new Array();
	var i=0;
	var evalua;
//	document.form1.registrar.disabled=true;	
	valores[0]=$("#cap").val();
	valores[1]=$("#fnextel").val();
	valores[2]=$("#esn").val();
	valores[3]=$("#imei").val();
	valores[4]=$("#modelo").val();
	valores[5]=$("#process").val();
	valores[6]=$("#recibe").val();
	valores[7]=$("#diagnostico1").val();
	valores[8]=$("#diagnostico2").val();
	valores[9]=$("#obs").val();
	
	evalua=valida(valores);
	if(evalua){
		if(confirm('Datos Introducidos en la captura:'+'\n'+'\n'+'CAP Origen: '+valores[0]+'\n'+'Numero de Guia: '+valores[1]+'\n'+'ESN: '+valores[2]+'\n'+'IMEI: '+valores[3]+'\n'+'Modelo: '+valores[4]+'\n'+'Proceso: '+valores[5]+'\n'+'Recibe: '+valores[6]+'\n'+'Diagnostico 1: '+valores[7]+'\n'+'Diagnostico 2: '+valores[8]+'\n'+'Observaciones: '+valores[9]+'\n'+'\n'+'Los Datos son correctos?'+'\n'+'\n'+'Presione Aceptar para guardar o Cancelar para corregir algun dato'+'\n')){
			parametros="action=guardarEquipo&cap="+valores[0]+"&guia="+valores[1]+"&serie="+valores[2]+"&imei="+valores[3]+"&modelo="+valores[4]+"&proceso="+valores[5]+"&recibe="+valores[6]+"&diagnostico1="+valores[7]+"&diagnostico2="+valores[8]+"&obs="+valores[9];
			ajaxApp("divResultadoInsercion","guardarEquipo.php",parametros,"POST");
		}else{
			return false;
		}//if del confirm
	}else{
		return false;
	}//cierra primer if de evalua
}
//funcion para validar que algunos campos no esten vacios
//y que algunos solo reciban numeros
function valida(valores1){
	//alert('funcion valida');
	for(i=0;i<=7;i++){
		if(valores1[i]==""){
			alert('No dejes ningun espacio en blanco');
			return false;
			break;
		}
	}
	
	if(isNaN(valores1[1])||(isNaN(valores1[3]))){
		alert('Verifique que en los campos Folio Nextel, o IMEI sean numeros');
		return false;
		//break;
	}
	
	return true;
}
function CambioC(id,tipod)
{
	switch(tipod)
	{
	case 'L':
		/* Campo Alfanumérico */
		document.getElementById(id).className='campoal';
		break;
	default:
		alert("El parámetro recibido para ACTIVAR el campo no está definido.");		
	}
}
//Esta funcion restablece el control en las cajas de texto
function RestableceC(id,tipod)
{
	switch(tipod)
	{
	case 'OL':
		/* Campo Obligatorio Alfanumérico*/
				document.getElementById(id).className='campov';
			break;
	default:
		alert("El parámetro recibido para DESACTIVAR el campo no está definido.");
	}
}
function verificaTecla(evento,idElemento){
	if(evento.which==13){
		//alert("Sig");		
		if(idElemento=="fnextel"){
			$("#imei").focus();
		}else if(idElemento=="imei"){
			$("#esn").focus();
		}else if(idElemento=="esn"){
			$("#cap").focus();
		}
	}
}