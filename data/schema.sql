CREATE TABLE discuss_thread
(
    thread_id INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    subject   VARCHAR(1000) NOT NULL,
    slug      VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE discuss_message
(
    message_id        INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    post_time         DATETIME NOT NULL,
    author_user_id    INTEGER DEFAULT NULL,
    author_email      VARCHAR(255) DEFAULT NULL UNIQUE,
    author_name       VARCHAR(50) DEFAULT NULL,
    thread_id         INTEGER NOT NULL,
    parent_message_id INTEGER DEFAULT NULL,
    subject           VARCHAR(100) DEFAULT NOT NULL,
    message           TEXT NOT NULL,
    FOREIGN KEY (author_user_id) REFERENCES user (user_id),
    FOREIGN KEY (thread_id) REFERENCES discuss_thread (thread_id) ON DELETE CASCADE,
    FOREIGN KEY (parent_message_id) REFERENCES discuss_message (message_id)
) ENGINE=InnoDB;

CREATE TABLE discuss_tag
(
    tag_id INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    name   VARCHAR(255) NOT NULL,
    slug   VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE discuss_thread_tag
(
    thread_id INTEGER NOT NULL,
    tag_id    INTEGER DEFAULT NULL,
    FOREIGN KEY (thread_id) REFERENCES discuss_thread (thread_id),
    FOREIGN KEY (tag_id) REFERENCES discuss_tag (tag_id)
) ENGINE=InnoDB;
