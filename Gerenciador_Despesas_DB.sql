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


/* Tabela Categorias */
CREATE TABLE `Categorias` (
  `IdCategoria` int(11) NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `Descricao` varchar(100) NOT NULL
)

ALTER TABLE `Categorias`
ADD PRIMARY KEY (`IdCategoria`);

ALTER TABLE `Categorias`
MODIFY `IdCategoria` int(11) NOT NULL AUTO_INCREMENT;


/* Tabela Favorecidos */
CREATE TABLE `Favorecidos` (
  `IdFavorecido` int(11) NOT NULL,
  `IdCategoria` int(11) NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `Descricao` varchar(100) NOT NULL
)

ALTER TABLE `Favorecidos`
ADD `IdUsuario` int(11) NOT NULL,

ALTER TABLE `Favorecidos`
ADD PRIMARY KEY (`IdFavorecido`),
ADD FOREIGN KEY (IdCategoria) REFERENCES Categorias(IdCategoria);

ALTER TABLE `Favorecidos`
MODIFY `IdFavorecido` int(11) NOT NULL AUTO_INCREMENT;

/* Tabela FormaPagamento */
CREATE TABLE `FormaPagamento` (
  `IdFormaPagamento` int(11) NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `Descricao` varchar(100) NOT NULL
)

ALTER TABLE `FormaPagamento`
ADD PRIMARY KEY (`IdFormaPagamento`);

/* Tabela Despesas */
CREATE TABLE `Despesas` (
  `IdDespesa` int(11) NOT NULL,
  `IdUsuario` int(11) NOT NULL,
  `IdFavorecido` int(11) NOT NULL,
  `IdFormaPagamento` int(11) NOT NULL,
  `Descricao` varchar(100) NOT NULL,
  `Valor` double(11,2) NOT NULL,
  `StatusDespesa` char(1) NOT NULL,
  `DataVencimento` datetime NOT NULL,
  `DataCadastro` timestamp NULL DEFAULT NULL,
  `DataUltimaModificacao` timestamp NULL DEFAULT NULL
)

ALTER TABLE `Despesas`
ADD PRIMARY KEY (`IdDespesa`),
ADD FOREIGN KEY (IdUsuario) REFERENCES Usuarios(IdUsuario),
ADD FOREIGN KEY (IdFavorecido) REFERENCES Favorecidos(IdFavorecido),
ADD FOREIGN KEY (IdFormaPagamento) REFERENCES FormaPagamento(IdFormaPagamento);

ALTER TABLE `Despesas`
MODIFY `IdDespesa` int(11) NOT NULL AUTO_INCREMENT;
