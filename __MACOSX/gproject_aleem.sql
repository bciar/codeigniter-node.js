--
-- Database: `gproject_aleem`
--
CREATE DATABASE IF NOT EXISTS `gproject_aleem` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gproject_aleem`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$dt2GwoMJ3LLY/ERKfk926uTaPIVoGnEUduvq9065qRjqY5fUpq0Le', '1');

-- --------------------------------------------------------

--
-- Table structure for table `block`
--

CREATE TABLE `block` (
  `id` int(10) UNSIGNED NOT NULL,
  `expert_id` int(10) NOT NULL,
  `client_id` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `desc` text CHARACTER SET utf8mb4 NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chat_history`
--

CREATE TABLE `chat_history` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `expert_id` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `spent_time` float NOT NULL,
  `expert_rate` float NOT NULL,
  `total_price` float NOT NULL,
  `expert_earning` float NOT NULL,
  `is_paid` int(11) NOT NULL DEFAULT '0',
  `paid_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_history`
--

INSERT INTO `chat_history` (`id`, `client_id`, `expert_id`, `start_time`, `end_time`, `spent_time`, `expert_rate`, `total_price`, `expert_earning`, `is_paid`, `paid_time`) VALUES
(1, 27, 15, '2017-04-01 01:04:14', '2017-04-01 01:05:31', 0.717, 7.21, 5.17, 2, 1, '2017-04-01 01:05:33'),
(2, 27, 15, '2017-04-01 01:12:56', '2017-04-01 01:14:15', 0.683, 7.21, 4.924, 2, 1, '2017-04-01 01:14:16'),
(3, 27, 15, '2017-05-05 06:17:25', '2017-05-05 06:57:24', 39.333, 7.21, 283.591, 141, 1, '2017-05-05 06:57:25');

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `expert_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `clients_info`
--

CREATE TABLE `clients_info` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `paym_email` varchar(255) NOT NULL,
  `usex` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clients_info`
--

INSERT INTO `clients_info` (`id`, `user_id`, `name`, `surname`, `birthday`, `paym_email`, `usex`, `image`, `update_date`) VALUES
(7, 16, 'Joealeeeeem', 'Joealeeem', '0004-09-04', 'joealeem@gmail.com', 'female', '5c1a2767905e6507521e065cc8e70d0c.jpg', '2016-05-16 00:39:05'),
(8, 20, 'Hrayr', 'Andreasyan', '2016-07-26', 'erfger', 'male', '61e1e9bf28014283b99e3e0fc51c1641.jpg', '2016-04-20 20:57:27'),
(11, 27, 'Gevor', 'gevor', '2016-09-20', '', 'male', '29e55de55aca563b3ab8d2cb73b9c56d.jpg', '2017-02-05 00:05:30'),
(12, 29, '', '', '0000-00-00', '', '', 'no_img.png', '0000-00-00 00:00:00'),
(13, 31, 'HAYASTAN', 'ARCAX', '2016-05-18', '', 'male', '38f0221738d330f2b6a8135fef171ac3.jpg', '2016-05-10 00:17:07'),
(14, 32, '', '', '0000-00-00', '', '', 'no_img.png', '0000-00-00 00:00:00'),
(16, 38, 'Lwww53a', 'Lessy654a', '1994-11-11', '', '', 'b0d69dc51d4be19c02fc2326d2d5978d.jpg', '2016-11-07 09:10:54');

-- --------------------------------------------------------

--
-- Table structure for table `configuration`
--

CREATE TABLE `configuration` (
  `id` int(11) NOT NULL,
  `auto_pay` int(1) NOT NULL DEFAULT '0',
  `pp_email` varchar(255) NOT NULL,
  `pp_sandbox` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `configuration`
--

INSERT INTO `configuration` (`id`, `auto_pay`, `pp_email`, `pp_sandbox`) VALUES
(1, 0, 'psychics-merchant@gmail.com', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `experts_info`
--

CREATE TABLE `experts_info` (
  `id` int(11) NOT NULL,
  `expert_id` int(11) NOT NULL,
  `expert_type` int(11) NOT NULL,
  `short_description` text NOT NULL,
  `bried_description` text NOT NULL,
  `services` text NOT NULL,
  `degrees` text NOT NULL,
  `expert_qualifications` text NOT NULL,
  `mail_price` varchar(255) NOT NULL,
  `chat_price` float NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `usex` varchar(50) NOT NULL,
  `paym_email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `expert_status` enum('1','2','3') NOT NULL,
  `expert_order` int(11) NOT NULL DEFAULT '0',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `experts_info`
--

INSERT INTO `experts_info` (`id`, `expert_id`, `expert_type`, `short_description`, `bried_description`, `services`, `degrees`, `expert_qualifications`, `mail_price`, `chat_price`, `name`, `surname`, `birthday`, `usex`, `paym_email`, `image`, `expert_status`, `expert_order`, `update_date`) VALUES
(8, 15, 16, 'My name is Hrair and I specialize in Angel Cards.', 'Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцовLorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцовLorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцовLorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцовLorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов', 'Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцовLorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцовLorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцовLorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцовLorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов', 'Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцовLorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцовLorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцовLorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцовLorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов', 'Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцовLorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцовLorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцовLorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов', '15', 7.21, 'Hrair', 'HR HR', '2016-04-15', 'female', 'vaxo@mail.ru', '598a03f9ba1a80e6d5374ae6fc74f4c5.png', '1', 3, '2017-05-04 14:22:29'),
(11, 19, 21, '', 'My clients range from TV Personalities (UK) to Friends and Family and I have over 20 years experience as a reader. I am accurate and honest and offer full guided readings without fairytales. I will always look at your situation and offer you the best course of action to ensure that your future is the best it can be', 'I was drawn to spirituality and the mystic sciences at an early age, and found immediately that my life felt better for it. I knew I had a purpose and when I began reading for others, I knew what my purpose was. It was to help and guide people though their lives and give them the vision of where their lives would take them.', 'In my work I use a unique way of reading which allows me to work with your Life Path. From the moment we are born we have a unique Life Path which has many aspects of your future already set in stone. Learning to read and interpret this path has become my passion for over 10 years. It is now my preferred methos of reading as it allows for clarity. It allows for me to look deeply into the past, present and future to find the best outcome for any situation you are in, or any problem you have, and to provide you with the most accurate answers.\r\n\r\nWhat I see, truly does happen. As an experienced Life Path reader you can be assured of nothing but the best insight into your situation.', 'When you are having readings, it is important to remember that we are all born with the important instinct of "FREE WILL". This allows for us to learn from ourselves, our own movements and mistakes so as to be able to make our own decisions in life. This action of "FREE WILL" has a huge impact on your life and so it is always best to remember that although the path can show your best direction, you must do that of your own want and need.\r\n\r\nAnother reason I am drawn to this method of reading is because we are able to see outcomes that are FIXED ! In most cases, free will only changes the way the outcome is reached and not the outcome itself. This is why it is generally such an accurate tool to use for predicting future events.\r\n\r\nA reading with me will not just provide you insight, but it will give you true and honest direction to reach for your desired goal or outcome and it is NEVER TOO LATE to attract the outcome you desire. A reading with me should also be fun, reflective and allow you to be as open and honest as you feel you need to be. I will NEVER judge and I will NEVER lie. Every reading is confidential to the both of us.\r\n\r\nI hope to hear from you soon so that you can start your journey.', '10', 0, 'Dr Sunny Marie', 'Dr Sunny Marie', '0033-03-31', 'female', '', 'af53e7563c5f2ae68c7804448e12e3be.jpg', '1', 0, '2016-12-24 10:58:24'),
(13, 28, 26, '', 'Hello world', 'i am a monster', 'bachelor', 'nice skills', '25', 0, 'Hr voice', 'voice of Expert', '1111-03-31', '', '', '2516840b2f0598cd658675bc84603221.jpg', '1', 0, '2016-12-24 10:58:33'),
(15, 33, 16, '', 'testetstetse', 'tetsetste', 'testetee', 'tstetste', '3', 4.78, 'alalalla', 'Sajid', '0001-01-01', '', '', 'dbc51318c38f6f317946260aa0cc3c24.png', '1', 0, '2017-01-07 13:11:30'),
(16, 34, 26, '', 'testetste', 'testetste', 'testetste', 'testetse', '1', 0, 'Aleem Sajid', 'Sajid', '0033-03-31', 'male', '', '17e4c287d9942ee825a02c118b3defd1.jpg', '1', 0, '2016-12-24 10:58:30'),
(17, 35, 22, '', 'Psychic Reader & Love Specialist. With over 17 years of experience to help guide you to the right path you deserve.', 'I offer many different types of readings to suit your every need, I help in all life matters such as…', 'I offer many different types of readings to suit your every need, I help in all life matters such as…', 'I offer many different types of readings to suit your every need, I help in all life matters such as…', '1', 0, 'Aleem Sajid', 'Sajid', '0000-00-00', 'female', '', '163144c29611a6e2aef9ea41fbbd262c.png', '1', 2, '2017-05-04 14:23:16'),
(18, 36, 28, '', 'I am a 4th generation psychic medium and healer from a lineage of very spiritual and empathetic person.', 'I was born a psychic.\r\ned for his psychic abilities and for healing others.', 'It was in my childhood that my psychic ability became apparent with prophetic dreams.', 'I experienced a traumatic situation in which a loved one crossed over. Their passing was one of the biggest moments in my life.', '10', 0, 'Aleem Sajid', 'Sajid', '0888-08-08', 'male', '', 'f0134f4ebd1c56f54f85d17188102c62.JPG', '1', 4, '2017-05-04 14:23:16'),
(20, 40, 29, '', 'saasagasgasgsag', 'asgsagsagasgsagasgasg', 'gasasgasgasgsag', 'asgasgasgasg', '10', 6.99, '', '', '0000-00-00', '', '', 'no_img.png', '2', 3, '2017-05-04 14:23:16');

-- --------------------------------------------------------

--
-- Table structure for table `expert_categories`
--

CREATE TABLE `expert_categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(200) NOT NULL,
  `category_slug` varchar(200) NOT NULL,
  `cat_image` varchar(255) NOT NULL,
  `status` enum('1','2') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expert_categories`
--

INSERT INTO `expert_categories` (`id`, `category_name`, `category_slug`, `cat_image`, `status`) VALUES
(16, 'Angel Cards', 'angel-cards', '6d712b331c674edac6a3ac9aad88887c.png', '1'),
(21, 'Horoscope', 'horoscope', '267a4cbde056a03ff580fb83510c70ce.png', '1'),
(26, 'Numerology', 'numerology', '9efe5d15b51c0e4b86dbe0ff00305421.png', '1'),
(22, 'Love & Romance', 'love-romance', '5d57687808b874117c656b06ac248b56.png', '1'),
(28, 'Love and sex', 'love-sex', 'da1eb22b14cc0696feedcf0a2199498b.png', '1'),
(29, 'Career & Work', 'career-work', 'da3a0cdf5a429c04a60e978d3a5e06d8.png', '1'),
(30, 'Tarot', 'tarot', 'db32e6bd816b41865919e8ebb9fe6006.png', '1'),
(35, ' Spiritual Giudance', 'spiritual-giudance                    ', '487bb43f5093b340e12a3fc32d3091ba.png', '1');

-- --------------------------------------------------------

--
-- Table structure for table `expert_clients`
--

CREATE TABLE `expert_clients` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `expert_id` int(11) NOT NULL,
  `type` enum('message','chat') NOT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expert_clients`
--

INSERT INTO `expert_clients` (`id`, `client_id`, `expert_id`, `type`, `date`) VALUES
(6, 27, 15, 'chat', '2017-05-05 07:12:26'),
(7, 27, 15, 'message', '2017-04-13 05:16:42');

-- --------------------------------------------------------

--
-- Table structure for table `expert_skills`
--

CREATE TABLE `expert_skills` (
  `id` int(11) NOT NULL,
  `expert_id` int(10) NOT NULL,
  `specializing` varchar(250) NOT NULL,
  `bried_description` text NOT NULL,
  `services` text NOT NULL,
  `degrees` text NOT NULL,
  `qualifications` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `favorite_list`
--

CREATE TABLE `favorite_list` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `expert_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `favorite_list`
--

INSERT INTO `favorite_list` (`id`, `client_id`, `expert_id`) VALUES
(23, 20, 15),
(64, 31, 15),
(70, 16, 28),
(73, 38, 19),
(87, 27, 35),
(88, 27, 35),
(91, 27, 15);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(10) UNSIGNED NOT NULL,
  `from_id` int(10) NOT NULL,
  `to_id` int(10) NOT NULL,
  `message` text NOT NULL,
  `star` varchar(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `from_id`, `to_id`, `message`, `star`, `time`) VALUES
(1, 15, 0, 'your comments...', '3', '2016-11-08 14:11:56'),
(2, 27, 0, 'ghjgh', '3', '2016-11-08 14:11:56'),
(3, 38, 0, 'your comments...', '3', '2016-11-08 14:11:56'),
(4, 27, 15, 'Horiojgp', '5', '2016-11-08 14:11:56'),
(5, 27, 15, 'hjh hjh hjhj', '1', '2016-11-08 14:11:56'),
(6, 27, 15, 'Good :)\r\n', '5', '2016-11-08 14:11:56'),
(7, 27, 15, 'very accurte ', '2', '2016-11-08 14:11:56'),
(8, 33, 0, 'nndnnwdnwjdw', '5', '2016-11-08 14:11:56'),
(9, 38, 19, 'LOovey reading ', '4', '2016-11-08 14:11:56'),
(10, 27, 19, 'your comments...', '5', '2016-11-08 14:11:56'),
(11, 27, 19, 'your comments...', '5', '2016-11-08 14:11:56'),
(12, 27, 19, 'your comments...', '2', '2016-11-08 14:11:56'),
(13, 27, 19, 'great Reader ', '3', '2016-11-08 14:11:56'),
(14, 27, 19, 'great Reader ', '5', '2016-11-08 14:11:56'),
(15, 27, 15, 'your comments...', '5', '2016-11-08 14:11:56'),
(16, 27, 15, ' You don''t have any blocked clients\r\n', '5', '2016-11-08 14:11:56'),
(17, 38, 19, 'your comments...cool', '5', '2016-11-08 14:11:56'),
(18, 27, 15, 'your comments...', '4', '2016-11-08 14:11:56'),
(19, 27, 19, 'Really nice  reader ', '5', '2016-11-08 14:11:56'),
(20, 27, 33, 'your comments...', '3', '2016-11-08 14:11:56'),
(21, 27, 33, 'your comments...', '5', '2016-11-08 14:11:56'),
(22, 27, 15, 'your comments...', '5', '2016-11-08 14:11:56'),
(23, 15, 0, 'your comments...', '3', '2016-11-08 14:11:56'),
(24, 27, 0, 'Aleem', '5', '2016-11-08 14:38:04'),
(25, 15, 0, 'aleem', '1', '2016-11-09 11:09:39'),
(26, 15, 0, 'your comments...Contract suspended', '1', '2016-11-10 15:42:30'),
(27, 15, 0, 'your comments...', '1', '2016-11-11 19:19:45'),
(28, 38, 0, 'your comments...', '3', '2016-11-15 21:11:22'),
(29, 27, 33, 'Nice reading \r\n', '5', '2016-11-29 13:38:09'),
(30, 27, 33, 'fuck .....', '1', '2016-11-29 13:39:07'),
(31, 27, 33, 'Super accurate psychic! Predictions have always come true in the past and I am looking forward to new ones to come to pass. Thank you for a lovely reading and for being so patient :)\r\n', '3', '2016-11-29 13:45:40'),
(32, 27, 33, 'Super accurate psychic! Predictions have always come true in the past and I am looking forward to new ones to come to pass. Thank you for a lovely reading and for being so patient :)\r\n\r\nent :)\r\n', '5', '2016-11-29 13:49:05'),
(33, 27, 33, 'watever said was not ryt as per the situation....but waited for his prediction to come true..but it did not turn correct..ty ty ty\r\n', '1', '2016-11-29 13:50:31'),
(34, 27, 33, 'We are committed to your complete satisfaction. If for any reason you feel your first psychic is not a good match, end your reading and contact Customer Service. We''ll credit your account for up to 10 minutes so you can find another advisor who is better suited for you.', '1', '2016-11-29 18:53:04'),
(35, 27, 15, 'Spot on even saying "he wants to be left alone" exactly his words and seems depressed or battling something. I hope there isn''t another woman	\r\n', '5', '2016-11-30 16:48:28'),
(36, 27, 15, 'Lav Expert', '1', '2016-12-12 16:36:55'),
(37, 27, 15, 'Hayer', '1', '2016-12-12 16:48:20'),
(38, 27, 15, 'your comments...', '4', '2016-12-12 17:12:08'),
(39, 27, 15, 'shat lav expert', '1', '2016-12-12 19:27:33'),
(40, 27, 15, 'Es inch lav experter', '5', '2016-12-13 18:00:23'),
(41, 27, 15, 'It was good he provided me a lot of helo thanks to him', '3', '2016-12-14 14:31:08'),
(42, 27, 15, 'dfgdfdfdggdgf', '5', '2016-12-17 19:31:50'),
(43, 27, 15, 'GExam', '5', '2017-02-11 10:19:13'),
(44, 27, 15, 'gexam', '4', '2017-02-12 09:48:07'),
(45, 27, 15, 'great Expert Thanks', '5', '2017-02-15 19:46:05'),
(46, 27, 15, 'THE WORLDS BEST EXPERT :))', '5', '2017-02-15 19:55:10'),
(47, 27, 15, 'it was awesome', '4', '2017-03-31 17:14:54'),
(48, 27, 15, 'test', '3', '2017-05-04 22:57:31');

-- --------------------------------------------------------

--
-- Table structure for table `free_messages`
--

CREATE TABLE `free_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `who_id` int(10) NOT NULL,
  `whom_id` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `free_messages`
--

INSERT INTO `free_messages` (`id`, `who_id`, `whom_id`) VALUES
(25, 33, 27);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `expert_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `sent_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paid_time` datetime DEFAULT NULL,
  `is_paid` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `expert_id`, `client_id`, `subject`, `amount`, `sent_time`, `paid_time`, `is_paid`) VALUES
(1, 15, 27, 'First Subject', 100, '2017-03-29 21:19:14', '2017-03-29 09:38:17', 1),
(2, 15, 27, 'hey', 150, '2017-03-29 21:26:47', '2017-03-29 09:38:17', 1),
(3, 15, 27, 'hey', 123, '2017-03-29 21:29:01', '2017-03-29 09:38:18', 1),
(4, 15, 27, 'hey', 200, '2017-03-29 21:30:03', '2017-03-29 09:38:18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `from_user_id` int(10) UNSIGNED NOT NULL,
  `to_user_id` int(10) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `subject` varchar(50) NOT NULL,
  `payment_id` int(11) NOT NULL DEFAULT '0',
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `ring` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `from_user_id`, `to_user_id`, `message`, `time`, `subject`, `payment_id`, `read`, `ring`) VALUES
(13, 27, 15, 'sdafasfasdf', '2017-03-28 21:13:14', 'abc', 0, 1, 1),
(11, 27, 15, 'asdfasfasfd', '2017-03-28 21:09:33', 'Test', 0, 0, 1),
(12, 27, 15, 'abcdefg', '2017-03-28 21:12:58', 'Test', 0, 0, 1),
(14, 15, 27, 'hey', '2017-03-28 21:13:49', 'abc', 0, 0, 1),
(15, 15, 27, 'asdasfd', '2017-03-28 21:14:38', 'abc', 0, 0, 1),
(16, 15, 27, 'test', '2017-03-28 21:14:51', 'abc', 0, 0, 1),
(17, 15, 27, 'asdfasdfasfsdaf', '2017-03-28 21:15:00', 'abc', 0, 0, 1),
(18, 15, 27, 'test', '2017-03-28 21:15:15', 'abc', 0, 0, 1),
(19, 15, 27, 'asdfsafdasdf', '2017-03-28 21:15:22', 'abc', 0, 0, 1),
(20, 27, 15, 'test', '2017-03-28 21:18:13', 'abc', 0, 1, 1),
(21, 27, 15, 'abcdfasdf', '2017-03-28 21:18:22', 'abc', 0, 1, 1),
(22, 27, 15, 'what!!!', '2017-03-28 21:18:30', 'abc', 0, 1, 1),
(23, 27, 15, 'test', '2017-03-28 21:18:45', 'abc', 0, 1, 1),
(24, 27, 15, 'abc', '2017-03-28 21:18:55', 'abc', 0, 1, 1),
(25, 27, 15, 'test', '2017-03-28 21:19:14', 'abc', 0, 1, 1),
(26, 27, 15, 'this is another test', '2017-03-29 02:23:08', 'another test', 0, 1, 1),
(27, 15, 27, 'nice', '2017-03-29 02:23:50', 'another test', 0, 0, 1),
(28, 27, 15, 'asaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2017-03-29 02:30:04', 'testadfsadf', 0, 1, 1),
(29, 27, 15, 'what', '2017-03-29 02:33:41', 'another test', 0, 0, 1),
(30, 27, 15, 'teaasdfsafasfasdf', '2017-03-29 02:35:36', 'First Subject', 0, 1, 1),
(31, 27, 15, 'teaasdfsafasfasdf', '2017-03-29 02:35:52', 'First Subject', 0, 1, 1),
(32, 27, 15, 'teaasdfsafasfasdf', '2017-03-29 02:38:10', 'First Subject', 0, 1, 1),
(33, 27, 15, 'sdafsdafacxzvvvvvvvvvvvvvvvvvvv', '2017-03-29 02:43:23', 'asfdasfdasfdsadf', 0, 1, 1),
(34, 15, 27, 'message looks great :D', '2017-03-29 02:47:56', 'testadfsadf', 0, 1, 1),
(35, 27, 15, 'test', '2017-03-29 03:52:44', 'test', 0, 0, 1),
(36, 27, 15, 'asdfsdafsdafsdafassfda', '2017-03-29 04:11:34', 'testasdfasdfasdfsdafafds', 0, 0, 1),
(37, 27, 15, 'test', '2017-03-29 04:12:24', '111', 0, 0, 1),
(38, 27, 15, 'abcasfd', '2017-03-29 04:14:24', 'hey', 0, 1, 1),
(39, 27, 15, 'asdfsadf', '2017-03-29 04:14:38', 'another hey', 0, 1, 1),
(40, 27, 15, 'asdfasdfasfsadf', '2017-03-29 07:00:32', 'First Subject', 0, 1, 1),
(41, 15, 27, 'Decline if an advisor offers you to pay outside the PsychicsVoice website. The offer may be fraudulent in result the swift account SuspensionDecline if an advisor offers you to pay outside the PsychicsVoice website. The offer may be fraudulent in result the swift account SuspensionDecline if an advisor offers you to pay outside the PsychicsVoice website. The offer may be fraudulent in result the swift account SuspensionDecline if an advisor offers you to pay outside the PsychicsVoice website. The offer may be fraudulent in result the swift account Suspension', '2017-03-29 07:11:24', 'First Subject', 0, 1, 1),
(42, 15, 27, 'hi', '2017-03-29 21:27:48', 'hey', 0, 1, 1),
(43, 27, 15, 'hi', '2017-04-13 17:16:42', 'hey', 98, 1, 1),
(44, 15, 27, 'hello', '2017-05-05 07:19:28', 'hey', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `expert_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `amount` float NOT NULL,
  `trx_id` varchar(255) NOT NULL DEFAULT '0',
  `currency_code` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` enum('top_up','pay') NOT NULL,
  `payment_type` enum('chat','message','invoice','payment','withdraw') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `client_id`, `expert_id`, `amount`, `trx_id`, `currency_code`, `date`, `type`, `payment_type`) VALUES
(1, 27, 15, 0.1, '0', 'USD', '2017-02-25 16:41:33', 'top_up', 'chat'),
(2, 27, 15, 0.24, '0', 'USD', '2017-02-25 16:43:12', 'top_up', 'chat'),
(3, 27, 15, 15, '58b2f9a76cb07', 'USD', '2017-02-26 03:52:07', 'top_up', 'message'),
(4, 27, 15, 0.26, '0', 'USD', '2017-02-28 07:46:12', 'top_up', 'chat'),
(5, 27, 15, 0.16, '0', 'USD', '2017-03-02 18:46:57', 'top_up', 'withdraw'),
(6, 27, 15, 0.28, '0', 'USD', '2017-03-02 18:50:37', 'top_up', 'chat'),
(7, 27, 15, 15, '58b869df6f416', 'USD', '2017-03-02 06:52:15', 'top_up', 'message'),
(8, 27, 15, 15, '58cc66d547cfb', 'USD', '2017-03-17 18:44:37', 'top_up', 'withdraw'),
(9, 27, 15, 15, '58cc68d1371ed', 'USD', '2017-03-17 18:53:05', 'top_up', 'message'),
(10, 27, 15, 15, '58cc69441951d', 'USD', '2017-03-17 18:55:00', 'top_up', 'message'),
(11, 27, 15, 15, '58cc694dd7736', 'USD', '2017-03-17 18:55:09', 'top_up', 'message'),
(12, 27, 15, 50, '58d1a2af1ffe1', 'USD', '2017-03-21 18:01:19', 'top_up', 'invoice'),
(13, 27, 15, 50, '58d1a3f30d4af', 'USD', '2017-03-21 18:06:43', 'top_up', 'invoice'),
(14, 27, 15, 50, '58d1a430b2562', 'USD', '2017-03-21 18:07:44', 'top_up', 'invoice'),
(15, 27, 15, 50, '58d1a4d774f55', 'USD', '2017-03-21 18:10:31', 'top_up', 'invoice'),
(16, 27, 15, 200, '58d1a4e9b6030', 'USD', '2017-03-21 18:10:49', 'top_up', 'withdraw'),
(17, 27, 15, 50, '58d26e943e76d', 'USD', '2017-03-21 20:31:16', 'top_up', 'invoice'),
(18, 27, 15, 100, '58d26f6175242', 'USD', '2017-03-21 20:34:41', 'top_up', 'invoice'),
(19, 27, 15, 50, '58d26f6190a1c', 'USD', '2017-03-21 20:34:41', 'top_up', 'invoice'),
(20, 27, 15, 200, '58d26f61b839e', 'USD', '2017-03-21 20:34:41', 'top_up', 'invoice'),
(21, 27, 15, 15, '58d4512334923', 'USD', '2017-03-23 18:50:11', 'top_up', 'message'),
(22, 27, 15, 15, '58d4514a42613', 'USD', '2017-03-23 18:50:50', 'top_up', 'message'),
(23, 27, 15, 15, '58d451947a417', 'USD', '2017-03-23 18:52:04', 'top_up', 'message'),
(24, 27, 15, 15, '58d4537f2edbd', 'USD', '2017-03-23 19:00:15', 'top_up', 'message'),
(25, 27, 15, 15, '58d453d9446e5', 'USD', '2017-03-23 19:01:45', 'top_up', 'message'),
(26, 27, 15, 15, '58d4572b110b9', 'USD', '2017-03-23 19:15:55', 'top_up', 'message'),
(27, 27, 15, 15, '58d45758a59b8', 'USD', '2017-03-23 19:16:40', 'top_up', 'message'),
(28, 27, 15, 15, '58d45785126b7', 'USD', '2017-03-23 19:17:25', 'top_up', 'message'),
(29, 27, 15, 15, '58d53e48883db', 'USD', '2017-03-23 23:42:00', 'top_up', 'message'),
(30, 27, 15, 15, '58d53e756ff6e', 'USD', '2017-03-23 23:42:45', 'top_up', 'message'),
(31, 27, 15, 15, '58d53ece9a552', 'USD', '2017-03-23 23:44:14', 'top_up', 'message'),
(32, 27, 15, 15, '58d541f93925d', 'USD', '2017-03-23 23:57:45', 'top_up', 'message'),
(33, 27, 15, 15, '58d5420b23af5', 'USD', '2017-03-23 23:58:03', 'top_up', 'message'),
(34, 27, 15, 15, '58d5a511e6fd2', 'USD', '2017-03-24 19:00:33', 'top_up', 'message'),
(35, 27, 15, 15, '58d5a562ae0d8', 'USD', '2017-03-24 19:01:54', 'top_up', 'message'),
(36, 27, 15, 15, '58d5a564d4f3c', 'USD', '2017-03-24 19:01:56', 'top_up', 'message'),
(37, 27, 15, 15, '58d5a5678d872', 'USD', '2017-03-24 19:01:59', 'top_up', 'message'),
(38, 27, 15, 15, '58d5a56b801ee', 'USD', '2017-03-24 19:02:03', 'top_up', 'message'),
(39, 27, 15, 15, '58d5a6178c73d', 'USD', '2017-03-24 19:04:55', 'top_up', 'message'),
(40, 27, 15, 15, '58d5a66b01cfa', 'USD', '2017-03-24 19:06:19', 'top_up', 'message'),
(41, 27, 15, 15, '58d5bd910b866', 'USD', '2017-03-24 20:45:05', 'top_up', 'message'),
(42, 27, 15, 15, '58d5bdbd9e2fb', 'USD', '2017-03-24 20:45:49', 'top_up', 'message'),
(43, 27, 15, 15, '58d5bebe429e9', 'USD', '2017-03-24 20:50:06', 'top_up', 'message'),
(44, 27, 15, 15, '58d5bef92f5f4', 'USD', '2017-03-24 20:51:05', 'top_up', 'message'),
(45, 27, 15, 15, '58d5c05d88f3b', 'USD', '2017-03-24 20:57:01', 'top_up', 'message'),
(46, 27, 15, 15, '58d5c0a523a26', 'USD', '2017-03-24 20:58:13', 'top_up', 'message'),
(47, 27, 15, 15, '58d5d39493af2', 'USD', '2017-03-24 22:19:00', 'top_up', 'message'),
(48, 27, 15, 15, '58d5d6407373f', 'USD', '2017-03-24 22:30:24', 'top_up', 'message'),
(49, 27, 15, 15, '58d5d666153e5', 'USD', '2017-03-24 22:31:02', 'top_up', 'message'),
(50, 27, 15, 15, '58d5d6f322bf1', 'USD', '2017-03-24 22:33:23', 'top_up', 'message'),
(51, 27, 15, 15, '58d5d74b123cf', 'USD', '2017-03-24 22:34:51', 'top_up', 'message'),
(52, 27, 15, 15, '58d5d75d61add', 'USD', '2017-03-24 22:35:09', 'top_up', 'message'),
(53, 27, 15, 15, '58d5dade6baeb', 'USD', '2017-03-24 22:50:06', 'top_up', 'message'),
(54, 27, 15, 15, '58d5dae2ee33c', 'USD', '2017-03-24 22:50:10', 'top_up', 'message'),
(55, 27, 15, 15, '58d6fb409a484', 'USD', '2017-03-25 19:20:32', 'top_up', 'message'),
(56, 27, 15, 15, '58d6fb61890c4', 'USD', '2017-03-25 19:21:05', 'top_up', 'message'),
(57, 27, 15, 15, '58d6fb7ec8f36', 'USD', '2017-03-25 19:21:34', 'top_up', 'message'),
(58, 27, 15, 15, '58d6fceb3877f', 'USD', '2017-03-25 19:27:39', 'top_up', 'message'),
(59, 27, 15, 15, '58da583968d5b', 'USD', '2017-03-27 20:34:01', 'top_up', 'message'),
(60, 27, 15, 15, '58da586c36b62', 'USD', '2017-03-27 20:34:52', 'top_up', 'message'),
(61, 27, 15, 15, '58da5c2e2c62e', 'USD', '2017-03-27 20:50:54', 'top_up', 'message'),
(62, 27, 15, 15, '58da5c5e4b5b0', 'USD', '2017-03-27 20:51:42', 'top_up', 'message'),
(63, 27, 15, 15, '58da5c5e824c6', 'USD', '2017-03-27 20:51:42', 'top_up', 'message'),
(64, 27, 15, 15, '58da5c898c805', 'USD', '2017-03-27 20:52:25', 'top_up', 'message'),
(65, 27, 15, 15, '58da5da3ab68e', 'USD', '2017-03-27 20:57:07', 'top_up', 'message'),
(66, 27, 15, 15, '58da5dba2f692', 'USD', '2017-03-27 20:57:30', 'top_up', 'message'),
(67, 27, 15, 15, '58da608de40a0', 'USD', '2017-03-27 21:09:33', 'top_up', 'message'),
(68, 27, 15, 15, '58da6295a99e2', 'USD', '2017-03-27 21:18:13', 'top_up', 'message'),
(69, 27, 15, 15, '58da629e673b8', 'USD', '2017-03-27 21:18:22', 'top_up', 'message'),
(70, 27, 15, 15, '58da62a6847f2', 'USD', '2017-03-27 21:18:30', 'top_up', 'message'),
(71, 27, 15, 15, '58da62b518011', 'USD', '2017-03-27 21:18:45', 'top_up', 'message'),
(72, 27, 15, 15, '58da62bf7aae1', 'USD', '2017-03-27 21:18:55', 'top_up', 'message'),
(73, 27, 15, 15, '58da62d201073', 'USD', '2017-03-27 21:19:14', 'top_up', 'message'),
(74, 27, 15, 15, '58daac857f3fe', 'USD', '2017-03-28 02:33:41', 'top_up', 'message'),
(75, 27, 15, 11.896, '0', 'USD', '2017-03-28 19:27:03', 'top_up', 'chat'),
(76, 27, 15, 15, '58dabf0c3fa3d', 'USD', '2017-03-28 03:52:44', 'top_up', 'message'),
(77, 27, 15, 15, '58dac376186ae', 'USD', '2017-03-29 04:11:34', 'top_up', 'message'),
(78, 27, 15, 15, '58dac3a86472b', 'USD', '2017-03-29 04:12:24', 'top_up', 'message'),
(79, 27, 15, 15, '58dac41ff3f4e', 'USD', '2017-03-29 04:14:23', 'top_up', 'message'),
(80, 27, 15, 15, '58dac42e7f8ad', 'USD', '2017-03-29 04:14:38', 'top_up', 'message'),
(81, 27, 15, 100, '58dbb57be90ff', 'USD', '2017-03-29 01:24:11', 'top_up', 'invoice'),
(82, 27, 15, 100, '58dbb68aa0eef', 'USD', '2017-03-29 01:28:42', 'top_up', 'invoice'),
(83, 27, 15, 150, '58dbb68ab6cda', 'USD', '2017-03-29 01:28:42', 'top_up', 'invoice'),
(84, 27, 15, 100, '58dbb6c926d86', 'USD', '2017-03-29 01:29:45', 'top_up', 'invoice'),
(85, 27, 15, 150, '58dbb6c94efd9', 'USD', '2017-03-29 01:29:45', 'top_up', 'invoice'),
(86, 27, 15, 123, '58dbb6c979a59', 'USD', '2017-03-29 01:29:45', 'top_up', 'invoice'),
(87, 27, 15, 100, '58dbb6e2a74e4', 'USD', '2017-03-29 01:30:10', 'top_up', 'invoice'),
(88, 27, 15, 150, '58dbb6e2c138b', 'USD', '2017-03-29 01:30:10', 'top_up', 'invoice'),
(89, 27, 15, 123, '58dbb6e2d9a0b', 'USD', '2017-03-29 01:30:10', 'top_up', 'invoice'),
(90, 27, 15, 200, '58dbb6e2f000c', 'USD', '2017-03-29 01:30:10', 'top_up', 'invoice'),
(91, 27, 15, 100, '58dbb8c9d1674', 'USD', '2017-03-29 01:38:17', 'top_up', 'invoice'),
(92, 27, 15, 150, '58dbb8c9ed60f', 'USD', '2017-03-29 01:38:17', 'top_up', 'invoice'),
(93, 27, 15, 123, '58dbb8ca0d977', 'USD', '2017-03-29 01:38:18', 'top_up', 'invoice'),
(94, 27, 15, 200, '58dbb8ca28343', 'USD', '2017-03-29 01:38:18', 'top_up', 'invoice'),
(95, 27, 15, 2.163, '0', 'USD', '2017-03-31 17:01:23', 'top_up', 'chat'),
(96, 27, 15, 5.17, '0', 'USD', '2017-03-31 17:05:33', 'top_up', 'chat'),
(97, 27, 15, 4.924, '0', 'USD', '2017-03-31 17:14:16', 'top_up', 'chat'),
(98, 27, 15, 15, '58ef41fa60299', 'USD', '2017-04-12 21:16:42', 'top_up', 'message'),
(101, 27, 15, 283.591, '0', 'USD', '2017-05-04 22:57:25', 'top_up', 'chat');

-- --------------------------------------------------------

--
-- Table structure for table `post_comments`
--

CREATE TABLE `post_comments` (
  `id` int(11) UNSIGNED NOT NULL,
  `post_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text,
  `create_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `expert_id` int(11) NOT NULL,
  `review` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `screen_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `email_verified` varchar(255) NOT NULL,
  `email_token` varchar(255) NOT NULL,
  `created_day` datetime NOT NULL,
  `updated_day` datetime NOT NULL,
  `last_visit` datetime NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `screen_name`, `email`, `password`, `type`, `email_verified`, `email_token`, `created_day`, `updated_day`, `last_visit`, `status`) VALUES
(15, 'Hrair', 'hrair@gmail.ru', '$2y$10$VZBjRRqowNZMwgMbXOx2JO/kayJwPpmhZQEDtpsqFsRzzQQPJmofK', 'expert', '', '', '2016-04-05 21:13:43', '2017-05-05 07:25:30', '2016-04-05 21:13:43', 1),
(16, '123456', 'joealeem@gmail.com', '$2y$10$4EJUjaAGic1WMQy/ELbgT.9GQAxy0EB6EYmEhPgTsKT/pLXHTVz8W', 'client', '', '', '2016-04-06 00:16:52', '2016-09-13 15:01:13', '2016-04-06 00:16:52', 1),
(19, 'Voice HR', 'aleemsajid123@gmail.com', '$2y$10$8j5v5a12yvY7gZMzO/hpkO6HBG9Pi.GkSCMJjni3pJVS2G0W0s6sa', 'expert', '', '', '2016-04-06 23:30:07', '2016-11-14 18:46:39', '2016-04-06 23:30:07', 1),
(20, 'kamera222', 'hrair5@inbox.ru', '$2y$10$U5l9.AjUssrkpwUgcPuVNOKpc3TefQjavTBW/RgQ7homkQpogBrQa', 'client', '', '', '2016-04-07 02:24:25', '2016-05-14 00:50:34', '2016-04-07 02:24:25', 1),
(27, 'Gevor', 'gevor096@mail.ru', '$2y$10$EfevnOwJf/Xpvjxxp.Kx9.EIL/SP0uvIJpVtgE3xI/7gTW81z/65e', 'client', '', '', '2016-04-17 13:40:16', '2017-05-05 07:40:13', '2016-04-17 13:40:16', 1),
(28, 'hroexpert', 'hrairxxx@yahoo.com', '$2y$10$yVozYJoGRUmakB6MybdRZueX2vQLitutjXlsOCBVCe.ASb5ZqMLCO', 'expert', '', '', '2016-04-18 19:51:54', '2016-07-04 17:31:36', '2016-04-18 19:51:54', 1),
(29, 'Reading by Hr', 'danpicarel@gmail.com', '$2y$10$T1qfPYrWr6mwk3rDbJQ77eUkCJdPsp5PmwXku9MDoxbVMZf6MFsoq', 'client', '', '', '2016-04-22 04:36:05', '2016-10-11 22:06:53', '2016-04-22 04:36:05', 1),
(31, 'ARCAX', 'gevor0966@mail.ru', '$2y$10$ihFpt6MVAzj.yC6vwAjvqOzqcM9gXRo5m17wfK.g4ST4SENS.kdVS', 'client', '', '', '2016-05-09 23:38:14', '0000-00-00 00:00:00', '2016-05-09 23:38:14', 1),
(32, 'kamera22', 'hro200@mail.ru', '$2y$10$CaYzZrKpjcYf/dKU6CbPpuRPpeDUdmvypYDW24X3xKzB9UKjI2Wc2', 'client', '', '', '2016-05-15 17:36:56', '2016-05-19 00:51:06', '2016-05-15 17:36:56', 1),
(33, 'Reading by HR', 'aleemnl54a@gmail.com', '$2y$10$8O6K2QJPwWwUH00KChPsA.VHSId1hPPsCJT./4llc.ewQu5F1E32a', 'expert', '', '', '2016-05-16 22:12:56', '2016-11-29 20:19:24', '2016-05-16 22:12:56', 1),
(34, 'Sylvia the Power', 'wisejonna@gmail.com', '$2y$10$utRkbY530Rpr7ISWEz3O5O3rCaUa80tGgDONpSwXtE1w4JS23sGai', 'expert', '', '', '2016-05-16 22:21:00', '2016-05-22 00:52:22', '2016-05-16 22:21:00', 2),
(35, 'Madam Dorene', 'wisejoannavoice@gmail.com', '$2y$10$aY2QCPyqMee2KaMxcByBIu7dj1MFUwqhx.hRCO1P3/rC8WNtUUSu2', 'expert', '', '', '2016-05-16 22:26:52', '2016-05-16 22:49:25', '2016-05-16 22:26:52', 1),
(36, 'Psychic Golden Eye', 'uslocascio@gmail.com', '$2y$10$CGHo7HqlGrKffTKxriSj.uwnpdrU7DWQCfQilcZdM9ODfj4eRbPdW', 'expert', '', '', '2016-06-04 01:35:16', '2016-06-04 01:55:03', '2016-06-04 01:35:16', 1),
(38, 'Lee52a', 'danpicarel123@gmail.com', '$2y$10$Df68Wk/RpudqVr.Sj0EvcehuNlKejJa4MC1E5Q24aqFeG5yzwvJAC', 'client', '', '', '2016-09-14 14:15:41', '2016-11-28 19:31:41', '2016-09-14 14:15:41', 1),
(40, 'Gexamna', 'gexam@mail.ru', '$2y$10$uJiDMr0djgGdrM7kOvcVYedXhPZ61N20MYOOFgKKB8IL5TpIYiMQS', 'expert', '', '', '2016-12-15 20:00:41', '2017-01-21 20:56:30', '2016-12-15 20:00:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_balances`
--

CREATE TABLE `users_balances` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_balances`
--

INSERT INTO `users_balances` (`id`, `user_id`, `amount`, `created_at`) VALUES
(1, 27, '25.00', '2017-01-29 03:01:11'),
(2, 27, '50.00', '2017-01-29 03:07:44'),
(3, 27, '1.00', '2017-01-29 03:25:33'),
(4, 27, '1.00', '2017-01-29 03:33:52'),
(5, 27, '-15', '2017-02-04 09:58:52'),
(6, 27, '-10', '2017-02-04 10:48:24'),
(7, 27, '-15', '2017-02-04 14:25:56'),
(8, 27, '-15', '2017-02-04 14:34:20'),
(9, 27, '-15', '2017-02-04 14:35:46'),
(10, 27, '100.00', '2017-02-04 05:48:06'),
(11, 27, '100.00', '2017-02-04 05:49:16'),
(12, 27, '500.00', '2017-02-04 05:56:02'),
(40, 27, '0', '2017-02-18 21:06:04'),
(41, 27, '-3.76', '2017-02-18 21:18:55'),
(42, 15, '0', '2017-02-18 21:28:46'),
(43, 27, '100.00', '2017-02-19 00:46:50'),
(44, 15, '0', '2017-02-22 08:19:13'),
(45, 15, '0', '2017-02-25 08:39:47'),
(46, 15, '0', '2017-02-25 08:50:45'),
(47, 15, '0', '2017-02-25 08:51:56'),
(48, 15, '0', '2017-02-25 08:55:56'),
(49, 15, '522', '2017-02-25 10:01:06'),
(52, 27, '500.00', '2017-02-24 22:03:35'),
(53, 27, '5000', '2017-02-25 11:04:08'),
(55, 27, '100.00', '2017-02-24 23:05:26'),
(56, 27, '-0.18', '2017-02-24 23:31:22'),
(58, 27, '-0.22', '2017-02-24 23:55:09'),
(59, 27, '-0.04', '2017-02-24 23:56:37'),
(62, 27, '0', '2017-02-25 00:12:27'),
(63, 27, '0', '2017-02-25 00:18:13'),
(64, 27, '0', '2017-02-25 00:20:40'),
(65, 27, '0', '2017-02-25 00:33:53'),
(66, 27, '-0.42', '2017-02-25 00:37:28'),
(67, 27, '-0.9', '2017-02-25 00:40:49'),
(68, 27, '-0.14', '2017-02-25 00:45:07'),
(69, 27, '-0.08', '2017-02-25 00:51:23'),
(70, 27, '-0.28', '2017-02-25 04:04:21'),
(71, 27, '-0.66', '2017-02-25 04:16:51'),
(72, 27, '-0.12', '2017-02-25 04:20:01'),
(73, 27, '-0.22', '2017-02-25 04:21:17'),
(74, 27, '-0.08', '2017-02-25 04:22:45'),
(75, 27, '-0.14', '2017-02-25 04:28:46'),
(76, 27, '-0.34', '2017-02-25 04:30:06'),
(77, 27, '-0.08', '2017-02-25 04:32:42'),
(78, 27, '-0.28', '2017-02-25 04:36:10'),
(79, 27, '-0.1', '2017-02-25 04:37:51'),
(80, 27, '-0.58', '2017-02-25 04:39:31'),
(81, 27, '-0.1', '2017-02-25 04:41:33'),
(82, 27, '-0.24', '2017-02-25 04:43:12'),
(83, 27, '-15', '2017-02-26 03:52:07'),
(84, 27, '-0.26', '2017-02-28 07:46:12'),
(85, 27, '-0.16', '2017-03-02 06:46:57'),
(86, 27, '-0.28', '2017-03-02 06:50:37'),
(87, 27, '-15', '2017-03-02 06:52:15'),
(88, 27, '100.00', '2017-03-17 18:43:42'),
(89, 27, '-15', '2017-03-17 18:44:37'),
(90, 27, '-15', '2017-03-17 18:53:05'),
(91, 27, '-15', '2017-03-17 18:55:00'),
(92, 27, '-15', '2017-03-17 18:55:09'),
(93, 15, '7', '2017-03-17 18:55:09'),
(94, 27, '-50', '2017-03-21 18:01:19'),
(95, 15, '25', '2017-03-21 18:01:19'),
(96, 27, '-50', '2017-03-21 18:07:44'),
(97, 15, '25', '2017-03-21 18:07:44'),
(98, 27, '-50', '2017-03-21 18:10:31'),
(99, 15, '25', '2017-03-21 18:10:31'),
(100, 27, '-200', '2017-03-21 18:10:49'),
(101, 15, '100', '2017-03-21 18:10:49'),
(102, 27, '-50', '2017-03-21 20:31:16'),
(103, 15, '25', '2017-03-21 20:31:16'),
(104, 27, '-100', '2017-03-21 20:34:41'),
(105, 15, '50', '2017-03-21 20:34:41'),
(106, 27, '-50', '2017-03-21 20:34:41'),
(107, 15, '25', '2017-03-21 20:34:41'),
(108, 27, '-200', '2017-03-21 20:34:41'),
(109, 15, '100', '2017-03-21 20:34:41'),
(110, 27, '-15', '2017-03-23 18:50:11'),
(111, 15, '7', '2017-03-23 18:50:11'),
(112, 27, '-15', '2017-03-23 18:50:50'),
(113, 15, '7', '2017-03-23 18:50:50'),
(114, 27, '-15', '2017-03-23 18:52:04'),
(115, 15, '7', '2017-03-23 18:52:04'),
(116, 27, '-15', '2017-03-23 19:00:15'),
(117, 15, '7', '2017-03-23 19:00:15'),
(118, 27, '-15', '2017-03-23 19:01:45'),
(119, 15, '7', '2017-03-23 19:01:45'),
(120, 27, '-15', '2017-03-23 19:15:55'),
(121, 15, '7', '2017-03-23 19:15:55'),
(122, 27, '-15', '2017-03-23 19:16:40'),
(123, 15, '7', '2017-03-23 19:16:40'),
(124, 27, '-15', '2017-03-23 19:17:25'),
(125, 15, '7', '2017-03-23 19:17:25'),
(126, 27, '-15', '2017-03-23 23:42:00'),
(127, 15, '7', '2017-03-23 23:42:00'),
(128, 27, '-15', '2017-03-23 23:42:45'),
(129, 15, '7', '2017-03-23 23:42:45'),
(130, 27, '-15', '2017-03-23 23:44:14'),
(131, 15, '7', '2017-03-23 23:44:14'),
(132, 27, '-15', '2017-03-23 23:57:45'),
(133, 15, '7', '2017-03-23 23:57:45'),
(134, 27, '-15', '2017-03-23 23:58:03'),
(135, 15, '7', '2017-03-23 23:58:03'),
(136, 27, '-15', '2017-03-24 19:00:33'),
(137, 15, '7', '2017-03-24 19:00:33'),
(138, 27, '-15', '2017-03-24 19:01:54'),
(139, 15, '7', '2017-03-24 19:01:54'),
(140, 27, '-15', '2017-03-24 19:01:56'),
(141, 15, '7', '2017-03-24 19:01:56'),
(142, 27, '-15', '2017-03-24 19:01:59'),
(143, 15, '7', '2017-03-24 19:01:59'),
(144, 27, '-15', '2017-03-24 19:02:03'),
(145, 15, '7', '2017-03-24 19:02:03'),
(146, 27, '-15', '2017-03-24 19:04:55'),
(147, 15, '7', '2017-03-24 19:04:55'),
(148, 27, '-15', '2017-03-24 19:06:19'),
(149, 15, '7', '2017-03-24 19:06:19'),
(150, 27, '-15', '2017-03-24 20:45:05'),
(151, 15, '7', '2017-03-24 20:45:05'),
(152, 27, '-15', '2017-03-24 20:45:49'),
(153, 15, '7', '2017-03-24 20:45:49'),
(154, 27, '-15', '2017-03-24 20:50:06'),
(155, 15, '7', '2017-03-24 20:50:06'),
(156, 27, '-15', '2017-03-24 20:51:05'),
(157, 15, '7', '2017-03-24 20:51:05'),
(158, 27, '-15', '2017-03-24 20:57:01'),
(159, 15, '7', '2017-03-24 20:57:01'),
(160, 27, '-15', '2017-03-24 20:58:13'),
(161, 15, '7', '2017-03-24 20:58:13'),
(162, 27, '-15', '2017-03-24 22:19:00'),
(163, 15, '7', '2017-03-24 22:19:00'),
(164, 27, '-15', '2017-03-24 22:30:24'),
(165, 15, '7', '2017-03-24 22:30:24'),
(166, 27, '-15', '2017-03-24 22:31:02'),
(167, 15, '7', '2017-03-24 22:31:02'),
(168, 27, '-15', '2017-03-24 22:33:23'),
(169, 15, '7', '2017-03-24 22:33:23'),
(170, 27, '-15', '2017-03-24 22:34:51'),
(171, 15, '7', '2017-03-24 22:34:51'),
(172, 27, '-15', '2017-03-24 22:35:09'),
(173, 15, '7', '2017-03-24 22:35:09'),
(174, 27, '-15', '2017-03-24 22:50:06'),
(175, 15, '7', '2017-03-24 22:50:06'),
(176, 27, '-15', '2017-03-24 22:50:10'),
(177, 15, '7', '2017-03-24 22:50:11'),
(178, 27, '-15', '2017-03-25 19:20:32'),
(179, 15, '7', '2017-03-25 19:20:32'),
(180, 27, '-15', '2017-03-25 19:21:05'),
(181, 15, '7', '2017-03-25 19:21:05'),
(182, 27, '-15', '2017-03-25 19:21:34'),
(183, 15, '7', '2017-03-25 19:21:34'),
(184, 27, '-15', '2017-03-25 19:27:39'),
(185, 15, '7', '2017-03-25 19:27:39'),
(186, 27, '-15', '2017-03-27 20:34:01'),
(187, 15, '7', '2017-03-27 20:34:01'),
(188, 27, '-15', '2017-03-27 20:34:52'),
(189, 15, '7', '2017-03-27 20:34:52'),
(190, 27, '-15', '2017-03-27 20:50:54'),
(191, 15, '7', '2017-03-27 20:50:54'),
(192, 27, '-15', '2017-03-27 20:51:42'),
(193, 15, '7', '2017-03-27 20:51:42'),
(194, 27, '-15', '2017-03-27 20:51:42'),
(195, 15, '7', '2017-03-27 20:51:42'),
(196, 27, '-15', '2017-03-27 20:52:25'),
(197, 15, '7', '2017-03-27 20:52:25'),
(198, 27, '-15', '2017-03-27 20:57:07'),
(199, 15, '7', '2017-03-27 20:57:07'),
(200, 27, '-15', '2017-03-27 20:57:30'),
(201, 15, '7', '2017-03-27 20:57:30'),
(202, 27, '-15', '2017-03-27 21:09:33'),
(203, 15, '7', '2017-03-27 21:09:33'),
(204, 27, '-15', '2017-03-27 21:18:13'),
(205, 15, '7', '2017-03-27 21:18:13'),
(206, 27, '-15', '2017-03-27 21:18:22'),
(207, 15, '7', '2017-03-27 21:18:22'),
(208, 27, '-15', '2017-03-27 21:18:30'),
(209, 15, '7', '2017-03-27 21:18:30'),
(210, 27, '-15', '2017-03-27 21:18:45'),
(211, 15, '7', '2017-03-27 21:18:45'),
(212, 27, '-15', '2017-03-27 21:18:55'),
(213, 15, '7', '2017-03-27 21:18:55'),
(214, 27, '-15', '2017-03-27 21:19:14'),
(215, 15, '7', '2017-03-27 21:19:14'),
(216, 27, '-15', '2017-03-28 02:33:41'),
(217, 15, '7', '2017-03-28 02:33:41'),
(218, 27, '-11.896', '2017-03-28 03:27:03'),
(219, 15, '5', '2017-03-28 03:27:03'),
(220, 27, '-15', '2017-03-28 03:52:44'),
(221, 15, '7', '2017-03-28 03:52:44'),
(222, 27, '-15', '2017-03-29 04:11:34'),
(223, 15, '7', '2017-03-29 04:11:34'),
(224, 27, '-15', '2017-03-29 04:12:24'),
(225, 15, '7', '2017-03-29 04:12:24'),
(226, 27, '-15', '2017-03-29 04:14:24'),
(227, 15, '7', '2017-03-29 04:14:24'),
(228, 27, '-15', '2017-03-29 04:14:38'),
(229, 15, '7', '2017-03-29 04:14:38'),
(230, 27, '-100', '2017-03-29 01:24:11'),
(231, 15, '50', '2017-03-29 01:24:12'),
(232, 27, '-100', '2017-03-29 01:28:42'),
(233, 15, '50', '2017-03-29 01:28:42'),
(234, 27, '-150', '2017-03-29 01:28:42'),
(235, 15, '75', '2017-03-29 01:28:42'),
(236, 27, '-100', '2017-03-29 01:29:45'),
(237, 15, '50', '2017-03-29 01:29:45'),
(238, 27, '-150', '2017-03-29 01:29:45'),
(239, 15, '75', '2017-03-29 01:29:45'),
(240, 27, '-123', '2017-03-29 01:29:45'),
(241, 15, '61', '2017-03-29 01:29:45'),
(242, 27, '-100', '2017-03-29 01:30:10'),
(243, 15, '50', '2017-03-29 01:30:10'),
(244, 27, '-150', '2017-03-29 01:30:10'),
(245, 15, '75', '2017-03-29 01:30:10'),
(246, 27, '-123', '2017-03-29 01:30:10'),
(247, 15, '61', '2017-03-29 01:30:10'),
(248, 27, '-200', '2017-03-29 01:30:11'),
(249, 15, '100', '2017-03-29 01:30:11'),
(250, 27, '-100', '2017-03-29 01:38:17'),
(251, 15, '50', '2017-03-29 01:38:17'),
(252, 27, '-150', '2017-03-29 01:38:17'),
(253, 15, '75', '2017-03-29 01:38:18'),
(254, 27, '-123', '2017-03-29 01:38:18'),
(255, 15, '61', '2017-03-29 01:38:18'),
(256, 27, '-200', '2017-03-29 01:38:18'),
(257, 15, '100', '2017-03-29 01:38:18'),
(258, 27, '-2.163', '2017-03-31 17:01:23'),
(259, 15, '1', '2017-03-31 17:01:23'),
(260, 27, '-5.17', '2017-03-31 17:05:33'),
(261, 15, '2', '2017-03-31 17:05:33'),
(262, 27, '-4.924', '2017-03-31 17:14:16'),
(263, 15, '2', '2017-03-31 17:14:16'),
(264, 27, '-15', '2017-04-12 21:16:42'),
(265, 15, '7', '2017-04-12 21:16:42'),
(266, 15, '-200', '2017-04-17 21:32:06'),
(268, 15, '-300', '2017-04-19 18:43:57'),
(269, 27, '-283.591', '2017-05-04 22:57:25'),
(270, 15, '141', '2017-05-04 22:57:25');

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `country` varchar(100) NOT NULL,
  `country_code` varchar(20) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `street` varchar(255) NOT NULL,
  `zip` varchar(50) NOT NULL,
  `phone_number` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`id`, `user_id`, `country`, `country_code`, `city`, `state`, `street`, `zip`, `phone_number`) VALUES
(2, 15, 'Armenia', '', 'aaaaa', 'dsggds', 'cxb', '5', '+37477000021'),
(3, 27, 'Armenia', '', 'gexamaasar', 'qez incha', 'Hajox', '1111', '121');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `email` varchar(255) NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `process_date` timestamp NULL DEFAULT NULL,
  `trx_id` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `withdrawals`
--

INSERT INTO `withdrawals` (`id`, `user_id`, `amount`, `email`, `request_date`, `process_date`, `trx_id`, `status`, `comment`) VALUES
(1, 15, 300, 'test@gmail.com', '2017-04-18 18:44:08', NULL, NULL, 'rejected', ''),
(2, 15, 500, 'test@gmail.com', '2017-04-18 18:44:36', NULL, NULL, 'pending', NULL),
(3, 15, 300, 'test@gmail.com', '2017-04-19 18:43:57', NULL, NULL, 'rejected', 'test reason');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_blog_posts_user` (`user_id`);

--
-- Indexes for table `chat_history`
--
ALTER TABLE `chat_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients_info`
--
ALTER TABLE `clients_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_users_info` (`user_id`);

--
-- Indexes for table `configuration`
--
ALTER TABLE `configuration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experts_info`
--
ALTER TABLE `experts_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_experts_info` (`expert_id`);

--
-- Indexes for table `expert_categories`
--
ALTER TABLE `expert_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expert_clients`
--
ALTER TABLE `expert_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expert_skills`
--
ALTER TABLE `expert_skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorite_list`
--
ALTER TABLE `favorite_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_favorite_list` (`client_id`),
  ADD KEY `FK_favorite_list_expert` (`expert_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `free_messages`
--
ALTER TABLE `free_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_post_comments` (`post_id`),
  ADD KEY `FK_comments_user` (`user_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_reviews_users` (`user_id`),
  ADD KEY `FK_reviews_experts` (`expert_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users_balances`
--
ALTER TABLE `users_balances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `block`
--
ALTER TABLE `block`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;
--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `chat_history`
--
ALTER TABLE `chat_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `clients_info`
--
ALTER TABLE `clients_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `configuration`
--
ALTER TABLE `configuration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `experts_info`
--
ALTER TABLE `experts_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `expert_categories`
--
ALTER TABLE `expert_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `expert_clients`
--
ALTER TABLE `expert_clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `expert_skills`
--
ALTER TABLE `expert_skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `favorite_list`
--
ALTER TABLE `favorite_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `free_messages`
--
ALTER TABLE `free_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT for table `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `users_balances`
--
ALTER TABLE `users_balances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;
--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD CONSTRAINT `FK_blog_posts_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `clients_info`
--
ALTER TABLE `clients_info`
  ADD CONSTRAINT `FK_users_info` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `experts_info`
--
ALTER TABLE `experts_info`
  ADD CONSTRAINT `FK_experts_info` FOREIGN KEY (`expert_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favorite_list`
--
ALTER TABLE `favorite_list`
  ADD CONSTRAINT `FK_favorite_list` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_favorite_list_expert` FOREIGN KEY (`expert_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD CONSTRAINT `FK_comments_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_post_comments` FOREIGN KEY (`post_id`) REFERENCES `blog_posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_reviews_experts` FOREIGN KEY (`expert_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reviews_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
