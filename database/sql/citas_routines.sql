-- PROCEDIMIENTOS
DROP PROCEDURE IF EXISTS RegistrarUsuario;
CREATE PROCEDURE RegistrarUsuario(
  IN pNombre VARCHAR(255),
  IN pEmail VARCHAR(255),
  IN pPassword VARCHAR(255),
  IN pFechaNac DATE,
  IN pTelefono VARCHAR(255),
  IN pEnfermedades TEXT
)
BEGIN
  INSERT INTO users(name,email,password,fecha_nac,telefono,enfermedades)
  VALUES(pNombre,pEmail,pPassword,pFechaNac,pTelefono,pEnfermedades);
END;

DROP PROCEDURE IF EXISTS AgendarCita;
CREATE PROCEDURE AgendarCita(
  IN pPacienteID INT,
  IN pFecha DATE,
  IN pHora TIME,
  IN pMotivo TEXT
)
BEGIN
  INSERT INTO citas(paciente_id,fecha,hora,motivo)
  VALUES(pPacienteID,pFecha,pHora,pMotivo);
END;

-- (y así con los demás: CancelarCita, VerCitasPorPaciente, EliminarCita)

-- FUNCIONES
DROP FUNCTION IF EXISTS CalcularEdad;
CREATE FUNCTION CalcularEdad(pFechaNacimiento DATE) 
  RETURNS INT DETERMINISTIC
BEGIN
  RETURN TIMESTAMPDIFF(YEAR,pFechaNacimiento,CURDATE());
END;

-- (y así con ContarCitasPorPaciente, CitaOcupada, ExisteCitaPorSlot)

-- TRIGGERS
DROP TRIGGER IF EXISTS Trg_PrevenirDobleCita;
CREATE TRIGGER Trg_PrevenirDobleCita
BEFORE INSERT ON citas
FOR EACH ROW
BEGIN
  IF ExisteCitaPorSlot(NEW.slot_id) THEN
    SIGNAL SQLSTATE '45000' 
      SET MESSAGE_TEXT = 'Error: slot ya ocupado';
  END IF;
END;

DROP TRIGGER IF EXISTS Trg_MarcarSlotNoDisp;
CREATE TRIGGER Trg_MarcarSlotNoDisp
AFTER INSERT ON citas
FOR EACH ROW
BEGIN
  UPDATE slots SET disponible = 0 WHERE id = NEW.slot_id;
END;

DROP TRIGGER IF EXISTS Trg_LiberarSlot;
CREATE TRIGGER Trg_LiberarSlot
AFTER UPDATE ON citas
FOR EACH ROW
BEGIN
  IF NEW.estado = 'cancelada' THEN
    UPDATE slots SET disponible = 1 WHERE id = OLD.slot_id;
  END IF;
END;
