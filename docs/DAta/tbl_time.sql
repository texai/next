SELECT * FROM DMARTSYS.TIEMPO o100185;

Otra forma:


SELECT  o100185.FECHA as E100186,o100185.DIA as E100187,o100185.NOMBREDIA as E100188,o100185.DIAUTIL as E100189,o100185.SEMANA as E100190,o100185.DIASUTILESSEMANA as E100191,o100185.MES as E100192,o100185.DIASUTILESMES as E100194,o100185.TRIMESTRE as E100195,o100185.DIASUTILESTRIMESTRE as E100196,o100185.ANIO as E100197,o100185.DIASUTILESANIO as E100198,o100185.NOMBREMES as E122046,as116031_100188_OLD as as116031_100188_OLD
 FROM DMARTSYS.TIEMPO o100185,
     ( SELECT o100185.NOMBREDIA AS as116031_100188_OLD_2, MAX((DECODE(TO_CHAR(o100185.FECHA,'D'),'1','7','2','1','3','2','4','3','5','4','6','5','7','6',''))) AS as116031_100188_OLD FROM DMARTSYS.TIEMPO o100185  GROUP BY o100185.NOMBREDIA)
 WHERE ( (o100185.NOMBREDIA = as116031_100188_OLD_2(+)));