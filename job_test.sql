-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Янв 29 2018 г., 15:24
-- Версия сервера: 10.1.26-MariaDB
-- Версия PHP: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `job_test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE `sessions` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `sid` varchar(255) NOT NULL,
  `lastUpdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `login` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `firstName`, `lastName`, `mail`, `role`) VALUES
(1, 'admin', '$2y$10$nXREn/Oie9oI9zUUxfb7euJ2WfLhTMnOz3AmNztlLQcFKU1D6U3Xa', 'Admin', 'Adminov', 'admin@mail.ru', 1),
(2, 'user', '$2y$10$/0ATORDR0KNGBsz5q.XT/.jx/C9dg6H0mozOXzATuDvcwfaFZXn5m', 'User', 'Userov', 'user@mail.ru', 0),
(3, 'user1', '$2y$10$nXREn/Oie9oI9zUUxfb7euJ2WfLhTMnOz3AmNztlLQcFKU1D6U3Xa', 'Jack', 'Jonson', 'jack@mail.com', 0),
(4, 'Lod', '$2y$10$nXREn/Oie9oI9zUUxfb7euJ2WfLhTMnOz3AmNztlLQcFKU1D6U3Xa', 'Lod', 'Lodov', 'lod@mail.ru', 0),
(5, 'greg', '$2y$10$nXREn/Oie9oI9zUUxfb7euJ2WfLhTMnOz3AmNztlLQcFKU1D6U3Xa', 'Gray', 'Grov', 'gray@mail.com', 0),
(6, 'Vikkka', '$2y$10$jkQDuwEMUCkro2YO7jbM8.xEZp4ZzCQE9RrfC7GB8HvikkJih1JOS', 'Viktoria', 'Lopi', 'KhryokovaV@mail.ru', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
