DROP DATABASE IF EXISTS api_usuarios;

CREATE DATABASE IF NOT EXISTS api_usuarios CHARACTER SET "utf8" COLLATE "utf8_spanish2_ci";

USE api_usuarios;

DROP TABLE IF EXISTS roles;

DROP TABLE IF EXISTS usuarios;

CREATE TABLE IF NOT EXISTS `roles`(
    `rol_id` INT(11) NOT NULL AUTO_INCREMENT,
    `rol_nombre` TEXT NOT NULL,
    PRIMARY KEY (`rol_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_spanish2_ci;

INSERT INTO `roles` (`rol_id`, `rol_nombre`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

CREATE TABLE IF NOT EXISTS `usuarios`(
    `usuario_id` INT(11) NOT NULL AUTO_INCREMENT,
    `usuario_nombre` TEXT NOT NULL,
    `usuario_apellidos` TEXT NOT NULL,
    `usuario_correo` TEXT NOT NULL,
    `rol_id` INT(11) NOT NULL,
    PRIMARY KEY (`usuario_id`),
    CONSTRAINT `fk_usuarios_roles` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`rol_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_spanish2_ci;