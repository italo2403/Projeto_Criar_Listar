create database cadastramento;
use cadastramento;
create table usuarios(
id int primary key auto_increment,
nome varchar(120),
idade int(5),
nascimento int(15), 
endereco varchar(220),
cpf varchar(16),
sexo char(1), 
identidade varchar(10),
est_civi varchar(15)
);

create table perfil(
id int primary key auto_increment,
pai varchar(150),
mae varchar(150), 
formacao varchar(150),
expe1 varchar(20), 
expe2 varchar(20),
just text
);

drop database cadastramento;

select *from usuarios;


select * from perfil; 
