CREATE TABLE IF NOT EXISTS utilizadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    nome VARCHAR(255),
    email VARCHAR(255),
    foto_perfil LONGBLOB,
    UNIQUE KEY (username),
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
    anexo_caminho VARCHAR(255), 
    FOREIGN KEY (utilizador_id) REFERENCES utilizadores(id),

);


CREATE TABLE IF NOT EXISTS partilhaTarefa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    remetente_id INT,
    destinatario_id INT,
    tarefa_id INT,
    FOREIGN KEY (remetente_id) REFERENCES utilizadores(id),
    FOREIGN KEY (destinatario_id) REFERENCES utilizadores(id),
    FOREIGN KEY (tarefa_id) REFERENCES tarefas(id)
);

