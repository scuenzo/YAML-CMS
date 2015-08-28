<?php $_layout = "default"; ?>

<div class="container">
    <div class="jumbotron">
        <h1><?= $page->header_title; ?></h1>
    </div>

    <?= $content ?>

    <div class="row">
        <?php foreach (pages('works')->where('homepage', 1) as $work): ?>
            <div class="col-xs-4">
                <a href="<?= route($work) ?>" title="<?= $work->title; ?>">
                    <img src="<?= url("assets/img/portfolio/{$work->image}.jpg"); ?>" class="thumbnail" alt=""
                         width="100%">
                    <h2>
                        <?= $work->title; ?>
                    </h2>
                </a>
            </div>
        <?php endforeach ?>
    </div>

</div>