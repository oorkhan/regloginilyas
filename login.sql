-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Окт 31 2018 г., 22:06
-- Версия сервера: 10.1.35-MariaDB
-- Версия PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `login`
--

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `body` varchar(500) NOT NULL,
  `user_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `user_id`, `deleted`) VALUES
(1, 'post no 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop p', 1, 0),
(2, 'jimbo', 'jimbo textjimbo textjimbo textjimbo textjimbo textjimbo text', 3, 0),
(3, 'jimbo ', 'jimbo textjimbo textjimbo textjimbo textjimbo textjimbo text', 3, 0),
(4, 'jimbo ', 'udated jimboudated jimboudated jimboudated jimboudated jimboudated jimbo', 3, 0),
(5, 'jimbo', 'updated', 3, 0),
(6, 'jimbo jimbo jimbo ', 'jimbo jimbo jimbo jimbo jimbo ', 3, 1),
(7, 'jimbo ', 'jimbo jimbo jimbo jimbo jimbo jimbo ', 3, 1),
(8, 'jimbo44444', '44444444444', 3, 0),
(9, 'post 3', 'sdasfdsdfsdf', 3, 0),
(10, 'post 3', 'asasas', 3, 0),
(11, 'ÐÐ¾Ð²Ð¾ÑÑ‚ÑŒ 3', 'zxcfcvxzc', 3, 0),
(12, 'ÐÐ¾Ð²Ð¾ÑÑ‚ÑŒ 3', 'zxcfcvxzc', 3, 0),
(13, 'post 3', 'ffffff', 3, 0),
(14, 'ÐÐ¾Ð²Ð¾ÑÑ‚ÑŒ 3', 'zxczxc', 3, 0),
(15, 'ÐÐ¾Ð²Ð¾ÑÑ‚ÑŒ 3', 'asdsadasd', 3, 0),
(16, 'ÐÐ¾Ð²Ð¾ÑÑ‚ÑŒ 3', 'asdasdsad', 3, 0),
(17, 'post 4', 'asdasdsad', 3, 0),
(18, 'poste with image', 'asdasdasdasdasd', 3, 0),
(19, 'multiple images', 'imagesimagesimagesimagesimagesimagesimagesimagesimages', 3, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `post_images`
--

CREATE TABLE `post_images` (
  `post_image_id` int(11) NOT NULL,
  `url` varchar(100) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `post_images`
--

INSERT INTO `post_images` (`post_image_id`, `url`, `post_id`) VALUES
(1, 'uploads/1540915955.jpg', 17),
(2, 'uploads/1540915955.jpg', 18),
(3, 'uploads/15391128601191201847771.jpg', 19),
(4, 'uploads/images.jpg', 19),
(5, 'uploads/simple(1).JPG', 19),
(6, 'uploads/simple.JPG', 19),
(7, 'uploads/travel-2.jpg', 19);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_img` varchar(100) NOT NULL DEFAULT 'images/profile.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `username`, `password`, `profile_img`) VALUES
(1, 'Orkhan', 'Orujaliyev', 'oorkhan', '', 'images/profile.png'),
(3, 'jimbo', 'mercury', 'jimbo', '$2y$10$TeA/Evv8ZuoFg3DYk35e6uwQMxD3QiQWemmzIbL7qUaQQNyNopbNC', '1541009967.jpg');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `post_images`
--
ALTER TABLE `post_images`
  ADD PRIMARY KEY (`post_image_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `post_images`
--
ALTER TABLE `post_images`
  MODIFY `post_image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
