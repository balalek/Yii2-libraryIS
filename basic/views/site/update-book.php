<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/** @var yii\web\View $this */

$this->title = 'LibraryIS';
?>

<div class="site-index">

    <h1> Update book </h1>

    <div class="body-content">
        <?php $form = ActiveForm::begin() ?>
        <div class="row">
            <div class="form-group">
                <div class="col-lg-6">
                    <?= $form->field($book, 'title')->textInput(['autofocus' => true]); ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <div class="col-lg-6">
                    <?= $form->field($book, 'author')->textInput(['autofocus' => true]); ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <div class="col-lg-6">
                    <?= $form->field($book, 'isbn')->textInput(['autofocus' => true]); ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <div class="col-lg-6">
                    <?= Html::submitButton('Update book', ['class' => 'btn btn-primary']); ?>
                    <a href="<?php echo yii::$app->homeUrl; ?>" class="btn btn-primary">Cancel</a>
                </div>
            </div>
        </div>

        <?php ActiveForm::end() ?>
    </div>
</div>