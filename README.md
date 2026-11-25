# EduCollab – Course Collaboration & File Repository Platform

A web platform where instructors run group projects for their courses and students store files, work in teams, and submit their work.

Built with **PHP**, **MySQL** and **HTML/CSS/JavaScript** (runs on XAMPP).

> Team project. See [Team](#team) below.

## Features

### For instructors
- **Create a course from a CSV file** (`student_university_id,cgpa`). The system generates a unique course code to share with students.
- **Form student groups**: automatically by CGPA (groups of a chosen size) or manually by selecting students. The student with the highest CGPA becomes group leader, and the instructor can change the leader, rename groups, or remove members.
- **Review final group submissions** on the task board and approve or reject them.

### For students
- **Personal cloud storage**: upload, rename, delete and organise files in folders.
- **Join a course** with the course code. The system checks that the student is on the instructor's enrolment list.
- **Course dashboard** that shows the student's group, members and leader.

### Task board (group workflow)
1. The **group leader** assigns tasks to members of their group.
2. A **member** accepts or rejects the task, then uploads their work.
3. The **leader** approves the work or sends it back.
4. The **leader** uploads the group's final submission.
5. The **instructor** approves or rejects the final submission.

## Security
- Passwords are stored as bcrypt hashes (`password_hash` / `password_verify`).
- Session-based login with **role-based access** (student / instructor), checked on every page.
- **Prepared statements**, which protect against SQL injection.
- **Authorization checks**: leaders can only act on their own group, and instructors only on their own courses.
- **Upload protection**: only safe file types are accepted (no `.php` and other scripts), files get random names, and `uploads/.htaccess` blocks script execution.
- Output is escaped with `htmlspecialchars` to prevent XSS.

## Database design

MySQL schema in `database/file_repo.sql`:

| Table | Purpose |
|---|---|
| `users` | Accounts: role, university ID, hashed password |
| `files`, `folders` | Personal file storage |
| `courses` | Courses with unique course code and owning instructor |
| `course_enrollments` | Students loaded from CSV, linked to their account once they join |
| `groups`, `group_members` | Project groups with leader |
| `tasks` | Task board items: assignee, status, submitted file |
| `final_submissions` | Final group submission and its approval status |

## Screenshots

<!-- Add screenshots to a `screenshots/` folder and uncomment:
![Login](screenshots/login.png)
![Instructor dashboard](screenshots/instructor.png)
![Course groups](screenshots/groups.png)
![Task board](screenshots/taskboard.png)
-->

## Run locally

1. Install [XAMPP](https://www.apachefriends.org/) and start **Apache** and **MySQL**.
2. Copy this folder into `xampp/htdocs/educollab`.
3. In phpMyAdmin, create a database named `file_repo` and import `database/file_repo.sql`.
4. Check the connection settings in `db.php`.
5. Open <http://localhost/educollab/register.php>. Register an instructor and some students. Student e-mails use the format `2023-1-60-001@gmail.com`; the part before `@` is the university ID.
6. As the instructor, create a course with a CSV of those university IDs. Students then join with the course code.

## Project structure

```
login.php, register.php, logout.php        Authentication
files.php, upload.php, rename.php,
delete.php, folders.php                    Personal file storage
professor_dashboard.php, upload_csv.php    Instructor dashboard and course creation
course_dashboard.php                       Enrolments and group management
join_course.php, student_course_dashboard.php,
student_utils.php                          Student course features
taskboard.php                              Group task workflow and final submissions
upload_rules.php                           Allowed upload types
db.php                                     Database connection
database/file_repo.sql                     Schema
```

## Team

Developed project at East West University, Dhaka (2025).

- Ankon Saha ([@ankonsaha12](https://github.com/ankonsaha12))
  
