-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 30 avr. 2019 à 16:33
-- Version du serveur :  10.1.37-MariaDB
-- Version de PHP :  7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `api`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adress` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `name`, `adress`) VALUES
(5, 'Blue Mobile Shop', ' rue test'),
(6, 'Red Mobile Shop', 'red test');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190419230151', '2019-04-19 23:02:04'),
('20190426091446', '2019-04-26 09:15:42');

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `screensize` int(11) DEFAULT NULL,
  `processor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `memory` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `name`, `screensize`, `processor`, `memory`) VALUES
(1, 'iphone 5', NULL, '?', 16),
(2, 'iphone 6', NULL, 'A8', 64),
(3, 'iphone X', NULL, '2,39 Mhz', 256),
(4, 'samsung S5', NULL, '2,5 Mhz', 32),
(5, 'samsung S7', NULL, '2,3 Mhz', 32),
(6, 'samsung S9', NULL, '2,7 Mhz', 64),
(7, 'Xioami note 5', NULL, '1,8 Mhz', 64),
(8, 'Xioami Mi 2', NULL, 'N.C', 128),
(9, 'nokia Lumia 830', NULL, '1,2 Mhz', 16);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `email` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `client_id`, `email`, `token`, `first_name`, `last_name`) VALUES
(7, 5, 'demoMail1@blueMobileShop.com', NULL, 'BlueDemoUser-1-FirstName', 'BlueDemoUser-1-LastName'),
(8, 5, 'demoMail2@blueMobileShop.com', NULL, 'BlueDemoUser-2-FirstName', 'BlueDemoUser-2-LastName'),
(9, 5, 'demoMail3@blueMobileShop.com', NULL, 'BlueDemoUser-3-FirstName', 'BlueDemoUser-3-LastName'),
(10, 5, 'demoMail4@blueMobileShop.com', NULL, 'BlueDemoUser-4-FirstName', 'BlueDemoUser-4-LastName'),
(11, 5, 'demoMail5@blueMobileShop.com', NULL, 'BlueDemoUser-5-FirstName', 'BlueDemoUser-5-LastName'),
(12, 5, 'demoMail6@blueMobileShop.com', NULL, 'BlueDemoUser-6-FirstName', 'BlueDemoUser-6-LastName'),
(13, 5, 'demoMail7@blueMobileShop.com', NULL, 'BlueDemoUser-7-FirstName', 'BlueDemoUser-7-LastName'),
(14, 5, 'demoMail8@blueMobileShop.com', NULL, 'BlueDemoUser-8-FirstName', 'BlueDemoUser-8-LastName'),
(15, 5, 'demoMail9@blueMobileShop.com', NULL, 'BlueDemoUser-9-FirstName', 'BlueDemoUser-9-LastName'),
(16, 5, 'demoMail10@blueMobileShop.com', NULL, 'BlueDemoUser-10-FirstName', 'BlueDemoUser-10-LastName'),
(17, 6, 'demoMail11@redMobileShop.com', NULL, 'RedDemoUser11FirstName', 'RedDemoUser11LastName'),
(18, 6, 'demoMail12@redMobileShop.com', NULL, 'RedDemoUser12FirstName', 'RedDemoUser12LastName'),
(19, 6, 'demoMail13@redMobileShop.com', NULL, 'RedDemoUser13FirstName', 'RedDemoUser13LastName'),
(20, 6, 'demoMail14@redMobileShop.com', NULL, 'RedDemoUser14FirstName', 'RedDemoUser14LastName'),
(21, 6, 'demoMail15@redMobileShop.com', NULL, 'RedDemoUser15FirstName', 'RedDemoUser15LastName'),
(22, 6, 'demoMail16@redMobileShop.com', NULL, 'RedDemoUser16FirstName', 'RedDemoUser16LastName'),
(23, 6, 'demoMail17@redMobileShop.com', NULL, 'RedDemoUser17FirstName', 'RedDemoUser17LastName'),
(24, 6, 'demoMail18@redMobileShop.com', NULL, 'RedDemoUser18FirstName', 'RedDemoUser18LastName'),
(25, 6, 'demoMail19@redMobileShop.com', NULL, 'RedDemoUser19FirstName', 'RedDemoUser19LastName'),
(26, 6, 'demoMail20@redMobileShop.com', NULL, 'RedDemoUser20FirstName', 'RedDemoUser20LastName'),
(27, 5, 'monemail.fr', 'AQWZgV1TEdbEABpLFIswTjwJhNmu3001CWnB8WDB6XDbHaGCRT95I2qO2qLZOrjB9TQO0a9aFsJ4SMNXQvbZny8MVtE8qdTn2t7CEoMUzP-iCVlHg7y4bOlujSHbTQ7dIJhjQi-mZGMUE9y2jhrR08fqtERjmKdkY3xhzHolkGIgtLll9PJMX7oYJdLWAZRxkRVyDaHmOI9gIg10Jrx9LQQLY7fcwZe--agMgPCYc25rrKVEKD7rt_-qEvYcVMVVK1JAKnNhKFPh94V1eLL9Yy2ItBgrE3wBGdpim5p5cZYLA9-PAJrBst5jJ2IcPgp1eFpgRJcCtOogDEX9_0n3K8v7YlmKaw', 'muhammed', 'inan'),
(28, 5, 'monemail.fr', 'AQVEeQpj56TD7BxwRfJtQRRkTQW-P4CSr9w3xQHAYMogH26CDmbd8L3oWtfjzYvxGaZWarwta65pLNEcZcIsCoFPQksFMJgP5C14QvnF2CjFTYFzB3utlpgeZFgH33zcuoE6xSI1JxPV52jlfnZsyCpXG4EtrJrFs4rfPcmGcTQY_MtNyiyiWDFC1EgrPXxde-AH0bniHLu7k3demQQ3LyV3X9vRhYqpHxRy64_yUraHQLGhrHi1XjBd5W4Gjs9Zbu8ot3OXwJCRZ72ZrUtXdmhWH1HHw85xYW2hmSdVSa_T2ecnX5oT3XuxWGDEcHdwuCT9wXJiVoD66AbMkCrlT-lGrV5lQA', 'muhammed', 'inan'),
(29, 5, 'monemail.fr', 'AQXvhurCAIygxUz85arEViqv4bBEvQanMYC20EVQwjx2DZqA0EJW63LtrvjVrcxZtUIS0BFo7p8RAMjvDwLfm7rUuDXWsh_Vw1-4twGWMRwoERFDtWE4fSNGEHqwXBQksIY5ot6hYwwEjNzUByY1AEGE9qZGVK-R0wI2Qry5OpzL_pDAqP0sM7PgRxFDXeq7Zen159NmJQdwJ52DdDfgD3L7tXsXDML94KuOR9SHemQpY3FSrzUETm9xg81rQOGZA_2mvmGMgZrlrXm0Lt-irxhq5pa386r0H5yxruJaz8kggV5ezKN2TIzyr0gVVx2A6LTeWBr49FhG28vnxqVJP13LXd1TfQ', 'muhammed', 'inan'),
(30, 5, 'monemail.fr', 'AQVQ_xzmIEiZBkiYR24AiyHdGVJiQ_vb4MKtqDXxTbGbbixKbP04ekgsIaY4frtNEe2zN3Wt2BBQXun6szWaLdvIuQareLwK9hBvcQB1TXMRwH6BUkdrL7c7tyDvJ5WVJ9Sp-OU9lrGGQOmKKKene3UR71cmyfDWvbb-JHdXx8B2EafIFfNX85fLqtmwwlE1IuAWWGeCgvWMI2giDB7xF1DQXAnKHA-Ve8JyJmTKAmklYqouu52uS08eP5vWyAX3DcVHOOT8VgnPd9cAxVGM05ViU2ZZXa1FRWLGHrOp7FvL6Z_zUZWEXF6fcXPPfviJ37ssOxr7-QdzvKHJdFSliPW2__lOYQ', 'muhammed', 'inan'),
(31, 5, 'monemail.fr', 'AQUvyxSCkA2UH6Kqc0iIaJp2OIq52cdjbf2I7cEE-PC8wVHySBTQ8xJByjjFZ8I6i6frp7QmLsJXMvBLRDerbHblInVnTU7qiLyXVMlaL8neAoVpYQk28EHswYHJuaFNxguUsupK5i_vF9ZlYFXkcRFFQICiXNCFn9TUlscc0qBDir8QHd903CwD5vOR6mJmHkVZukC_nSSjJdOGSgT2_AnhbLOd_X7Zf4pBAyQ-h4BB6vWh5fCvortmCfuQl7uZoBCtD_wPfugK1YBf39T8DNeNQtiGNhj2qrhHyRrccSn5gNZe-NCG6ESzCDzdcuqfLRxf-4FbLQj0U5xt1W6qFh52ESKB6w', 'muhammed', 'inan'),
(32, 5, 'monemail.fr', 'AQVWIooDyLL2c70HHsfIo3OFX2JYesXVVIWdiNGDG9OO-gDuZx1ou2UGRArY9oFGXgP4Pcul4nDczEv68pD-JL7Hr3NJvU3IJjTePNdihj2aC_ZXWilPBIML71HVEorrHj85vz1ec5jkF6PM8x8VzjfkzUYIu0raTbHSuJNyZT06VXvvMArhrN-7N9DTxuZvXPGSUY5Zi_HkQtFQ5E_xmL06depV27ZbZ-pURmG2ZMBkW1pQ2srdYzbULeTmu-9RUFxo6s4BYr1oPOWTMVI2khxV_56B_5IY2voCt5u4Tmk7kNWqyThAzFvytCICetrA2KnprlIhRSlRSQtmoZ7g3xWaOztsRQ', 'muhammed', 'inan'),
(33, 5, 'monemail.fr', 'AQWQJCBh44pwaJyExftckdcfG9rOuxX7NfpYoxR1jYla4EAPlj6UzCIUtiXRUw8XZAHjSHDRdE55rZaPUAQFuA3meTlDzKRYCmn6nanZ-Y7SgzuSFy8hoTiQimyCNgsI2V8KUxBxhrBvgneNSG707T2Tw34p0smDgGPGAKzaNt6QkExEDD1J_BW3GLugfj_b-Kk7o_dOxZX2tqSVdlN-TRNSnTzI90jcIZum7oL5Mg8y3-xOslQmtfvFNwBsdcpYB_Fj3zS53K9vgQlHePkDdTcIbcw_X2EaofLSBqG3XgWkrTlsjNyYUDXrMO9mhz14D5kFrzYopN4Nm_YhcmD3N6Iz3xxfIw', 'muhammed', 'inan'),
(34, 5, 'monemail.fr', 'AQWY0bi-GgeQCzfLXuSys0q_zWQ3CZoEyd0mhjdcmimoWfiRlYpQJJvc7_u3ksYPsqeqveSLER2Eh0xj3GHHs1Tag_5gIe6ktHN3hhGdMCQxi1-CnbHWFYWMcg3cjWipF5uxIlpiCCd1qr0ysB6pUReBww21zr5Mj71Fbilu4EGSO6HG4fbCP0CHbWqam3Vb6MkWKrUnnQcU3nQB6I7oK3uoMU4Tv-MK_ItOYxna0CGTa0Zr7TmCrYSrjCiS2dDKJX7v29jp1or9HIyf37-ckCxs2nlFZrLsTB3at8fugXeW-Yg00qzo0D9qzzFdIDhT9uEkOm_PIAIr4loS24oyvmQeYyF0bw', 'muhammed', 'inan'),
(35, 5, 'monemail.fr', 'AQV_21tiOTzcTkj-5Et4MG33ij8vS3qTr9VOl6CXZJdfnh0Ht5KO67eaa70SyFQXQHb9yMWJDBWoFXRPdUcRrrvq8ApCzdbugSl8TOkp5EgerRZyTckpEnveLNaei6HMX5BbuNkTDDgNd75oiiAYe0D5J00lTGNK359wWakRpHglMNu2UgQpQEHW1HDT9Sjz4UV_1QnN_Erc0yyv7AbJdqwYiM0j1J5t99JtR5vQQDF4_jnv5vhM8IedPf9F6DteK78UUj297L0OOqt3GYdDobzovNS3G9gJD_B8OF2dA-EPY9JD6-vFEowrTj0xj6--q2kVAaq3YIiaknTgWEAvXPmaijPELw', 'muhammed', 'inan'),
(36, 5, 'monemail.fr', 'AQUxOQwbm4PpmU6bi4bq97dYuZvBPw2qAN3N-1o-68W65b8DeIhbNNis97YU1jbpw5hucZX2YRsCUrSquyEOLlpDpHFy-d7khK-WY8KAxcuRNXOlSMXxGkyInBlFyrnKJtgxR4MYFCq_kSPZiXo_gS2uborZsqQ5x131IeMR1rlv9mnG_zDCyJ73dxfKnrBCo3YfNMqy8KU33v5kFL6chJJa7-a7-a3c33q7ZrA3HGRCMdA5Cejwev_K82LcnQhcUfr5LEFJ1nidfWwcS4DvYvzrlt9GP-8zvujs-DyNExnsamrE2aLo8PHYq6gWCajftREqCuJPoppU0VHCt3aI0eoVvZoQow', 'muhammed', 'inan');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8D93D64919EB6921` (`client_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D64919EB6921` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
