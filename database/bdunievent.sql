
CREATE DATABASE bdunievent;
USE bdunievent;
DROP DATABASE bdunievent;
CREATE TABLE contato(
id integer primary key auto_increment,
telefone_contato varchar(15) not null,
email_contato varchar(80) not null
)engine=InnoDB;

CREATE TABLE responsavelevento(
id integer primary key auto_increment,
nome varchar(100)  not null,
id_contato_fk integer, foreign key (id_contato_fk)
references contato(id) ON  UPDATE CASCADE ON DELETE CASCADE
) engine=InnoDB;

CREATE TABLE endereco(
id integer primary key auto_increment,
rua varchar(100) not null,
cidade varchar(80) not null,
bairro varchar(100) not null,
estado char(2) not null,
cep varchar(13) not null,
numero varchar(5) not null
)engine=InnoDB;

CREATE TABLE instituicao(
id integer primary key auto_increment,
email_login varchar(100) not null,
senha_login varchar(60) not null,
foto_perfil varchar(200) not null,
cnpj varchar (14) not null,
id_endereco_fk integer,
foreign key(id_endereco_fk)
references endereco(id)
ON DELETE CASCADE
ON UPDATE CASCADE
) engine=InnoDB;

CREATE TABLE aluno(
ra bigint primary key not null,
nome varchar (100) not null,
senha varchar (12) not null,
email_login varchar (100) not null,
foto_perfil varchar(200),
data_nascimento date not null,
id_instituicao_fk integer, foreign key(id_instituicao_fk)
references instituicao(id) ON DELETE CASCADE ON UPDATE CASCADE

)engine=InnoDB;


CREATE TABLE evento(
id integer primary key auto_increment,
nome varchar(80) not null,
descricao varchar(150) not null,
categoria_evento varchar (40) not null,
data_evento date not null,
hora_evento time not null,
capacidade int not null,
thumbnail varchar(200) not null,
thumbnail2 varchar(200),
thumbnail3 varchar(200) ,
id_responsavel_evento_fk integer, foreign key  (id_responsavel_evento_fk)
references responsavelevento(id) ON UPDATE CASCADE
ON DELETE CASCADE,
id_endereco_fk integer, foreign key  (id_endereco_fk)
references endereco(id) ON UPDATE CASCADE
ON DELETE CASCADE
)engine=InnoDB;




CREATE TABLE certificado(
id integer primary key auto_increment,
data_certificado date not null,
texto varchar(100) not null,
id_instituicao_fk integer, foreign key(id_instituicao_fk)
references instituicao(id) on update cascade on delete cascade,
id_aluno_fk bigint, foreign key(id_aluno_fk)
references aluno(ra) on update cascade on delete cascade,
id_evento_fk integer, foreign key  (id_evento_fk)
references evento(id) ON UPDATE CASCADE
ON DELETE CASCADE
)engine=InnoDB;

CREATE TABLE instituicao_evento (
    id integer PRIMARY KEY AUTO_INCREMENT,
    id_instituicao_fk integer NOT NULL,
    id_evento_fk integer NOT NULL,
    UNIQUE (id_instituicao_fk, id_evento_fk),
    FOREIGN KEY (id_instituicao_fk) REFERENCES instituicao(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (id_evento_fk) REFERENCES evento(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE secretaria(
rgm bigint primary key not null unique,
nome varchar(80) not null,
email varchar(200) not null,
senha varchar(200) not null,
id_instituicao_fk integer, foreign key (id_instituicao_fk)
references instituicao(id) ON UPDATE CASCADE ON DELETE CASCADE 
)engine=InnoDB;

DELIMITER //
create function emailInstitucional(email varchar (100)) returns boolean
begin 
	declare email_validado boolean;
	if email like '%@fatec.sp.gov.br' THEN set email_validado = true; 
    else set email_validado = false;
    end if;
    return email_validado;
end //

select emailInstitucional('levi@fatec.sp.gov.br');
