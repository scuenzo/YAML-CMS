<?php $_layout = 'default'; ?>

<div class="jumbotron" style="overflow: hidden; color:#FFF; background-image:url(<?= url("assets/img/portfolio/{$page->image}.jpg"); ?>)">
    <div class="container" >
        <h1><?= $page->title ?></h1>
    </div>
</div>


<div class="container">
    <?= $content ?>
</div>
