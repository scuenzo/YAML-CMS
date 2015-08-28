<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= (isset($page) && isset($page->title)) ? $page->title : 'Mon site'; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <nav class="navbar navbar-inverse" style="margin-bottom: 0;">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?= route('home') ?>">Bootstrap theme</a>
                <ul class="nav navbar-nav">
                    <li>
                        <a href="<?= route('contact') ?>">Me contacter</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?= $content; ?>

</body>
</html>
