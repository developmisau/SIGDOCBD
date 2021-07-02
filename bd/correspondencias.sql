-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 25-Nov-2020 às 10:55
-- Versão do servidor: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sigdoc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `correspondencias`
--

CREATE TABLE `correspondencias` (
  `id` int(11) NOT NULL,
  `numCorrespondencia` varchar(100) NOT NULL,
  `tipo_pro` varchar(45) DEFAULT NULL,
  `categorias_id` int(11) DEFAULT NULL,
  `tipo_doc_id` int(11) DEFAULT NULL,
  `classificacao_id` int(11) DEFAULT NULL,
  `prioridades_id` int(11) DEFAULT NULL,
  `refProv` varchar(200) DEFAULT NULL,
  `refRec` varchar(200) DEFAULT NULL,
  `pro_direcoes_id` int(11) DEFAULT '0',
  `pro_departamentos_id` int(11) DEFAULT '0',
  `pro_reparticoes_id` int(11) DEFAULT '0',
  `pro_externa_id` int(11) DEFAULT '0',
  `num_entrada_saida_livro` varchar(200) NOT NULL,
  `data_entrada_saida_livro` varchar(200) NOT NULL,
  `assunto` tinytext,
  `observacao` text,
  `destinatario` varchar(200) DEFAULT NULL,
  `estadoTra` int(11) DEFAULT '0',
  `estadoDes` int(11) NOT NULL,
  `file` varchar(100) DEFAULT NULL,
  `path` varchar(300) DEFAULT NULL,
  `url` varchar(300) DEFAULT NULL,
  `local_direcoes_id` int(11) DEFAULT NULL,
  `local_departamentos_id` int(11) DEFAULT NULL,
  `local_reparticoes_id` int(11) DEFAULT NULL,
  `usuarios_id` int(11) DEFAULT NULL,
  `date` varchar(200) NOT NULL,
  `data_normal` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `correspondencias`
--

INSERT INTO `correspondencias` (`id`, `numCorrespondencia`, `tipo_pro`, `categorias_id`, `tipo_doc_id`, `classificacao_id`, `prioridades_id`, `refProv`, `refRec`, `pro_direcoes_id`, `pro_departamentos_id`, `pro_reparticoes_id`, `pro_externa_id`, `num_entrada_saida_livro`, `data_entrada_saida_livro`, `assunto`, `observacao`, `destinatario`, `estadoTra`, `estadoDes`, `file`, `path`, `url`, `local_direcoes_id`, `local_departamentos_id`, `local_reparticoes_id`, `usuarios_id`, `date`, `data_normal`) VALUES
(1, 'NOTA Nº 4578/031.13/DAF/20', 'Interna', 1, 23, 114, 1, '4578/031.13', '1/030/DPC/20', 9, 0, NULL, 0, '1220/DPC/20', '2020-11-24', 'Comfirmacao de cabamento de verba para renovacao do contrato', '', 'DIEH', 0, 0, '5d9cde7b762aadafdac9621ba70e2dca.jpg', 'C:/xampp/htdocs/sigdoc/assets/correspondencias/24-11-2020/5d9cde7b762aadafdac9621ba70e2dca.jpg', 'http://172.16.240.50/sigdoc/assets/correspondencias/24-11-2020/5d9cde7b762aadafdac9621ba70e2dca.jpg', 7, 0, 0, 15, '2020-11-24 12:53:10', '2020-11-24'),
(2, 'NOTA Nº 5134/043/UGEA/20', 'Interna', 1, 23, 193, 1, '5134/043', '2/043/DTIC/20', 14, 0, NULL, 0, '196/DTIC/20', '2020-11-24', 'Pedido de aditamento a empresa Movitel referente a prestacao de servico de Internet.', '', 'Momade Sumalgy', 0, 0, '5e13d419e9caa3349ade72783676fa2b.pdf', 'C:/xampp/htdocs/sigdoc/assets/correspondencias/24-11-2020/5e13d419e9caa3349ade72783676fa2b.pdf', 'http://172.16.240.50/sigdoc/assets/correspondencias/24-11-2020/5e13d419e9caa3349ade72783676fa2b.pdf', 13, 0, 0, 6, '2020-11-24 13:13:08', '2020-11-24'),
(3, 'NOTA Nº 5121/043/UGEA/20', 'Interna', 1, 23, 193, 1, '5121/043', '3/043/DTIC/20', 14, 0, NULL, 0, '197/DTIC/20', '2020-11-24', 'Aquisicao de equipamento Informatico, comunicacao do menbro de juri, Honover Fondo', '', 'Momade Sumalgy', 0, 0, '567cf00c5ee6d4f5fdcb6a6f868c8214.pdf', 'C:/xampp/htdocs/sigdoc/assets/correspondencias/24-11-2020/567cf00c5ee6d4f5fdcb6a6f868c8214.pdf', 'http://172.16.240.50/sigdoc/assets/correspondencias/24-11-2020/567cf00c5ee6d4f5fdcb6a6f868c8214.pdf', 13, 0, 0, 6, '2020-11-24 14:09:19', '2020-11-24'),
(4, 'MEMORANDO Nº SN-4/UGEA/20', 'Interna', 1, 15, 33, 1, 'SN-4', '4/022.1/GM/GAB-VICE/20', 14, 0, NULL, 0, '7022/GM/GAB-VICE/20', '2020-11-24', 'Concurso Ajuste Directo 58A000141 AD n 23/DA/MISAU/2020 Aquisicao de equipamento Individual', '', 'vice-Ministra', 0, 0, 'bccb7af82824240b1e71aae78b070587.pdf', 'C:/xampp/htdocs/sigdoc/assets/correspondencias/24-11-2020/bccb7af82824240b1e71aae78b070587.pdf', 'http://172.16.240.50/sigdoc/assets/correspondencias/24-11-2020/bccb7af82824240b1e71aae78b070587.pdf', 12, 54, 0, 10, '2020-11-24 14:48:37', '2020-11-24'),
(5, 'NOTA Nº 713/DS-Comercial/20', 'Externa', 1, 23, 123, 1, '713', '5/032.22/DTIC/20', NULL, NULL, NULL, 67, '198/DTIC/20', '2020-11-25', 'Aquisicao, montagem e configuracao de equipamento Informatico para LAN E Servidores- Zona Norte ', '', 'Momade Sumalgy', 0, 0, '967fc9e5ae6ff423d950c187301dea99.pdf', 'C:/xampp/htdocs/sigdoc/assets/correspondencias/25-11-2020/967fc9e5ae6ff423d950c187301dea99.pdf', 'http://172.16.240.50/sigdoc/assets/correspondencias/25-11-2020/967fc9e5ae6ff423d950c187301dea99.pdf', 13, 0, 0, 6, '2020-11-25 08:50:58', '2020-11-25'),
(6, 'NOTA Nº 4185/H.C.M./20', 'Externa', 1, 23, 39, 1, '4185', '6/023.3/DAF/SG/20', NULL, NULL, NULL, 32, '1595/DAF/SG/20', '2020-11-25', 'Rectificacao de despacho progressao', '', 'Gabinete do Ministro', 1, 0, 'd82b7760dd8f05570d2b1a43f85912b2.pdf', 'C:/xampp/htdocs/sigdoc/assets/correspondencias/25-11-2020/d82b7760dd8f05570d2b1a43f85912b2.pdf', 'http://172.16.240.50/sigdoc/assets/correspondencias/25-11-2020/d82b7760dd8f05570d2b1a43f85912b2.pdf', 9, 56, 0, 14, '2020-11-25 10:05:47', '2020-11-25'),
(7, 'NOTA Nº 548/OMS/20', 'Externa', 1, 23, 336, 1, '548', '7/ASSUNTOS DIVERSOS/DAF/SG/20', NULL, NULL, NULL, 13, '1594/DAF/SG/20', '2020-11-25', 'Pedido de apoio tecnico para actualizacao da estrategia integrada de vectores', '', 'Gabinete do Ministro', 1, 0, '51fb5b501e90edd0009d989ca838baa3.pdf', 'C:/xampp/htdocs/sigdoc/assets/correspondencias/25-11-2020/51fb5b501e90edd0009d989ca838baa3.pdf', 'http://172.16.240.50/sigdoc/assets/correspondencias/25-11-2020/51fb5b501e90edd0009d989ca838baa3.pdf', 9, 56, 0, 14, '2020-11-25 10:09:24', '2020-11-25'),
(8, 'NOTA Nº 311/MIC/20', 'Externa', 1, 23, 320, 1, '311', '8/062.4/DAF/SG/20', NULL, NULL, NULL, 40, '1593/DAF/SG/20', '2020-11-24', 'Renuncia a cartas disposicoes de acordo TRIPS', '', 'Gabinete do Ministro', 1, 0, 'f00fd3cbc5225d802e709846187b8f05.pdf', 'C:/xampp/htdocs/sigdoc/assets/correspondencias/25-11-2020/f00fd3cbc5225d802e709846187b8f05.pdf', 'http://172.16.240.50/sigdoc/assets/correspondencias/25-11-2020/f00fd3cbc5225d802e709846187b8f05.pdf', 9, 56, 0, 14, '2020-11-25 10:12:50', '2020-11-25'),
(9, 'NOTA Nº 126/CIP/20', 'Externa', 1, 23, 249, 1, '126', '9/052.3/DAF/SG/20', NULL, NULL, NULL, 68, '1592/DAF/SG/20', '2020-11-24', 'Gestao das doacoes de equipamento por parte do Misau e nivel de preparacao dos hospitais e centros de isolamento para face a covid 19', '', 'GMS', 1, 0, '2d493bd31d98f263bde1e28dcf25103c.pdf', 'C:/xampp/htdocs/sigdoc/assets/correspondencias/25-11-2020/2d493bd31d98f263bde1e28dcf25103c.pdf', 'http://172.16.240.50/sigdoc/assets/correspondencias/25-11-2020/2d493bd31d98f263bde1e28dcf25103c.pdf', 9, 56, 0, 14, '2020-11-25 10:21:26', '2020-11-25'),
(10, 'MEMORANDO Nº SN-10/DNF/20', 'Interna', 1, 15, 22, 1, 'SN-10', '10/012.2/GM/GAB-VICE/20', 4, 0, NULL, 0, '7568/GM/GAB-VICE/20', '2020-11-25', 'Memo - Informacao de Ocorrencia', '', 'vice-Ministra', 0, 0, '61c1a45738d38e0758ef2bd6784b3693.pdf', 'C:/xampp/htdocs/sigdoc/assets/correspondencias/25-11-2020/61c1a45738d38e0758ef2bd6784b3693.pdf', 'http://172.16.240.50/sigdoc/assets/correspondencias/25-11-2020/61c1a45738d38e0758ef2bd6784b3693.pdf', 12, 54, 0, 10, '2020-11-25 11:38:24', '2020-11-25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `correspondencias`
--
ALTER TABLE `correspondencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_correspondencias_categorias` (`categorias_id`),
  ADD KEY `fk_correspondencias_prioridades` (`prioridades_id`),
  ADD KEY `fk_correspondencias_pro_direcoes` (`pro_direcoes_id`),
  ADD KEY `fk_correspondencias_pro_externa` (`pro_externa_id`),
  ADD KEY `fk_correspondencias_usuarios` (`usuarios_id`),
  ADD KEY `fk_correspondencias_tipo_doc` (`tipo_pro`),
  ADD KEY `fk_correspondencias_tipoDoc` (`tipo_doc_id`),
  ADD KEY `fk_correspondencias_classificador` (`classificacao_id`),
  ADD KEY `fk_correspondencias_local_direcoes` (`local_direcoes_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `correspondencias`
--
ALTER TABLE `correspondencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `correspondencias`
--
ALTER TABLE `correspondencias`
  ADD CONSTRAINT `fk_correspondencias_categorias` FOREIGN KEY (`categorias_id`) REFERENCES `categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_correspondencias_classificador` FOREIGN KEY (`classificacao_id`) REFERENCES `classificacao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_correspondencias_local_direcoes` FOREIGN KEY (`local_direcoes_id`) REFERENCES `direcoes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_correspondencias_prioridades` FOREIGN KEY (`prioridades_id`) REFERENCES `prioridades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_correspondencias_pro_direcoes` FOREIGN KEY (`pro_direcoes_id`) REFERENCES `direcoes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_correspondencias_tipoDoc` FOREIGN KEY (`tipo_doc_id`) REFERENCES `tipo_doc` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_correspondencias_usuarios` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
