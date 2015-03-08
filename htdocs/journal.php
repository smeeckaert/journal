<?php
require_once '../bootstrap.php';
$user = \Session\Session::user();
if (!$user) {
    header('Location: /');
    exit;
}
require_once 'common/header.php';
?>
    <header>

        <a href="/journal">
            <span class="icon-book bigicon"></span>

            <h1 title="Journal">Journal</h1></a>
        <nav id="menu">

            <a href="/signout">
                <span class="icon-key"></span> Signout
            </a>
        </nav>
    </header>
    <div class="journal">
        <div class="row">
            <div class="columns large-3">
                <div class="content">
                    <h3><span class="icon-calendar"></span> Agenda</h3>

                    <div class="agenda">
                        <div class="loader-container">
                            <div class="loader"></div>
                            <div class="message">Loading</div>
                        </div>
                        <div class="ajax-content"></div>

                    </div>
                </div>
            </div>
            <div class="columns large-6">
                <div class="content">

                    <h3><span class="icon-pen"></span> Diary</h3>

                    <div class="article">
                        <div class="loader-container">
                            <div class="loader large"></div>
                            <div class="message">Loading</div>
                        </div>
                        <div class="ajax-content"></div>
                    </div>
                </div>
            </div>
            <div class="columns large-3">
                <div class="content">

                    <h3><span class="icon-clip"></span> Todo List</h3>

                    <div class="todolist">
                        <div class="loader-container">
                            <div class="loader"></div>
                            <div class="message">Loading</div>
                        </div>
                        <div class="ajax-content">
                            <button>New todo</button>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
require_once 'common/footer.php';