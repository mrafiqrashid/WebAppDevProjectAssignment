-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2022 at 04:12 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eval_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `criteria`
--

CREATE TABLE `criteria` (
  `cid` int(255) NOT NULL,
  `section` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `criteria`
--

INSERT INTO `criteria` (`cid`, `section`) VALUES
(1, 'Project Characteristics'),
(2, 'Strategic Management Risks'),
(3, 'Procurement Risks'),
(4, 'Human Resource Risks'),
(5, 'Business Risks'),
(6, 'Project Management Integration Risks'),
(7, 'Project Requirements Risks');

-- --------------------------------------------------------

--
-- Table structure for table `infocrld`
--

CREATE TABLE `infocrld` (
  `infocrldid` int(255) NOT NULL,
  `level` varchar(5000) NOT NULL,
  `definition` varchar(5000) NOT NULL,
  `score` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `infocrld`
--

INSERT INTO `infocrld` (`infocrldid`, `level`, `definition`, `score`) VALUES
(1, 'rere', 'Project has low risk and complexity. The project outcome affects only a specific service or at most a specific program, and risk mitigations for general project risks are in place. The project does not consume a significant percentage of departmental or agency resources.', 'less than 45'),
(2, 'Tactical', ' \r\nA project rated at this level affects multiple services within a program and may involve more significant procurement activities. It may involve some information management or information technology (IM/IT) or engineering activities. The project risk profile may indicate that some risks could have serious impacts, requiring carefully planned responses. The scope of a tactical project is operational in nature and delivers new capabilities within limits.', '45 to 63'),
(3, 'Evolutionary', ' \r\nAs indicated by the name, projects within this level of complexity and risk introduce change, new capabilities and may have a fairly extensive scope. Disciplined skills are required to successfully manage evolutionary projects. Scope frequently spans programs and may affect one or two other departments or agencies. There may be substantial change to business process, internal staff, external clients, and technology infrastructure. IM/IT components may represent a significant proportion of total project activity.', '64 to 82'),
(4, 'Transformational', ' \r\nAt this level, projects require extensive capabilities and may have a dramatic impact on the organization and potentially other organizations. Horizontal (i.e. multi-departmental, multi-agency, or multi-jurisdictional) projects are transformational in nature. Risks associated with these projects often have serious consequences, such as restructuring the organization, change in senior management, and/or loss of public reputation.', '83 and over');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `projectid` int(100) NOT NULL,
  `projectname` varchar(100) DEFAULT NULL,
  `owner` varchar(100) DEFAULT NULL,
  `financial` decimal(65,0) DEFAULT NULL,
  `duration` varchar(5000) DEFAULT NULL,
  `mode` varchar(100) DEFAULT NULL,
  `userid` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`projectid`, `projectname`, `owner`, `financial`, `duration`, `mode`, `userid`) VALUES
(35152, 'qwqw', 'wqwq', '123', 'wqwq', 'Insource', 4563),
(43211, 'Building school', 'Muhammad Rashid bin Shamsul Kahar', '32000', '1 year 3 month', 'wew', 4563),
(76544, 'Building temple', 'Ong Ki Huat', '50000', '10 months', 'Outsource', 4563),
(98766, 'Building wooden house', 'Rahul Chandra', '3000', '8 months', 'Co-source', 4563);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `questionid` int(100) NOT NULL,
  `question` varchar(5000) DEFAULT NULL,
  `rating` varchar(5000) DEFAULT NULL,
  `cid` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`questionid`, `question`, `rating`, `cid`) VALUES
(1, 'What is the total project cost estimate?', '1 = $1-5 million</br>2 = $5-10 million</br>3 = $10-25 million</br>4 = $25-100 million</br>5 = over $100 million', 1),
(2, 'What percentage of the total project cost estimate is for procurement?', '1 = No procurement is required—answer \"1\" </br>to all questions in the \"Procurement risks\" section (3.3).\r\n2 = under 25 per cent</br>\r\n3 = 26-50 per cent</br>\r\n4 = 51-75 per cent</br>\r\n5 = over 75 per cent', 1),
(3, 'Relative to the average project in your organization, which of the following adjectives describes the total project cost estimate?', '1 = Small</br>\r\n3 = Medium</br>\r\n5 = Large', 1),
(4, 'How many people (part-time or full-time on the project, including Government of Canada employees and individual contractors) are required to complete this project at its peak activity?', '1 = under 10</br>\r\n2 = 10-25</br>\r\n3 = 26-100</br>\r\n4 = 101-250</br>\r\n5 = over 250', 1),
(5, 'From project definition to project close-out, what is the expected duration of the project?', '1 = under 12 months</br>\r\n2 = 12-24 months</br>\r\n3 = 24-36 months</br>\r\n4 = 36-48 months</br>\r\n5 = over 48 months', 1),
(6, 'How many sponsoring or funding departments or agencies are involved?', '1 = The project involves only one department or agency.</br>\r\n2 = The project involves another department or agency.</br>\r\n3 = The project involves two other departments or agencies.</br>\r\n4 = The project involves three other departments or agencies.</br>\r\n5 = The project involves at least four other departments or agencies.', 1),
(7, ' How will the outcome of this project change or directly affect business processes, sectors, branches and other departments and agencies?', '1 = The outcome of this project will affect one business process within a sector</br>\r\n2 = The outcome of this project will affect multiple business processes within a sector.</br>\r\n3 = The outcome of this project will affect multiple sectors.</br>\r\n4 = The outcome of this project will affect multiple branches.</br>\r\n5 = The outcome of this project will affect multiple departments or agencies.', 1),
(8, 'The proposed or established project governance structure demonstrates adequate support for how many of the following project factors?\r\n\r\nappropriate representation of stakeholders and executive management;\r\ndocumented decision-making processes;\r\ndocumented roles, responsibilities, and authorities within the governance structure; and\r\ndocumented information requirements.', '1 = Support for all factors is demonstrated.</br>\r\n2 = Support for three of the factors is demonstrated.</br>\r\n3 = Support for two of the factors is demonstrated.</br>\r\n4 = Support for one of the factors is demonstrated.</br>\r\n5 = Support is not demonstrated for any of the factors.', 1),
(9, 'In supporting the achievement of the expected outcomes, how many of the following criteria apply to the total project cost estimate (either indicative cost estimate or substantive cost estimate)?\r\n\r\nCost estimates are generated at the work-package level.\r\nCost estimates are based on historical data or industry benchmarks. ', '1 = Both criteria are met.</br>\r\n3 = One of the two criteria is met.</br>\r\n5 = None of the criteria ', 1),
(10, 'In supporting the achievement of the expected outcomes, how many of the following criteria apply to the costing model?\r\n\r\nThe source of funds has been identified within departmental reference levels.\r\nThe funds have been internally committed.', '1 = Both criteria are met.</br>\r\n3 = One of the two criteria is met.</br>\r\n5 = None of the criteria ', 1),
(11, 'Is the project susceptible to time delays? Time delays can have a number of causes, such as the following:\r\n\r\nChanges in technology;\r\nRequirements of participating organizations;\r\nSeasonal considerations;\r\nThe need for policy approvals; and\r\nExternal influences.', '1 = No, the project is not susceptible.</br>\r\n3 = Yes, the project is moderately susceptible; time delays will have minor effects on the schedule.</br>\r\n5 = Yes, the project is highly susceptible; time delays will have major effects on the schedule.', 1),
(12, 'Do geographical considerations influence the manner in which the project is conducted? Consider the following statements:\r\n\r\nProject activities or team members are distributed across a wide geographical area.\r\nThe project will be conducted in a remote or difficult location.', '1 = Neither statement applies.</br>\r\n3 = One statement is true.</br>\r\n5 = Both statements are true.', 1),
(13, 'Do environmental considerations influence the manner in which the project is conducted?', '1 = No</br>\r\n5 = Yes', 1),
(14, 'Are there any socio-economic considerations that must be taken into account?', '1 = No</br>\r\n5 = Yes', 1),
(15, 'Consider how the availability of facilities will influence the manner in which the project is conducted:', '1 = Appropriate facilities are available to conduct the project.</br>\r\n3 = Facilities available to the project are inadequate.</br>\r\n5 = Facilities are unavailable for the project.', 1),
(16, 'Does public perception influence the manner in which the project is conducted?', '1 = No</br>\r\n5 = Yes', 1),
(17, 'Do considerations relating to Aboriginal people (including land claims and Aboriginal consultation obligations) influence the manner in which the project is conducted?', '1 = No</br>\r\n5 = Yes', 1),
(18, 'Do health and safety requirements add significant complexity to the requirements for this project?', '1 = No</br>\r\n5 = Yes', 1),
(19, 'How well and how clearly does the project align with the organization\'s mandate and strategic outcomes?', '1 = The project is directly aligned and it explicity contributes</br>to the strategic\r\noutcomes of the organization or program.\r\n3 = There is good alignment with the strategic outcome and there is an indirect contribution to the strategic outcomes of the organization or program.</br>\r\n5 = There is a weak alignment with the strategic outcomes, or the strategic outcomes have not been established.', 2),
(20, 'What level of priority is the project to the organization?', '1 = The project is a critical priority: all resources necessary will be allocated to it.</br>\r\n5 = The project is a normal priority: resources may be shared with a project of equal or higher priority.', NULL),
(21, 'How thoroughly does the project business case demonstrate the value of the project to the organization?', '1 = The business case is compelling, and value is extensively documented, </br>OR a business case is not required.\r\n3 = The business case provides a good demonstration of value; some details require further clarification.</br>\r\n5 = The business case does not demonstrate value or is not complete.', 2),
(22, 'To what degree is the organization\'s management and relevant stakeholders aware of the project?', '1 = There is consistent, clear, and comprehensive understanding of the project at all relevant levels.</br>\r\n3 = There is good general awareness of the project, its implications, and its budget.</br>\r\n5 = There is minimal awareness of the project in relevant levels of the organization.', 2),
(23, 'Does the project have a communications plan?', '1 = Yes, there is a project communications plan.</br>\r\n3 = The project communications plan has not yet been completed.</br>\r\n5 = No, a project communications plan does not exist.', 2),
(24, 'How extensive is the commitment of the organization\'s senior executive management, stakeholders, partners, and project sponsors to the timely and successful completion of this project? Consider the following criteria:\r\n\r\nA senior project sponsor or management champion is engaged.\r\nStakeholders and partners are willing to reallocate resources if necessary.\r\nSenior executive management oversight is in place.\r\nCommitment from all stakeholders is confirmed.', '1 = All four criteria are met.</br>\r\n2 = Three of the four criteria are met.</br>\r\n3 = Two of the four criteria are met.</br>\r\n4 = One of the four criteria is met.</br>\r\n5 = None of the four criteria are met.', 2),
(25, 'The documented project procurement strategy:', '1 = addresses all project requirements.</br>\r\n3 = is high-level and adequately describes required procurement activities.</br>\r\n5 = is incomplete or inappropriate for the project.', 3),
(26, 'What is the supplier availability and willingness?', '1 = There are qualified suppliers in the market willing to work with the Government of Canada.</br>\r\n3 = There is a limited number of qualified suppliers in the market or some suppliers are reluctant to work with the Government of Canada.</br>\r\n5 = There is only one supplier or there are no qualified suppliers that can meet the requirements.', 3),
(27, 'Will the appropriate products, goods, or services be supplied in a timely manner (according to specified contract delivery dates or required delivery dates) within the expected cost envelope by a qualified supplier?', '1 = There is no potential for products, goods, or services not being readily supplied.</br>\r\n3 = There is a slight potential for slippage of project schedule due</br> to procurement complexity or vendor challenges.</br>\r\n5 = There is a potential that the project deliverables, schedule, </br>or budget may be seriously affected by </br>limited qualified bidders, significant request-for-proposal process delays, or extended challenges.', 3),
(28, 'How many of the following statements are true?\r\n\r\nThe personnel involved in the project\'s procurement component have expertise in writing specifications or contracts.\r\nThe personnel involved in the project\'s procurement component have subject-matter expertise in the goods or services being procured.\r\nThere is a robust review process for contract award.', '1 = All statements are true.</br>\r\n2 = Two statements are true.</br>\r\n4 = One statement is true.</br>\r\n5 = None of the statements are true.', 3),
(29, 'How many separate contracts associated with key deliverables are planned for this project?', '1 = One contract.</br>\r\n2 = Two contracts.</br>\r\n3 = Three contracts.</br>\r\n4 = Four contracts.</br>\r\n5 = Five or more contracts.', 3),
(30, 'How many of the following statements are true?\r\n\r\nThe firm or individual obtaining the contract will subcontract to other companies\r\nContracts are subject to trade agreements\r\nThe results of the contract are dependent on the results of another contract.', '1 = None of the statements are true.</br>\r\n3 = One statement is true.</br>\r\n4 = Two statements are true.</br>\r\n5 = All of the statements are true.', 3),
(31, 'Based on the contract, consider the degree of control over supplier selection and anticipated contract style.', '1 = directed (sole-source, Advance Contract Award Notice - ACAN).</br>\r\n2 = a standing offer call-up.</br>\r\n4 = a supply arrangement procurement.</br>\r\n5 = a public tender (request for quotation,</br> invitation to tender, request for proposal).', 3),
(32, 'How many of the following statements pertaining to contract management are true?\r\n\r\nThe personnel who wrote the contract are involved in the management of the contract.\r\nThere is a standardized acceptance process for the review of the completion of contracts (e.g. peer reviewing or field trials).\r\nThe lines of communication between the contract authority and the contractor are well-defined and regularized.\r\nThere is a standardized process for reporting progress (e.g. punctual evaluation or regular meetings).\r\nThere is a mechanism in place to address any contractual disagreements between parties regarding the completion of a contract.', '1 = All statements are true.</br>\r\n2 = Four statements are true.</br>\r\n3 = Three statements are true.</br>\r\n4 = Two statements are true.</br>\r\n5 = One or none of the statements are true.', 3),
(33, 'Has PWGSC or a delegated contracting authority been formally engaged through a service agreement to provide adequate support for the procurement process?', '1 = Yes, or not required.</br>\r\n3 = This is planned but not yet in place.</br>\r\n5 = No.', 3),
(34, 'Does the organization anticipate a shortage of available personnel with appropriate skills during a significant period of the project?', '1 = No</br>\r\n5 = Yes', 4),
(35, 'What is the predicted stability of the project team? Consider the following criteria:\r\n\r\nThe project team has previously worked together.\r\nA low rate of turnover is expected.\r\nIt is expected that a suitable replacement will be readily available.', '1 = All three criteria are met.</br>\r\n2 = Two of the three criteria are met.</br>\r\n4 = One of the three criteria is met.</br>\r\n5 = None of the three criteria are met.', 4),
(36, 'What percentage of the project team is assigned full-time to the project?', '1 = over 80 per cent</br>\r\n2 = 61-80 per cent</br>\r\n3 = 41-60 per cent</br>\r\n4 = 20-40 per cent</br>\r\n5 = under 20 per cent or all part-time', 4),
(37, 'Consider the following criteria regarding knowledge and experience:\r\n\r\nThe project will use a proven approach.\r\nThis type of project has been done before in the Government of Canada.\r\nThe project will use resources that have been applied to this type of project before.', '1 = All three criteria are met.</br>\r\n2 = Two of the three criteria are met.</br>\r\n4 = One of the three criteria is met.</br>\r\n5 = None of the three criteria are met.', 4),
(38, 'Has the assigned project manager worked on a project of this size and complexity before?', '1 = Yes</br>\r\n5 = No', 4),
(39, 'Describe the overall effect of this project on the organization:', '1 = Project will fit with the organization\'s current processes,</br>use existing workforce and skills, and not require substantial changes</br> to technology and other infrastructure.</br>\r\n3 = Some changes to processes, staffing models, or technology will be required.</br>\r\n5 = Significant restructuring of business processes, staffing requirements,</br> partner relationships, and infrastructure will be required.', 5),
(40, ' Does the project have a change management plan?', '1 = Change management will be required and a change management plan has been prepared.</br> Alternatively, there are no significant change management requirements.</br>\r\n3 = Change management will be required and preparation of a change management plan </br>is incorporated or included in the project management plan.</br>\r\n5 = Change management will be required but there are no plans to establish a change management plan.', 5),
(41, ' What is the level of public involvement required to achieve expected outcomes?', '1 = No public participation is required for project success.</br>\r\n2 = Limited public participation is required for project success.</br>\r\n4 = Moderate public participation is required for project success.</br>\r\n5 = Extensive public participation is required for project success.', 5),
(42, 'What level of legal risk will be introduced by this project through the addition of new liabilities, regulatory requirements, and legislative changes?', '1 = No legal review is required;</br> no legislative changes are required; </br>legal costs and effort are assessed as low.</br>\r\n2 = One or more risk events will likely occur resulting in legal costs and effort; </br>a legal review has been completed.</br>\r\n3 = One or more risk events will likely occur resulting in legal costs and effort;</br> a legal review has not been completed.</br>\r\n4 = There is a high probability of liability and other legal risks;</br> extensive legal resources will be required during the project; </br>legislative change is required to implement the project; </br>a legal review has been completed.</br>\r\n5 = There is a high probability of liability and other legal risks; </br>extensive legal resources will be required during the project; </br>legislative change is required to implement the project;</br> a legal review has not been completed.', 5),
(43, 'Are there expected challenges to ensure that this project complies with relevant Treasury Board policy requirements, such as those regarding security, accessibility, common look and feel standards for the Internet, and management of government information?', '1 = The project fully complies with all applicable policies.</br> Alternatively, the project is not subject to any of these policies.</br>\r\n3 = There are some challenges associated with policy requirements, </br>but the project team is adequately equipped to address these.</br>\r\n5 = There are some challenges associated with policy requirements and </br>there is a lack of confidence that policy requirements can be met on schedule and within the budget.</br>', 5),
(44, 'How many of the following elements are defined in the project management plan?\r\n\r\nscope\r\ncosts\r\nschedule\r\nproject controls\r\nrisks\r\ndeliverables\r\nteam or skills', '1 = All elements are defined.</br>\r\n2 = Five or six elements are defined.</br>\r\n3 = Three or four elements are defined.</br>\r\n4 = One or two elements are defined.</br>\r\n5 = No plan has been completed.', 6),
(45, ' To indicate the extent of the project team\'s being appropriately organized to undertake a project of this scope, how many of these criteria are met?\r\n\r\nProject team composition, resource levels, and roles and responsibilities are defined and documented.\r\nResources are dedicated (i.e. available when required).\r\nResponsibilities and required authorities for managers and leads within the project team are defined and documented.', '1 = All three criteria are met.</br>\r\n2 = Two of the three criteria are met.</br>\r\n4 = One of the three criteria is met.</br>\r\n5 = None of the three criteria are met.', 6),
(46, 'Has a project reporting and control process appropriate for the project been documented?', '1 = Yes</br>\r\n3 = The development of a project reporting and control process is a planned activity,</br> but not yet completed.</br>\r\n5 = No', 6),
(47, 'How many of the following disciplines will, or does the project employ?\r\n\r\nquality assurance\r\nrisk management\r\noutcome management\r\nissue management', '1 = All four disciplines.</br>\r\n2 = Three of the disciplines.</br>\r\n3 = Two of the disciplines.</br>\r\n4 = One of the disciplines.</br>\r\n5 = None of the disciplines.', 6),
(48, 'Has a risk management plan been completed, and to what degree have appropriate contingency plans been included which respond to the risks as identified in the plan?\r\n\r\nConsider the following criteria:\r\n\r\nIdentified risks have been assessed and prioritized.\r\nAppropriate controls and mitigations are in place for all significant residual risks.\r\nA risk management plan has been integrated into the project management plan.', '1 = All three criteria are met,</br> OR a risk management plan is not required.</br>\r\n2 = Two of the three criteria are met.</br>\r\n4 = One of the three criteria is met.</br>\r\n5 = None of the three criteria are met.', 6),
(49, 'Is an appropriate information management (IM) process planned or in place to collect, distribute, and protect relevant and important project information, such as designs, project plans, baseline, and registers?', '1 = Comprehensive information management practices are in place or planned </br>to support the project throughout its life cycle.</br>\r\n3 = Standard IM practices are planned or in place and resourced.</br>\r\n5 = Minimal IM practices are in place or planned within the project.</br>', 6),
(50, 'How many of the following statements are true?\r\n\r\nThe project solution requires a high degree (greater than normal) of availability.\r\nThe project solution requires customization beyond normal configuration.\r\nThe project solution requires a high degree of performance quality.\r\nThe project solution requires a high degree of reliability.', '1 = None of the statements are true.</br>\r\n2 = One of the statements is true.</br>\r\n3 = Two of the statements are true.</br>\r\n4 = Three of the statements are true.</br>\r\n5 = All of the statements are true.', 7),
(51, 'In defining project requirements, how many of the following statements are true?\r\n\r\nThe requirements can be defined with very few people.\r\nThe requirements can be defined in a short period of time.\r\nThere are a small number of individual requirements to define.\r\nThe requirements do not require a high degree of detail.', '1 = Four of the statements are true.</br>\r\n2 = Three of the statements are true.</br>\r\n3 = Two of the statements are true.</br>\r\n4 = One of the statements is true.</br>\r\n5 = None of the statements are true.', 7),
(52, 'To what extent have available sources/methods been employed and verified to provide information for this project as applicable (e.g. research, consultations, workshops, surveys, and existing documentation)?', '1 = All sources/methods have been employed and verified.</br>\r\n2 = All sources/methods have been employed but have not been verified.</br>\r\n3 = Some sources/methods have been employed.</br>\r\n4 = Few sources/methods have been employed.</br>\r\n5 = No information has been gathered or is available.', 7),
(53, 'Have the business requirements been validated with users with an appropriate technique, such as walk-throughs, workshops, and independent verification and validation?', '1 = Yes</br>\r\n3 = Validation is a planned activity but has not yet been completed.</br>\r\n5 = No', 7),
(54, 'Have feasibility studies been conducted, and is there confidence in the assumptions made in the feasibility studies?', '1 = Feasibility studies are not required, </br>because none of the requirements are technically difficult to implement.</br>\r\n2 = Feasibility studies were conducted and there is confidence in the assumptions made.</br>\r\n4 = Feasibility studies were conducted,</br> but there is not complete confidence in the assumptions made.</br>\r\n5 = Feasibility studies were necessary but not conducted.', 7),
(55, 'What percentage of tasks cannot be fully defined until the completion of previous tasks? These are tasks that may be understood but cannot be documented in detail due to dependency on results from a previous task.', '1 = under 10 per cent</br>\r\n2 = 20 per cent</br>\r\n3 = 30 per cent</br>\r\n4 = 40 per cent</br>\r\n5 = over 40 per cent', 7),
(56, 'To what extent are the project\'s requirements clear, completed, and communicated?', '1 = All requirements are clear, complete, and communicated.</br>\r\n3 = Up to 10 per cent of total requirements are not complete or are undocumented.</br>\r\n5 = More than 10 per cent of total requirements are not complete or are unclear.', 7),
(57, 'How many of the following project characteristics are expected to remain stable?\r\n\r\nquality\r\nfunctionality\r\nschedule\r\nintegration\r\ndesign\r\ntesting', '1 = All of the project characteristics are expected to remain stable.</br>\r\n2 = Five of the six project characteristics are expected to remain stable.</br>\r\n3 = Four of the six project characteristics are expected to remain stable.</br>\r\n4 = Three of the six project characteristics are expected to remain stable.</br>\r\n5 = Two or less of the project characteristics are expected to remain stable.', 7),
(58, 'Are any other projects dependent on outputs or outcomes of this project?', '1 = No</br>\r\n5 = Yes', 7),
(59, 'Are outcomes of this project dependent on the outputs and/or outcomes of any other projects?', '1 = No</br>\r\n5 = Yes', 7),
(60, 'What degree of integration with externalities, such as other projects, systems, infrastructure, or organizations, is required?', '1 = There are few complex integration requirements;</br> activities to specify integration are included in the project management plan.</br>\r\n3 = There is adequate understanding and planning for integration.</br>\r\n5 = There are highly complex or numerous integration requirements </br>and insufficient planning of required activities.', 7),
(61, 'What degree of integration is required within the project?', '1 = There are few complex integration requirements; </br>activities to specify integration are included in the project management plan.</br>\r\n3 = There is adequate understanding and planning for integration.</br>\r\n5 = There are highly complex or numerous integration requirements</br> and insufficient planning of required activities.', 7),
(62, 'Relative to the average (typical) project in your organization, which of the following adjectives describes the number of tasks, elements, or deliverables in the work breakdown structure?', '1 = Small</br>\r\n3 = Medium</br>\r\n5 = Large', 7),
(63, ' Does the project schedule accommodate the critical path of the project, including appropriate contingencies?', '1 = Yes</br>\r\n5 = No, OR no critical path analysis has been performed.', 7),
(64, '64. What is the effect on the project of the requirement for scarce resources or resources that are in very high demand?', '1 = No scarce resources are required OR not applicable.</br>\r\n2 = The project will incur minor delays or minor cost overruns due to scarcity of resources.</br>\r\n3 = The project will incur moderate delays or moderate cost overruns due to scarcity of resources.</br>\r\n4 = The project will incur significant delays or significant cost overruns</br> due to scarcity of resources and must return to Treasury Board for revised approval.</br>\r\n5 = The success of the project is critically dependent on scarce resources.', 7);

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `scoreid` int(255) NOT NULL,
  `projectid` int(255) DEFAULT NULL,
  `score1` varchar(255) DEFAULT NULL,
  `score2` varchar(255) DEFAULT NULL,
  `score3` varchar(255) DEFAULT NULL,
  `score4` varchar(255) DEFAULT NULL,
  `score5` varchar(255) DEFAULT NULL,
  `score6` varchar(255) DEFAULT NULL,
  `score7` varchar(255) DEFAULT NULL,
  `scoreoverall` varchar(255) DEFAULT NULL,
  `infocrldid` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `score`
--

INSERT INTO `score` (`scoreid`, `projectid`, `score1`, `score2`, `score3`, `score4`, `score5`, `score6`, `score7`, `scoreoverall`, `infocrldid`) VALUES
(1, 43211, '65', '28', '40', '20', '19', '23', '67', '262', 4),
(2, 76544, '70', '20', '40', '22', '21', '22', '56', '251', 4),
(3, 98766, '89', '27', '41', '24', '21', '27', '70', '299', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(100) NOT NULL,
  `position` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `position`, `username`, `password`) VALUES
(6, 'Admin', 'admin', '123'),
(4563, 'Manager', 'manager', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `criteria`
--
ALTER TABLE `criteria`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `infocrld`
--
ALTER TABLE `infocrld`
  ADD PRIMARY KEY (`infocrldid`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`projectid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`questionid`),
  ADD KEY `FK_question` (`cid`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`scoreid`),
  ADD KEY `score_ibfk_2` (`projectid`),
  ADD KEY `infocrldid` (`infocrldid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `infocrld`
--
ALTER TABLE `infocrld`
  MODIFY `infocrldid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `score`
--
ALTER TABLE `score`
  MODIFY `scoreid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `FK_question` FOREIGN KEY (`cid`) REFERENCES `criteria` (`cid`);

--
-- Constraints for table `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `score_ibfk_1` FOREIGN KEY (`projectid`) REFERENCES `project` (`projectid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `score_ibfk_2` FOREIGN KEY (`projectid`) REFERENCES `project` (`projectid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `score_ibfk_3` FOREIGN KEY (`infocrldid`) REFERENCES `infocrld` (`infocrldid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
