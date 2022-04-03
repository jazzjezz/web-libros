CREATE TABLE IF NOT EXISTS users (id INT AUTO_INCREMENT,  user VARCHAR(40) NOT NULL UNIQUE KEY, password BLOB NOT NULL, name VARCHAR(250), PRIMARY KEY(id) );


INSERT INTO users VALUES (NULL, 'santococlos@polonorte.com', '$2y$10$7VAyojts0hQgJkCgV5rDUOhpGd9Hb3LxCFzOKow.zDCTVxky6C.FK', 'Santo Clos');
