SELECT O100185.ANIO, O101448.TIPOITEM, O101448.CODIGOORACLE, O101448.MODELOITEM, O101448.SUBTIPOITEM, O111036.SUBALMACEN, O111036.CONDICIONALMACEN, O111036.UBICACIONFISICA, O111084.MOTIVOTRANSACCIONINVENTARIO, O111084.MOTIVOLOGISTICA, ( DECODE(SIGN(O111083.ITEMS),1,'2.Ingresos',-1,'3.Salidas') ), O100185.NOMBREMES, SUM(O111083.ITEMS)
FROM DMARTSYS.TIEMPO O100185, DMARTSYS.ITEM O101448, DMARTSYS.ALMACENEQUIPOS O111036, DMARTSYS.INVENTARIOTRANSACCIONES O111083, DMARTSYS.MOTIVOTRANSACCIONINVENTARIO O111084
WHERE ( ( O111036.CODIGOSUBALMACEN = O111083.CODIGOSUBALMACEN ) AND ( O101448.CODIGOITEM = O111083.CODIGOITEM ) AND ( O111084.CODIGOMOTIVOTRANSACCIONINV = O111083.CODIGOMOTIVOTRANSACCIONINV ) AND ( O100185.FECHA = O111083.FECHA ) )  AND ( O111084.MOTIVOTRANSACCIONINVENTARIO NOT IN ('300.Transferencia','301.Rechazo Transferencia','Transf. a otros almacenes','Transf. de otros almacenes','Transferencia de ALM','Transferencia de Inventario Ingreso','Transferencia de Inventario Salida','00. Stock Inicial','17.Reemplazo de Equipo') ) AND ( O100185.ANIO IN (( 2011 )) ) AND ( O100185.NOMBREMES IN (( 'Noviembre' )) )
GROUP BY O100185.ANIO, O101448.TIPOITEM, O101448.CODIGOORACLE, O101448.MODELOITEM, O101448.SUBTIPOITEM, O111036.SUBALMACEN, O111036.CONDICIONALMACEN, O111036.UBICACIONFISICA, O111084.MOTIVOTRANSACCIONINVENTARIO, O111084.MOTIVOLOGISTICA, ( DECODE(SIGN(O111083.ITEMS),1,'2.Ingresos',-1,'3.Salidas') ), O100185.NOMBREMES
;