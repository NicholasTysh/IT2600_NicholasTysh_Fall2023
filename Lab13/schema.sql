USE it1150;

CREATE TABLE `users` (
    `user_id` varchar(45) NOT NULL,
    `email` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

ALTER TABLE `users`
  MODIFY `user_id` INT NOT NULL AUTO_INCREMENT,
  ADD PRIMARY KEY (`user_id`);

ALTER TABLE users
ADD UNIQUE (email);