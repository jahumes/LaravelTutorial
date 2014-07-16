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
            <div class="jumbotron">
                <h1>@section('page_title')
                    Welcome to
                    @show</h1>
            </div>
            @yield('content')
        </div>
    </body>
</html>