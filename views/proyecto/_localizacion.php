<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

?>

<div class="panel panel-default">
    <div class="panel-body">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>País</th>
                    <th>Estado</th>
                    <th>Municipio</th>
                    <th>Parroquia</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= HtmlPurifier::process($key) ?></td>
                    <td><?= HtmlPurifier::process($model->nombrePais) ?></td>
                    <td><?= HtmlPurifier::process($model->nombreEstado) ?></td>
                    <td><?= HtmlPurifier::process($model->nombreMunicipio) ?></td>
                    <td><?= HtmlPurifier::process($model->nombreParroquia) ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>