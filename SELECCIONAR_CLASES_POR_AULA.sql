DELIMITER $$
CREATE PROCEDURE SELECCIONAR_CLASES_POR_AULA
	(IN Edif varchar(5) = 'DEDX', 
	IN ParamAula varchar(5) = 'A001')
BEGIN
    SELECT A.Hora_Inicio, A.Hora_Fin - A.Hora_Inicio as DIFERENCIA, A.NRC, A.Clave, A.Materia, B.Hora_Inicio, B.Hora_Fin - B.Hora_Inicio as DIFERENCIA,
	B.NRC, B.Clave, B.Materia, C.Hora_Inicio, C.Hora_Fin - C.Hora_Inicio as DIFERENCIA, C.NRC, C.Clave, C.Materia, 
	D.Hora_Inicio, D.Hora_Fin - D.Hora_Inicio as DIFERENCIA, D.NRC, D.Clave, D.Materia, E.Hora_Inicio, E.Hora_Fin - E.Hora_Inicio as DIFERENCIA,
	E.NRC, E.Clave, E.Materia, F.Hora_Inicio, F.Hora_Fin - F.Hora_Inicio as DIFERENCIA, F.NRC, F.Clave, F.Materia  
	FROM 
	(SELECT * FROM Horas_Inicio) Z LEFT JOIN
	(SELECT * FROM oferta 
	WHERE Edificio LIKE '%'+Edif+'%' AND Aula LIKE '%'+ParamAula+'%'
	AND Lunes IS NOT NULL) A ON
	A.Hora_Inicio = Z.Hora LEFT JOIN
	(SELECT * FROM oferta 
	WHERE Edificio LIKE '%'+Edif+'%' AND Aula LIKE '%'+ParamAula+'%'
	AND Martes IS NOT NULL) B ON B.Hora_Inicio = Z.Hora LEFT JOIN
	(SELECT * FROM oferta 
	WHERE Edificio LIKE '%'+Edif+'%' AND Aula LIKE '%'+ParamAula+'%'
	AND Miercoles IS NOT NULL) C ON C.Hora_Inicio = Z.Hora LEFT JOIN
	(SELECT * FROM oferta 
	WHERE Edificio LIKE '%'+Edif+'%' AND Aula LIKE '%'+ParamAula+'%'
	AND Jueves IS NOT NULL) D ON D.Hora_Inicio = Z.Hora LEFT JOIN
	(SELECT * FROM oferta 
	WHERE Edificio LIKE '%'+Edif+'%' AND Aula LIKE '%'+ParamAula+'%'
	AND Viernes IS NOT NULL) E ON E.Hora_Inicio = Z.Hora LEFT JOIN
	(SELECT * FROM oferta 
	WHERE Edificio LIKE '%'+Edif+'%' AND Aula LIKE '%'+ParamAula+'%'
	AND Sabado IS NOT NULL) F ON F.Hora_Inicio = Z.Hora
	ORDER BY Z.Hora;
END$$
DELIMITER ;