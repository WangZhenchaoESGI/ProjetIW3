TYPE=VIEW
query=select `performance_schema`.`memory_summary_global_by_event_name`.`EVENT_NAME` AS `event_name`,`performance_schema`.`memory_summary_global_by_event_name`.`CURRENT_COUNT_USED` AS `current_count`,`sys`.`format_bytes`(`performance_schema`.`memory_summary_global_by_event_name`.`CURRENT_NUMBER_OF_BYTES_USED`) AS `current_alloc`,`sys`.`format_bytes`(ifnull((`performance_schema`.`memory_summary_global_by_event_name`.`CURRENT_NUMBER_OF_BYTES_USED` / nullif(`performance_schema`.`memory_summary_global_by_event_name`.`CURRENT_COUNT_USED`,0)),0)) AS `current_avg_alloc`,`performance_schema`.`memory_summary_global_by_event_name`.`HIGH_COUNT_USED` AS `high_count`,`sys`.`format_bytes`(`performance_schema`.`memory_summary_global_by_event_name`.`HIGH_NUMBER_OF_BYTES_USED`) AS `high_alloc`,`sys`.`format_bytes`(ifnull((`performance_schema`.`memory_summary_global_by_event_name`.`HIGH_NUMBER_OF_BYTES_USED` / nullif(`performance_schema`.`memory_summary_global_by_event_name`.`HIGH_COUNT_USED`,0)),0)) AS `high_avg_alloc` from `performance_schema`.`memory_summary_global_by_event_name` where (`performance_schema`.`memory_summary_global_by_event_name`.`CURRENT_NUMBER_OF_BYTES_USED` > 0) order by `performance_schema`.`memory_summary_global_by_event_name`.`CURRENT_NUMBER_OF_BYTES_USED` desc
md5=0a3c8b3a3fa954cca8ab5b6cc3026944
updatable=1
algorithm=2
definer_user=mysql.sys
definer_host=localhost
suid=0
with_check_option=0
<<<<<<< HEAD
<<<<<<< HEAD
timestamp=2019-01-31 10:31:15
=======
timestamp=2018-12-10 18:11:20
>>>>>>> d570eace88a0088af082cbf4496e4d5aba4063b7
=======
timestamp=2019-01-31 10:31:15
>>>>>>> e094dc70c1877b964c63025a1b60c9b50e80d4e7
create-version=1
source=SELECT event_name, current_count_used AS current_count, sys.format_bytes(current_number_of_bytes_used) AS current_alloc, sys.format_bytes(IFNULL(current_number_of_bytes_used / NULLIF(current_count_used, 0), 0)) AS current_avg_alloc, high_count_used AS high_count, sys.format_bytes(high_number_of_bytes_used) AS high_alloc, sys.format_bytes(IFNULL(high_number_of_bytes_used / NULLIF(high_count_used, 0), 0)) AS high_avg_alloc FROM performance_schema.memory_summary_global_by_event_name WHERE current_number_of_bytes_used > 0 ORDER BY current_number_of_bytes_used DESC
client_cs_name=utf8
connection_cl_name=utf8_general_ci
view_body_utf8=select `performance_schema`.`memory_summary_global_by_event_name`.`EVENT_NAME` AS `event_name`,`performance_schema`.`memory_summary_global_by_event_name`.`CURRENT_COUNT_USED` AS `current_count`,`sys`.`format_bytes`(`performance_schema`.`memory_summary_global_by_event_name`.`CURRENT_NUMBER_OF_BYTES_USED`) AS `current_alloc`,`sys`.`format_bytes`(ifnull((`performance_schema`.`memory_summary_global_by_event_name`.`CURRENT_NUMBER_OF_BYTES_USED` / nullif(`performance_schema`.`memory_summary_global_by_event_name`.`CURRENT_COUNT_USED`,0)),0)) AS `current_avg_alloc`,`performance_schema`.`memory_summary_global_by_event_name`.`HIGH_COUNT_USED` AS `high_count`,`sys`.`format_bytes`(`performance_schema`.`memory_summary_global_by_event_name`.`HIGH_NUMBER_OF_BYTES_USED`) AS `high_alloc`,`sys`.`format_bytes`(ifnull((`performance_schema`.`memory_summary_global_by_event_name`.`HIGH_NUMBER_OF_BYTES_USED` / nullif(`performance_schema`.`memory_summary_global_by_event_name`.`HIGH_COUNT_USED`,0)),0)) AS `high_avg_alloc` from `performance_schema`.`memory_summary_global_by_event_name` where (`performance_schema`.`memory_summary_global_by_event_name`.`CURRENT_NUMBER_OF_BYTES_USED` > 0) order by `performance_schema`.`memory_summary_global_by_event_name`.`CURRENT_NUMBER_OF_BYTES_USED` desc
