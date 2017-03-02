USE [Horario2017SIIAU]
GO

/****** Object:  StoredProcedure [dbo].[LOGON]    Script Date: 14/02/2017 11:44:12 a. m. ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[LOGON]
@usuario as varchar(50),
@password as varchar(20)
AS
BEGIN
	SET NOCOUNT ON;

    SELECT [rol] FROM [usuarios]
	WHERE [usuario] = @usuario AND [contrasenia] = @password AND [estatus] = 'A'
END

GO

