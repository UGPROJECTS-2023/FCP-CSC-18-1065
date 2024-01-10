-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2024 at 11:12 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studentadvisingsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `advisors`
--

CREATE TABLE `advisors` (
  `advisor_id` int(11) NOT NULL,
  `advisor_name` varchar(50) NOT NULL,
  `advisor_email` varchar(100) NOT NULL,
  `advisor_password` varchar(50) NOT NULL,
  `advisor_level` varchar(50) DEFAULT NULL,
  `department_id` varchar(10) NOT NULL,
  `advisor_phone` varchar(20) DEFAULT NULL,
  `advisor_office_location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advisors`
--

INSERT INTO `advisors` (`advisor_id`, `advisor_name`, `advisor_email`, `advisor_password`, `advisor_level`, `department_id`, `advisor_phone`, `advisor_office_location`) VALUES
(3, 'bello', 'bello@gmail.com', 'bello', 'Level 4', '', '08060021676', 'kano'),
(9, 'Tawakaltu Muhammad', 'abraze419@gmail.com', 'abraze', 'Level 3', '', '+2348161711212', '192 Maikawa Yanlemo Kano'),
(10, 'ibrahim', 'ibrahim@gmail.com', 'ibrahim', 'Level 1', '', '+2348161711212', '192 Maikawa Yanlemo Kano'),
(11, 'Yakubu LAka', 'ibrahim.rrasheed@gmail.com', 'abraze', 'Level 2', '', '07038834343', '192 Maikawa Yanlemo Kano'),
(12, 'John Doe', 'john.doe@example.com', '', 'Senior', '', NULL, NULL),
(13, 'Jane Smith', 'jane.smith@example.com', '', 'Junior', '', NULL, NULL),
(14, 'Robert Johnson', 'robert.johnson@example.com', '', 'Senior', '', NULL, NULL),
(15, 'Emily Davis', 'emily.davis@example.com', '', 'Junior', '', NULL, NULL),
(16, 'Michael Wilson', 'michael.wilson@example.com', '', 'Senior', '', NULL, NULL),
(17, 'Susan Brown', 'susan.brown@example.com', '', 'Junior', '', NULL, NULL),
(18, 'David Lee', 'david.lee@example.com', '', 'Senior', '', NULL, NULL),
(19, 'Linda Hall', 'linda.hall@example.com', '', 'Junior', '', NULL, NULL),
(20, 'William White', 'william.white@example.com', '', 'Senior', '', NULL, NULL),
(21, 'Karen Taylor', 'karen.taylor@example.com', '', 'Junior', '', NULL, NULL),
(22, 'James Harris', 'james.harris@example.com', '', 'Senior', '', NULL, NULL),
(24, 'Daniel Martin', 'daniel.martin@example.com', '', 'Senior', '', NULL, NULL),
(25, 'Nancy King', 'nancy.king@example.com', '', 'Junior', '', NULL, NULL),
(26, 'Thomas Lewis', 'thomas.lewis@example.com', '', 'Senior', '', NULL, NULL),
(28, 'Richard Turner', 'richard.turner@example.com', '', 'Senior', '', NULL, NULL),
(30, 'Matthew Green', 'matthew.green@example.com', '', 'Senior', '', NULL, NULL),
(31, 'Jennifer Parker', 'jennifer.parker@example.com', '', 'Junior', '', NULL, NULL),
(32, 'Mal Abdulaziz', 'malabdulaziz@gmail.com', 'aaa', 'Level 3', '', '08012345678', 'I.C.T');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `advisor_id` int(11) NOT NULL,
  `appointment_type` varchar(50) NOT NULL,
  `Reg_number` varchar(20) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `reason` text DEFAULT NULL,
  `status` varchar(225) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `advisor_id`, `appointment_type`, `Reg_number`, `appointment_date`, `appointment_time`, `reason`, `status`, `created_at`, `updated_at`) VALUES
(3, 3, 'academic_advising', 'FCP/CSC/18/1065', '2023-09-28', '13:23:00', 'Change of courses', 'Approved', '2023-08-26 15:41:38', '2024-01-09 19:35:18'),
(8, 8, 'academic_advising', 'FCP/CSC/18/1065', '2023-09-01', '12:46:00', 'Change of courses', 'Approved', '2023-09-01 11:43:49', '2024-01-09 19:35:11'),
(14, 3, 'academic_advising', 'FCP/CSC/18/1015', '2024-01-10', '08:35:00', 'COURSE REGISTRATION', '', '2024-01-09 19:30:59', '2024-01-09 19:38:36');

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `advisor_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courseregistration`
--

CREATE TABLE `courseregistration` (
  `id` int(11) NOT NULL,
  `program` varchar(255) DEFAULT NULL,
  `Academic_Level` varchar(11) DEFAULT NULL,
  `course_name` varchar(255) DEFAULT NULL,
  `course_code` varchar(20) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `credit_unit` int(11) DEFAULT NULL,
  `academic_session` varchar(50) DEFAULT NULL,
  `academic_semester` varchar(20) DEFAULT NULL,
  `advisor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courseregistration`
--

INSERT INTO `courseregistration` (`id`, `program`, `Academic_Level`, `course_name`, `course_code`, `department`, `credit_unit`, `academic_session`, `academic_semester`, `advisor_id`) VALUES
(21, 'B.Sc (Hons) Computer Science', 'Level 1', 'Introduction to Programming', 'CSC101', 'Department of Computer Science', 3, '2021/2022', 'First', 0),
(22, 'B.Sc (Hons) Computer Science', 'Level 1', 'Mathematics for Computer Science', 'MTH101', 'Department of Mathematics', 3, '2021/2022', 'First', 0),
(23, 'B.Sc (Hons) Computer Science', 'Level 1', 'Data Structures', 'CSC102', 'Department of Computer Science', 3, '2021/2022', 'Second', 0),
(24, 'B.Sc (Hons) Computer Science', 'Level 1', 'Communication Skills', 'GST101', 'Department of English', 2, '2021/2022', 'First', 0),
(25, 'B.Sc (Hons) Computer Science', 'Level 1', 'Introduction to Electronics', 'PHY101', 'Department of Electrical Engineering', 3, '2021/2022', 'Second', 0),
(26, 'B.Sc (Hons) Computer Science', 'Level 2', 'Data Structures and Algorithms', 'CSC202', 'Department of Computer Science', 3, '2022/2023', 'First', 0),
(27, 'B.Sc (Hons) Computer Science', 'Level 2', 'Database Management Systems', 'CSC204', 'Department of Computer Science', 3, '2022/2023', 'First', 0),
(28, 'B.Sc (Hons) Computer Science', 'Level 2', 'Software Engineering Principles', 'CSC206', 'Department of Computer Science', 3, '2022/2023', 'Second', 0),
(29, 'B.Sc (Hons) Computer Science', 'Level 2', 'Discrete Mathematics', 'MTH201', 'Department of Mathematics', 3, '2022/2023', 'First', 0),
(30, 'B.Sc (Hons) Computer Science', 'Level 2', 'Introduction to AI', 'CSC208', 'Department of Computer Science', 3, '2022/2023', 'Second', 0),
(31, 'B.Sc (Hons) Computer Science', 'Level 3', 'Software Testing and Quality Assurance', 'CSC301', 'Department of Computer Science', 3, '2023/2024', 'First', 0),
(32, 'B.Sc (Hons) Computer Science', 'Level 3', 'Operating Systems', 'CSC303', 'Department of Computer Science', 3, '2023/2024', 'First', 0),
(33, 'B.Sc (Hons) Computer Science', 'Level 3', 'Web Development', 'CSC305', 'Department of Computer Science', 3, '2023/2024', 'Second', 0),
(34, 'B.Sc (Hons) Computer Science', 'Level 3', 'Database Design and Implementation', 'CSC307', 'Department of Computer Science', 3, '2023/2024', 'First', 0),
(35, 'B.Sc (Hons) Computer Science', 'Level 3', 'Networking and Security', 'CSC309', 'Department of Computer Science', 3, '2023/2024', 'Second', 0),
(36, 'B.Sc (Hons) Computer Science', 'Level 4', 'Advanced Algorithms', 'CSC401', 'Department of Computer Science', 3, '2024/2025', 'First', 0),
(37, 'B.Sc (Hons) Computer Science', 'Level 4', 'Capstone Project', 'CSC499', 'Department of Computer Science', 6, '2024/2025', 'First', 0),
(38, 'B.Sc (Hons) Computer Science', 'Level 4', 'Machine Learning', 'CSC403', 'Department of Computer Science', 3, '2024/2025', 'Second', 0),
(39, 'B.Sc (Hons) Computer Science', 'Level 4', 'Natural Language Processing', 'CSC405', 'Department of Computer Science', 3, '2024/2025', 'First', 0),
(40, 'B.Sc (Hons) Computer Science', 'Level 4', 'Ethical Hacking', 'CSC407', 'Department of Computer Science', 3, '2024/2025', 'Second', 0);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `course_number` varchar(20) NOT NULL,
  `creditHours` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `semester_id` int(11) DEFAULT NULL,
  `Academic_Level` varchar(11) DEFAULT NULL,
  `Academic_Level1` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `course_number`, `creditHours`, `description`, `semester_id`, `Academic_Level`, `Academic_Level1`) VALUES
(1, 'Probabilty I', 'STA111', 3, 'Introduction to statistics', 1, '100', 'Level 1'),
(2, 'Inorganic Chemistry', 'CHM102', 2, 'Basic principles of chemistry', 1, '100', 'Level 1'),
(3, 'Linear Algebra', 'MTH205', 3, 'Introductory algebra course', 1, '200', 'Level 2'),
(4, 'Computer Hardware ', 'CSC207', 2, 'Introduction To Ecology', 1, '200', 'Level 2'),
(5, 'Computer Architecture', 'CSC303', 2, 'Introduction To Matter', 1, '300', 'Level 3'),
(6, 'Theory Of Computation', 'CSC306', 1, 'Pratical 1', 2, '300', 'Level 3'),
(7, 'Survey Of Programming Language', 'CSC301', 2, 'Introduction To Mechanics', 1, '300', 'Level 3'),
(8, 'AI', 'CSC411', 3, 'Introduction to Computer', 1, '400', 'Level 4'),
(9, 'DATABASE', 'CSC406', 2, 'Introduction to Algorithm', 1, '400', 'Level 4'),
(10, 'Project', '499', 2, 'Project', 2, '400', 'Level 4'),
(11, 'Element of Statistics', 'STA112', 4, 'Element of Statistics', 2, '100', 'Level 1'),
(12, 'ODE', '202', 3, 'Calculus', 2, '200', 'Level 2'),
(15, 'WEB design', 'CSC201', 2, 'Introduction to Web  Design', 2, '200', 'Level 4');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` varchar(10) NOT NULL,
  `department_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`, `created_at`) VALUES
('CSC', 'Computer Science', '2023-08-16 15:48:04');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `question`, `answer`) VALUES
(1, 'What is Lorem Ipsum?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'),
(2, 'Why do we use it?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.'),
(3, 'Where does it come from?', 'Contrary to popular belief, Lorem Ipsum is not simply random text.'),
(4, 'What is the first book?', 'The first book is \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil)'),
(5, 'Who wrote it?', 'Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words.'),
(6, 'Is it readable English?', 'It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.'),
(7, 'Why is it used for typesetting?', 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text.'),
(8, 'Where can I get some?', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.'),
(9, 'Is Lorem Ipsum the same as Latin?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.'),
(10, 'What is the standard passage?', 'The standard passage of Lorem Ipsum used since the 1500s is reproduced below for those interested.');

-- --------------------------------------------------------

--
-- Table structure for table `frequent_asks`
--

CREATE TABLE `frequent_asks` (
  `id` int(30) NOT NULL,
  `question_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `frequent_asks`
--

INSERT INTO `frequent_asks` (`id`, `question_id`) VALUES
(1, 0),
(2, 0),
(3, 0),
(4, 0),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 4),
(12, 1),
(13, 6),
(14, 7),
(15, 7),
(16, 1),
(17, 7),
(18, 8),
(19, 7),
(20, 7),
(21, 7),
(22, 6),
(23, 7),
(24, 7),
(25, 7),
(26, 7),
(27, 7),
(28, 7),
(29, 9),
(30, 1),
(31, 8),
(32, 2),
(33, 7),
(34, 14),
(35, 9),
(36, 9),
(37, 9),
(38, 1),
(39, 4),
(40, 6),
(41, 7),
(42, 2),
(43, 20),
(44, 24),
(45, 25),
(46, 2),
(47, 4),
(48, 26),
(49, 8),
(50, 27),
(51, 26),
(52, 26),
(53, 20),
(54, 26);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `Reg_number` varchar(50) NOT NULL,
  `message` text DEFAULT NULL,
  `advisor_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `Reg_number`, `message`, `advisor_id`, `timestamp`) VALUES
(39, 'FCP/CSC/18/1065', 'Come for your file update', 3, '2024-01-09 19:40:02'),
(43, 'FCP/CSC/18/1065', 'Submit your dataform\r\n', 3, '2024-01-09 20:58:53'),
(47, 'FCP/CSC/18/1065', 'M, M,N/KLN/LK', 3, '2024-01-09 21:25:31'),
(48, 'FCP/CSC/18/1065', '.bajhjhBA,jhbjh', 3, '2024-01-09 21:29:27'),
(49, 'FCP/CSC/18/1065', 'b.jhbjhk.bjk', 3, '2024-01-09 21:30:55'),
(50, 'FCP/CSC/18/1065', 'nmbjhjhbjhbhhjm', 3, '2024-01-09 21:32:51'),
(51, 'FCP/CSC/18/1065', 'bj,bjhkbhjbjhh', 3, '2024-01-09 21:36:51');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(30) NOT NULL,
  `question` text DEFAULT NULL,
  `response_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `response_id`) VALUES
(2, 'who are you', 1),
(4, 'What can you do', 2),
(8, 'What is ChatBot', 5),
(9, 'hi', 6),
(10, 'hello', 6),
(11, 'yow', 6),
(16, 'good day', 9),
(18, 'BRIEF HISTORY OF THE UNIVERSITY', 11),
(19, 'PHILOSOPHY OFTHE UNIVERSITY', 12),
(20, 'WHO IS THE CURRENT HEAD OF DEPARTMENT', 13),
(21, 'WHO IS THE CURRENT DEPARTMENT EXAM OFFICER', 14),
(22, 'what are you', 15),
(23, 'what topic can I ask', 16),
(25, 'ADMISSION REQUIREMENTS', 18),
(26, 'Who are you', 19),
(27, 'Level one First semester courses', 20);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `Reg_number` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `problem_type` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `filename` varchar(225) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `Reg_number`, `name`, `email`, `problem_type`, `description`, `filename`, `timestamp`) VALUES
(10, 'UG17/COMS/1093', 'ABDULRASHEED IBRAHIM OPEYEMI', 'abraze419@gmail.com', 'Study Skills and Time Management', 'Need foe Skill Acusation ', 'b.pdf', '2023-09-06 09:36:57'),
(11, 'UG17/COMS/1093', 'Ibrahim Abdulrasheed Opeyemi', 'abraze419@gmail.com', 'Accessibility and Accommodations', 'Rooms ', 'scsystem1.sql', '2023-09-06 10:05:32'),
(12, 'UG17/COMS/1093', 'Ibrahim Abdulrasheed Opeyemi', 'abraze419@gmail.com', 'Accessibility and Accommodations', 'b bxjhzbhjxbd', 'scsystem1.sql', '2023-09-06 10:06:44'),
(13, 'UG17/COMS/1093', 'Ibrahim Abdulrasheed Opeyemi', 'abraze419@gmail.com', 'Financial Advising', 'Finance budgeting ', 'b.pdf', '2023-09-06 10:07:02'),
(14, 'UG17/COMS/1093', 'ABDULRASHEED IBRAHIM OPEYEMI', 'abraze419@gmail.com', 'Scheduling Conflicts', 'Fight Occur', 'download.png', '2023-09-10 06:19:48'),
(15, 'UG17/COMS/1001', 'ABDULRASHEED IBRAHIM OPEYEMI', 'abraze419@gmail.com', 'Study Skills and Time Management', 'Time Management', '15436_25.jpg', '2023-09-12 07:58:04'),
(16, 'FCP/CSC/18/1065', 'Abdulaziz', 'bello@gmail.com', 'Course Registration Issues', 'fccgvjhklhgnvbh', '01d68203-2ad1-4ad4-9f08-85e4f499a0d1.jpg', '2024-01-09 21:37:51');

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE `responses` (
  `id` int(30) NOT NULL,
  `response_message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `responses`
--

INSERT INTO `responses` (`id`, `response_message`) VALUES
(2, 'I am in charge to answer your questions.'),
(3, 'You can ask me about something related to this website.'),
(4, 'PHP (recursive acronym for PHP: Hypertext Preprocessor ) is a widely-used open source general-purpose scripting language that is especially suited for web development and can be embedded into HTML.'),
(5, 'A chatbot is a software application used to conduct an on-line chat conversation via text or text-to-speech, in lieu of providing direct contact with a live human agent.'),
(6, 'Hi there, how can I help you ? :)'),
(7, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue, lectus non tincidunt viverra, lacus erat venenatis mauris, sed hendrerit libero diam ac tellus. Integer imperdiet massa lacus, sed porta ligula efficitur at. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; '),
(8, 'You can ask me about something related to this website.'),
(9, 'Hi there, how can I help you ? :)'),
(10, 'I am ABRAZE, the chatBot of this application'),
(11, 'Kano University of Science and Technology (KUST) Wudil was established in 2001 after a process that began in 1988. It offers 18 programs across five faculties and values excellence, dignity, leadership, and loyalty.'),
(12, 'The guiding philosophy of Kano University of Science and Technology, Wudil shall be the provision of community based education that will facilitate the production of graduates who shall fulfill the stipulated requirements in learning and character to graduate in their various fields of specialization. The graduates shall also be groomed in such a manner that they will be able to effectively function in the Community.'),
(13, 'Dr. IDRIS ABUBAKAR UMAR'),
(14, 'MALLAM HAFIZ USMAN UBA'),
(15, 'I am ABRAZE, the chatBot of this application.'),
(16, 'You can ask me about something related to Computer Scienece Department'),
(17, 'ADMISSION REQUIREMENTS\r\nTo be admitted into the 4 year B. Sc. Biology a candidate must have;\r\na. UTME Entry Mode\r\nCredit passes in five (5) WAEC/GCE/NECO/NABTEB subjects including.\r\nEnglish, Mathematics, Chemistry, Biology and any other science subjects ( Physics, Agricultural Science or Geography) in not more than two (2) sittings.\r\nb. Direct Entry Mode\r\nTwo (2) A level passes in Botony/Zoology, Biology or Chemistry in addition to a above. NCE at credit level, OND (Upper Credit) and HND (Lower Credit) are accepted for admission.\r\nCourse duration\r\nThe duration of the programme is Four (4) years for UTME candidates and Three (3) years for Direct Entry candidates.\r\n'),
(18, 'ADMISSION REQUIREMENTS\r\nTo be admitted into the 4 year B. Sc. Biology a candidate must have\r\n\r\na. UTME Entry Mode\r\nCredit passes in five (5) WAEC/GCE/NECO/NABTEB subjects including.\r\nEnglish, Mathematics, Chemistry, Biology and any other science subjects ( Physics, Agricultural Science or Geography) in not more than two (2) sittings.\r\n\r\nb. Direct Entry Mode\r\nTwo (2) A level passes in Botony/Zoology, Biology or Chemistry in addition to a above. NCE at credit level, OND (Upper Credit) and HND (Lower Credit) are accepted for admission.\r\nCourse duration\r\nThe duration of the programme is Four (4) years for UTME candidates and Three (3) years for Direct Entry candidates.\r\n'),
(19, 'I am ABRAZE, the chatBot of this application'),
(20, 'CSC1301 (INTRODUCTION TO COMPUTER SCIENCE)\r\nCSC1203 (INTRODUCTION TO INTERNET)\r\nMTH1301 (ALGEBRA AND TRIGONOMETRY)\r\nPHY1201 (PROPERTIES OF MATTER)\r\nPHY1105 EXPERIMENTAL PHYSICS I\r\nBIO1301 (INTODUCTION TO ECOLOGY)\r\nGST1201 (USE OF LIBRARY, STUDY SKILLS AND INFORMATION & COMMUNICATION TECHNOLOGY)\r\nPHY1204 (MECHANICS )\r\nCHM1211 (INORGANIC CHEMISTRY)\r\nSTA1301(INTRODUCTION TO STATISTICS)\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `semester_id` int(11) NOT NULL,
  `semester_name` varchar(20) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`semester_id`, `semester_name`, `start_date`, `end_date`) VALUES
(1, 'First', '2023-09-01', '2023-12-15'),
(2, 'Second', '2024-01-15', '2024-05-15');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `Reg_number` varchar(50) NOT NULL,
  `advisor_id` int(11) NOT NULL,
  `Fullname` varchar(225) NOT NULL,
  `department_name` varchar(50) NOT NULL,
  `Academic_Level` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expiry` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(225) NOT NULL,
  `student_ID` int(11) NOT NULL,
  `message` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`Reg_number`, `advisor_id`, `Fullname`, `department_name`, `Academic_Level`, `email`, `password`, `reset_token`, `reset_token_expiry`, `created_at`, `image`, `student_ID`, `message`) VALUES
('Reg2', 0, 'Jane Smith', 'CSC', 'Year 1', 'jane@example.com', 'hashed_password2', NULL, NULL, '2023-08-26 09:28:13', 'image2.jpg', 24, ''),
('Reg3', 0, 'Michael Johnson', 'CSC', 'Year 1', 'michael@example.com', 'hashed_password3', NULL, NULL, '2023-08-26 09:28:13', 'image3.jpg', 25, ''),
('Reg4', 0, 'Emily Williams', 'CSC', 'Year 1', 'emily@example.com', 'hashed_password4', NULL, NULL, '2023-08-26 09:28:13', 'image4.jpg', 26, ''),
('Reg5', 0, 'Robert Brown', 'CSC', 'Year 1', 'robert@example.com', 'hashed_password5', NULL, NULL, '2023-08-26 09:28:13', 'image5.jpg', 27, ''),
('Reg6', 0, 'Amanda Jones', 'CSC', 'Year 1', 'amanda@example.com', 'hashed_password6', NULL, NULL, '2023-08-26 09:28:13', 'image6.jpg', 28, ''),
('Reg7', 0, 'William Davis', 'CSC', 'Year 1', 'william@example.com', 'hashed_password7', NULL, NULL, '2023-08-26 09:28:13', 'image7.jpg', 29, ''),
('Reg8', 0, 'Olivia Wilson', 'CSC', 'Year 1', 'olivia@example.com', 'hashed_password8', NULL, NULL, '2023-08-26 09:28:13', 'image8.jpg', 30, ''),
('Reg9', 0, 'James Miller', 'CSC', 'Year 1', 'james@example.com', 'hashed_password9', NULL, NULL, '2023-08-26 09:28:13', 'image9.jpg', 31, ''),
('FCP/CSC/18/1065', 0, 'Ahmad', '', 'Level 4', 'adamuahmad579@gmail.com', 'ahmad', NULL, NULL, '2024-01-09 19:29:40', 'uploads/IMG_7437.PNG', 42, '');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'FUD.DUTSE SAAS ChatBot'),
(4, 'intro', 'Hi! I&apos;m Abraze, a ChatBot of this Student Advising System,. How can I help you?'),
(6, 'short_name', 'FUD SAAS ChatBot'),
(10, 'no_result', 'I am sorry. I can&apos;t understand your question. Please rephrase your question and make sure it is related to this site. Thank you :)'),
(11, 'logo', 'uploads/1704836340_IMG_7595.PNG'),
(12, 'bot_avatar', 'uploads/bot_avatar.JPG'),
(13, 'user_avatar', 'uploads/user_avatar.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `unanswered`
--

CREATE TABLE `unanswered` (
  `id` int(30) NOT NULL,
  `question` text DEFAULT NULL,
  `no_asks` int(30) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unanswered`
--

INSERT INTO `unanswered` (`id`, `question`, `no_asks`) VALUES
(1, 'what can you do?', 6),
(2, 'what can you do ?', 6),
(3, 'what topic can I ask', 6),
(4, 'chat bot', 6),
(5, 'asdasd', 6),
(6, 'asdaaa', 6),
(7, 'asd', 6),
(9, 'hello', 6),
(10, 'sample', 6),
(11, 'test', 6),
(12, 'what is my name ', 4),
(13, 'Head OF Departmwnr', 4),
(14, 'Exam offecier', 4),
(15, 'HOD', 4),
(16, ' what is the admission ADMISSION REQUIREMENTS', 4),
(17, 'jbsnkj', 4),
(18, 'what is the head of department name ', 4),
(19, 'head od department', 4),
(20, 'who are you', 4),
(21, 'level 1', 2),
(22, 'Level 1 fist semester course', 2),
(23, 'LEVEL 100 FIRST SEMESTER\nCOURSE\n', 1),
(24, 'LEVEL 100 FIRST SEMESTER COURSE', 1),
(25, 'Level 100', 1),
(26, 'who is the current HOD', 0),
(27, 'how are you', 0),
(28, 'who  is the current HOD', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `last_login`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/1620201300_avatar.png', NULL, '2021-01-20 14:02:37', '2021-05-05 15:55:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advisors`
--
ALTER TABLE `advisors`
  ADD PRIMARY KEY (`advisor_id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courseregistration`
--
ALTER TABLE `courseregistration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `semester_id` (`semester_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frequent_asks`
--
ALTER TABLE `frequent_asks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_advisor` (`advisor_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`semester_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD UNIQUE KEY `student_ID` (`student_ID`) USING BTREE;

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unanswered`
--
ALTER TABLE `unanswered`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `advisors`
--
ALTER TABLE `advisors`
  MODIFY `advisor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courseregistration`
--
ALTER TABLE `courseregistration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `frequent_asks`
--
ALTER TABLE `frequent_asks`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `responses`
--
ALTER TABLE `responses`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `unanswered`
--
ALTER TABLE `unanswered`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `fk_student` FOREIGN KEY (`Reg_number`) REFERENCES `students` (`Reg_number`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`semester_id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_advisor` FOREIGN KEY (`advisor_id`) REFERENCES `advisors` (`advisor_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
