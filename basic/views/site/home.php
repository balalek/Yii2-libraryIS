<?php
use yii\helpers\Html;
/** @var yii\web\View $this */

$this->title = 'LibraryIS';
?>

<div class="site-index">
    <?php if(Yii::$app->session->hasFlash('message')): ?>
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="btn-close" data-bs-dismiss="alert">&times;</button>
            <?php echo Yii::$app->session->getFlash('message'); ?>
        </div>
    <?php endif; ?>
    <div class="jumbotron text-center bg-transparent mt-5 mb-5" style="padding-bottom: 15px; padding-top: 15px">
        <!-- h1 and center -->
        <h1 style="color: #337ab7;"> Books database </h1>
    </div>
    <div>
        <span><?= Html::a('Add book', ['site/add-book'], ['class' => 'btn btn-primary']) ?></span>
    </div>

    <div class="body-content">
        <div class="row">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Book name</th>
                    <th scope="col">Author(s)</th>
                    <th scope="col">ISBN</th>
                    <th scope="col">Return date</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if(count($books) > 0): ?>
                    <?php foreach($books as $book): ?>
                        <?php if($book->return_date != null): ?>
                            <tr class="table-danger">
                            <?php else: ?>
                            <tr class="table-success">
                            <?php endif; ?>
                            <th scope="row"><?= $book->title ?></th>
                            <td><?= $book->author ?></td>
                            <td><?= $book->isbn ?></td>
                            <td><?php if ($book->return_date != null) {
                                    $date = date_create($book->return_date);
                                    echo date_format($date, "d.m.Y");
                                }?></td>
                            <td>
                                <span><?= Html::a('View', ['view', 'book_id' => $book->book_id], ['class' => 'badge rounded-pill bg-primary']) ?></span>
                                <span><?= Html::a('Update', ['update-book', 'book_id' => $book->book_id], ['class' => 'badge rounded-pill bg-secondary']) ?></span>
                                <?php if($book->return_date == null): ?>
                                <span><?= Html::a('Delete', ['delete', 'book_id' => $book->book_id], ['class' => 'badge rounded-pill bg-danger']) ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr class="table-danger">
                        <td colspan="5">No books found</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>