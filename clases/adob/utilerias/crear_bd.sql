# Servidor.....: localhost
# Base de datos: mibd
# Tabla........: 'clientes'
# 
CREATE TABLE `clientes` (
  `ID` int(11) NOT NULL auto_increment,
  `NOMBRE` varchar(100) NOT NULL default '',
  `APELLIDO1` varchar(100) NOT NULL default '',
  `APELLIDO2` varchar(100) NOT NULL default '',
  `DNI` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM; 

INSERT INTO clientes VALUES (1,'Manolo','Domínguez','Dorado','1234567');
INSERT INTO clientes VALUES (2,'José Luis','Carracedo','Pérez','3216548');
INSERT INTO clientes VALUES (3,'María José','Lorente','Millán','1597535');