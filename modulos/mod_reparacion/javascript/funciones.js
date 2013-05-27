// JavaScript Document
var anterior;
var win1;
var n;
function abreVentana(n){
    win1= window.open("catdiag.php?n="+n+"","Catalogo","width=400,height=300,scrollbars=yes,top=50,left=600") 
    win1.focus()
}
function abreVentanaRefaccion(n,m){
	var mod=m
	win1= window.open("catrefac.php?n="+n+"&m="+mod+"","Catalogo","width=400,height=300,scrollbars=yes,top=50,left=600") 
    win1.focus()
}
function abreReparacionEfectuada(n,m){
	var mod=m
	win1= window.open("catrepefec.php?n="+n+"&m="+mod+"","Catalogo","width=400,height=300,scrollbars=yes,top=50,left=600") 
    win1.focus()
}
function confirmar(){
	var evalua;
	var texto=document.frm.status.options[document.frm.status.selectedIndex].value;
	var diagnostico=document.frm.ds1.value;
	var diagclave=document.frm.cl1.value;
	var refaccion=document.frm.rds1.value;
	var refacclave=document.frm.rcl1.value;
	var reparacion=document.frm.reds1.value;
	var repclave=document.frm.recl1.value;
	/*recuperacion del modelo*/
	var modelo=document.frm.modelo.value;
	/*modificaciones*/
	//var rec=verificaObservaciones(modelo);
	rec=true;
	if(rec==true){
		if(texto=='DIAG'){
		alert('Asegurese de cambiar el status de la reparación');
		return false;
		}
		else if((diagnostico=="")||(diagclave=="")||(refaccion=="")||(refacclave=="")||(reparacion=="")||(repclave=="")){
			alert('Error: Verifique que los datos de Diagnostico, Refacciones Utilizadas y Reparacion Efectuada'+'\n'+'\n'+'No tengan espacios en blanco');
			return false;
		}
		else{
			/*fin de este proceso*/
			var texto1=new Array();
			texto1[0]="La reparación se guardara con el status:"
			texto1[1]="Presione el botón Aceptar para guardar la reparación."
			texto1[2]="Presione el botón Cancelar para realizar cambios a la actual reparación."
	
			if(confirm(texto1[0]+'\n'+'\n'+texto+'\n'+'\n'+texto1[1]+'\n'+texto1[2])){
				return true;
				//return false;
			}else{
				return false
			}
		}
	}else{
		return false;
	}
}
function verificaObservaciones(modelo){
	var observaciones=document.frm.observaciones.value;
	if(document.frm.chk1.checked){
		if(observaciones==""){
			alert('Selecciono la opción de SIM dañada'+'\n'+'\n'+'Escriba los detalles en el campo observaciones')
			return false;
		}else{
			return true;
		}
	}else{
		return true;
	}
}
function borrarContenido(campo1,campo2){
	document.getElementById(campo1).value="";
	document.getElementById(campo2).value="";
}
function mostrarAdvertencia(){
	if(document.frm.chk1.checked){
		alert('No olvide anotar comentarios en el campo observaciones.');
	}else{
		alert('Ha quitado la selección que indica que la SIM esta dañada'+'\n'+'Si se equivoco vuelva a seleccionar esta opción');
	}
}