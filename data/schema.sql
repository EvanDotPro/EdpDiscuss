CREATE TABLE discuss_thread
(
    thread_id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
    subject   VARCHAR(1000) NOT NULL,
    slug      VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE discuss_message
(
    message_id        INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
    post_time         DATETIME NOT NULL,
    author_user_id    INT UNSIGNED DEFAULT NULL,
    author_email      VARCHAR(255) DEFAULT NULL UNIQUE,
    author_name       VARCHAR(50) DEFAULT NULL,
    thread_id         INT UNSIGNED NOT NULL,
    parent_message_id INT UNSIGNED DEFAULT NULL,
    subject           VARCHAR(100) NOT NULL,
    message           TEXT NOT NULL,
    FOREIGN KEY (author_user_id) REFERENCES user (user_id),
    FOREIGN KEY (thread_id) REFERENCES discuss_thread (thread_id) ON DELETE CASCADE,
    FOREIGN KEY (parent_message_id) REFERENCES discuss_message (message_id)
) ENGINE=InnoDB;

CREATE TABLE discuss_tag
(
    tag_id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
    name   VARCHAR(255) NOT NULL,
    slug   VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE discuss_thread_tag
(
    thread_id INT UNSIGNED NOT NULL,
    tag_id    INT UNSIGNED DEFAULT NULL,
    FOREIGN KEY (thread_id) REFERENCES discuss_thread (thread_id),
    FOREIGN KEY (tag_id) REFERENCES discuss_tag (tag_id)
) ENGINE=InnoDB;

CREATE TABLE discuss_visit
(
    ip_address VARCHAR(45) NOT NULL,
    thread_id INT UNSIGNED NOT NULL,
    visit_time   DATETIME NOT NULL,
    PRIMARY KEY(ip_address, thread_id),
    FOREIGN KEY (thread_id) REFERENCES discuss_thread(thread_id)
) ENGINE=InnoDB;