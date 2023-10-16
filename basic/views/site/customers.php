<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'LibraryIS';
?>

<div class="site-index">
    <div class="jumbotron text-center bg-transparent mt-5 mb-5" style="padding-bottom: 15px; padding-top: 15px">
        <!-- h1 and center -->
        <h1 style="color: #337ab7;"> Customers database </h1>
    </div>

    <div class="body-content">
        <div class="row">
            <table class="table table-hover">
                <!-- Show all users in one column, and in second show books they borrowed, if there are any -->
                <thead>
                <tr>
                    <th scope="col">Customer name</th>
                    <th scope="col">Phone number</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Borrowed books</th>
                </tr>

                </thead>
                <tbody>
                <?php if(count($users) > 0): ?>
                    <?php foreach($users as $user): ?>
                        <tr>
                            <th scope="row"><?= $user->name ?></th>
                            <td><?= $user->phone ?></td>
                            <td><?= $user->email ?></td>
                            <td>
                                <?php if(count($user->borrowed_books) > 0): ?>
                                    <?php foreach($user->borrowed_books as $borrowed_book): ?>
                                        <?= $borrowed_book ?> <br>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    --
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr class="table-danger">
                        <td colspan="2">No users found</td>
                    </tr>
                <?php endif; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>