<p align="center">
    <h1 align="center">Library Information System</h1>
    <br>
</p>

## Information
Since this is very simple Yii2 project, there is no login system. The user is meant to be admin. 
The admin can view, add, update, and delete books. 
The admin can also view the list of books and the list of users with their borrowed books.

### Modified Files
Since this project is created from the basic template of Yii2, I am attaching a list of the files that I have modified and added to the project.

- `config/db.php`
- `controllers/SiteController.php`
- `models/Books.php`
- `models/Loans.php`
- `models/Users.php`
- `views/site/add-book.php`
- `views/site/home.php`
- `views/site/view.php`
- `views/site/update.php`
- `views/site/customers.php`
- `views/site/index.php`
- `views/layouts/main.php`
- `web/css/site.css`

### Instalation
1. Clone this repository
2. If you are using XAMPP, put the `basic` folder in `C:\xampp\htdocs` and type `http://localhost/basic/web/index.php` in your browser
3. Run MySQL database using XAMPP for example, where you can use phpMyAdmin, create a new database called `library` and import the `library.sql` file.
