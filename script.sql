create table if not exists contactos (
    idContacto int auto_increment not null,
    nombreContacto varchar(20) not null,
    telefonoContacto varchar(10) not null,
    correoContacto varchar(30) not null,
    primary key (idContacto)
)