TYPE=VIEW
query=select count(0) AS `cnt`,round((`performance_schema`.`events_statements_summary_by_digest`.`AVG_TIMER_WAIT` / 1000000),0) AS `avg_us` from `performance_schema`.`events_statements_summary_by_digest` group by `avg_us`
md5=06f1f0e6df61fcfe10c0118e39bc5047
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
source=SELECT COUNT(*) cnt,  ROUND(avg_timer_wait/1000000) AS avg_us FROM performance_schema.events_statements_summary_by_digest GROUP BY avg_us
client_cs_name=utf8
connection_cl_name=utf8_general_ci
view_body_utf8=select count(0) AS `cnt`,round((`performance_schema`.`events_statements_summary_by_digest`.`AVG_TIMER_WAIT` / 1000000),0) AS `avg_us` from `performance_schema`.`events_statements_summary_by_digest` group by `avg_us`