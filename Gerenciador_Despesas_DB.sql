/***************************************/
/* Script de Criação do Banco de Dados */
/***************************************/

/* Tabela Usuarios */
CREATE TABLE `Usuarios` (
  `IdUsuario` int(11) NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `Sexo` char(1) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Senha` varchar(30) NOT NULL,
  `StatusConta` char(1) NOT NULL,
  `DataNascimento` datetime NOT NULL,
  `DataCadastro` timestamp NULL DEFAULT NULL,
  `DataUltimaModificacao` timestamp NULL DEFAULT NULL
)

ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD UNIQUE KEY `Email` (`Email`);


ALTER TABLE `Usuarios`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;