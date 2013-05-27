<?php
    if($_POST["action"]=="listarCapturas"){
        listarCapturas();
    }
    
    function listarCapturas(){
        $sql="SELECT * FROM equiposrep ORDER BY fecharec DESC";
        $res=mysql_query($sql,conectarBd());
        if(mysql_num_rows($res)==0){
            echo "Sin Registros que mostrar";
        }else{
?>
            <style type="text/css">
                .estiloResultados{height: 15px;padding: 5px;border-bottom: 1px solid #CCC;text-align: center;}
                .estiloResultados:hover{background: #e1e1e1;}
            </style>
            <table border="0" cellpadding="1" cellspacing="1" width="800" style="font-size: 10px;margin: 10px;">
                <tr>
                    <td style="height: 15px;padding: 5px;border:1px solid #ccc;background: #F0F0F0;text-align: center;font-weight: bold;">Id</td>
                    <td style="height: 15px;padding: 5px;border:1px solid #ccc;background: #F0F0F0;text-align: center;font-weight: bold;">Imei</td>
                    <td style="height: 15px;padding: 5px;border:1px solid #ccc;background: #F0F0F0;text-align: center;font-weight: bold;">Serie</td>
                    <td style="height: 15px;padding: 5px;border:1px solid #ccc;background: #F0F0F0;text-align: center;font-weight: bold;"># Guia</td>
                    <td style="height: 15px;padding: 5px;border:1px solid #ccc;background: #F0F0F0;text-align: center;font-weight: bold;">F. de Recibo</td>
                </tr>
<?
            while($row=mysql_fetch_array($res)){
?>
                <tr class="estiloResultados">
                    <td style="height: 15px;padding: 5px;border-bottom: 1px solid #CCC;"><?=$row["id"];?></td>
                    <td style="height: 15px;padding: 5px;border-bottom: 1px solid #CCC;"><?=$row["imei"];?></td>
                    <td style="height: 15px;padding: 5px;border-bottom: 1px solid #CCC;"><?=$row["esn"];?></td>
                    <td style="height: 15px;padding: 5px;border-bottom: 1px solid #CCC;"><?=$row["fnextel"];?></td>
                    <td style="height: 15px;padding: 5px;border-bottom: 1px solid #CCC;"><?=$row["fecharec"];?></td>
                </tr>
<?
            }
?>
            </table>
<?
        }
    }
    
    function conectarBd(){
        require("../../includes/config.inc.php");
        $link=mysql_connect($host,$usuario,$pass);
        if($link==false){
            echo "Error en la conexion a la base de datos";
        }else{
            mysql_select_db($db);
            return $link;
        }				
    }
?>