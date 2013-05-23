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
	valores[0]=document.form1.cap.options[document.form1.cap.selectedIndex].value;
	valores[1]=document.getElementById("fnextel").value;
	valores[2]=document.getElementById("esn").value;
	valores[3]=document.getElementById("imei").value;
	valores[4]=document.form1.modelo.options[document.form1.modelo.selectedIndex].value;
	valores[5]=document.form1.process.options[document.form1.process.selectedIndex].value;
	valores[6]=document.getElementById("recibe").value;
	valores[7]=document.form1.diagnostico1.options[document.form1.diagnostico1.selectedIndex].value;
	valores[8]=document.form1.diagnostico2.options[document.form1.diagnostico2.selectedIndex].value;	
	valores[9]=document.getElementById("obs").value;
	
	evalua=valida(valores);
	if(evalua){
		if(confirm('Datos Introducidos en la captura:'+'\n'+'\n'+'CAP Origen: '+valores[0]+'\n'+'Folio Nextel: '+valores[1]+'\n'+'ESN: '+valores[2]+'\n'+'IMEI: '+valores[3]+'\n'+'Modelo: '+valores[4]+'\n'+'Proceso: '+valores[5]+'\n'+'Recibe: '+valores[6]+'\n'+'Diagnostico 1: '+valores[7]+'\n'+'Diagnostico 2: '+valores[8]+'\n'+'Observaciones: '+valores[9]+'\n'+'\n'+'¿Los Datos son correctos?'+'\n'+'\n'+'Presione Aceptar para guardar o Cancelar para corregir algun dato'+'\n')){
			/*este if es en caso de equipos blackberry*/
			/******************************************************************************/
			/******************informacion de la sim y de equipos blackberry***************/
			/******************************************************************************/
				if(valores[4]=="BB7100i"){
					valores[10]=document.getElementById("sim").value;
					//informacion de la bateria
					if(document.form1.bateria.checked){
						valores[11]=document.form1.bateria.value;
					}else{
						valores[11]="Sin Bateria";
					}
					//informacion de la tapa
					if(document.form1.tapa.checked){
						valores[12]=document.form1.tapa.value;
					}else{
						valores[12]="Sin Tapa";
					}
					/*añadir confirm*/
					if(confirm('¿La Información sobre el equipo Blackberry es correcta?:'+'\n'+'\n'+'Sim introducida: '+valores[10]+'\n'+'Bateria: '+valores[11]+'\n'+'Tapa: '+valores[12])){
						return true;
					}else{
						return false;
					}				
				}else{
					return true;
				}//fin if BB7100i
			/*******************************************************************************/
			/*******************************************************************************/
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