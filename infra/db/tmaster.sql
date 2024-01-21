CREATE TABLE IF NOT EXISTS utilizadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    nome VARCHAR(255),
    email VARCHAR(255),
    role_id INT,
    UNIQUE KEY (username),
    FOREIGN KEY (role_id) REFERENCES role(id)
);


CREATE TABLE IF NOT EXISTS tarefas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descricao TEXT,
    data_inicio DATE,
    data_fim DATE,
    prioridade INT,
    estado ENUM('Por fazer', 'A ser feita', 'Terminada') DEFAULT 'Por fazer',
    favorita BOOLEAN DEFAULT false,
    utilizador_id INT,
    categoria_id INT,
    anexo_caminho VARCHAR(255), 
    FOREIGN KEY (utilizador_id) REFERENCES utilizadores(id),
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);


CREATE TABLE IF NOT EXISTS categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL
);


CREATE TABLE IF NOT EXISTS partilha (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilizador_id INT,
    FOREIGN KEY (utilizador_id) REFERENCES utilizadores(id)
);


CREATE TABLE IF NOT EXISTS role (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL
);


CREATE TABLE IF NOT EXISTS partilhaTarefa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    partilha_id INT,
    remetente_id INT,
    destinatario_id INT,
    tarefa_id INT,
    FOREIGN KEY (partilha_id) REFERENCES partilha(id),
    FOREIGN KEY (remetente_id) REFERENCES utilizadores(id),
    FOREIGN KEY (destinatario_id) REFERENCES utilizadores(id),
    FOREIGN KEY (tarefa_id) REFERENCES tarefas(id),
    UNIQUE KEY (partilha_id, tarefa_id)
);

