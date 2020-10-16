<?php

use yii\helpers\Html;
use yii\widgets\ListView;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="contact-index">
    <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_operatorView',
            'layout'=>"<div class='row'><div class='col-md-5'>{summary}</div><div class='col-md-7'>{pager}</div></div>{items}<div class='text-center'>{pager}</div>",
            'pager' => [
                'prevPageLabel' => '<span class="glyphicon glyphicon-chevron-left"></span>Precedent',
                'nextPageLabel' => 'Următor<span class="glyphicon glyphicon-chevron-right"></span>',
                'maxButtonCount' => 0,
            ],
            'summary' => '<h4>Pacient #{page} din {pageCount}</h4>',
            'emptyText' => '<h2 class="text-center">Nu mai sunt pacienți de verificat</h2>',
        ]
    );
    ?>
</div>
