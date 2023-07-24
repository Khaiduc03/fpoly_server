SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+07:00";

CREATE TABLE `user` (
  `id` INT UNIQUE PRIMARY KEY NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(256) NOT NULL,
  `email` VARCHAR(255) ,
  `password` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(20),
  `dob` DATETIME,
  `class_id` INT
);

CREATE TABLE `news` (
  `id` INT UNIQUE PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `create_date` DATE NOT NULL,
  `body` TEXT NOT NULL,
  `image` VARCHAR(255),
  `category_id` INT NOT NULL
);

CREATE TABLE `category_news` (
  `id` INT UNIQUE PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL
);

CREATE TABLE `class` (
  `id` INT PRIMARY KEY NOT NULL,
  `name` VARCHAR(255) NOT NULL
);

CREATE TABLE `subject` (
  `id` INT UNIQUE PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `class_id` INT NOT NULL,
  `teacher_id` INT NOT NULL,
  `time_id` INT,
  `Room` VARCHAR(256) NOT NULL,
  `auditorium` VARCHAR(256) NOT NULL,
  `status` BOOLEAN
);

CREATE TABLE `time` (
  `id` INT PRIMARY KEY NOT NULL,
  `time_start` TIME,
  `time_end` TIME,
  `date` DATE
);

CREATE TABLE `Teacher` (
  `id` INT UNIQUE PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` INT,
  `major` VARCHAR(256)
);

CREATE TABLE `score` (
  `id` INT UNIQUE PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_id` VARCHAR(256),
  `subject_id` VARCHAR(256),
  `score` FLOAT
);

ALTER TABLE `news` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `news` ADD FOREIGN KEY (`category_id`) REFERENCES `category_news` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `user` ADD FOREIGN KEY (`class_id`) REFERENCES `class` (`id`);

ALTER TABLE `subject` ADD FOREIGN KEY (`teacher_id`) REFERENCES `Teacher` (`id`);

ALTER TABLE `subject` ADD FOREIGN KEY (`class_id`) REFERENCES `class` (`id`);

ALTER TABLE `score` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

ALTER TABLE `score` ADD FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`);

ALTER TABLE `subject` ADD FOREIGN KEY (`time_id`) REFERENCES `Time` (`id`);



-- Dummy data for the `class` table
INSERT INTO `class` (`id`, `name`)
VALUES
  (1, 'Class A'),
  (2, 'Class B'),
  (3, 'Class C');

-- Dummy data for the `user` table
INSERT INTO `user` (`id`, `username`, `email`, `password`, `phone`, `dob`, `class_id`)
VALUES
  (1, 'user1', 'user1@example.com', 'password1', '1234567890', '1990-01-01', 1),
  (2, 'user2', 'user2@example.com', 'password2', '9876543210', '1985-05-15', 2),
  (3, 'user3', 'user3@example.com', 'password3', '0123456789', '1995-10-20', 2),
  (4, 'user4', 'user4@example.com', 'password4', '1112223333', '1988-07-08', 1),
  (5, 'user5', 'user5@example.com', 'password5', '4445556666', '1992-12-30', 3),
  (6, 'user6', 'user6@example.com', 'password6', '7778889999', '1993-03-25', 1),
  (7, 'user7', 'user7@example.com', 'password7', '9998887777', '1989-06-12', 1),
  (8, 'user8', 'user8@example.com', 'password8', '6665554444', '1991-09-18', 2),
  (9, 'user9', 'user9@example.com', 'password9', '3332221111', '1994-04-17', 3),
  (10, 'user10', 'user10@example.com', 'password10', '0001112222', '1996-11-05', 1);

-- Dummy data for the `news` table
INSERT INTO `news` (`id`, `user_id`, `title`, `create_date`, `body`, `image`, `category_id`)
VALUES
  (1, 1, 'Exciting News', '2023-07-24', 'Check out our new website!', 'website.jpg', 1),
  (2, 2, 'Product Launch', '2023-07-23', 'Introducing our latest product: XYZ Gadget', 'product.jpg', 1),
  (3, 3, 'Upcoming Event', '2023-07-25', 'Join us for our annual conference.', 'event.jpg', 2),
  (4, 4, 'New Feature Release', '2023-07-26', 'We are thrilled to announce a new feature.', 'feature.jpg', 1),
  (5, 5, 'Important Update', '2023-07-27', 'Please read for important information.', 'update.jpg', 3),
  (6, 6, 'Company Milestone', '2023-07-28', 'Celebrating 10 years of success!', 'milestone.jpg', 1),
  (7, 7, 'Community Outreach', '2023-07-29', 'Join us in giving back to the community.', 'outreach.jpg', 2),
  (8, 8, 'Industry Recognition', '2023-07-30', 'We have been awarded the Best Company of the Year.', 'award.jpg', 1),
  (9, 9, 'Tech Symposium', '2023-07-31', 'Join industry experts at our tech symposium.', 'symposium.jpg', 2),
  (10, 10, 'New Partnership', '2023-08-01', 'We are excited to partner with another company.', 'partnership.jpg', 1);

-- Dummy data for the `category_news` table
INSERT INTO `category_news` (`id`, `name`)
VALUES
  (1, 'Company News'),
  (2, 'Events'),
  (3, 'Updates');



-- Dummy data for the `subject` table
INSERT INTO `subject` (`id`, `class_id`, `teacher_id`, `time_id`, `Room`, `auditorium`, `status`)
VALUES
  (1, 1, 1, 1, 'Room 101', 'Hall A', true),
  (2, 2, 2, 2, 'Room 102', 'Hall B', true),
  (3, 3, 3, 3, 'Room 103', 'Hall C', false),
  (4, 1, 2, 1, 'Room 104', 'Hall D', true),
  (5, 2, 1, 2, 'Room 105', 'Hall E', true),
  (6, 3, 3, 3, 'Room 106', 'Hall F', false),
  (7, 1, 1, 1, 'Room 107', 'Hall G', true),
  (8, 2, 2, 2, 'Room 108', 'Hall H', true),
  (9, 3, 3, 3, 'Room 109', 'Hall I', false),
  (10, 1, 2, 1, 'Room 110', 'Hall J', true);

-- Dummy data for the `Time` table
INSERT INTO `Time` (`id`, `time_start`, `time_end`, `date`)
VALUES
  (1, '08:00:00', '09:30:00', '2023-07-25'),
  (2, '10:00:00', '11:30:00', '2023-07-26'),
  (3, '13:00:00', '14:30:00', '2023-07-27'),
  (4, '15:00:00', '16:30:00', '2023-07-28'),
  (5, '08:30:00', '10:00:00', '2023-07-29'),
  (6, '10:30:00', '12:00:00', '2023-07-30'),
  (7, '13:30:00', '15:00:00', '2023-07-31'),
  (8, '15:30:00', '17:00:00', '2023-08-01'),
  (9, '09:00:00', '10:30:00', '2023-08-02'),
  (10, '11:00:00', '12:30:00', '2023-08-03');

-- Dummy data for the `Teacher` table
INSERT INTO `Teacher` (`id`, `name`, `major`)
VALUES
  (1, 'John Doe', 'Mathematics'),
  (2, 'Jane Smith', 'Science'),
  (3, 'Michael Brown', 'History');

-- Dummy data for the `score` table
INSERT INTO `score` (`id`, `user_id`, `subject_id`, `score`)
VALUES
  (1, '1', '1', 90.5),
  (2, '2', '2', 85.0),
  (3, '3', '3', 78.5),
  (4, '4', '4', 92.0),
  (5, '5', '5', 87.5),
  (6, '6', '6', 81.0),
  (7, '7', '7', 88.5),
  (8, '8', '8', 95.0),
  (9, '9', '9', 79.5),
  (10, '10', '10', 83.0);






