-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июл 23 2024 г., 17:52
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `exam_schedule`
--

-- --------------------------------------------------------

--
-- Структура таблицы `subjects_to_specialities`
--

CREATE TABLE `subjects_to_specialities` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `speciality_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `subjects_to_specialities`
--

INSERT INTO `subjects_to_specialities` (`id`, `subject_id`, `speciality_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 2),
(7, 7, 2),
(8, 8, 2),
(9, 9, 2),
(10, 10, 2),
(11, 7, 2),
(12, 1, 1),
(13, 2, 1),
(14, 3, 1),
(15, 4, 1),
(16, 5, 1),
(17, 6, 2),
(18, 7, 2),
(19, 8, 2),
(20, 9, 2),
(21, 10, 2),
(22, 2, 1),
(23, 1, 1),
(24, 6, 2),
(25, 8, 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `subjects_to_specialities`
--
ALTER TABLE `subjects_to_specialities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `speciality_id` (`speciality_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `subjects_to_specialities`
--
ALTER TABLE `subjects_to_specialities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `subjects_to_specialities`
--
ALTER TABLE `subjects_to_specialities`
  ADD CONSTRAINT `subjects_to_specialities_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `subjects_to_specialities_ibfk_2` FOREIGN KEY (`speciality_id`) REFERENCES `specialities` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
