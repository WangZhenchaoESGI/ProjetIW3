TYPE=TRIGGERS
triggers='CREATE DEFINER=`mysql.sys`@`localhost` TRIGGER sys_config_insert_set_user BEFORE INSERT on sys_config FOR EACH ROW BEGIN IF @sys.ignore_sys_config_triggers != true AND NEW.set_by IS NULL THEN SET NEW.set_by = USER(); END IF; END' 'CREATE DEFINER=`mysql.sys`@`localhost` TRIGGER sys_config_update_set_user BEFORE UPDATE on sys_config FOR EACH ROW BEGIN IF @sys.ignore_sys_config_triggers != true AND NEW.set_by IS NULL THEN SET NEW.set_by = USER(); END IF; END'
sql_modes=0 0
definers='mysql.sys@localhost' 'mysql.sys@localhost'
client_cs_names='utf8' 'utf8'
connection_cl_names='utf8_general_ci' 'utf8_general_ci'
db_cl_names='utf8_general_ci' 'utf8_general_ci'
<<<<<<< HEAD
<<<<<<< HEAD
created=154893067555 154893067556
=======
created=154446548063 154446548064
>>>>>>> d570eace88a0088af082cbf4496e4d5aba4063b7
=======
created=154893067555 154893067556
>>>>>>> e094dc70c1877b964c63025a1b60c9b50e80d4e7
