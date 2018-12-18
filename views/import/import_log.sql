CREATE TABLE  `csv_import_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(145) DEFAULT NULL,
  `total_records` int(11) DEFAULT NULL,
  `success_records` int(11) DEFAULT NULL,
  `error_records` int(11) DEFAULT NULL,
  `success_path` varchar(145) DEFAULT NULL,
  `success_file` varchar(145) DEFAULT NULL,
  `error_path` varchar(145) DEFAULT NULL,
  `error_file` varchar(145) DEFAULT NULL,
  `created_by` varchar(145) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);