<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>My Site</title>
        <?= stylesheet_link_tag() ?>
        <?= javascript_include_tag() ?>
    </head>
    <body>
        <div class="container" role="main">
            <h1>@yield('page_title')</h1>
            <?php $messages =  $errors->all() ?>
            <?php foreach ($messages as $msg): ?>
                <?= Alert::error($msg); ?>
            <?php endforeach; ?>

            @yield('content')
        </div>
    </body>
</html>