CREATE TABLE Cliente (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(80) NOT NULL,
    cpf VARCHAR(11) NOT NULL,
    rg VARCHAR(7)NOT NULL,
    dataNascimento DATE,
    email VARCHAR(100),
    telefone VARCHAR(13),
    celular VARCHAR(13),
    endereco VARCHAR(80),
    numeroCasa INT,
    bairro VARCHAR(80),
    cidade VARCHAR(80),
    cep VARCHAR(8),
    uf VARCHAR(2)
)

CREATE TABLE  `Fornecedor` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `identificacao` varchar(80) NOT NULL,
  `cnpj` varchar(14) NOT NULL,
  `inscEstadual` varchar(10) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefone` varchar(13) DEFAULT NULL,
  `celular` varchar(13) DEFAULT NULL,
  `site` varchar(26) DEFAULT NULL,
  `endereco` varchar(80) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `bairro` varchar(80) DEFAULT NULL,
  `cidade` varchar(80) DEFAULT NULL,
  `cep` varchar(8) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

CREATE TABLE IF NOT EXISTS `Funcionario` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `rg` varchar(7) NOT NULL,
  `ctps` varchar(11) NOT NULL,
  `serie` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefone` varchar(13) DEFAULT NULL,
  `celular` varchar(13) DEFAULT NULL,
  `dataEmissao` date DEFAULT NULL,
  `funçao` varchar(50) DEFAULT NULL,
  `salarioInicial` double DEFAULT NULL,
  `horasTrabalho` int(11) DEFAULT NULL,
  `situacaoCivil` varchar(30) DEFAULT NULL,
  `conjuge` varchar(80) DEFAULT NULL,
  `dependentes` varchar(80) DEFAULT NULL,
  `endereco` varchar(80) DEFAULT NULL,
  `numeroCasa` int(11) DEFAULT NULL,
  `bairro` varchar(80) DEFAULT NULL,
  `cidade` varchar(80) DEFAULT NULL,
  `cep` varchar(8) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `otica`.`Funcionario` (`id`, `nome`, `cpf`, `rg`, `ctps`, `serie`, `email`, `telefone`, `celular`, `dataEmissao`, `funçao`, `salarioInicial`, `horasTrabalho`, `situacaoCivil`, `conjuge`, `dependentes`, `endereco`, `numeroCasa`, `bairro`, `cidade`, `cep`, `uf`) 
        VALUES (NULL, 'maria', '0987678', '8765678', '765678', 'numseioqe', 'maria@email', '876578', '987678', '2000-09-09', 'atendente', '1000', '40', 'solteiro', 'antonio', 'pedro,joao', 'rua2', '123', 'vknsenjef', 'bnjfjn', '876789', 'pr');
        
CREATE TABLE Produto(
    id INT( 6 ) UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
    codigoBarra VARCHAR( 13 ) NOT NULL ,
    descricao VARCHAR( 100 ) ,
    grupoEstoque VARCHAR( 50 ) ,
    marca VARCHAR( 50 ) ,
    modelo VARCHAR( 50 ) ,
    unidade VARCHAR( 50 ) ,
    quantidade INT,
    valor DOUBLE,
    estoqueMinimo INT,
    fornecedorId INT( 6 ) UNSIGNED,
    FOREIGN KEY ( fornecedorId ) REFERENCES Fornecedor( id )
)

CREATE TABLE ItemVenda(
id INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
precoUnitario DOUBLE DEFAULT NULL ,
precoTotal DOUBLE DEFAULT NULL ,
quantidade INT UNSIGNED DEFAULT NULL ,
produtoId INT UNSIGNED,
vendaId INT UNSIGNED,
PRIMARY KEY ( id ) ,
FOREIGN KEY ( vendaId ) REFERENCES Venda( Id ) ,
FOREIGN KEY ( produtoId ) REFERENCES Produto( id )
)
CREATE TABLE  Compra (
  id int unsigned AUTO_INCREMENT,
  data datetime,
  valorTotal double,
  valorPago double,
  compraPaga boolean,
  fornecedorId int unsigned, 
  caixaId int unsigned,
  PRIMARY KEY (id),
  FOREIGN KEY (fornecedorId) REFERENCES Fornecedor(id),
  FOREIGN KEY (caixaId) REFERENCES Caixa(id)
);

CREATE TABLE ItemCompra (
  id int unsigned NOT NULL AUTO_INCREMENT,
  precoUnitario double,
  precoTotal double,
  quantidade int unsigned,
  produtoId int unsigned,
  compraId int unsigned,
  PRIMARY KEY (id),
  FOREIGN KEY  (compraId) REFERENCES Compra(id),
  FOREIGN KEY  (produtoId) REFERENCES Produto(id)
);

CREATE TABLE IF NOT EXISTS `Venda` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `data` datetime DEFAULT NULL,
  `valorTotal` double DEFAULT NULL,
  `clienteId` int(6) unsigned DEFAULT NULL,
  `valorRecebido` double NOT NULL,
  `vendaRecebida` tinyint(1) NOT NULL,
  `caixaId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `clienteId` (`clienteId`),
  KEY `caixaId` (`caixaId`),
  KEY `caixaId_2` (`caixaId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

