TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER `trig_recharge_update` AFTER UPDATE ON `xy_member_recharge` FOR EACH ROW BEGIN\nIF OLD.state = 1 OR OLD.state = 9 THEN\n     IF OLD.flag = 0   THEN\n          if NEW.amount>0 AND NEW.isDelete = 0 AND NEW.flag = 1 THEN\n               -- 每次充值赠送\n			   call setRechargeBack(NEW.amount, NEW.uid, NEW.id, NEW.rechargeId);\n         end if;\n     END IF;\nEND IF;\nEND'
sql_modes=1342177280
definers='root@localhost'
client_cs_names='utf8'
connection_cl_names='utf8_general_ci'
db_cl_names='utf8_general_ci'
