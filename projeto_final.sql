-- Cria o schema projeto_final se não existir
CREATE SCHEMA IF NOT EXISTS `projeto_final` DEFAULT CHARACTER SET latin1;

-- Seleciona o schema projeto_final para uso
USE `projeto_final`;

-- Cria a tabela usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `idusuario` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(150) NOT NULL,
  `cpf` VARCHAR(11) NOT NULL UNIQUE,
  `datanascimento` DATE NULL DEFAULT NULL,
  `email` VARCHAR(150) NOT NULL UNIQUE,
  `senha` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE = InnoDB DEFAULT CHARACTER SET = latin1;

-- Cria a tabela formacaoacademica
CREATE TABLE IF NOT EXISTS `formacaoacademica` (
  `idformacaoacademica` INT(11) NOT NULL AUTO_INCREMENT,
  `idusuario` INT(11) NOT NULL,
  `inicio` DATE NULL DEFAULT NULL,
  `fim` DATE NULL DEFAULT NULL,
  `descricao` VARCHAR(150) NULL DEFAULT NULL,
  PRIMARY KEY (`idformacaoacademica`),
  INDEX `fk_idUsuario_formacao_idx` (`idusuario` ASC),
  CONSTRAINT `fk_idUsuario_formacao`
    FOREIGN KEY (`idusuario`)
    REFERENCES `usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB DEFAULT CHARACTER SET = latin1;

-- Cria a tabela experienciaprofissional
CREATE TABLE IF NOT EXISTS `experienciaprofissional` (
  `idexperienciaprofissional` INT(11) NOT NULL AUTO_INCREMENT,
  `idusuario` INT(11) NOT NULL,
  `inicio` DATE NULL DEFAULT NULL,
  `fim` DATE NULL DEFAULT NULL,
  `empresa` VARCHAR(45) NULL DEFAULT NULL,
  `descricao` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idexperienciaprofissional`),
  INDEX `fk_idUsuario_experiencia_idx` (`idusuario` ASC),
  CONSTRAINT `fk_idUsuario_experiencia`
    FOREIGN KEY (`idusuario`)
    REFERENCES `usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB DEFAULT CHARACTER SET = latin1;

-- Cria a tabela outrasformacoes
CREATE TABLE IF NOT EXISTS `outrasformacoes` (
  `idoutrasformacoes` INT(11) NOT NULL AUTO_INCREMENT,
  `idusuario` INT(11) NOT NULL,
  `inicio` DATE NULL DEFAULT NULL,
  `fim` DATE NULL DEFAULT NULL,
  `descricao` VARCHAR(150) NULL DEFAULT NULL,
  PRIMARY KEY (`idoutrasformacoes`),
  INDEX `idusuario_idx` (`idusuario` ASC),
  CONSTRAINT `fk_idUsuario`
    FOREIGN KEY (`idusuario`)
    REFERENCES `usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB DEFAULT CHARACTER SET = latin1;