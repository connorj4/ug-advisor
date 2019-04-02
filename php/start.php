<?php
//======================================================================
// CREATE THE DATABASE
//======================================================================

error_reporting(-1);
ini_set('display_errors', 'On');

/* the first connection to the database */
DEFINE('DB_HOST', "localhost");
DEFINE('DB_USER', "root");
DEFINE('DB_PASSWORD', ""); //Note: this should be your root password


try {
  $db_connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD)
    OR die("Connection failed: " . $db_connection->connect_error);
} catch (Exception $e) {
  echo 'Caught exception: ',  $e->getMessage(), nl2br("\r\n");
}

/* Check if database is there or will create it */
$create_stmt = "CREATE DATABASE IF NOT EXISTS ugadvisor_db";
/* Check if database drop was sucessful */
if(mysqli_query($db_connection, $create_stmt)) {
	echo nl2br("Database was successfully created.\r\n");
} else {
	echo "Error dropping database: " . mysqli_error() . nl2br("\r\n");
}
$prep_stmt = $db_connection -> prepare($create_stmt);
$prep_stmt->execute();
$prep_stmt->close();

/* Change to the created database */
$db_connection->select_db("ugadvisor_db");

/* Drop all tables for clean install */
$db_connection->query('SET foreign_key_checks = 0');
if ($result = $db_connection->query("SHOW TABLES")) {
  while($row = $result->fetch_array(MYSQLI_NUM)) {
    $db_connection->query('DROP TABLE IF EXISTS '.$row[0]);
	}
	echo "Tables removed successfully." . nl2br("\r\n");
} else {
	echo "No tables were removed." . nl2br("\r\n");
}
$db_connection->query('SET foreign_key_checks = 1');


/* Salt used for seasoning */
$salt = 'graduate';

//-----------------------------------------------------
// Create Database Tables
//-----------------------------------------------------
echo "Table creation started." . nl2br("\r\n");

/* Role */
$create_role = $db_connection->prepare(
	"CREATE OR REPLACE TABLE role
  (role_id int NOT NULL AUTO_INCREMENT,
	role_type varchar(255) NOT NULL,
	PRIMARY KEY(role_id));");
$create_role->execute();
$create_role->close();

/* Status  */
$create_status = $db_connection->prepare(
	"CREATE OR REPLACE TABLE status
  (status_id int NOT NULL AUTO_INCREMENT,
  status_type varchar(255) NOT NULL,
	PRIMARY KEY(status_id));");
$create_status->execute();
$create_status->close();

/* State In Time */
$create_status = $db_connection->prepare(
	"CREATE OR REPLACE TABLE state
  (state_id int NOT NULL AUTO_INCREMENT,
  state_type varchar(255) NOT NULL,
	PRIMARY KEY(state_id));");
$create_status->execute();
$create_status->close();

/* Permission */
$create_permission = $db_connection->prepare(
	"CREATE OR REPLACE TABLE permission
	(permission_id int NOT NULL AUTO_INCREMENT,
	permission_type varchar(255) NOT NULL,
	PRIMARY KEY(permission_id));");
$create_permission->execute();
$create_permission->close();

/* Grade */
$create_grade = $db_connection->prepare(
	"CREATE OR REPLACE TABLE grade
  (grade_id int NOT NULL AUTO_INCREMENT,
  grade_type varchar(2) NOT NULL,
	PRIMARY KEY(grade_id));");
$create_grade->execute();
$create_grade->close();

/* Year */
$create_year = $db_connection->prepare(
	"CREATE OR REPLACE TABLE years
  (year_id int NOT NULL AUTO_INCREMENT,
  year_type int NOT NULL,
	PRIMARY KEY(year_id));");
$create_year->execute();
$create_year->close();

/* Semester */
$create_semester = $db_connection->prepare(
	"CREATE OR REPLACE TABLE semester
  (semester_id int NOT NULL AUTO_INCREMENT,
  semester_type varchar(255) NOT NULL,
	PRIMARY KEY(semester_id));");
$create_semester->execute();
$create_semester->close();

/* Below Are Tables That Have Forigen Keys */
/* ------------------------------------------ */

/* Department */
$create_dept = $db_connection->prepare(
	"CREATE OR REPLACE TABLE department(
		dept_id varchar(4) NOT NULL,
		dept_name varchar(255) NOT NULL,
		creation_date timestamp,
		status_id int NOT NULL,
		PRIMARY KEY(dept_id),
		FOREIGN KEY(status_id) REFERENCES status(status_id));");
$create_dept->execute();
$create_dept->close();

/* Program */
$create_program = $db_connection->prepare(
	"CREATE OR REPLACE TABLE program
		(program_id int NOT NULL AUTO_INCREMENT,
		program_name varchar(255) NOT NULL,
		creation_date timestamp,
		dept_id varchar(4) NOT NULL,
		status_id int NOT NULL,
		PRIMARY KEY(program_id),
		FOREIGN KEY(dept_id) REFERENCES department(dept_id),
		FOREIGN KEY(status_id) REFERENCES status(status_id));");
	$create_program->execute();
	$create_program->close();

/* Below Are Tables Describe Users */
/* ------------------------------------------ */

/* User */
$create_user = $db_connection->prepare(
	"CREATE OR REPLACE TABLE user
	(user_id int NOT NULL AUTO_INCREMENT,
	username varchar(255) NOT NULL,
	password varchar(255) NOT NULL,
	email varchar(255),
	first_name varchar(255),
	last_name varchar(255),
	role_id int NOT NULL,
	creation_date timestamp,
	PRIMARY KEY(user_id),
	FOREIGN KEY(role_id) REFERENCES role(role_id));");
$create_user->execute();
$create_user->close();

/* Administrator */
$create_sysadmin = $db_connection->prepare(
	"CREATE OR REPLACE TABLE administrator
	(admin_id int NOT NULL AUTO_INCREMENT,
  user_id int NOT NULL,
	PRIMARY KEY(admin_id),
  FOREIGN KEY(user_id) REFERENCES user(user_id));");
$create_sysadmin->execute();
$create_sysadmin->close();

/* Faculty */
$create_faculty = $db_connection->prepare(
	"CREATE OR REPLACE TABLE faculty
	(faculty_id int NOT NULL AUTO_INCREMENT,
	user_id int NOT NULL,
	dept_id varchar(4) NOT NULL,
  status_id int NOT NULL,
	PRIMARY KEY(faculty_id),
	FOREIGN KEY(user_id) REFERENCES user(user_id),
	FOREIGN KEY(dept_id) REFERENCES department(dept_id),
  FOREIGN KEY(status_id) REFERENCES status(status_id));");
$create_faculty->execute();
$create_faculty->close();

/* Student */
$create_student = $db_connection->prepare(
	"CREATE OR REPLACE TABLE student
	(student_id int NOT NULL AUTO_INCREMENT,
	user_id int NOT NULL,
	program_id int NOT NULL,
  status_id int NOT NULL,
	PRIMARY KEY(student_id),
	FOREIGN KEY(user_id) REFERENCES user(user_id),
	FOREIGN KEY(program_id) REFERENCES program(program_id),
  FOREIGN KEY(status_id) REFERENCES status(status_id));");
$create_student->execute();
$create_student->close();

/* Advisor */
$create_advisor = $db_connection->prepare(
	"CREATE OR REPLACE TABLE advisor
	(student_id int NOT NULL,
	faculty_id int NOT NULL,
	CONSTRAINT pk_advisor PRIMARY KEY(student_id, faculty_id),
	FOREIGN KEY(student_id) REFERENCES student(student_id),
	FOREIGN KEY(faculty_id) REFERENCES faculty(faculty_id));");
$create_advisor->execute();
$create_advisor->close();

/* ------------------------------------------ */
/* Courses and graduation maps */

/* Course */
$create_course = $db_connection->prepare(
	"CREATE OR REPLACE TABLE course
		(course_id int NOT NULL,
		course_name varchar(255) NOT NULL,
		credits int,
		dept_id varchar(4) NOT NULL,
		status_id int NOT NULL,
		creation_date timestamp,
		PRIMARY KEY(course_id),
		FOREIGN KEY(dept_id) REFERENCES department(dept_id),
		FOREIGN KEY(status_id) REFERENCES status(status_id));");
$create_course->execute();
$create_course->close();

/* Prerequisite */
$create_prerequisite = $db_connection->prepare(
	"CREATE OR REPLACE TABLE prerequisite
		(prerequisite_id int NOT NULL AUTO_INCREMENT,
		course_id int NOT NULL,
		PRIMARY KEY(prerequisite_id),
		FOREIGN KEY(course_id) REFERENCES course(course_id));");
$create_prerequisite->execute();
$create_prerequisite->close();

/* Take */
$create_taken = $db_connection->prepare(
	"CREATE OR REPLACE TABLE take
		(take_id int NOT NULL AUTO_INCREMENT,
		course_id int NOT NULL,
		grade_id int NOT NULL,
		semester_id int NOT NULL,
		year_id int NOT NULL,
		state_id int NOT NULL,
		student_id int NOT NULL,
		PRIMARY KEY(take_id),
		FOREIGN KEY(course_id) REFERENCES course(course_id),
		FOREIGN KEY(grade_id) REFERENCES grade(grade_id),
		FOREIGN KEY(semester_id) REFERENCES semester(semester_id),
		FOREIGN KEY(year_id) REFERENCES years(year_id),
		FOREIGN KEY(state_id) REFERENCES state(state_id),
		FOREIGN KEY(student_id) REFERENCES student(student_id));");
$create_taken->execute();
$create_taken->close();

/* Graduation Map */
$create_graduation = $db_connection->prepare(
	"CREATE OR REPLACE TABLE graduation
		(graduation_id int NOT NULL AUTO_INCREMENT,
		take_id int NOT NULL,
		enrolled timestamp,
		PRIMARY KEY(graduation_id),
		FOREIGN KEY(take_id) REFERENCES take(take_id));");
$create_graduation->execute();
$create_graduation->close();

/* Status Display */
echo nl2br("The database tables were successfully created.\r\n");


//-----------------------------------------------------
// Populate Tables of Database
//-----------------------------------------------------

/* Role */
$insert_role = $db_connection->prepare(
	"INSERT INTO role
		(role_id, role_type) VALUES(?,?);");
$insert_role->bind_param("is", $role_id, $role_title);

$role_id = 1;
$role_title = "administrator";
$insert_role->execute();

$role_id = 2;
$role_title = "faculty";
$insert_role->execute();

$role_id = 3;
$role_title = "student";
$insert_role->execute();

$role_id = 4;
$role_title = "guest";
$insert_role->execute();

$insert_role->close();

/* Status */
$insert_status = $db_connection->prepare(
	"INSERT INTO status
		(status_id, status_type) VALUES(?,?);");
$insert_status->bind_param("is", $status_id, $status_title);
$status_id = 1;
$status_title = "active";
$insert_status->execute();

$status_id = 2;
$status_title = "dormant";
$insert_status->execute();

$insert_status->close();

/* State */
$insert_state = $db_connection->prepare(
	"INSERT INTO state
		(state_id, state_type) VALUES(?,?);");
$insert_state->bind_param("is", $state_id, $state_title);
$state_id = 1;
$state_title = "past";
$insert_state->execute();

$state_id = 2;
$state_title = "present";
$insert_state->execute();

$state_id = 3;
$state_title = "future";
$insert_state->execute();

$insert_state->close();

/* Grade */
$insert_grade = $db_connection->prepare(
	"INSERT INTO grade
		(grade_id, grade_type) VALUES(?,?);");
$insert_grade->bind_param("is", $grade_id, $grade_type);
$grade_id = 1;
$grade_type = "A+";
$insert_grade->execute();

$grade_id = 2;
$grade_type = "A";
$insert_grade->execute();

$grade_id = 3;
$grade_type = "A-";
$insert_grade->execute();

$grade_id = 4;
$grade_type = "B+";
$insert_grade->execute();

$grade_id = 5;
$grade_type = "B";
$insert_grade->execute();

$grade_id = 6;
$grade_type = "B-";
$insert_grade->execute();

$grade_id = 7;
$grade_type = "C+";
$insert_grade->execute();

$grade_id = 8;
$grade_type = "C";
$insert_grade->execute();

$grade_id = 9;
$grade_type = "C-";
$insert_grade->execute();

$grade_id = 10;
$grade_type = "D+";
$insert_grade->execute();

$grade_id = 11;
$grade_type = "D";
$insert_grade->execute();

$grade_id = 12;
$grade_type = "D-";
$insert_grade->execute();

$grade_id = 13;
$grade_type = "F";
$insert_grade->execute();

$grade_id = 14;
$grade_type = "I";
$insert_grade->execute();

$grade_id = 15;
$grade_type = "P";
$insert_grade->execute();

$insert_grade->close();

/* Department */
$insert_dept = $db_connection->prepare(
	"INSERT INTO department
		(dept_id,
		dept_name,
		status_id) VALUES(?,?,?);");
$insert_dept->bind_param("ssi",
$dept_id,
$dept_name,
$status_id);

$dept_id = "CSC";
$dept_name = "Computer Science";
$status_id = 1;
$insert_dept->execute();

$dept_id = "MAT";
$dept_name = "Mathematics";
$status_id = 1;
$insert_dept->execute();

$dept_id = "INQ";
$dept_name = "Inquiry";
$status_id = 1;
$insert_dept->execute();

$dept_id = "ENG";
$dept_name = "English";
$status_id = 1;
$insert_dept->execute();

$dept_id = "CHE";
$dept_name = "Chemistry";
$status_id = 1;
$insert_dept->execute();

$dept_id = "ECS";
$dept_name = "Earth science";
$status_id = 1;
$insert_dept->execute();

$dept_id = "PHY";
$dept_name = "Physics";
$status_id = 1;
$insert_dept->execute();

$dept_id = "BIO";
$dept_name = "Biology";
$status_id = 1;
$insert_dept->execute();

$dept_id = "MIS";
$dept_name = "Management";
$status_id = 1;
$insert_dept->execute();

$dept_id = "ACC";
$dept_name = "Accounting";
$status_id = 1;
$insert_dept->execute();

$dept_id = "AAA";
$dept_name = "Department Not Specified";
$status_id = 1;
$insert_dept->execute();

$insert_dept->close();

/* Program */
$insert_program = $db_connection->prepare(
	"INSERT INTO program
		(program_id,
		program_name,
		dept_id,
		status_id) VALUES(?,?,?,?);");
$insert_program->bind_param("issi",
$program_id,
$program_name,
$dept_id,
$status_id);

$program_id = 1;
$program_name = "Computer Science General";
$dept_id = "CSC";
$status_id = 1;
$insert_program->execute();

$program_id = 2;
$program_name = "Computer Information Systems";
$dept_id = "CSC";
$status_id = 1;
$insert_program->execute();

$insert_program->close();

/* User */
$insert_user = $db_connection->prepare(
	"INSERT INTO user
		(user_id,
		username,
		password,
		email,
		first_name,
		last_name,
		role_id) VALUES(?,?,?,?,?,?,?);");
$insert_user->bind_param("isssssi",
$user_id,
$username,
$password,
$email,
$first_name,
$last_name,
$role_id);

$user_id = 1;
$username = "ken";
$password = crypt("SCSU2019", $salt);
$email = "ken@smith.edu";
$first_name = "ken";
$last_name = "smith";
$role_id = 3;
$insert_user->execute();

$user_id = 2;
$username = "snow";
$password = crypt("winter", $salt);
$email = "snow@winter.edu";
$first_name = "john";
$last_name = "snow";
$role_id = 1;
$insert_user->execute();

$user_id = 3;
$username = "prof";
$password = crypt("sugar", $salt);
$email = "prof@place.edu";
$first_name = "mike";
$last_name = "ike";
$role_id = 2;
$insert_user->execute();

$user_id = 4;
$username = "flowers";
$password = crypt("spring", $salt);
$email = "flowers@spring.edu";
$first_name = "jeff";
$last_name = "flowers";
$role_id = 3;
$insert_user->execute();

$user_id = 5;
$username = "bugs";
$password = crypt("summer", $salt);
$email = "bugs@summer.edu";
$first_name = "tim";
$last_name = "summer";
$role_id = 3;
$insert_user->execute();

$user_id = 6;
$username = "leaf";
$password = crypt("tree", $salt);
$email = "leaf@fall.edu";
$first_name = "kelly";
$last_name = "tree";
$role_id = 3;
$insert_user->execute();

$user_id = 7;
$username = "john";
$password = crypt("smith1", $salt);
$email = "john@smith.edu";
$first_name = "john";
$last_name = "smith";
$role_id = 3;
$insert_user->execute();

$user_id = 8;
$username = "north";
$password = crypt("west", $salt);
$email = "north@west.edu";
$first_name = "north";
$last_name = "compass";
$role_id = 3;
$insert_user->execute();

$user_id = 9;
$username = "prof_james";
$password = crypt("sugar1", $salt);
$email = "prof_james@place.edu";
$first_name = "james";
$last_name = "ike";
$role_id = 2;
$insert_user->execute();

$user_id = 9;
$username = "prof_jess";
$password = crypt("sugar2", $salt);
$email = "prof_jess@place.edu";
$first_name = "jess";
$last_name = "ike";
$role_id = 2;
$insert_user->execute();

$user_id = 9;
$username = "prof_pam";
$password = crypt("sugar3", $salt);
$email = "prof_pam@place.edu";
$first_name = "pam";
$last_name = "east";
$role_id = 2;
$insert_user->execute();

$insert_user->close();

/* Administrator */
$insert_admin = $db_connection->prepare(
	"INSERT INTO administrator
		(admin_id,
		user_id) VALUES(?,?);");
$insert_admin->bind_param("ii",
$admin_id,
$user_id);

$admin_id = 1;
$user_id = 2;
$insert_admin->execute();

$insert_admin->close();

/* Faculty */
$insert_faculty = $db_connection->prepare(
	"INSERT INTO faculty
		(faculty_id,
		user_id,
		dept_id,
		status_id) VALUES(?,?,?,?);");
$insert_faculty->bind_param("iisi",
$faculty_id,
$user_id,
$dept_id,
$status_id);

$faculty_id = 1;
$user_id = 3;
$dept_id = "CSC";
$status_id = 1;
$insert_faculty->execute();

$faculty_id = 2;
$user_id = 9;
$dept_id = "CSC";
$status_id = 1;
$insert_faculty->execute();

$insert_faculty->close();

/* Year */
$insert_year = $db_connection->prepare(
	"INSERT INTO years
		(year_id,
		year_type) VALUES(?,?);");
$insert_year->bind_param("ii",
$year_id,
$year_type);

$year_id = 1;
$year_type= 2015;
$insert_year->execute();

$year_id = 2;
$year_type= 2016;
$insert_year->execute();

$year_id = 3;
$year_type= 2017;
$insert_year->execute();

$year_id = 4;
$year_type= 2018;
$insert_year->execute();

$year_id = 5;
$year_type= 2019;
$insert_year->execute();

$year_id = 6;
$year_type= 2020;
$insert_year->execute();

$year_id = 7;
$year_type= 2021;
$insert_year->execute();

$year_id = 8;
$year_type= 2022;
$insert_year->execute();

$year_id = 9;
$year_type= 2023;
$insert_year->execute();

$insert_year->close();

/* Semester */
$insert_semester = $db_connection->prepare(
	"INSERT INTO semester
		(semester_id,
		semester_type) VALUES(?,?);");
$insert_semester->bind_param("is",
$semester_id,
$semester_type);

$semester_id = 1;
$semester_type= "Fall";
$insert_semester->execute();

$semester_id = 2;
$semester_type= "Fall 1st 8 weeks";
$insert_semester->execute();

$semester_id = 3;
$semester_type= "Fall 2nd 8 weeks";
$insert_semester->execute();

$semester_id = 4;
$semester_type= "Spring 1st 8 weeks";
$insert_semester->execute();

$semester_id = 5;
$semester_type= "Spring 2nd 8 weeks";
$insert_semester->execute();

$semester_id = 6;
$semester_type= "Spring";
$insert_semester->execute();

$semester_id = 7;
$semester_type= "Winter";
$insert_semester->execute();

$semester_id = 8;
$semester_type= "Summer A";
$insert_semester->execute();

$semester_id = 9;
$semester_type= "Summer B";
$insert_semester->execute();

$semester_id = 10;
$semester_type= "Summer C";
$insert_semester->execute();

$insert_semester->close();

/* Permission */
$insert_permission = $db_connection->prepare(
	"INSERT INTO permission
		(permission_id,
		permission_type) VALUES(?,?);");
$insert_permission->bind_param("is",
$permission_id,
$permission_type);

$permission_id = 1;
$permission_type= "Approved";
$insert_permission->execute();

$permission_id = 2;
$permission_type= "Denied";
$insert_permission->execute();

$insert_permission->close();

/* Course */
$insert_course = $db_connection->prepare(
	"INSERT INTO course
		(course_id,
		course_name,
		credits,
		dept_id,
		status_id) VALUES(?,?,?,?,?);");

$insert_course->bind_param("isisi",
$course_id,
$course_name,
$credits,
$dept_id,
$status_id);

$course_id = 152;
$course_name= "Fundamentals of Programming";
$credits = 3;
$dept_id = "CSC";
$status_id = 1;
$insert_course->execute();

$course_id = 112;
$course_name= "Algebra for Bus. & Services";
$credits = 3;
$dept_id = "MAT";
$status_id = 1;
$insert_course->execute();

$course_id = 101;
$course_name= "Intellectual Inquiry";
$credits = 3;
$dept_id = "INQ";
$status_id = 1;
$insert_course->execute();

$course_id = 001;
$course_name= "Tech Fluency";
$credits = 3;
$dept_id = "AAA";
$status_id = 1;
$insert_course->execute();

$course_id = 110;
$course_name= "Composition Writing Lab";
$credits = 3;
$dept_id = "ENG";
$status_id = 1;
$insert_course->execute();

$insert_course->close();

/* Student */
$insert_student = $db_connection->prepare(
	"INSERT INTO student
		(student_id,
		user_id,
		program_id,
		status_id) VALUES(?,?,?,?);");
$insert_student->bind_param("iiii",
$student_id,
$user_id,
$program_id,
$status_id);

$student_id = 1;
$user_id = 1;
$status_id = 1;
$program_id = 1;
$insert_student->execute();

$student_id = 2;
$user_id = 4;
$status_id = 1;
$program_id = 2;
$insert_student->execute();

$student_id = 3;
$user_id = 5;
$status_id = 1;
$program_id = 1;
$insert_student->execute();

$student_id = 3;
$user_id = 6;
$status_id = 1;
$program_id = 1;
$insert_student->execute();

$student_id = 4;
$user_id = 7;
$status_id = 1;
$program_id = 1;
$insert_student->execute();

$student_id = 5;
$user_id = 8;
$status_id = 2;
$program_id = 1;
$insert_student->execute();

$insert_student->close();

/* Take */
$insert_take = $db_connection->prepare(
	"INSERT INTO take
		(take_id,
		course_id,
		grade_id,
		semester_id,
		year_id,
		state_id,
		student_id) VALUES(?,?,?,?,?,?,?);");
$insert_take->bind_param("iiiiiii",
$take_id,
$course_id,
$grade_id,
$semester_id,
$year_id,
$state_id,
$student_id);

$take_id = 1;
$course_id = 152;
$grade_id = 14;
$semester_id = 1;
$year_id = 5;
$state_id = 3;
$student_id = 1;
$insert_take->execute();

$take_id = 2;
$course_id = 112;
$grade_id = 14;
$semester_id = 1;
$year_id = 5;
$state_id = 3;
$student_id = 1;
$insert_take->execute();

$take_id = 3;
$course_id = 101;
$grade_id = 14;
$semester_id = 1;
$year_id = 5;
$state_id = 3;
$student_id = 1;
$insert_take->execute();

$take_id = 4;
$course_id = 001;
$grade_id = 14;
$semester_id = 1;
$year_id = 5;
$state_id = 3;
$student_id = 1;
$insert_take->execute();

$take_id = 5;
$course_id = 110;
$grade_id = 14;
$semester_id = 1;
$year_id = 5;
$state_id = 3;
$student_id = 1;
$insert_take->execute();

$insert_take->close();

/* Graduation Map */
$insert_graduation = $db_connection->prepare(
	"INSERT INTO graduation
		(graduation_id,
		take_id) VALUES(?,?);");
$insert_graduation->bind_param("ii",
$graduation_id,
$take_id);

$graduation_id = 1;
$take_id = 1;
$insert_graduation->execute();

$insert_graduation->close();

/* Advisor */
$insert_advisor = $db_connection->prepare(
	"INSERT INTO advisor
		(student_id,
		faculty_id) VALUES(?,?);");
$insert_advisor->bind_param("ii",
$student_id,
$faculty_id);

$student_id = 1;
$faculty_id = 1;
$insert_advisor->execute();

$insert_advisor->close();

/* Status Display */
echo nl2br("The database tables were successfully populated.\r\n");
/* Return to homepage after 5 seconds */
header( "refresh:10;url=/ug-advisor" );

/* ALWAYS CLOSE THE DB CONNECTION */
$db_connection->close();

?>
