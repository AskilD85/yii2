-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 20 2019 г., 19:08
-- Версия сервера: 5.7.23-log
-- Версия PHP: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `yii2base`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '52', 1558344901),
('admin', '56', 1558352161),
('user', '48', 1558344559),
('user', '55', 1558352052);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, NULL, NULL, NULL, 1558293619, 1558293619),
('CreateAdmin', 2, 'Создание админа', NULL, NULL, 1558293619, 1558293619),
('CreateRequest', 2, 'Создание заявки', NULL, NULL, 1558293619, 1558293619),
('CreateUser', 2, 'Создание пользователя', NULL, NULL, 1558293619, 1558293619),
('deleteUser', 2, 'Удаление пользователя', NULL, NULL, 1558293619, 1558293619),
('user', 1, NULL, NULL, NULL, 1558293619, 1558293619);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'CreateAdmin'),
('user', 'CreateRequest'),
('admin', 'deleteUser'),
('admin', 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1558012638),
('m140506_102106_rbac_init', 1558252913),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1558252913),
('m180523_151638_rbac_updates_indexes_without_prefix', 1558252915),
('m190516_125739_create_users_table', 1558012691),
('m190516_131302_create_request_table', 1558012692),
('m190516_132050_create_user_table', 1558013333),
('m190516_132643_add_status_column_to_request_table', 1558013335),
('m190516_134911_create_user_table', 1558014570),
('m190516_142308_add_role_column_to_user_table', 1558016648),
('m190516_152403_create_request_table', 1558020412),
('m190516_153403_create_request_table', 1558020935),
('m190516_154212_create_request_table', 1558021823),
('m190516_155219_create_request_table', 1558022279),
('m190516_155914_create_request_table', 1558022376),
('m190516_160015_create_request_table', 1558022430),
('m190516_160931_create_request_table', 1558023015),
('m190516_163004_add_reg_date_column_to_user_table', 1558024389),
('m190517_232545_create_user_table', 1558135713),
('m190517_233016_create_user_table', 1558135843),
('m190517_233445_add_role_column_to_user_table', 1558136129),
('m190518_064631_add_column_reg_date_to_user_table', 1558162272),
('m190519_063327_create_user_table', 1558247689),
('m190519_064107_create_user_table', 1558248103),
('m190519_064357_create_user_table', 1558248263);

-- --------------------------------------------------------

--
-- Структура таблицы `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `user` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `reg_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(255) DEFAULT 'Новая'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `request`
--

INSERT INTO `request` (`id`, `user`, `email`, `reg_date`, `status`) VALUES
(84, 'Андрей', 'test@tddvdet.ru', '2019-05-20 14:11:59', 'Принят'),
(85, 'Андрей', 'askild@mail.ru', '2019-05-20 16:33:28', 'Принят');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `reg_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `fullname`, `auth_key`, `reg_date`, `role`, `password_hash`, `password_reset_token`, `email`, `created_at`, `updated_at`) VALUES
(48, 'Andrew1', 'Андрей', '7JU2_KmSupI4AEhYfwYqCEuIrR0QwGYr', '2019-05-20 14:29:19', 'user', '$2y$13$FARqIYoT0uYWr5a7KVMt.O8gKL/N1qdpk6d6w5z97l5wbxU.o0RZq', NULL, 'test@tddvdet.ru', 1558344559, 1558344559),
(52, 'admin', '', 'ACYrwu-s8IxZkekEsDHRBL4p8Iys4aFn', '2019-05-20 14:35:01', 'admin', '$2y$13$ar2KZDoW.a27WVb8Bk3Xeea/1sheRrLriSQQkYlpYgUIcW6myRGgy', NULL, NULL, 1558344901, 1558344901),
(55, 'user', 'Андрей', 'Khjep3U3GC5xZC6ktxRxvUlTtX_24S66', '2019-05-20 16:34:12', 'user', '$2y$13$/wE6F8pmCG7.LiAo0Vay9.CwkoQbfL9FvTC92BQ7BDRcHQWSiSPO2', NULL, 'askild@mail.ru', 1558352052, 1558352052),
(56, 'admin4', '', '_5Sz4BDmV0lsVvqQyAJ_NkbcT2zNsAWE', '2019-05-20 16:36:01', 'admin', '$2y$13$MaVPZHxb44lX5YloHyUx7egtSCl3Jmq3HyNZEKdM1VRlMBGb/.nhu', NULL, NULL, 1558352161, 1558352161);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Индексы таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Индексы таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Индексы таблицы `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
