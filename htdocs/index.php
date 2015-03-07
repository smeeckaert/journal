<?php
require_once '../bootstrap.php';
$user = \Session\Session::user();
if ($user) {
    \Session\Session::set(null, null); //@todo remove
    header('Location: /journal');
    exit;
}
require_once 'common/header.php';
?>

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

                    <div class="error message hidden">

                    </div>
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
                    <div class="row">
                        <div class="columns small-3">
                            <label for="pwd">Password</label>
                        </div>
                        <div class="columns small-9">
                            <input type="password" name="pwd" id="pwd">
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
                    <div class="buttons">
                        <button class="hide-register" disabled>
                            Sign-in
                        </button>
                        <button class="show-register" disabled>
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
                    You can find it on <a href="https://github.com/smeeckaert/journal">GitHub</a>.
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
<?php
require_once 'common/footer.php';
?>
<script>
    $(document).ready(function () {
        Crypto.setStorage(false);
    });
</script>

