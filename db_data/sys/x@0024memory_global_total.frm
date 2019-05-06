TYPE=VIEW
query=select sum(`performance_schema`.`memory_summary_global_by_event_name`.`CURRENT_NUMBER_OF_BYTES_USED`) AS `total_allocated` from `performance_schema`.`memory_summary_global_by_event_name`
md5=6f943b5a93d4d8b6c06840dbfa5027a9
updatable=0
algorithm=1
definer_user=mysql.sys
definer_host=localhost
suid=0
with_check_option=0
<<<<<<< HEAD
<<<<<<< HEAD
timestamp=2019-01-31 10:31:15
=======
timestamp=2018-12-10 18:11:21
>>>>>>> d570eace88a0088af082cbf4496e4d5aba4063b7
=======
timestamp=2019-01-31 10:31:15
>>>>>>> e094dc70c1877b964c63025a1b60c9b50e80d4e7
create-version=1
source=SELECT SUM(CURRENT_NUMBER_OF_BYTES_USED) total_allocated FROM performance_schema.memory_summary_global_by_event_name
client_cs_name=utf8
connection_cl_name=utf8_general_ci
view_body_utf8=select sum(`performance_schema`.`memory_summary_global_by_event_name`.`CURRENT_NUMBER_OF_BYTES_USED`) AS `total_allocated` from `performance_schema`.`memory_summary_global_by_event_name`
