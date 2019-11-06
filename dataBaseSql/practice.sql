-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 06 2019 г., 23:43
-- Версия сервера: 10.3.13-MariaDB
-- Версия PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `practice`
--

-- --------------------------------------------------------

--
-- Структура таблицы `chatmsg`
--

CREATE TABLE `chatmsg` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `message` varchar(10000) NOT NULL,
  `data` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'exist',
  `img` varchar(255) NOT NULL DEFAULT 'anon.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `chatmsg`
--

INSERT INTO `chatmsg` (`id`, `username`, `role`, `message`, `data`, `time`, `status`, `img`) VALUES
(7, 'admin', 'admin', 'first chat message', '31.10.19', '00.04.11', 'exist', '0c8501d5aa0d530.jpg'),
(8, 'user1', 'user', 'Hellow everybody!', '31.10.19', '00.05.03', 'exist', 'tron_disc_2.png'),
(9, 'admin', 'admin', 'hi', '31.10.19', '20.51.36', 'deleted', '0c8501d5aa0d530.jpg'),
(10, 'admin', 'admin', 'ddsadasad', '31.10.19', '20.51.55', 'deleted', '0c8501d5aa0d530.jpg'),
(11, 'admin', 'admin', 'sadasDAdaS', '31.10.19', '20.52.00', 'deleted', '0c8501d5aa0d530.jpg'),
(12, 'admin', 'admin', 'ASDASdAD', '31.10.19', '20.52.04', 'exist', '0c8501d5aa0d530.jpg'),
(13, 'Ivan', 'user', 'Hi', '31.10.19', '21.45.44', 'exist', 'anon.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `num` int(11) NOT NULL,
  `header` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `text` varchar(255) NOT NULL,
  `button` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'exist'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`num`, `header`, `image`, `text`, `button`, `user`, `status`) VALUES
(1, 'autumn', '1.jpg', 'autumn is cool...', 'autumn', 'Admin', 'exist'),
(2, 'mountains', '2.jpg', 'mountains are cool...', 'mountains', 'Admin', 'exist'),
(3, 'trees', '3.jpg', 'trees are cool...', 'trees', 'Admin', 'exist'),
(4, 'lake', '4.jpg', 'lake is cool...', 'lake', 'Admin', 'exist'),
(5, 'sunflowers', '5.jpg', 'sunflowers are cool...', 'sunflowers', 'Admin', 'exist'),
(6, 'gulf', '6.jpg', 'gulf is cool...', 'gulf', 'Admin', 'exist'),
(14, 'Waterhall', '7.jpg', 'Waterhall is good...', 'Waterhall', 'user1', 'exist'),
(15, 'Lagune', '9.jpg', 'Lagune is good...', 'Lagune', 'user1', 'exist'),
(16, 'Tron bike1', 'Light-Cycle-3-Tron-Legacy-Wallpaper.jpg', 'tron bike1', 'tron bike1', 'Admin', 'exist'),
(17, 'Tron bike', 'Tron-Legacy-wallpaper-846575.jpg', 'Tron motocicle', 'Tron', 'Admin', 'exist'),
(18, 'Desks', 'doski_1920x1080.jpg', 'Desks is cool', 'Desk', 'admin', 'exist'),
(19, 'Ivan', '4427247169_5f73d00197_o.jpg', 'Rinzler', 'Rinzler', 'Ivan', 'exist'),
(20, 'Desks', 'arhitektura_interer_setka_140025_1920x1080.jpg', 'Some text...', 'Some text...', 'admin', 'exist');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `img` varchar(255) NOT NULL DEFAULT 'anon.jpg',
  `status` varchar(255) NOT NULL DEFAULT 'recover'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `role`, `img`, `status`) VALUES
(7, 'Ivan', 'admin@email.com', 'root12345', 'user', 'anon.jpg', 'recover'),
(38, 'admin', 'admin@gmail.com', 'root12345', 'admin', '0c8501d5aa0d530.jpg', 'recover'),
(39, 'Alex', 'admin@email.com', 'root12345', 'moderator', 'tron_disc_2.png', 'recover'),
(40, 'user1', 'admin@email.com', 'root12345', 'user', 'tron_disc_2.png', 'recover'),
(41, 'user2', 'admin@email.com', 'root12345', 'user', 'anon.jpg', 'recover'),
(42, 'user3', 'admin@email.com', 'root12345', 'user', 'tron_disc_2.png', 'recover'),
(44, 'Alex10', 'alex10@email.com', 'dsfsddfdsafdafsda', 'user', 'Light-Cycle-3-Tron-Legacy-Wallpaper.jpg', 'recover');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `chatmsg`
--
ALTER TABLE `chatmsg`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`num`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `chatmsg`
--
ALTER TABLE `chatmsg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
