CREATE TABLE post (
    post_id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    url_key VARCHAR(255) NOT NULL,
    image_path VARCHAR(255) NULL,
    content TEXT DEFAULT NULL,
    description VARCHAR(255) DEFAULT NULL,
    published_date DATETIME NOT NULL,
    PRIMARY KEY (post_id),
    UNIQUE KEY url_key (url_key)
) ENGINE=InnoDB;