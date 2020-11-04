/*Versão 2.0 */
drop database if exists usuarios;
create database usuarios;
use usuarios;
create table pessoas(
	id_pessoa integer not null auto_increment, 
	nome varchar(40) not null,
	primary key (id_pessoa)
);
create table telefones(
	id_pessoa integer not null,
	telefone varchar(15) not null,
	constraint fk_tel_pess foreign key (id_pessoa)
	references pessoas(id_pessoa)
);
create table usuarios(
	id_pessoa integer not null,
	login varchar(12) not null,
	senha varchar(50) not null,
	tipo varchar(15) not null,
	constraint fk_possui foreign key (id_pessoa)
	references pessoas(id_pessoa)
);

describe pessoas;
describe telefones;
describe usuarios;
show tables;

insert into pessoas(nome) values
("Leonardo Silva"),
("Rodolpho Vieira"),
("Jurema Andrade");
insert into pessoas(nome) values ("Marcia Souza");
insert into pessoas(nome) values ("Rodrigo vieira");
insert into pessoas values (default,"Maria Silva");

insert into telefones(id_pessoa,telefone) values (1,"19 45677-7897"), (1,"19 98787-7897"), (3,"19 88888-8888"), (5, "19 99764-2390");

insert into usuarios values
(1, "silva.leonar", md5 ("Senh@123"), "comum"),
(2, "vieira.rodol", md5 ("Senh@123"), "comum"),
(3, "andrade.jure", md5 ("Senh@123"), "adm"),
(5, "vieira.rodri", md5 ("Senh@123"), "adm");

-- Mostra a tabela da esquerda (pessoas) completa
create view vw_pessoas as
select p.id_pessoa, p.nome, t.telefone
from pessoas p left join telefones t
on p.id_pessoa = t.id_pessoa order by p.id_pessoa;

select * from pessoas;
select * from telefones;
select * from vw_pessoas;
select * from usuarios;
