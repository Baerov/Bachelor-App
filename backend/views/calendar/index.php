<?php
use yii\helpers\Url;

echo yii2fullcalendar\yii2fullcalendar::widget(array(
    'ajaxEvents' => Url::to(['/calendar/jsoncalendar']),
    'options' => [
        'lang' => 'RO',
    ],
    'clientOptions' => [
        'timeFormat' => 'H(:mm)',
    ],
));
?>