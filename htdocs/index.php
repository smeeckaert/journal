<?php

require_once '../bootstrap.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="UTF-8">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="/static/img/favicon/apple-touch-icon-57x57.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/static/img/favicon/apple-touch-icon-114x114.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/static/img/favicon/apple-touch-icon-72x72.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/static/img/favicon/apple-touch-icon-144x144.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="/static/img/favicon/apple-touch-icon-60x60.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="/static/img/favicon/apple-touch-icon-120x120.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="/static/img/favicon/apple-touch-icon-76x76.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="/static/img/favicon/apple-touch-icon-152x152.png"/>
    <link rel="icon" type="image/png" href="/static/img/favicon/favicon-196x196.png" sizes="196x196"/>
    <link rel="icon" type="image/png" href="/static/img/favicon/favicon-96x96.png" sizes="96x96"/>
    <link rel="icon" type="image/png" href="/static/img/favicon/favicon-32x32.png" sizes="32x32"/>
    <link rel="icon" type="image/png" href="/static/img/favicon/favicon-16x16.png" sizes="16x16"/>
    <link rel="icon" type="image/png" href="/static/img/favicon/favicon-128.png" sizes="128x128"/>
    <meta name="application-name" content="Journal"/>
    <meta name="msapplication-TileColor" content="#2B292E"/>
    <meta name="msapplication-TileImage" content="/static/img/favicon/mstile-144x144.png"/>
    <meta name="msapplication-square70x70logo" content="/static/img/favicon/mstile-70x70.png"/>
    <meta name="msapplication-square150x150logo" content="/static/img/favicon/mstile-150x150.png"/>
    <meta name="msapplication-wide310x150logo" content="/static/img/favicon/mstile-310x150.png"/>
    <meta name="msapplication-square310x310logo" content="/static/img/favicon/mstile-310x310.png"/>

    <title>Journal</title>

    <link rel="stylesheet" href="/static/css/template.css">
    <link href='http://fonts.googleapis.com/css?family=Rufina:400,700,100,300|Raleway|Sintony:400,700,100,300'
          rel='stylesheet' type='text/css'>
    <?php

    if (PROD) {
        ?>
        <script src="/static/js/build.min.js"></script>
    <?php
    } else {
    ?>
        <script src="/static/js/libs/jquery-2.1.3.js"></script>
        <script src="/static/js/libs/crypto/sha512.js"></script>
        <script src="/static/js/libs/crypto/aes.js"></script>
        <script src="/static/js/src/config.js"></script>
        <script src="/static/js/src/form.js"></script>
        <script src="/static/js/src/home.js"></script>
        <script src="/static/js/src/api.js"></script>
        <script src="/static/js/src/middleware.js"></script>
        <script src="/static/js/src/middleware/crypt.js"></script>

    <?php
    }
    ?>

</head>

<body>
<header>

    <a href="/">
        <span class="icon-book"></span>

        <h1 title="Journal">Journal</h1></a>
    <nav id="menu"></nav>
</header>
<div class="content">

    <h1>Welcome to your Journal</h1>

    <h3>Journal is a secured application to write a private diary and agenda.</h3>
    <br><br>

    <div class="row">
        <div class="columns small-12  sign-form">
            <h2>Register or sign-in right now.</h2>

            <div class="loader-container hidden">
                <div class="loader large"></div>
                <div class="message"></div>
            </div>

            <div class="register-content">
                <form>
                    <input type="radio" name="tab" value="signin" checked="checked" id="signin"
                           data-message="Signing in"
                           data-action="signin" data-check="false">
                    <input type="radio" name="tab" value="register" id="register" data-message="Creating access"
                           data-action="register" data-check="true">

                    <div class="row tabs">
                        <div class="columns small-6">
                            <label for="signin">
                                <span class="icon-key"></span>
                                Sign-in
                            </label>
                        </div>
                        <div class="columns small-6">
                            <label for="register">
                                <span class="icon-pen"></span>
                                Register
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="columns small-3">
                            <label for="login" class="hide-register">Login or E-Mail</label>
                            <label for="login" class="show-register">Login</label>
                        </div>
                        <div class="columns small-9">
                            <input type="text" name="login" id="login" data-check="login">
                            <span class="error hidden"></span>
                        </div>
                    </div>
                    <div class="row show-register">
                        <div class="columns small-3">
                            <label for="mail">Mail</label>
                        </div>
                        <div class="columns small-9">
                            <input type="text" name="mail" id="mail" data-check="mail">
                            <span class="error hidden"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="columns small-3">
                            <label for="pwd">Password</label>
                        </div>
                        <div class="columns small-9">
                            <input type="password" name="pwd" id="pwd">
                        </div>
                    </div>

                    <div class="buttons">
                        <button class="hide-register">
                            Sign-in
                        </button>
                        <button class="show-register">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row subtext">
    <div class="columns small-12">
        <h1>Journal is</h1>

        <div class="row">
            <div class="columns large-4">
                <h2>Secured</h2>

                <div class="bigicon">
                    <span class="icon-lock"></span>
                </div>
                <p>
                    Everything is <strong>encrypted</strong> on your browser before <strong>sending</strong> it
                    to the server.
                    <br>
                    That way <strong>no one</strong>,
                    except you, can have access to your informations.
                </p>
            </div>
            <div class="columns large-4">
                <h2>Open</h2>

                <div class="bigicon">
                    <span class="icon-public"></span>
                </div>
                <p>
                    <strong>All</strong> Journal's source code is <strong>open</strong> and under public domain.
                    <br>
                    That means you can install it on any server and modify it as you want.<br>
                    You can find it on <a href="http://github.com">GitHub</a>.
                </p>
            </div>
            <div class="columns large-4">
                <h2>Free</h2>

                <div class="bigicon">
                    <span class="icon-banknote"></span>
                </div>
                <p>
                    <strong>Everything</strong> is free. And you are not <a
                        href="http://geek-and-poke.com/geekandpoke/2010/12/21/the-free-model.html">the
                        product</a>.
                    <br>
                    Everything is encrypted. Therefore we can't use your data and we can't sell it.
                </p>
            </div>
        </div>
    </div>
</div>
<footer>
    Pinecone Studio
    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
         width="521.63px" height="585.316px" viewBox="0 0 521.63 585.316"
         style="enable-background:new 0 0 521.63 585.316;"
         xml:space="preserve">
<g id="Logo_Black">
    <path style="fill:#90A4AE;" d="M475.34,322.605h-0.029L317.5,404.799h0.842c-25.434,13.249-45.396,47.551-45.396,76.234v52.134
		v52.149l203.242-106.273c25.434-13.246,45.441-47.555,45.441-76.23V350.67v-52.148L475.34,322.605z"/>
    <path style="fill:#90A4AE;" d="M46.291,286.112h0.026l157.808,82.188h-0.84c25.437,13.242,45.398,47.551,45.398,76.23v52.149
		v52.138L45.444,442.541C20.007,429.296,0,394.99,0,366.307v-52.142v-52.138L46.291,286.112z"/>
    <path style="fill:#607D8B;" d="M425.287,201.219h-0.504L306.176,262.86h0.723c-19.066,9.942-33.953,35.662-33.953,57.175v39.114
		v39.11l153.189-79.706c19.074-9.942,34.84-35.673,34.84-57.184v-39.106V183.15L425.287,201.219z"/>
    <path style="fill:#607D8B;" d="M96.342,164.718h0.503l118.606,61.645h-0.723c19.07,9.938,33.954,35.665,33.954,57.176v39.106
		v39.113L95.495,282.044c-19.075-9.938-34.84-35.665-34.84-57.176v-39.106v-39.11L96.342,164.718z"/>
    <path style="fill:#455B65;" d="M372.197,121.548h0.539l-78.633,41.092h0.982c-12.721,6.623-22.141,23.775-22.141,38.117v26.067
		v26.067l100.104-53.131c12.725-6.615,21.205-23.771,21.205-38.109V135.58v-26.067L372.197,121.548z"/>
    <g>
        <path style="fill:#263238;" d="M318.645,97.684c0.781-12.01-6.439-23.735-13.998-34.798C304.635,62.875,261.66,0,261.66,0
			l-38.917,54.651c-8.212,11.752-5.508,28.348,6.016,36.88c9.773,7.245,21.321,14.731,29.504,23.985
			c8.548,9.675,10.644,20.117,11.941,32.232c1.393-0.512,32.406-20.926,42.465-34.55C316.518,107.997,318.307,102.81,318.645,97.684
			z"/>
    </g>
    <path style="fill:#455B65;" d="M149.43,85.042h-0.537l78.635,41.093h-0.983c12.719,6.626,22.139,23.779,22.139,38.117v26.071
		v26.071l-100.103-53.135c-12.721-6.619-21.205-23.771-21.205-38.113V99.078V73.011L149.43,85.042z"/>
</g>
</svg>
</footer>
</body>
</html>