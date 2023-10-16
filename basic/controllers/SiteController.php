<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Books;
use app\models\Users;
use app\models\Loans;

class SiteController extends Controller
{

    /**
     * Displays homepage with all books.
     *
     * @return string
     */
    public function actionIndex()
    {
        // Join books with loans and get all books with return date
        $books = Books::find()
            ->select(['books.*', 'loans.return_date'])
            ->leftJoin('loans', 'books.book_id = loans.book_id')
            ->all();

        foreach ($books as $book) {
            if($book->return_date != null) {
                // For each unloaned book, that have return_date <= today, set return date to null
                if ($book->return_date < date('Y-m-d')) {
                    $book->return_date = null;
                }
            }
        }

        return $this->render('home', ['books' => $books]);
    }

    /**
     * Displays add book page.
     *
     * @return string | Response If book is added, return to index page, else open add book page
     */
    public function actionAddBook()
    {
        $book = new Books();
        $formData = Yii::$app->request->post();
        if ($book->load($formData)) {
            if ($book->save()) {
                Yii::$app->getSession()->setFlash('message', 'Book added successfully');
                return $this->redirect(['index']);
            } else {
                Yii::$app->getSession()->setFlash('message', 'Failed to add book');
            }
        }
        return $this->render('add-book', ['book' => $book]);
    }

    /**
     * Displays book information page.
     *
     * @param $book_id int ID of the book
     * @return string
     */
    public function actionView($book_id)
    {
        $book = Books::findOne($book_id);
        // Find user who loaned the book in Loans, where book_id is the same and return_date is after today
        $loan = Loans::find()->where(['book_id' => $book_id])->andWhere(['>', 'return_date', date('Y-m-d')])->one();
        $all_loans = Loans::find()->where(['book_id' => $book_id])->all();

        // How often are books loaned per year and make average loans per year
        // Group by year and count number of loans for each year
        $loans_per_year = Loans::find()
            ->select(['YEAR(loan_date) AS year', 'COUNT(*) AS count'])
            ->where(['book_id' => $book_id])
            ->groupBy(['YEAR(loan_date)'])
            ->all();

        // Divide all loans by number of years and round it, unless it's empty
        if (count($loans_per_year) > 0) {
            $average = count($all_loans) / count($loans_per_year);
            $averageRound = round($average);
        } else {
            $averageRound = 0;
        }

        // If loan exists, find user who loaned the book
        if ($loan) {
            $user_id = $loan->user_id;
            $user = Users::findOne($user_id);
            return $this->render('view', ['book' => $book, 'user' => $user, 'loan' => $loan, 'all_loans' => $all_loans, 'average' => $averageRound]);
        }

        // If book is not loaned, don't return user and return date
        return $this->render('view', ['book' => $book, 'all_loans' => $all_loans, 'average' => $averageRound]);
    }

    /**
     * Update book information
     * @param $book_id int ID of the book
     * @return string|Response If book is updated, return to index page, else open update page
     */
    public function actionUpdateBook($book_id)
    {
        $book = Books::findOne($book_id);
        if ($book->load(Yii::$app->request->post()) && $book->save()) {
            Yii::$app->getSession()->setFlash('message', 'Book updated successfully');
            return $this->redirect(['index', 'book_id' => $book->book_id]);
        }
        else {
            return $this->render('update-book', ['book' => $book]);
        }
    }

    /**
     * Delete book
     * @param $book_id int ID of the book
     * @return Response Redirect to index page
     */
    public function actionDelete($book_id)
    {
        $book = Books::findOne($book_id);
        $book->delete();
        if ($book) {
            Yii::$app->getSession()->setFlash('message', 'Book deleted successfully');
            return $this->redirect(['index']);
        }
    }

    /**
     * Displays customers page.
     *
     * @return string
     */
    public function actionCustomers()
    {
        $users = Users::find()->all();
        // Find books in loans, where user_id is the same and return_date is after today and store it in array
        foreach ($users as $user) {
            $user->borrowed_books = Loans::find()
                ->select(['books.title'])
                ->leftJoin('books', 'loans.book_id = books.book_id')
                ->where(['user_id' => $user->user_id])
                ->andWhere(['>', 'return_date', date('Y-m-d')])
                ->column();
        }

        return $this->render('customers', ['users' => $users]);
    }





    /*************************************************************  BASIC TEMPLATE CODE  ***************************************************************/




    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }
}
