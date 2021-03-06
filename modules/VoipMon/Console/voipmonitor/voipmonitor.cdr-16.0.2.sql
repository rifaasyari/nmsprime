-- NOTE: DROPPING AND CREATING THE DATABASE IS INTENTIONAL
--       THE DUMP HAS BEEN MANUALLY MODIFIED, AS IT EASES THE MIGRATION
--       PLEASE ONLY REMOVE IF YOU KNOW WHAT YOU ARE DOING
DROP DATABASE IF EXISTS `voipmonitor`;
CREATE DATABASE `voipmonitor`;
CREATE TABLE `voipmonitor`.`cdr` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `calldate` datetime NOT NULL,
  `callend` datetime NOT NULL,
  `duration` mediumint(8) unsigned DEFAULT NULL,
  `connect_duration` mediumint(8) unsigned DEFAULT NULL,
  `progress_time` mediumint(8) unsigned DEFAULT NULL,
  `first_rtp_time` mediumint(8) unsigned DEFAULT NULL,
  `caller` varchar(255) DEFAULT NULL,
  `caller_domain` varchar(255) DEFAULT NULL,
  `caller_reverse` varchar(255) DEFAULT NULL,
  `callername` varchar(255) DEFAULT NULL,
  `callername_reverse` varchar(255) DEFAULT NULL,
  `called` varchar(255) DEFAULT NULL,
  `called_domain` varchar(255) DEFAULT NULL,
  `called_reverse` varchar(255) DEFAULT NULL,
  `sipcallerip` int(10) unsigned DEFAULT NULL,
  `sipcallerport` smallint(5) unsigned DEFAULT NULL,
  `sipcalledip` int(10) unsigned DEFAULT NULL,
  `sipcalledport` smallint(5) unsigned DEFAULT NULL,
  `whohanged` enum('caller','callee') DEFAULT NULL,
  `bye` tinyint(3) unsigned DEFAULT NULL,
  `lastSIPresponse_id` mediumint(8) unsigned DEFAULT NULL,
  `lastSIPresponseNum` smallint(5) unsigned DEFAULT NULL,
  `reason_sip_cause` smallint(5) unsigned DEFAULT NULL,
  `reason_sip_text_id` mediumint(8) unsigned DEFAULT NULL,
  `reason_q850_cause` smallint(5) unsigned DEFAULT NULL,
  `reason_q850_text_id` mediumint(8) unsigned DEFAULT NULL,
  `sighup` tinyint(4) DEFAULT NULL,
  `dscp` int(10) unsigned DEFAULT NULL,
  `a_index` tinyint(4) DEFAULT NULL,
  `b_index` tinyint(4) DEFAULT NULL,
  `a_payload` int(11) DEFAULT NULL,
  `b_payload` int(11) DEFAULT NULL,
  `a_saddr` int(10) unsigned DEFAULT NULL,
  `b_saddr` int(10) unsigned DEFAULT NULL,
  `a_received` mediumint(8) unsigned DEFAULT NULL,
  `b_received` mediumint(8) unsigned DEFAULT NULL,
  `a_lost` mediumint(8) unsigned DEFAULT NULL,
  `b_lost` mediumint(8) unsigned DEFAULT NULL,
  `a_ua_id` int(10) unsigned DEFAULT NULL,
  `b_ua_id` int(10) unsigned DEFAULT NULL,
  `a_avgjitter_mult10` mediumint(8) unsigned DEFAULT NULL,
  `b_avgjitter_mult10` mediumint(8) unsigned DEFAULT NULL,
  `a_maxjitter` smallint(5) unsigned DEFAULT NULL,
  `b_maxjitter` smallint(5) unsigned DEFAULT NULL,
  `a_sl1` mediumint(8) unsigned DEFAULT NULL,
  `a_sl2` mediumint(8) unsigned DEFAULT NULL,
  `a_sl3` mediumint(8) unsigned DEFAULT NULL,
  `a_sl4` mediumint(8) unsigned DEFAULT NULL,
  `a_sl5` mediumint(8) unsigned DEFAULT NULL,
  `a_sl6` mediumint(8) unsigned DEFAULT NULL,
  `a_sl7` mediumint(8) unsigned DEFAULT NULL,
  `a_sl8` mediumint(8) unsigned DEFAULT NULL,
  `a_sl9` mediumint(8) unsigned DEFAULT NULL,
  `a_sl10` mediumint(8) unsigned DEFAULT NULL,
  `a_d50` mediumint(8) unsigned DEFAULT NULL,
  `a_d70` mediumint(8) unsigned DEFAULT NULL,
  `a_d90` mediumint(8) unsigned DEFAULT NULL,
  `a_d120` mediumint(8) unsigned DEFAULT NULL,
  `a_d150` mediumint(8) unsigned DEFAULT NULL,
  `a_d200` mediumint(8) unsigned DEFAULT NULL,
  `a_d300` mediumint(8) unsigned DEFAULT NULL,
  `b_sl1` mediumint(8) unsigned DEFAULT NULL,
  `b_sl2` mediumint(8) unsigned DEFAULT NULL,
  `b_sl3` mediumint(8) unsigned DEFAULT NULL,
  `b_sl4` mediumint(8) unsigned DEFAULT NULL,
  `b_sl5` mediumint(8) unsigned DEFAULT NULL,
  `b_sl6` mediumint(8) unsigned DEFAULT NULL,
  `b_sl7` mediumint(8) unsigned DEFAULT NULL,
  `b_sl8` mediumint(8) unsigned DEFAULT NULL,
  `b_sl9` mediumint(8) unsigned DEFAULT NULL,
  `b_sl10` mediumint(8) unsigned DEFAULT NULL,
  `b_d50` mediumint(8) unsigned DEFAULT NULL,
  `b_d70` mediumint(8) unsigned DEFAULT NULL,
  `b_d90` mediumint(8) unsigned DEFAULT NULL,
  `b_d120` mediumint(8) unsigned DEFAULT NULL,
  `b_d150` mediumint(8) unsigned DEFAULT NULL,
  `b_d200` mediumint(8) unsigned DEFAULT NULL,
  `b_d300` mediumint(8) unsigned DEFAULT NULL,
  `a_mos_lqo_mult10` tinyint(3) unsigned DEFAULT NULL,
  `b_mos_lqo_mult10` tinyint(3) unsigned DEFAULT NULL,
  `a_mos_f1_min_mult10` tinyint(3) unsigned DEFAULT NULL,
  `a_mos_f2_min_mult10` tinyint(3) unsigned DEFAULT NULL,
  `a_mos_adapt_min_mult10` tinyint(3) unsigned DEFAULT NULL,
  `a_mos_xr_min_mult10` tinyint(3) unsigned DEFAULT NULL,
  `b_mos_f1_min_mult10` tinyint(3) unsigned DEFAULT NULL,
  `b_mos_f2_min_mult10` tinyint(3) unsigned DEFAULT NULL,
  `b_mos_adapt_min_mult10` tinyint(3) unsigned DEFAULT NULL,
  `b_mos_xr_min_mult10` tinyint(3) unsigned DEFAULT NULL,
  `a_mos_f1_mult10` tinyint(3) unsigned DEFAULT NULL,
  `a_mos_f2_mult10` tinyint(3) unsigned DEFAULT NULL,
  `a_mos_adapt_mult10` tinyint(3) unsigned DEFAULT NULL,
  `a_mos_xr_mult10` tinyint(3) unsigned DEFAULT NULL,
  `b_mos_f1_mult10` tinyint(3) unsigned DEFAULT NULL,
  `b_mos_f2_mult10` tinyint(3) unsigned DEFAULT NULL,
  `b_mos_adapt_mult10` tinyint(3) unsigned DEFAULT NULL,
  `b_mos_xr_mult10` tinyint(3) unsigned DEFAULT NULL,
  `a_rtcp_loss` smallint(5) unsigned DEFAULT NULL,
  `a_rtcp_maxfr` smallint(5) unsigned DEFAULT NULL,
  `a_rtcp_avgfr_mult10` smallint(5) unsigned DEFAULT NULL,
  `a_rtcp_maxjitter` smallint(5) unsigned DEFAULT NULL,
  `a_rtcp_avgjitter_mult10` smallint(5) unsigned DEFAULT NULL,
  `b_rtcp_loss` smallint(5) unsigned DEFAULT NULL,
  `b_rtcp_maxfr` smallint(5) unsigned DEFAULT NULL,
  `b_rtcp_avgfr_mult10` smallint(5) unsigned DEFAULT NULL,
  `b_rtcp_maxjitter` smallint(5) unsigned DEFAULT NULL,
  `b_rtcp_avgjitter_mult10` smallint(5) unsigned DEFAULT NULL,
  `a_last_rtp_from_end` smallint(5) unsigned DEFAULT NULL,
  `b_last_rtp_from_end` smallint(5) unsigned DEFAULT NULL,
  `a_rtp_ptime` tinyint(3) unsigned DEFAULT NULL,
  `b_rtp_ptime` tinyint(3) unsigned DEFAULT NULL,
  `payload` int(11) DEFAULT NULL,
  `jitter_mult10` mediumint(8) unsigned DEFAULT NULL,
  `mos_min_mult10` tinyint(3) unsigned DEFAULT NULL,
  `a_mos_min_mult10` tinyint(3) unsigned DEFAULT NULL,
  `b_mos_min_mult10` tinyint(3) unsigned DEFAULT NULL,
  `packet_loss_perc_mult1000` mediumint(8) unsigned DEFAULT NULL,
  `a_packet_loss_perc_mult1000` mediumint(8) unsigned DEFAULT NULL,
  `b_packet_loss_perc_mult1000` mediumint(8) unsigned DEFAULT NULL,
  `delay_sum` mediumint(8) unsigned DEFAULT NULL,
  `a_delay_sum` mediumint(8) unsigned DEFAULT NULL,
  `b_delay_sum` mediumint(8) unsigned DEFAULT NULL,
  `delay_avg_mult100` mediumint(8) unsigned DEFAULT NULL,
  `a_delay_avg_mult100` mediumint(8) unsigned DEFAULT NULL,
  `b_delay_avg_mult100` mediumint(8) unsigned DEFAULT NULL,
  `delay_cnt` mediumint(8) unsigned DEFAULT NULL,
  `a_delay_cnt` mediumint(8) unsigned DEFAULT NULL,
  `b_delay_cnt` mediumint(8) unsigned DEFAULT NULL,
  `rtcp_avgfr_mult10` smallint(5) unsigned DEFAULT NULL,
  `rtcp_avgjitter_mult10` smallint(5) unsigned DEFAULT NULL,
  `lost` mediumint(8) unsigned DEFAULT NULL,
  `caller_clipping_div3` smallint(5) unsigned DEFAULT NULL,
  `called_clipping_div3` smallint(5) unsigned DEFAULT NULL,
  `caller_silence` tinyint(3) unsigned DEFAULT NULL,
  `called_silence` tinyint(3) unsigned DEFAULT NULL,
  `caller_silence_end` smallint(5) unsigned DEFAULT NULL,
  `called_silence_end` smallint(5) unsigned DEFAULT NULL,
  `response_time_100` smallint(5) unsigned DEFAULT NULL,
  `response_time_xxx` smallint(5) unsigned DEFAULT NULL,
  `id_sensor` smallint(5) unsigned DEFAULT NULL,
  `price_operator_mult100` int(10) unsigned DEFAULT NULL,
  `price_operator_currency_id` tinyint(3) unsigned DEFAULT NULL,
  `price_customer_mult100` int(10) unsigned DEFAULT NULL,
  `price_customer_currency_id` tinyint(3) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `phonenumber_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`,`calldate`),
  KEY `calldate` (`calldate`),
  KEY `callend` (`callend`),
  KEY `duration` (`duration`),
  KEY `source` (`caller`),
  KEY `source_reverse` (`caller_reverse`),
  KEY `destination` (`called`),
  KEY `destination_reverse` (`called_reverse`),
  KEY `callername` (`callername`),
  KEY `callername_reverse` (`callername_reverse`),
  KEY `sipcallerip` (`sipcallerip`),
  KEY `sipcalledip` (`sipcalledip`),
  KEY `lastSIPresponseNum` (`lastSIPresponseNum`),
  KEY `bye` (`bye`),
  KEY `a_saddr` (`a_saddr`),
  KEY `b_saddr` (`b_saddr`),
  KEY `a_lost` (`a_lost`),
  KEY `b_lost` (`b_lost`),
  KEY `a_maxjitter` (`a_maxjitter`),
  KEY `b_maxjitter` (`b_maxjitter`),
  KEY `a_rtcp_loss` (`a_rtcp_loss`),
  KEY `a_rtcp_maxfr` (`a_rtcp_maxfr`),
  KEY `a_rtcp_maxjitter` (`a_rtcp_maxjitter`),
  KEY `b_rtcp_loss` (`b_rtcp_loss`),
  KEY `b_rtcp_maxfr` (`b_rtcp_maxfr`),
  KEY `b_rtcp_maxjitter` (`b_rtcp_maxjitter`),
  KEY `a_ua_id` (`a_ua_id`),
  KEY `b_ua_id` (`b_ua_id`),
  KEY `a_avgjitter_mult10` (`a_avgjitter_mult10`),
  KEY `b_avgjitter_mult10` (`b_avgjitter_mult10`),
  KEY `a_rtcp_avgjitter_mult10` (`a_rtcp_avgjitter_mult10`),
  KEY `b_rtcp_avgjitter_mult10` (`b_rtcp_avgjitter_mult10`),
  KEY `lastSIPresponse_id` (`lastSIPresponse_id`),
  KEY `reason_sip_text_id` (`reason_sip_text_id`),
  KEY `reason_q850_text_id` (`reason_q850_text_id`),
  KEY `payload` (`payload`),
  KEY `id_sensor` (`id_sensor`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPRESSED
