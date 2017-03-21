Cloning the repo
----------------

1. Clone the repo to `~/Code/Laravel`
2. `cd` into the cloned repo in your VM
3. Run `composer install` to install PHP dependencies
4. Run `npm install` to install Node.js dependencies
5. Copy `.env.example` to `.env`
6. In `.env`, set `APP_KEY` to a random 32-character string

Playing with the database
----------------
Last updated: 
Mon Mar 20 20:43:08 EDT 2017

Currently the base models are not merged with master so we'll need to checkout
the 'firstModels' branch.

1. `git pull`
2. `git checkout origin/firstModels`


From the root directory of the project run the following commands.

1. `php artisan migrate:install`

Expected output
> Migration table created successfully.

2. `php artisan migrate`
Expected output

<pre>
Migrated: 2014_10_12_000000_create_users_table 
Migrated: 2014_10_12_100000_create_password_resets_table 
Migrated: 2017_02_14_204134_create_courses_table 
Migrated: 2017_02_15_034244_create_courses_users_table 
Migrated: 2017_03_09_015134_create_repositories_table 
Migrated: 2017_03_09_034837_create_repositories_users_table 
Migrated: 2017_03_15_002742_create_assignments_table 
Migrated: 2017_03_15_004119_create_submissions_table 
</pre>

Now seed the database with mock data:
3. `php artisan db:seed`

You might receive an error about reflection or unable to find UsersTableSeeder

To remedy this run the following command:

`composer dump-autoload`

then run the seed command again.

Expected output:

<pre>
Seeding: UsersTableSeeder
Seeding: CoursesTableSeeder
</pre>

Cool, now the database is now seeded with some mock data.
Lets Inspect it.

4. `mysql -u homestead`

You'll be in an interactive mysql session. To display all the databases run
the following command.

 5. `show databases;`

<pre>
+--------------------+
| Database           |
+--------------------+
| homestead          |
| information_schema |
| mysql              |
| performance_schema |
+--------------------+
</pre>

For any future operations we want to use the homestead database.

6. `use homestead;`

View all the tables:

7. `show tables;`

<pre>
+---------------------+
| Tables_in_homestead |
+---------------------+
| assignments         |
| courses             |
| courses_users       |
| migrations          |
| password_resets     |
| repositories        |
| repositories_users  |
| submissions         |
| users               |
+---------------------+
</pre>

Use the following command to view the random courses that have been generated:

8. `select * from courses;`

<pre>
+----+----------+----------+--------+---------------------+---------------------+
| id | name     | slug     | active | created_at          | updated_at
+----+----------+----------+--------+---------------------+---------------------+
|  1 | CIS876   | CIS876   |      1 | 2017-03-20 23:59:22 | 2017-03-20 23:59:22
|  2 | MATH4702 | MATH4702 |      1 | 2017-03-20 23:59:22 | 2017-03-20 23:59:22
|  3 | CIS5916  | CIS5916  |      1 | 2017-03-20 23:59:22 | 2017-03-20 23:59:22
|  4 | MATH7174 | MATH7174 |      1 | 2017-03-20 23:59:22 | 2017-03-20 23:59:22
|  5 | STAT6183 | STAT6183 |      1 | 2017-03-20 23:59:22 | 2017-03-20 23:59:22
|  6 | CIS6056  | CIS6056  |      1 | 2017-03-20 23:59:29 | 2017-03-20 23:59:29
|  7 | STAT6373 | STAT6373 |      1 | 2017-03-20 23:59:30 | 2017-03-20 23:59:30
+----+----------+----------+--------+---------------------+---------------------+
</pre>

Feel free to explore the other tables. The only ones that aren't seeded are
repository related.

Exit the sql interpretor

9. `quit;`

Then run

10. `php artisan tinker`

Tinker is a great environment for poking and playing around with components in
Laravel. Let's play around with the Course model located in app/Course


This will return a collection of all the courses in the database.
11. `$courses = App\Course::get();`

Lets play around with course 5.

12. `$course = $courses[4];`

If we look at the at app\Course.php, we can see that theres a function to get
the assignments for a course. Let's try calling it.

13. `$course->assignments();`

Notice how we get an object that's an instance of HasMany. It's not
what we were expecting.

> => Illuminate\Database\Eloquent\Relations\HasMany {#658}

The class HasMany is inherited from the abstract class **Relation**. The
**Relation** class contains a member called **query** which is an instance of **Builder**.
**Relation** is implemented in such a way that we can call **Builder** methods
on it. This allows us to use the 'get' method to obtain the results of the
query.

14. `$course->assignments()->get();`

What are the benefits to returning an instance of **Builder** or **Relation**?
It allows us to save trips to the database and we can build more complex
queries.

For Example: I want to get all the instructors for a course and order them by
their names.

15. `$course->enrollments()->where('role', 'instructor')->orderBy('name')->get();`

Feel free to play around with all the other models in Tinker.



## Etc

Q: I broke my database and can't migrate any more

Run the following Commands:
1. `mysql -u homestead`
2. `drop database homestead;`
3. `create database homestead;`
4. `quit;`
5. `php artisan migrate:install`
6. `php artisan migrate`

This should place your database in a fresh state.
