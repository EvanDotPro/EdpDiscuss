CREATE TABLE discuss_thread
(
    thread_id          INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    subject            VARCHAR(1000) NOT NULL,
    first_message_id   INTEGER DEFAULT NULL,
    latest_message_id   INTEGER DEFAULT NULL
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
    message           TEXT NOT NULL,
    FOREIGN KEY (author_user_id) REFERENCES user (user_id),
    FOREIGN KEY (thread_id) REFERENCES discuss_thread (thread_id) ON DELETE CASCADE,
    FOREIGN KEY (parent_message_id) REFERENCES discuss_message (message_id)
) ENGINE=InnoDB;

ALTER TABLE discuss_thread ADD CONSTRAINT first_message_fk FOREIGN KEY (first_message_id) REFERENCES discuss_message (message_id);
ALTER TABLE discuss_thread ADD CONSTRAINT latest_message_fk FOREIGN KEY (latest_message_id) REFERENCES discuss_message (message_id);

DELIMITER |

CREATE TRIGGER latest_post_time AFTER INSERT ON discuss_message
    FOR EACH ROW BEGIN
        UPDATE discuss_thread SET latest_message_id = NEW.message_id WHERE discuss_thread.thread_id = NEW.thread_id;
        SET @threadMsg = (SELECT message_id FROM discuss_message WHERE thread_id = NEW.thread_id LIMIT 1);
        IF @threadMsg = 0 THEN
            UPDATE discuss_thread SET first_message_id = NEW.message_id WHERE discuss_thread.thread_id = NEW.thread_id;
        END IF;
    END;
|

DELIMITER ;
