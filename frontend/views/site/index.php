<?php

/* @var $this yii\web\View */

$this->title = 'Family money';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Hello!</h1>

        <p class="lead"><b>You have successfully entered our site! You'll be rich with us:)</b></p>
        <br>
        <?php
        if (Yii::$app->user->isGuest) {
            echo 'This site is created for accuracy in your money spend.';
            echo 'If you want to take all possibilities of our site,please,sign up.';
            echo "<br>";
            echo "<br>";
            echo "<br>";
            echo "<br>";
            echo "<br>";
            echo "<br>";
            echo "<br>";
            echo "<br>";
            echo "<br>";
            return null;
        } ?>
        <p><a class="btn btn-lg btn-success" href="http://fam_money.test/profile/info">Profile information</a></p>
    </div>


    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Family</h2>

                <p>Add your family members to your own group.
                    It allows them to see your accounts and transactions.</p>

                <p><a class="btn btn-default" href="http://fam_money.test/family">Family &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Accounts</h2>

                <p>Create,update and delete your accounts in any currency</p>

                <p><a class="btn btn-default" href="http://fam_money.test/family">Accounts &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Transactions</h2>

                <p>Create,update and delete your transactions in any currency</p>

                <p><a class="btn btn-default" href="http://fam_money.test/family">Transactions &raquo;</a></p>
            </div>

            <div class="col-lg-4">
                <h2>Categories</h2>

                <p>Create,update and delete categories of your salaries and losses </p>

                <p><a class="btn btn-default" href="http://fam_money.test/family">Transactions &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
