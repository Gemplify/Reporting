-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:8889
-- Tiempo de generación: 24-05-2021 a las 15:35:00
-- Versión del servidor: 5.6.38
-- Versión de PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `books_stats`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `customerno` varchar(30) NOT NULL,
  `selidprofile` varchar(255) DEFAULT NULL,
  `targetidlocation` varchar(255) DEFAULT NULL,
  `idlocation` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `titlea` varchar(255) DEFAULT NULL,
  `firstnamea` varchar(255) DEFAULT NULL,
  `prefixa` varchar(255) DEFAULT NULL,
  `namea` varchar(255) DEFAULT NULL,
  `addresseeaddon1` varchar(255) DEFAULT NULL,
  `addresseeaddon2` varchar(255) DEFAULT NULL,
  `addresseeaddon3` varchar(255) DEFAULT NULL,
  `institutiona` varchar(255) DEFAULT NULL,
  `departmenta` varchar(255) DEFAULT NULL,
  `subdepartmenta` varchar(255) DEFAULT NULL,
  `subdepartment2a` varchar(255) DEFAULT NULL,
  `titleb` varchar(255) DEFAULT NULL,
  `firstnameb` varchar(255) DEFAULT NULL,
  `prefixb` varchar(255) DEFAULT NULL,
  `nameb` varchar(255) DEFAULT NULL,
  `institutionb` varchar(255) DEFAULT NULL,
  `departmentb` varchar(255) DEFAULT NULL,
  `subdepartmentb` varchar(255) DEFAULT NULL,
  `subdepartment2b` varchar(255) DEFAULT NULL,
  `postalcode` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `citydistrict` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `streetnumber` varchar(255) DEFAULT NULL,
  `addressaddon` varchar(255) DEFAULT NULL,
  `addressaddon2` varchar(255) DEFAULT NULL,
  `addressaddon3` varchar(255) DEFAULT NULL,
  `postofficedescr` varchar(255) DEFAULT NULL,
  `poboxnumber` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `termstate` varchar(255) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `anrede` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `mobilphone` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `externalreferencenumber` varchar(255) DEFAULT NULL,
  `idprofilesource` varchar(255) DEFAULT NULL,
  `personinstitution` varchar(255) DEFAULT NULL,
  `idjuristicperson` varchar(255) DEFAULT NULL,
  `deliveryaddinfo` varchar(255) DEFAULT NULL,
  `personinstitution2` varchar(255) DEFAULT NULL,
  `campaignnoinfo` varchar(255) DEFAULT NULL,
  `idjuristicpersonb` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customer_rel`
--

CREATE TABLE `customer_rel` (
  `id` int(11) NOT NULL,
  `custtype` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customerno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `voucheryear` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pending_statistik`
--

CREATE TABLE `pending_statistik` (
  `id` int(11) NOT NULL,
  `orderdate` varchar(255) DEFAULT NULL,
  `ordermark` varchar(255) DEFAULT NULL,
  `valutadate` varchar(255) DEFAULT NULL,
  `valuta` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `plandeliverydate` varchar(255) DEFAULT NULL,
  `isbnorderno` varchar(255) DEFAULT NULL,
  `isbn` varchar(255) DEFAULT NULL,
  `binding` varchar(255) DEFAULT NULL,
  `pubdate` varchar(255) DEFAULT NULL,
  `orderno` varchar(255) DEFAULT NULL,
  `mandator` varchar(255) DEFAULT NULL,
  `groupofcompany` varchar(255) DEFAULT NULL,
  `orderquantity` varchar(255) DEFAULT NULL,
  `orderid` varchar(255) DEFAULT NULL,
  `partquantity` varchar(255) DEFAULT NULL,
  `customerno` varchar(255) DEFAULT NULL,
  `shorttitle` varchar(255) DEFAULT NULL,
  `jpinfoadrinfo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `isbno_noissn` varchar(30) DEFAULT NULL,
  `editionno` varchar(2) DEFAULT NULL,
  `project_no` varchar(20) DEFAULT NULL,
  `prdsrl` varchar(255) DEFAULT NULL,
  `publisher` varchar(20) DEFAULT NULL,
  `pub_date` varchar(15) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `shorttitle` varchar(255) DEFAULT NULL,
  `authors` varchar(255) DEFAULT NULL,
  `editors` varchar(255) DEFAULT NULL,
  `divisionms_type` varchar(255) DEFAULT NULL,
  `subjectgroup` varchar(255) DEFAULT NULL,
  `language` varchar(15) DEFAULT NULL,
  `acqeditor` varchar(255) DEFAULT NULL,
  `pubyear` varchar(4) DEFAULT NULL,
  `pubmonth` varchar(5) DEFAULT NULL,
  `mainthemacode` varchar(255) DEFAULT NULL,
  `mainthematext` varchar(255) DEFAULT NULL,
  `themacode2` varchar(255) DEFAULT NULL,
  `thematext2` varchar(255) DEFAULT NULL,
  `themacode3` varchar(255) DEFAULT NULL,
  `thematext3` varchar(255) DEFAULT NULL,
  `mainbiccode` varchar(255) DEFAULT NULL,
  `mainbictext` varchar(255) DEFAULT NULL,
  `biccode2` varchar(255) DEFAULT NULL,
  `bictext2` varchar(255) DEFAULT NULL,
  `biccode3` varchar(255) DEFAULT NULL,
  `bictext3` varchar(255) DEFAULT NULL,
  `mainbisaccode` varchar(255) DEFAULT NULL,
  `mainbisactext` varchar(255) DEFAULT NULL,
  `bisaccode2` varchar(255) DEFAULT NULL,
  `bisactext2` varchar(255) DEFAULT NULL,
  `bisaccode3` varchar(255) DEFAULT NULL,
  `bisactext3` varchar(255) DEFAULT NULL,
  `availability` varchar(255) DEFAULT NULL,
  `editionsizeplanned` varchar(255) DEFAULT NULL,
  `seriestitle` varchar(255) DEFAULT NULL,
  `seriessubtitle` varchar(255) DEFAULT NULL,
  `seriescode` varchar(255) DEFAULT NULL,
  `seriesissn` varchar(255) DEFAULT NULL,
  `volumeno` varchar(255) DEFAULT NULL,
  `maindesc` text,
  `shortdesc` varchar(255) DEFAULT NULL,
  `toc` varchar(255) DEFAULT NULL,
  `authorsbio` varchar(255) DEFAULT NULL,
  `awards` varchar(255) DEFAULT NULL,
  `pricesfr` varchar(255) DEFAULT NULL,
  `priceeur_d` varchar(255) DEFAULT NULL,
  `priceeur_a` varchar(255) DEFAULT NULL,
  `priceeur` varchar(255) DEFAULT NULL,
  `pricegbp` varchar(255) DEFAULT NULL,
  `priceusd` varchar(255) DEFAULT NULL,
  `version` varchar(255) DEFAULT NULL,
  `binding` varchar(255) DEFAULT NULL,
  `pages` varchar(255) DEFAULT NULL,
  `pagesapprox` varchar(255) DEFAULT NULL,
  `format` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `illuscolour` varchar(255) DEFAULT NULL,
  `illusblackandwhite` varchar(255) DEFAULT NULL,
  `productlink` varchar(255) DEFAULT NULL,
  `pre_pubprice_chf` varchar(255) DEFAULT NULL,
  `subscriptionprice_chf` varchar(30) DEFAULT NULL,
  `specialprice_chf` varchar(30) DEFAULT NULL,
  `multi_userpricelibrary_chf` varchar(30) DEFAULT NULL,
  `chapterprice_chf` varchar(30) DEFAULT NULL,
  `pre_pubprice_eur` varchar(30) DEFAULT NULL,
  `subscriptionprice_eur` varchar(30) DEFAULT NULL,
  `specialprice_eur` varchar(30) DEFAULT NULL,
  `multi_userpricelibrary_eur` varchar(30) DEFAULT NULL,
  `chapterprice_eur` varchar(30) DEFAULT NULL,
  `pre_pubprice_eura` varchar(30) DEFAULT NULL,
  `subscriptionprice_eura` varchar(30) DEFAULT NULL,
  `specialprice_eura` varchar(30) DEFAULT NULL,
  `multi_userpricelibrary_eura` varchar(30) DEFAULT NULL,
  `chapterprice_eura` varchar(30) DEFAULT NULL,
  `pre_pubprice_eurd` varchar(30) DEFAULT NULL,
  `subscriptionprice_eurd` varchar(30) DEFAULT NULL,
  `specialprice_eurd` varchar(30) DEFAULT NULL,
  `multi_userpricelibrary_eurd` varchar(30) DEFAULT NULL,
  `chapterprice_eurd` varchar(30) DEFAULT NULL,
  `pre_pubprice_usd` varchar(30) DEFAULT NULL,
  `subscriptionprice_usd` varchar(30) DEFAULT NULL,
  `specialprice_usd` varchar(30) DEFAULT NULL,
  `multi_userpricelibrary_usd` varchar(30) DEFAULT NULL,
  `chapterprice_usd` varchar(30) DEFAULT NULL,
  `subsequentedition` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `statistik`
--

CREATE TABLE `statistik` (
  `id` int(11) NOT NULL,
  `customerno` varchar(255) DEFAULT NULL,
  `invaddressno` varchar(255) DEFAULT NULL,
  `deladdressno` varchar(255) DEFAULT NULL,
  `jahr` varchar(255) DEFAULT NULL,
  `monat` varchar(255) DEFAULT NULL,
  `postingdate` varchar(20) DEFAULT NULL,
  `invoiceno` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `isbn` varchar(255) DEFAULT NULL,
  `ordernumber` varchar(255) DEFAULT NULL,
  `ordertype` varchar(255) DEFAULT NULL,
  `orderno` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `netsalesrevenue` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(2) NOT NULL,
  `type` int(2) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `customer_rel`
--
ALTER TABLE `customer_rel`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pending_statistik`
--
ALTER TABLE `pending_statistik`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `statistik`
--
ALTER TABLE `statistik`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217880;

--
-- AUTO_INCREMENT de la tabla `customer_rel`
--
ALTER TABLE `customer_rel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5186;

--
-- AUTO_INCREMENT de la tabla `pending_statistik`
--
ALTER TABLE `pending_statistik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2980;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80639;

--
-- AUTO_INCREMENT de la tabla `statistik`
--
ALTER TABLE `statistik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1749998;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
