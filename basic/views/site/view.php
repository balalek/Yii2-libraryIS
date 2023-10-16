<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/** @var yii\web\View $this */

$this->title = 'LibraryIS';
?>

<div class="site-index">

    <h1> Book information </h1>

    <div class="body-content">
        <div class="row">
            <div class="col-md-2">
                <ul class="list-group no-grid-lines">
                    <li class="list-group-item">Title:</li>
                    <li class="list-group-item">Author:</li>
                    <li class="list-group-item">ISBN:</li>
                    <?php // If $user is not set, then user borrowed this book, so display his name + return date
                    if(isset($user)): ?>
                        <li class="list-group-item">Borrowed by:</li>
                        <li class="list-group-item">Return date:</li>
                    <?php endif; ?>
                    <li class="list-group-item">All time loans count:</li>
                    <li class="list-group-item">Average loans per year:</li>
                </ul>
            </div>
            <div class="col-md-6">
                <ul class="list-group no-grid-lines">
                    <li class="list-group-item"><?= $book->title ?></li>
                    <li class="list-group-item"><?= $book->author ?></li>
                    <li class="list-group-item"><?= $book->isbn ?></li>
                    <?php // If $user is not set, then user borrowed this book, so display his name + return date
                    if(isset($user)): ?>
                        <li class="list-group-item"><?= $user->name ?></li>
                        <li class="list-group-item">
                            <?php
                            // show date in czech format
                            $date = date_create($loan->return_date);
                            echo date_format($date, "d.m.Y");
                            ?>
                        </li>
                    <?php endif; ?>
                    <li class="list-group-item"><?= count($all_loans) ?></li>
                    <li class="list-group-item"><?= $average ?></li>
                </ul>
            </div>

            <div class="row" style="margin-top: 20px;">
                <div class="form-group">
                    <div class="col-lg-6">
                        <a href="<?php echo yii::$app->homeUrl; ?>" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>