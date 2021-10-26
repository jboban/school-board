# School board

Program calculate the average of the grades for a given student, identify if he has passed or failed and return the student's statistic.

Each school board can have a different rule to calculate if he has passed or not and in which format (JSON, XML) it return results.

### Notes:
* A student is registered with only one school board.
* A student can have 1 to 4 grades.
* Implement two school boards, **CSM** and **CSMB**.
* CSM considers pass if the average is bigger or equal to 7 and fail otherwise. Returns JSON format.
* CSMB discards the lowest grade, if you have more then 2 grades, and considers pass if his biggest grade is bigger than 8. Returns XML format.
* Each student result, either XML or JSON, will contain the student id, name, list of grades, average and final result (Fail, Pass).
* Database used is MySQL.
* Entry point of app is through HTTP request. Eg.

[http://localhost/?student=1](http://localhost/?student=1)

It returns report of student with ID of 1 for example, with the fields provided above.

### database.inc format:

const C_DB_Host = "host_name";

const C_DB_User = "user";

const C_DB_Pass = "pass";

const C_DB_Name = "school_board";
