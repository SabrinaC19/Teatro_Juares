CREATE SCHEMA IF NOT EXISTS `Teatro_JuaresBD` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `Teatro_JuaresBD` ;

-- -----------------------------------------------------
-- Table `Teatro_JuaresBD`.`tblClientes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Teatro_JuaresBD`.`tblClientes` (
  `cedulaCliente` VARCHAR(15) NOT NULL ,
  `nombreCliente` VARCHAR(100) NOT NULL ,
  `apellidoCliente` VARCHAR(100) NOT NULL ,
  `correo` VARCHAR(120) NOT NULL ,
  `nroTelefono` VARCHAR(11) NULL ,
  PRIMARY KEY (`cedulaCliente`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Teatro_JuaresBD`.`tblCitasReservacion`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Teatro_JuaresBD`.`tblCitasReservacion` (
  `nroCita` INT(11) AUTO_INCREMENT NOT NULL ,
  `nombreEvento` VARCHAR(100) NOT NULL ,
  `fechaCita` DATE NOT NULL ,
  `horaCita` TIME NOT NULL ,
  `servicio` VARCHAR(60) NOT NULL ,
  `espacio` VARCHAR(60) NOT NULL ,
  `descripcionEvento` VARCHAR(160) NOT NULL ,
  `razonSocial` VARCHAR(160) NULL ,
  `correoContacto` VARCHAR(120) NOT NULL ,
  `tlfContacto` VARCHAR(11) NULL ,
  `cartaSolicitud` TEXT NOT NULL ,
  `tipoCita` INT NOT NULL ,
  `estadoCita` INT NOT NULL,
  `cedCliente` VARCHAR(15) NOT NULL ,
  PRIMARY KEY (`nroCita`) ,
  INDEX `FK_CitasClientes_idx` (`cedCliente` ASC) ,
  CONSTRAINT `FK_CitasClientes`
    FOREIGN KEY (`cedCliente` )
    REFERENCES `Teatro_JuaresBD`.`tblClientes` (`cedulaCliente` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Teatro_JuaresBD`.`tblBanco`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Teatro_JuaresBD`.`tblBanco` (
  `idBanco` VARCHAR(4) NOT NULL ,
  `nombreBanco` VARCHAR(120) NOT NULL ,
  `estadoBanco` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idBanco`) )
ENGINE = InnoDB;
  INSERT INTO `tblbanco`(`idBanco`, `nombreBanco`, `estadoBanco`) VALUES 
  ("0102", "Banco de Venezuela", DEFAULT), 
  ("0104", "Banco Venezolano de Crédito", DEFAULT),
  ("0105", "Mercantil", DEFAULT),
  ("0108", "Banco Provincial", DEFAULT),
  ("0114", "Bancaribe", DEFAULT),
  ("0115", "Banco Exterior", DEFAULT),
  ("0116", "Banco Occidental de Descuento", DEFAULT),
  ("0128", "Banco Caroní", DEFAULT),
  ("0134", "Banesco", DEFAULT),
  ("0138", "Banco Plaza", DEFAULT),
  ("0151", "Banco Fondo Común", DEFAULT),
  ("0156", "100% Banco", DEFAULT),
  ("0157", "Banco del Sur", DEFAULT),
  ("0163", "Banco del Tesoro", DEFAULT),
  ("0166", "Banco Agrícola de Venezuela", DEFAULT),
  ("0168", "Bancrecer", DEFAULT),
  ("0169", "Mi Banco", DEFAULT),
  ("0171", "Banco Activo", DEFAULT),
  ("0172", "Bancamiga", DEFAULT),
  ("0174", "Banplus", DEFAULT),
  ("0175", "Banco Bicentenario", DEFAULT),
  ("0177", "Banfanb", DEFAULT),
  ("0191", "Banco Nacional de Crédito", DEFAULT);


-- -----------------------------------------------------
-- Table `Teatro_JuaresBD`.`tblCompras`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Teatro_JuaresBD`.`tblCompras` (
  `numeroCompra` INT(11) AUTO_INCREMENT NOT NULL ,
  `fechaCompra` DATE NOT NULL ,
  `horaCompra` TIME NOT NULL ,
  `montoTotal` DECIMAL(10,2) NOT NULL ,
  `metodoPago` VARCHAR(40) NOT NULL ,
  `referenciaBancaria` INT NULL ,
  `numeroTarjeta` VARCHAR(19) NULL ,
  `banco` VARCHAR(4) NULL,
  `tipoCompra` TINYINT(1) NOT NULL DEFAULT 1,
  `cedCliente` VARCHAR(15) NULL ,
  PRIMARY KEY (`numeroCompra`) ,
  INDEX `FK__idx` (`cedCliente` ASC) ,
  INDEX `FK_ComprasBanco_idx` (`banco` ASC) ,
  CONSTRAINT `FK_ComprasClientes`
    FOREIGN KEY (`cedCliente` )
    REFERENCES `Teatro_JuaresBD`.`tblClientes` (`cedulaCliente` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_ComprasBanco`
    FOREIGN KEY (`banco` )
    REFERENCES `Teatro_JuaresBD`.`tblBanco` (`idBanco` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Teatro_JuaresBD`.`tblCategoria`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Teatro_JuaresBD`.`tblCategoria` (
  `idCategoria` INT(11) AUTO_INCREMENT NOT NULL ,
  `nombreCategoria` VARCHAR(120) NOT NULL ,
   `status` TINYINT(1) NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`idCategoria`) )
ENGINE = InnoDB;

INSERT INTO `tblCategoria`(`nombreCategoria`) VALUES ('Todo Público');
INSERT INTO `tblCategoria`(`nombreCategoria`) VALUES ('Obra Teatral');
INSERT INTO `tblCategoria`(`nombreCategoria`) VALUES ('Danza');
INSERT INTO `tblCategoria`(`nombreCategoria`) VALUES ('Musical');
INSERT INTO `tblCategoria`(`nombreCategoria`) VALUES ('Suspenso');
INSERT INTO `tblCategoria`(`nombreCategoria`) VALUES ('Terror');


-- -----------------------------------------------------
-- Table `Teatro_JuaresBD`.`tblEventos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Teatro_JuaresBD`.`tblEventos` (
  `nroEvento` INT(11) AUTO_INCREMENT NOT NULL ,
  `nombre` VARCHAR(100) NOT NULL ,
  `descripcion` VARCHAR(120) NOT NULL ,
  `fechaEvento` DATE NOT NULL ,
  `horaInicio` TIME NOT NULL ,
  `horaFinal` TIME NOT NULL ,
  `categoriaEvento` INT(11) NOT NULL ,
  `director` VARCHAR(120) NULL ,
  `imagenEvento` TEXT NOT NULL ,
  `patioStatus` INT NOT NULL ,
  `palcoStatus` INT NOT NULL ,
  `galeriaStatus` INT NOT NULL ,
  `estadoEvento` INT NOT NULL,
  PRIMARY KEY (`nroEvento`) ,
  INDEX `FK_EventoCategoria_idx` (`categoriaEvento` ASC) ,
  CONSTRAINT `FK_EventoCategoria`
    FOREIGN KEY (`categoriaEvento` )
    REFERENCES `Teatro_JuaresBD`.`tblCategoria` (`idCategoria` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Teatro_JuaresBD`.`tblBoletos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Teatro_JuaresBD`.`tblBoletos` (
  `numeroBoleto` INT(11) AUTO_INCREMENT NOT NULL ,
  `status` INT NOT NULL DEFAULT 0,
  `precioBoleto` DECIMAL(10,2) NOT NULL ,
  `numCompra` INT(11) NOT NULL ,
  `numEvento` INT(11) NOT NULL ,
  PRIMARY KEY (`numeroBoleto`) ,
  INDEX `FK_ComprasBoletos_idx` (`numCompra` ASC) ,
  INDEX `FK_BoletosEventos_idx` (`numEvento` ASC) ,
  CONSTRAINT `FK_BoletosCompras`
    FOREIGN KEY (`numCompra` )
    REFERENCES `Teatro_JuaresBD`.`tblCompras` (`numeroCompra` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_BoletosEventos`
    FOREIGN KEY (`numEvento` )
    REFERENCES `Teatro_JuaresBD`.`tblEventos` (`nroEvento` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Teatro_JuaresBD`.`tblAsientosAreas`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Teatro_JuaresBD`.`tblAsientosAreas` (
  `codigoAsiento` VARCHAR(10) NOT NULL ,
  `nombreArea` VARCHAR(100) NOT NULL ,
  `estado` INT DEFAULT 1 ,
  PRIMARY KEY (`codigoAsiento`) )
ENGINE = InnoDB;

INSERT INTO `tblasientosareas`(`codigoAsiento`, `nombreArea`, `estado`) VALUES 
 
  -- PATIO OESTE
  ("PO17", "Patio", DEFAULT),
  ("PO15", "Patio", DEFAULT),
  ("PO13", "Patio", DEFAULT),
  ("PO11", "Patio", DEFAULT),
  ("PO9", "Patio", DEFAULT),
  ("PO7", "Patio", DEFAULT),
  ("PO5", "Patio", DEFAULT),
  ("PO3", "Patio", DEFAULT),
  ("PO1", "Patio", DEFAULT),

  ("PN23", "Patio", DEFAULT),
  ("PN21", "Patio", DEFAULT),
  ("PN19", "Patio", DEFAULT),
  ("PN17", "Patio", DEFAULT),
  ("PN15", "Patio", DEFAULT),
  ("PN13", "Patio", DEFAULT),
  ("PN11", "Patio", DEFAULT),
  ("PN9", "Patio", DEFAULT),
  ("PN7", "Patio", DEFAULT),
  ("PN5", "Patio", DEFAULT),
  ("PN3", "Patio", DEFAULT),
  ("PN1", "Patio", DEFAULT),

  ("PM23", "Patio", DEFAULT),
  ("PM21", "Patio", DEFAULT),
  ("PM19", "Patio", DEFAULT),
  ("PM17", "Patio", DEFAULT),
  ("PM15", "Patio", DEFAULT),
  ("PM13", "Patio", DEFAULT),
  ("PM11", "Patio", DEFAULT),
  ("PM9", "Patio", DEFAULT),
  ("PM7", "Patio", DEFAULT),
  ("PM5", "Patio", DEFAULT),
  ("PM3", "Patio", DEFAULT),
  ("PM1", "Patio", DEFAULT),

  ("PL23", "Patio", DEFAULT),
  ("PL21", "Patio", DEFAULT),
  ("PL19", "Patio", DEFAULT),
  ("PL17", "Patio", DEFAULT),
  ("PL15", "Patio", DEFAULT),
  ("PL13", "Patio", DEFAULT),
  ("PL11", "Patio", DEFAULT),
  ("PL9", "Patio", DEFAULT),
  ("PL7", "Patio", DEFAULT),
  ("PL5", "Patio", DEFAULT),
  ("PL3", "Patio", DEFAULT),
  ("PL1", "Patio", DEFAULT),

  ("PK23", "Patio", DEFAULT),
  ("PK21", "Patio", DEFAULT),
  ("PK19", "Patio", DEFAULT),
  ("PK17", "Patio", DEFAULT),
  ("PK15", "Patio", DEFAULT),
  ("PK13", "Patio", DEFAULT),
  ("PK11", "Patio", DEFAULT),
  ("PK9", "Patio", DEFAULT),
  ("PK7", "Patio", DEFAULT),
  ("PK5", "Patio", DEFAULT),
  ("PK3", "Patio", DEFAULT),
  ("PK1", "Patio", DEFAULT),

  ("PJ23", "Patio", DEFAULT),
  ("PJ21", "Patio", DEFAULT),
  ("PJ19", "Patio", DEFAULT),
  ("PJ17", "Patio", DEFAULT),
  ("PJ15", "Patio", DEFAULT),
  ("PJ13", "Patio", DEFAULT),
  ("PJ11", "Patio", DEFAULT),
  ("PJ9", "Patio", DEFAULT),
  ("PJ7", "Patio", DEFAULT),
  ("PJ5", "Patio", DEFAULT),
  ("PJ3", "Patio", DEFAULT),
  ("PJ1", "Patio", DEFAULT),

  ("PI23", "Patio", DEFAULT),
  ("PI21", "Patio", DEFAULT),
  ("PI19", "Patio", DEFAULT),
  ("PI17", "Patio", DEFAULT),
  ("PI15", "Patio", DEFAULT),
  ("PI13", "Patio", DEFAULT),
  ("PI11", "Patio", DEFAULT),
  ("PI9", "Patio", DEFAULT),
  ("PI7", "Patio", DEFAULT),
  ("PI5", "Patio", DEFAULT),
  ("PI3", "Patio", DEFAULT),
  ("PI1", "Patio", DEFAULT),

  ("PH25", "Patio", DEFAULT),
  ("PH23", "Patio", DEFAULT),
  ("PH21", "Patio", DEFAULT),
  ("PH19", "Patio", DEFAULT),
  ("PH17", "Patio", DEFAULT),
  ("PH15", "Patio", DEFAULT),
  ("PH13", "Patio", DEFAULT),
  ("PH11", "Patio", DEFAULT),
  ("PH9", "Patio", DEFAULT),
  ("PH7", "Patio", DEFAULT),
  ("PH5", "Patio", DEFAULT),
  ("PH3", "Patio", DEFAULT),
  ("PH1", "Patio", DEFAULT),

  ("PG27", "Patio", DEFAULT),
  ("PG25", "Patio", DEFAULT),
  ("PG23", "Patio", DEFAULT),
  ("PG21", "Patio", DEFAULT),
  ("PG19", "Patio", DEFAULT),
  ("PG17", "Patio", DEFAULT),
  ("PG15", "Patio", DEFAULT),
  ("PG13", "Patio", DEFAULT),
  ("PG11", "Patio", DEFAULT),
  ("PG9", "Patio", DEFAULT),
  ("PG7", "Patio", DEFAULT),
  ("PG5", "Patio", DEFAULT),
  ("PG3", "Patio", DEFAULT),
  ("PG1", "Patio", DEFAULT),

  ("PF27", "Patio", DEFAULT),
  ("PF25", "Patio", DEFAULT),
  ("PF23", "Patio", DEFAULT),
  ("PF21", "Patio", DEFAULT),
  ("PF19", "Patio", DEFAULT),
  ("PF17", "Patio", DEFAULT),
  ("PF15", "Patio", DEFAULT),
  ("PF13", "Patio", DEFAULT),
  ("PF11", "Patio", DEFAULT),
  ("PF9", "Patio", DEFAULT),
  ("PF7", "Patio", DEFAULT),
  ("PF5", "Patio", DEFAULT),
  ("PF3", "Patio", DEFAULT),
  ("PF1", "Patio", DEFAULT),

  ("PE27", "Patio", DEFAULT),
  ("PE25", "Patio", DEFAULT),
  ("PE23", "Patio", DEFAULT),
  ("PE21", "Patio", DEFAULT),
  ("PE19", "Patio", DEFAULT),
  ("PE17", "Patio", DEFAULT),
  ("PE15", "Patio", DEFAULT),
  ("PE13", "Patio", DEFAULT),
  ("PE11", "Patio", DEFAULT),
  ("PE9", "Patio", DEFAULT),
  ("PE7", "Patio", DEFAULT),
  ("PE5", "Patio", DEFAULT),
  ("PE3", "Patio", DEFAULT),
  ("PE1", "Patio", DEFAULT),

  ("PD27", "Patio", DEFAULT),
  ("PD25", "Patio", DEFAULT),
  ("PD23", "Patio", DEFAULT),
  ("PD21", "Patio", DEFAULT),
  ("PD19", "Patio", DEFAULT),
  ("PD17", "Patio", DEFAULT),
  ("PD15", "Patio", DEFAULT),
  ("PD13", "Patio", DEFAULT),
  ("PD11", "Patio", DEFAULT),
  ("PD9", "Patio", DEFAULT),
  ("PD7", "Patio", DEFAULT),
  ("PD5", "Patio", DEFAULT),
  ("PD3", "Patio", DEFAULT),
  ("PD1", "Patio", DEFAULT),

  ("PC27", "Patio", DEFAULT),
  ("PC25", "Patio", DEFAULT),
  ("PC23", "Patio", DEFAULT),
  ("PC21", "Patio", DEFAULT),
  ("PC19", "Patio", DEFAULT),
  ("PC17", "Patio", DEFAULT),
  ("PC15", "Patio", DEFAULT),
  ("PC13", "Patio", DEFAULT),
  ("PC11", "Patio", DEFAULT),
  ("PC9", "Patio", DEFAULT),
  ("PC7", "Patio", DEFAULT),
  ("PC5", "Patio", DEFAULT),
  ("PC3", "Patio", DEFAULT),
  ("PC1", "Patio", DEFAULT),

  ("PB25", "Patio", DEFAULT),
  ("PB23", "Patio", DEFAULT),
  ("PB21", "Patio", DEFAULT),
  ("PB19", "Patio", DEFAULT),
  ("PB17", "Patio", DEFAULT),
  ("PB15", "Patio", DEFAULT),
  ("PB13", "Patio", DEFAULT),
  ("PB11", "Patio", DEFAULT),
  ("PB9", "Patio", DEFAULT),
  ("PB7", "Patio", DEFAULT),
  ("PB5", "Patio", DEFAULT),
  ("PB3", "Patio", DEFAULT),
  ("PB1", "Patio", DEFAULT),

  ("PA23", "Patio", DEFAULT),
  ("PA21", "Patio", DEFAULT),
  ("PA19", "Patio", DEFAULT),
  ("PA17", "Patio", DEFAULT),
  ("PA15", "Patio", DEFAULT),
  ("PA13", "Patio", DEFAULT),
  ("PA11", "Patio", DEFAULT),
  ("PA9", "Patio", DEFAULT),
  ("PA7", "Patio", DEFAULT),
  ("PA5", "Patio", DEFAULT),
  ("PA3", "Patio", DEFAULT),
  ("PA1", "Patio", DEFAULT),

  -- PATIO ESTE

  ("PO2", "Patio", DEFAULT),
  ("PO4", "Patio", DEFAULT),
  ("PO6", "Patio", DEFAULT),
  ("PO8", "Patio", DEFAULT),
  ("PO10", "Patio", DEFAULT),
  ("PO12", "Patio", DEFAULT),
  ("PO14", "Patio", DEFAULT),
  ("PO16", "Patio", DEFAULT),
  ("PO18", "Patio", DEFAULT),

  ("PN2", "Patio", DEFAULT),
  ("PN4", "Patio", DEFAULT),
  ("PN6", "Patio", DEFAULT),
  ("PN8", "Patio", DEFAULT),
  ("PN10", "Patio", DEFAULT),
  ("PN12", "Patio", DEFAULT),
  ("PN14", "Patio", DEFAULT),
  ("PN16", "Patio", DEFAULT),
  ("PN18", "Patio", DEFAULT),
  ("PN20", "Patio", DEFAULT),
  ("PN22", "Patio", DEFAULT),
  ("PN24", "Patio", DEFAULT),

  ("PM2", "Patio", DEFAULT),
  ("PM4", "Patio", DEFAULT),
  ("PM6", "Patio", DEFAULT),
  ("PM8", "Patio", DEFAULT),
  ("PM10", "Patio", DEFAULT),
  ("PM12", "Patio", DEFAULT),
  ("PM14", "Patio", DEFAULT),
  ("PM16", "Patio", DEFAULT),
  ("PM18", "Patio", DEFAULT),
  ("PM20", "Patio", DEFAULT),
  ("PM22", "Patio", DEFAULT),
  ("PM24", "Patio", DEFAULT),

  ("PL2", "Patio", DEFAULT),
  ("PL4", "Patio", DEFAULT),
  ("PL6", "Patio", DEFAULT),
  ("PL8", "Patio", DEFAULT),
  ("PL10", "Patio", DEFAULT),
  ("PL12", "Patio", DEFAULT),
  ("PL14", "Patio", DEFAULT),
  ("PL16", "Patio", DEFAULT),
  ("PL18", "Patio", DEFAULT),
  ("PL20", "Patio", DEFAULT),
  ("PL22", "Patio", DEFAULT),
  ("PL24", "Patio", DEFAULT),

  ("PK2", "Patio", DEFAULT),
  ("PK4", "Patio", DEFAULT),
  ("PK6", "Patio", DEFAULT),
  ("PK8", "Patio", DEFAULT),
  ("PK10", "Patio", DEFAULT),
  ("PK12", "Patio", DEFAULT),
  ("PK14", "Patio", DEFAULT),
  ("PK16", "Patio", DEFAULT),
  ("PK18", "Patio", DEFAULT),
  ("PK20", "Patio", DEFAULT),
  ("PK22", "Patio", DEFAULT),
  ("PK24", "Patio", DEFAULT),

  ("PJ2", "Patio", DEFAULT),
  ("PJ4", "Patio", DEFAULT),
  ("PJ6", "Patio", DEFAULT),
  ("PJ8", "Patio", DEFAULT),
  ("PJ10", "Patio", DEFAULT),
  ("PJ12", "Patio", DEFAULT),
  ("PJ14", "Patio", DEFAULT),
  ("PJ16", "Patio", DEFAULT),
  ("PJ18", "Patio", DEFAULT),
  ("PJ20", "Patio", DEFAULT),
  ("PJ22", "Patio", DEFAULT),
  ("PJ24", "Patio", DEFAULT),

  ("PI2", "Patio", DEFAULT),
  ("PI4", "Patio", DEFAULT),
  ("PI6", "Patio", DEFAULT),
  ("PI8", "Patio", DEFAULT),
  ("PI10", "Patio", DEFAULT),
  ("PI12", "Patio", DEFAULT),
  ("PI14", "Patio", DEFAULT),
  ("PI16", "Patio", DEFAULT),
  ("PI18", "Patio", DEFAULT),
  ("PI20", "Patio", DEFAULT),
  ("PI22", "Patio", DEFAULT),
  ("PI24", "Patio", DEFAULT),

  ("PH2", "Patio", DEFAULT),
  ("PH4", "Patio", DEFAULT),
  ("PH6", "Patio", DEFAULT),
  ("PH8", "Patio", DEFAULT),
  ("PH10", "Patio", DEFAULT),
  ("PH12", "Patio", DEFAULT),
  ("PH14", "Patio", DEFAULT),
  ("PH16", "Patio", DEFAULT),
  ("PH18", "Patio", DEFAULT),
  ("PH20", "Patio", DEFAULT),
  ("PH22", "Patio", DEFAULT),
  ("PH24", "Patio", DEFAULT),
  ("PH26", "Patio", DEFAULT),

  ("PG2", "Patio", DEFAULT),
  ("PG4", "Patio", DEFAULT),
  ("PG6", "Patio", DEFAULT),
  ("PG8", "Patio", DEFAULT),
  ("PG10", "Patio", DEFAULT),
  ("PG12", "Patio", DEFAULT),
  ("PG14", "Patio", DEFAULT),
  ("PG16", "Patio", DEFAULT),
  ("PG18", "Patio", DEFAULT),
  ("PG20", "Patio", DEFAULT),
  ("PG22", "Patio", DEFAULT),
  ("PG24", "Patio", DEFAULT),
  ("PG26", "Patio", DEFAULT),
  ("PG28", "Patio", DEFAULT),

  ("PF2", "Patio", DEFAULT),
  ("PF4", "Patio", DEFAULT),
  ("PF6", "Patio", DEFAULT),
  ("PF8", "Patio", DEFAULT),
  ("PF10", "Patio", DEFAULT),
  ("PF12", "Patio", DEFAULT),
  ("PF14", "Patio", DEFAULT),
  ("PF16", "Patio", DEFAULT),
  ("PF18", "Patio", DEFAULT),
  ("PF20", "Patio", DEFAULT),
  ("PF22", "Patio", DEFAULT),
  ("PF24", "Patio", DEFAULT),
  ("PF26", "Patio", DEFAULT),
  ("PF28", "Patio", DEFAULT),

  ("PE2", "Patio", DEFAULT),
  ("PE4", "Patio", DEFAULT),
  ("PE6", "Patio", DEFAULT),
  ("PE8", "Patio", DEFAULT),
  ("PE10", "Patio", DEFAULT),
  ("PE12", "Patio", DEFAULT),
  ("PE14", "Patio", DEFAULT),
  ("PE16", "Patio", DEFAULT),
  ("PE18", "Patio", DEFAULT),
  ("PE20", "Patio", DEFAULT),
  ("PE22", "Patio", DEFAULT),
  ("PE24", "Patio", DEFAULT),
  ("PE26", "Patio", DEFAULT),
  ("PE28", "Patio", DEFAULT),

  ("PD2", "Patio", DEFAULT),
  ("PD4", "Patio", DEFAULT),
  ("PD6", "Patio", DEFAULT),
  ("PD8", "Patio", DEFAULT),
  ("PD10", "Patio", DEFAULT),
  ("PD12", "Patio", DEFAULT),
  ("PD14", "Patio", DEFAULT),
  ("PD16", "Patio", DEFAULT),
  ("PD18", "Patio", DEFAULT),
  ("PD20", "Patio", DEFAULT),
  ("PD22", "Patio", DEFAULT),
  ("PD24", "Patio", DEFAULT),
  ("PD26", "Patio", DEFAULT),
  ("PD28", "Patio", DEFAULT),

  ("PC2", "Patio", DEFAULT),
  ("PC4", "Patio", DEFAULT),
  ("PC6", "Patio", DEFAULT),
  ("PC8", "Patio", DEFAULT),
  ("PC10", "Patio", DEFAULT),
  ("PC12", "Patio", DEFAULT),
  ("PC14", "Patio", DEFAULT),
  ("PC16", "Patio", DEFAULT),
  ("PC18", "Patio", DEFAULT),
  ("PC20", "Patio", DEFAULT),
  ("PC22", "Patio", DEFAULT),
  ("PC24", "Patio", DEFAULT),
  ("PC26", "Patio", DEFAULT),
  ("PC28", "Patio", DEFAULT),

  ("PB2", "Patio", DEFAULT),
  ("PB4", "Patio", DEFAULT),
  ("PB6", "Patio", DEFAULT),
  ("PB8", "Patio", DEFAULT),
  ("PB10", "Patio", DEFAULT),
  ("PB12", "Patio", DEFAULT),
  ("PB14", "Patio", DEFAULT),
  ("PB16", "Patio", DEFAULT),
  ("PB18", "Patio", DEFAULT),
  ("PB20", "Patio", DEFAULT),
  ("PB22", "Patio", DEFAULT),
  ("PB24", "Patio", DEFAULT),
  ("PB26", "Patio", DEFAULT),

  ("PA2", "Patio", DEFAULT),
  ("PA4", "Patio", DEFAULT),
  ("PA6", "Patio", DEFAULT),
  ("PA8", "Patio", DEFAULT),
  ("PA10", "Patio", DEFAULT),
  ("PA12", "Patio", DEFAULT),
  ("PA14", "Patio", DEFAULT),
  ("PA16", "Patio", DEFAULT),
  ("PA18", "Patio", DEFAULT),
  ("PA20", "Patio", DEFAULT),
  ("PA22", "Patio", DEFAULT),
  ("PA24", "Patio", DEFAULT),

  -- BALCON OESTE 

  ("BO1", "Balcon", DEFAULT),
  ("BO3", "Balcon", DEFAULT),
  ("BO5", "Balcon", DEFAULT),
  ("BO7", "Balcon", DEFAULT),
  ("BO9", "Balcon", DEFAULT),
  ("BO11", "Balcon", DEFAULT),
  ("BO13", "Balcon", DEFAULT),
  ("BO15", "Balcon", DEFAULT),
  ("BO17", "Balcon", DEFAULT),
  ("BO19", "Balcon", DEFAULT),
  ("BO21", "Balcon", DEFAULT),
  ("BO23", "Balcon", DEFAULT),

  -- BALCON ESTE

  ("BE2", "Balcon", DEFAULT),
  ("BE4", "Balcon", DEFAULT),
  ("BE6", "Balcon", DEFAULT),
  ("BE8", "Balcon", DEFAULT),
  ("BE10", "Balcon", DEFAULT),
  ("BE12", "Balcon", DEFAULT),
  ("BE14", "Balcon", DEFAULT),
  ("BE16", "Balcon", DEFAULT),
  ("BE18", "Balcon", DEFAULT),
  ("BE20", "Balcon", DEFAULT),
  ("BE22", "Balcon", DEFAULT),
  ("BE24", "Balcon", DEFAULT),

  -- GALERIA OESTE

  ("GL27", "Galeria", DEFAULT),
  ("GL25", "Galeria", DEFAULT),
  ("GL23", "Galeria", DEFAULT),
  ("GL21", "Galeria", DEFAULT),
  ("GL19", "Galeria", DEFAULT),
  ("GL17", "Galeria", DEFAULT),
  ("GL15", "Galeria", DEFAULT),
  ("GL13", "Galeria", DEFAULT),
  ("GL11", "Galeria", DEFAULT),
  ("GL9", "Galeria", DEFAULT),
  ("GL7", "Galeria", DEFAULT),
  ("GL5", "Galeria", DEFAULT),
  ("GL3", "Galeria", DEFAULT),
  ("GL1", "Galeria", DEFAULT),

  ("GK25", "Galeria", DEFAULT),
  ("GK23", "Galeria", DEFAULT),
  ("GK21", "Galeria", DEFAULT),
  ("GK19", "Galeria", DEFAULT),
  ("GK17", "Galeria", DEFAULT),
  ("GK15", "Galeria", DEFAULT),
  ("GK13", "Galeria", DEFAULT),
  ("GK11", "Galeria", DEFAULT),
  ("GK9", "Galeria", DEFAULT),
  ("GK7", "Galeria", DEFAULT),
  ("GK5", "Galeria", DEFAULT),
  ("GK3", "Galeria", DEFAULT),
  ("GK1", "Galeria", DEFAULT),

  ("GJ25", "Galeria", DEFAULT),
  ("GJ23", "Galeria", DEFAULT),
  ("GJ21", "Galeria", DEFAULT),
  ("GJ19", "Galeria", DEFAULT),
  ("GJ17", "Galeria", DEFAULT),
  ("GJ15", "Galeria", DEFAULT),
  ("GJ13", "Galeria", DEFAULT),
  ("GJ11", "Galeria", DEFAULT),
  ("GJ9", "Galeria", DEFAULT),
  ("GJ7", "Galeria", DEFAULT),
  ("GJ5", "Galeria", DEFAULT),
  ("GJ3", "Galeria", DEFAULT),
  ("GJ1", "Galeria", DEFAULT),

  ("GI23", "Galeria", DEFAULT),
  ("GI21", "Galeria", DEFAULT),
  ("GI19", "Galeria", DEFAULT),
  ("GI17", "Galeria", DEFAULT),
  ("GI15", "Galeria", DEFAULT),
  ("GI13", "Galeria", DEFAULT),
  ("GI11", "Galeria", DEFAULT),
  ("GI9", "Galeria", DEFAULT),
  ("GI7", "Galeria", DEFAULT),
  ("GI5", "Galeria", DEFAULT),
  ("GI3", "Galeria", DEFAULT),
  ("GI1", "Galeria", DEFAULT),

  ("GH23", "Galeria", DEFAULT),
  ("GH21", "Galeria", DEFAULT),
  ("GH19", "Galeria", DEFAULT),
  ("GH17", "Galeria", DEFAULT),
  ("GH15", "Galeria", DEFAULT),
  ("GH13", "Galeria", DEFAULT),
  ("GH11", "Galeria", DEFAULT),
  ("GH9", "Galeria", DEFAULT),
  ("GH7", "Galeria", DEFAULT),
  ("GH5", "Galeria", DEFAULT),
  ("GH3", "Galeria", DEFAULT),
  ("GH1", "Galeria", DEFAULT),

  ("GG23", "Galeria", DEFAULT),
  ("GG21", "Galeria", DEFAULT),
  ("GG19", "Galeria", DEFAULT),
  ("GG17", "Galeria", DEFAULT),
  ("GG15", "Galeria", DEFAULT),
  ("GG13", "Galeria", DEFAULT),
  ("GG11", "Galeria", DEFAULT),
  ("GG9", "Galeria", DEFAULT),
  ("GG7", "Galeria", DEFAULT),
  ("GG5", "Galeria", DEFAULT),
  ("GG3", "Galeria", DEFAULT),
  ("GG1", "Galeria", DEFAULT),

  ("GF23", "Galeria", DEFAULT),
  ("GF21", "Galeria", DEFAULT),
  ("GF19", "Galeria", DEFAULT),
  ("GF17", "Galeria", DEFAULT),
  ("GF15", "Galeria", DEFAULT),
  ("GF13", "Galeria", DEFAULT),
  ("GF11", "Galeria", DEFAULT),
  ("GF9", "Galeria", DEFAULT),
  ("GF7", "Galeria", DEFAULT),
  ("GF5", "Galeria", DEFAULT),
  ("GF3", "Galeria", DEFAULT),
  ("GF1", "Galeria", DEFAULT),

  ("GE23", "Galeria", DEFAULT),
  ("GE21", "Galeria", DEFAULT),
  ("GE19", "Galeria", DEFAULT),
  ("GE17", "Galeria", DEFAULT),
  ("GE15", "Galeria", DEFAULT),
  ("GE13", "Galeria", DEFAULT),
  ("GE11", "Galeria", DEFAULT),
  ("GE9", "Galeria", DEFAULT),
  ("GE7", "Galeria", DEFAULT),
  ("GE5", "Galeria", DEFAULT),
  ("GE3", "Galeria", DEFAULT),
  ("GE1", "Galeria", DEFAULT),

  ("GD23", "Galeria", DEFAULT),
  ("GD21", "Galeria", DEFAULT),
  ("GD19", "Galeria", DEFAULT),
  ("GD17", "Galeria", DEFAULT),
  ("GD15", "Galeria", DEFAULT),
  ("GD13", "Galeria", DEFAULT),
  ("GD11", "Galeria", DEFAULT),
  ("GD9", "Galeria", DEFAULT),
  ("GD7", "Galeria", DEFAULT),
  ("GD5", "Galeria", DEFAULT),
  ("GD3", "Galeria", DEFAULT),
  ("GD1", "Galeria", DEFAULT),

  ("GC25", "Galeria", DEFAULT),
  ("GC23", "Galeria", DEFAULT),
  ("GC21", "Galeria", DEFAULT),
  ("GC19", "Galeria", DEFAULT),
  ("GC17", "Galeria", DEFAULT),
  ("GC15", "Galeria", DEFAULT),
  ("GC13", "Galeria", DEFAULT),
  ("GC11", "Galeria", DEFAULT),
  ("GC9", "Galeria", DEFAULT),
  ("GC7", "Galeria", DEFAULT),
  ("GC5", "Galeria", DEFAULT),
  ("GC3", "Galeria", DEFAULT),
  ("GC1", "Galeria", DEFAULT),

  ("GB25", "Galeria", DEFAULT),
  ("GB23", "Galeria", DEFAULT),
  ("GB21", "Galeria", DEFAULT),
  ("GB19", "Galeria", DEFAULT),
  ("GB17", "Galeria", DEFAULT),
  ("GB15", "Galeria", DEFAULT),
  ("GB13", "Galeria", DEFAULT),
  ("GB11", "Galeria", DEFAULT),
  ("GB9", "Galeria", DEFAULT),
  ("GB7", "Galeria", DEFAULT),
  ("GB5", "Galeria", DEFAULT),
  ("GB3", "Galeria", DEFAULT),
  ("GB1", "Galeria", DEFAULT),

  ("GA25", "Galeria", DEFAULT),
  ("GA23", "Galeria", DEFAULT),
  ("GA21", "Galeria", DEFAULT),
  ("GA19", "Galeria", DEFAULT),
  ("GA17", "Galeria", DEFAULT),
  ("GA15", "Galeria", DEFAULT),
  ("GA13", "Galeria", DEFAULT),
  ("GA11", "Galeria", DEFAULT),
  ("GA9", "Galeria", DEFAULT),
  ("GA7", "Galeria", DEFAULT),
  ("GA5", "Galeria", DEFAULT),
  ("GA3", "Galeria", DEFAULT),
  ("GA1", "Galeria", DEFAULT),

  -- GALERIA ESTE

  ("GL2", "Galeria", DEFAULT),
  ("GL4", "Galeria", DEFAULT),
  ("GL6", "Galeria", DEFAULT),
  ("GL8", "Galeria", DEFAULT),
  ("GL10", "Galeria", DEFAULT),
  ("GL12", "Galeria", DEFAULT),
  ("GL14", "Galeria", DEFAULT),
  ("GL16", "Galeria", DEFAULT),
  ("GL18", "Galeria", DEFAULT),
  ("GL20", "Galeria", DEFAULT),
  ("GL22", "Galeria", DEFAULT),
  ("GL24", "Galeria", DEFAULT),
  ("GL26", "Galeria", DEFAULT),

  ("GK2", "Galeria", DEFAULT),
  ("GK4", "Galeria", DEFAULT),
  ("GK6", "Galeria", DEFAULT),
  ("GK8", "Galeria", DEFAULT),
  ("GK10", "Galeria", DEFAULT),
  ("GK12", "Galeria", DEFAULT),
  ("GK14", "Galeria", DEFAULT),
  ("GK16", "Galeria", DEFAULT),
  ("GK18", "Galeria", DEFAULT),
  ("GK20", "Galeria", DEFAULT),
  ("GK22", "Galeria", DEFAULT),
  ("GK24", "Galeria", DEFAULT),
  ("GK26", "Galeria", DEFAULT),

  ("GJ2", "Galeria", DEFAULT),
  ("GJ4", "Galeria", DEFAULT),
  ("GJ6", "Galeria", DEFAULT),
  ("GJ8", "Galeria", DEFAULT),
  ("GJ10", "Galeria", DEFAULT),
  ("GJ12", "Galeria", DEFAULT),
  ("GJ14", "Galeria", DEFAULT),
  ("GJ16", "Galeria", DEFAULT),
  ("GJ18", "Galeria", DEFAULT),
  ("GJ20", "Galeria", DEFAULT),
  ("GJ22", "Galeria", DEFAULT),
  ("GJ24", "Galeria", DEFAULT),

  ("GI2", "Galeria", DEFAULT),
  ("GI4", "Galeria", DEFAULT),
  ("GI6", "Galeria", DEFAULT),
  ("GI8", "Galeria", DEFAULT),
  ("GI10", "Galeria", DEFAULT),
  ("GI12", "Galeria", DEFAULT),
  ("GI14", "Galeria", DEFAULT),
  ("GI16", "Galeria", DEFAULT),
  ("GI18", "Galeria", DEFAULT),
  ("GI20", "Galeria", DEFAULT),
  ("GI22", "Galeria", DEFAULT),

  ("GH2", "Galeria", DEFAULT),
  ("GH4", "Galeria", DEFAULT),
  ("GH6", "Galeria", DEFAULT),
  ("GH8", "Galeria", DEFAULT),
  ("GH10", "Galeria", DEFAULT),
  ("GH12", "Galeria", DEFAULT),
  ("GH14", "Galeria", DEFAULT),
  ("GH16", "Galeria", DEFAULT),
  ("GH18", "Galeria", DEFAULT),
  ("GH20", "Galeria", DEFAULT),
  ("GH22", "Galeria", DEFAULT),

  ("GG2", "Galeria", DEFAULT),
  ("GG4", "Galeria", DEFAULT),
  ("GG6", "Galeria", DEFAULT),
  ("GG8", "Galeria", DEFAULT),
  ("GG10", "Galeria", DEFAULT),
  ("GG12", "Galeria", DEFAULT),
  ("GG14", "Galeria", DEFAULT),
  ("GG16", "Galeria", DEFAULT),
  ("GG18", "Galeria", DEFAULT),
  ("GG20", "Galeria", DEFAULT),
  ("GG22", "Galeria", DEFAULT),

  ("GF2", "Galeria", DEFAULT),
  ("GF4", "Galeria", DEFAULT),
  ("GF6", "Galeria", DEFAULT),
  ("GF8", "Galeria", DEFAULT),
  ("GF10", "Galeria", DEFAULT),
  ("GF12", "Galeria", DEFAULT),
  ("GF14", "Galeria", DEFAULT),
  ("GF16", "Galeria", DEFAULT),
  ("GF18", "Galeria", DEFAULT),
  ("GF20", "Galeria", DEFAULT),
  ("GF22", "Galeria", DEFAULT),

  ("GE2", "Galeria", DEFAULT),
  ("GE4", "Galeria", DEFAULT),
  ("GE6", "Galeria", DEFAULT),
  ("GE8", "Galeria", DEFAULT),
  ("GE10", "Galeria", DEFAULT),
  ("GE12", "Galeria", DEFAULT),
  ("GE14", "Galeria", DEFAULT),
  ("GE16", "Galeria", DEFAULT),
  ("GE18", "Galeria", DEFAULT),
  ("GE20", "Galeria", DEFAULT),
  ("GE22", "Galeria", DEFAULT),

  ("GD2", "Galeria", DEFAULT),
  ("GD4", "Galeria", DEFAULT),
  ("GD6", "Galeria", DEFAULT),
  ("GD8", "Galeria", DEFAULT),
  ("GD10", "Galeria", DEFAULT),
  ("GD12", "Galeria", DEFAULT),
  ("GD14", "Galeria", DEFAULT),
  ("GD16", "Galeria", DEFAULT),
  ("GD18", "Galeria", DEFAULT),
  ("GD20", "Galeria", DEFAULT),
  ("GD22", "Galeria", DEFAULT),

  ("GC2", "Galeria", DEFAULT),
  ("GC4", "Galeria", DEFAULT),
  ("GC6", "Galeria", DEFAULT),
  ("GC8", "Galeria", DEFAULT),
  ("GC10", "Galeria", DEFAULT),
  ("GC12", "Galeria", DEFAULT),
  ("GC14", "Galeria", DEFAULT),
  ("GC16", "Galeria", DEFAULT),
  ("GC18", "Galeria", DEFAULT),
  ("GC20", "Galeria", DEFAULT),
  ("GC22", "Galeria", DEFAULT),
  ("GC24", "Galeria", DEFAULT),
  ("GC26", "Galeria", DEFAULT),

  ("GB2", "Galeria", DEFAULT),
  ("GB4", "Galeria", DEFAULT),
  ("GB6", "Galeria", DEFAULT),
  ("GB8", "Galeria", DEFAULT),
  ("GB10", "Galeria", DEFAULT),
  ("GB12", "Galeria", DEFAULT),
  ("GB14", "Galeria", DEFAULT),
  ("GB16", "Galeria", DEFAULT),
  ("GB18", "Galeria", DEFAULT),
  ("GB20", "Galeria", DEFAULT),
  ("GB22", "Galeria", DEFAULT),
  ("GB24", "Galeria", DEFAULT),
  ("GB26", "Galeria", DEFAULT),

  ("GA2", "Galeria", DEFAULT),
  ("GA4", "Galeria", DEFAULT),
  ("GA6", "Galeria", DEFAULT),
  ("GA8", "Galeria", DEFAULT),
  ("GA10", "Galeria", DEFAULT),
  ("GA12", "Galeria", DEFAULT),
  ("GA14", "Galeria", DEFAULT),
  ("GA16", "Galeria", DEFAULT),
  ("GA18", "Galeria", DEFAULT),
  ("GA20", "Galeria", DEFAULT),
  ("GA22", "Galeria", DEFAULT),
  ("GA24", "Galeria", DEFAULT),
  ("GA26", "Galeria", DEFAULT);


-- -----------------------------------------------------
-- Table `Teatro_JuaresBD`.`tblRoles`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Teatro_JuaresBD`.`tblRoles` (
  `idRol` INT(11) AUTO_INCREMENT NOT NULL ,
  `nombreRol` VARCHAR(60) NOT NULL ,
  `descripcionRol` VARCHAR(100) NOT NULL ,
  `estado` INT NOT NULL ,
  PRIMARY KEY (`idRol`) )
ENGINE = InnoDB;


INSERT INTO `tblroles`(`nombreRol`, `descripcionRol`, `estado`) VALUES ('Usuario','Rol de un usuario comun',1);
INSERT INTO `tblroles`(`nombreRol`, `descripcionRol`, `estado`) VALUES ('Administrador','Rol con todos los permisos',1);
INSERT INTO `tblroles`(`nombreRol`, `descripcionRol`, `estado`) VALUES ('Personal de Medios','Personal encargado de gestionar eventos',1);
INSERT INTO `tblroles`(`nombreRol`, `descripcionRol`, `estado`) VALUES ('Personal de Administracion','Personal encargado de ventas y reportes',1);
INSERT INTO `tblroles`(`nombreRol`, `descripcionRol`, `estado`) VALUES ('Taquillero','Personal encargado de la venta de boletos',1);


-- -----------------------------------------------------
-- Table `Teatro_JuaresBD`.`tblUsuarios`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Teatro_JuaresBD`.`tblUsuarios` (
  `cedula` VARCHAR(15) NOT NULL ,
  `nombre` VARCHAR(100) NOT NULL ,
  `apellido` VARCHAR(100) NOT NULL ,
  `correo` VARCHAR(120) NOT NULL ,
  `telefono` VARCHAR(11) NULL ,
  `clave` VARCHAR(8) NOT NULL ,
  `fecha_reg` DATETIME NOT NULL ,
  `imgUser` TEXT NULL ,
  `rol_Id` INT(11) NOT NULL ,
  `status` TINYINT(1) NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`cedula`) ,
  INDEX `FK_UsuariosRoles_idx` (`rol_Id` ASC) ,
  CONSTRAINT `FK_UsuariosRoles`
    FOREIGN KEY (`rol_Id` )
    REFERENCES `Teatro_JuaresBD`.`tblRoles` (`idRol` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

INSERT INTO `tblUsuarios` (`cedula`, `nombre`, `apellido`, `correo`, `clave`, `fecha_reg`, `rol_Id`, `status`) 
VALUES ('30025415', 'Manolo', 'Gonzálo', 'manolito@gmail.com', '12345678', NOW(), 2, DEFAULT);


-- -----------------------------------------------------
-- Table `Teatro_JuaresBD`.`tblAsientosDisponible`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Teatro_JuaresBD`.`tblAsientosDisponible` (
  `numDisponible` INT(11) AUTO_INCREMENT NOT NULL ,
  `estado` INT NOT NULL ,
  `precioArea` FLOAT NOT NULL ,
  `codAsiento` VARCHAR(10) NOT NULL ,
  `numEvento` INT(11) NOT NULL ,
  PRIMARY KEY (`numDisponible`) ,
  INDEX `FK_AsientosDisponibleAreas_idx` (`codAsiento` ASC) ,
  INDEX `FK_AsientosDisponibleEvento_idx` (`numEvento` ASC) ,
  CONSTRAINT `FK_AsientosDisponibleAreas`
    FOREIGN KEY (`codAsiento` )
    REFERENCES `Teatro_JuaresBD`.`tblAsientosAreas` (`codigoAsiento` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_AsientosDisponibleEvento`
    FOREIGN KEY (`numEvento` )
    REFERENCES `Teatro_JuaresBD`.`tblEventos` (`nroEvento` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Teatro_JuaresBD`.`tblBoletosAsientos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Teatro_JuaresBD`.`tblBoletosAsientos` (
  `numBoleto` INT(11) NOT NULL ,
  `numDisponible` INT(11) NOT NULL ,
  `estado` INT NOT NULL ,
  PRIMARY KEY (`numBoleto`, `numDisponible`) ,
  INDEX `FK_BoletosAsientos_idx` (`numBoleto` ASC) ,
  INDEX `FK_BoletosAsientosDisponible_idx` (`numDisponible` ASC) ,
  CONSTRAINT `FK_BoletosAsientos`
    FOREIGN KEY (`numBoleto` )
    REFERENCES `Teatro_JuaresBD`.`tblBoletos` (`numeroBoleto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_BoletosAsientosDisponible`
    FOREIGN KEY (`numDisponible` )
    REFERENCES `Teatro_JuaresBD`.`tblAsientosDisponible` (`numDisponible` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Teatro_JuaresBD`.`tblModulos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Teatro_JuaresBD`.`tblModulos` (
  `idModulo` INT(11) AUTO_INCREMENT NOT NULL ,
  `nombreModulo` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idModulo`) )
ENGINE = InnoDB;


INSERT INTO `tblModulos`(`nombreModulo`) VALUES ('Citas');
INSERT INTO `tblModulos`(`nombreModulo`) VALUES ('Eventos');
INSERT INTO `tblModulos`(`nombreModulo`) VALUES ('Ventas');
INSERT INTO `tblModulos`(`nombreModulo`) VALUES ('Personal');
INSERT INTO `tblModulos`(`nombreModulo`) VALUES ('Clientes');

-- -----------------------------------------------------
-- Table `Teatro_JuaresBD`.`tblAccesoModulo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Teatro_JuaresBD`.`tblAccesoModulo` (
  `idModulo` INT(11) NOT NULL ,
  `idRol` INT(11) NOT NULL ,
  `estadoAcceso` TINYINT(1) NOT NULL ,
  PRIMARY KEY (`idModulo`, `idRol`) ,
  INDEX `FK_ModuloAcceso_idx` (`idModulo` ASC) ,
  INDEX `FK_RolAcceso_idx` (`idRol` ASC) ,
  CONSTRAINT `FK_ModuloAcceso`
    FOREIGN KEY (`idModulo` )
    REFERENCES `Teatro_JuaresBD`.`tblModulos` (`idModulo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_RolAcceso`
    FOREIGN KEY (`idRol` )
    REFERENCES `Teatro_JuaresBD`.`tblRoles` (`idRol` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

INSERT INTO `tblAccesoModulo`(`idModulo`, `idRol`, `estadoAcceso`) 
VALUES (1, 2, 1),
       (2, 2, 1),
       (3, 2, 1),
       (4, 2, 1),
       (5, 2, 1);

