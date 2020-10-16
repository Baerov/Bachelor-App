<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        Eroarea de mai sus a apărut în timp ce serverul web a făcut procesarea solicitării
    </p>
    <p>
        Vă rugăm să ne contactați dacă sunteți de părere că aceasta este o eroare de server. Vă mulțumim
    </p>

</div>
