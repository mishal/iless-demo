<?php

use ILess\Exception\Exception;
use ILess\Parser;

require_once __DIR__.'/vendor/autoload.php';

$less = '';
$error = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $less = $_POST['less'];
    $options = [
        'sourceMap' => true,
        'sourceMapOptions' => [
            'url' => 'demo',
        ],
    ];
    try {
        $parser = new Parser($options);
        $parser->parseString($less);

        $css = $parser->getCSS();
    } catch (Exception $e) {
        $error = $e->toString(true, true);
    }

} else {
    $less = file_get_contents(__DIR__.'/css/default.less');
    $css = file_get_contents(__DIR__.'/css/default.css');
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>ILess demo</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/css/demo.min.css"/>
    <link rel="stylesheet" href="/css/codemirror.css">
    <link rel="stylesheet" href="/css/twilight.css">
    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="/js/vendor/codemirror/lib/codemirror.js"></script>
    <script src="/js/vendor/codemirror/mode/css/css.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="/js/app.js"></script>
    <meta name="google-site-verification" content="Jt9VElNJ6qLVUCGX8FWJNjb3d5-R8tGSDEEAGUydyCk" />
</head>
<body>

<div class="container">
    <!-- Static navbar -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">
                    <img src="/images/logo.png" alt="ILess"/>
                </a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="https://github.com/mishal/iless">
                            <i class="glyphicon glyphicon-folder-open"></i> &nbsp; Sources</a>
                    </li>
                    <li><a href="https://github.com/mishal/iless/releases">
                            <i class="glyphicon glyphicon-download-alt"></i> Downloads</a>
                    </li>
                    <li><a href="https://packagist.org/packages/mishal/iless">On packagist</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="https://github.com/mishal/iless"><i class="glyphicon glyphicon-floppy-save"></i> Fork
                            on GitHub</a></li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
        <!--/.container-fluid -->
    </nav>

    <h1>ILess demo</h1>

    <p class="lead">
        Try out before using in your next project...
    </p>

    <form action="" method="post">
        <?php if ($error): ?>
            <div class="alert alert-danger" role="alert">
                <strong>Ohhh.</strong> There was an error, see the output for more information.
            </div>
        <?php endif; ?>

        <div class="textareas-wrapper">
            <div class="textarea-wrapper less">
                <h2>Less</h2>
                <textarea class="less-input" name="less"><?php echo $less; ?></textarea>
            </div>
            <div class="textarea-wrapper css">
                <h2>CSS</h2>
                <?php if ($error): ?>
                    <div class="error"><?php echo $error; ?></div>
                <?php else: ?>
                    <textarea class="css-output"><?php echo $css; ?></textarea>
                <?php endif; ?>
            </div>
        </div>
        <p>
            <button class="btn btn-lg btn-block btn-primary" type="submit">Compile</button>
        </p>
    </form>

    <section class="help">
        <ul>
            <li>
                <a href="http://lesscss.org/features/">Less features reference</a>
            </li>
        </ul>
    </section>

    <section class="bug-report">
        <h2>Missing something or found a bug?</h2>

        <p>
            Please <a href="https://github.com/mishal/iless/issues">submit an issue</a> to the issue tracker.
        </p>
    </section>

    <footer>
        &copy; <?php echo date('Y'); ?> ILess contributors, licensed under MIT, Powered by
        <a href="https://github.com/mishal/iless">ILess</a> <?php echo Parser::VERSION; ?>, compatible with
        less.js <?php echo Parser::LESS_JS_VERSION; ?>
        <div class="logo"><a href="https://www.openshift.com/"></a></div>
    </footer>

</div>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-67370642-1', 'auto');
    ga('send', 'pageview');
</script>
</body>
</html>
