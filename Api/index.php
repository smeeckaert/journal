<?php

require 'bootstrap.php';
header("Content-Type: application/json");

$app = new \Slim\Slim();

$app->get('/signin', function () {
    global $app;
    $login    = $app->request->params('login');
    $password = hash('sha512', $app->request->params('pwd'));
    $user     = \Session\Session::check($login, $password);
    if (!$user) {
        $app->response()->status(404);
    } else {
        \Session\Session::set($login, $password);
    }
    $app->response()->body(json_encode(
        array('authenticated' => !empty($user))
    ));
});

$app->get('/register/check/:field', function ($field) {
    global $app;

    $fields = array('mail', 'login');
    $check  = $app->request->params('check');

    if (!in_array($field, $fields) || empty($check)) {
        return false;
    }
    $user = \Api\Model\User::find(array('and_where' => array($field => $check)));
    if ($user) {
        $app->response->status(409);
    } else {
        $app->response()->status(202);
    }

});

$app->get('/register', function () {
    global $app;
    $infos    = array();
    $login    = $app->request->params('login');
    $reqPwd   = $app->request->params('pwd');
    $password = hash('sha512', $reqPwd);
    $mail     = $app->request->params('mail');
    try {
        if (empty($login) || empty($reqPwd) || empty($mail)) {
            throw new Exception("Missing parameters");
        }
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email");
        }
        $user        = new \Api\Model\User();
        $user->login = $login;
        $user->pwd   = $password;
        $user->mail  = $mail;
        $user->save();
        \Session\Session::set($login, $password);
        $infos['authenticated'] = true;
    } catch (\Orm\Model\Exception\Unique $e) {
        $app->response->status(409);
        $infos['error'] = "Existing informations";
    } catch (Exception $e) {
        $app->response->status(406);
        $infos['error'] = "Wrong or missing informations";
    }

    $app->response()->body(json_encode($infos));
});

$app->get('/status', function () {
    global $app;
    $user = \Session\Session::user();
    if (empty($user)) {
        $app->response()->status(401);
    }
    $app->response()->body(json_encode(
        array('authenticated' => !empty($user))
    ));
});

$app->get('/agenda/list/:year(/)(:month/?)(:day/?)', function ($year, $pmonth = null, $pday = null) {
    global $app;
    $month = $pmonth ?: 1;
    $day   = $pday ?: 1;
    if (!($user = checkUser())) {
        return;
    }
    $date      = mktime(0, 0, 0, $month, $day, $year);
    $dateMysql = date('Y-m-d H:i:s', $date);
    if (!empty($pday)) {
        $day++;
    } else if (!empty($pmonth)) {
        $month++;
    } else {
        $year++;
    }

    $endDate      = mktime(0, 0, -1, $month, $day, $year);
    $endDateMysql = date('Y-m-d H:i:s', $endDate);
    $events       = \Api\Model\Agenda::getByDate($dateMysql, $endDateMysql, $user->id);
    $data         = array();
    foreach ($events as $event) {
        $data[] = $event->serialize();
    }
    $app->response()->body(json_encode(
        $data
    ));
});

$app->get('/agenda/add', function () {
    global $app;
    if (!($user = checkUser())) {
        return;
    }
    $data                 = array();
    $data['agen_title']   = $app->request->params('title');
    $data['agen_content'] = $app->request->params('content');
    $data['agen_start']   = $app->request->params('start');
    $data['agen_end']     = $app->request->params('end');
    foreach ($data as $key => $value) {
        if (empty($value)) {
            $app->response->status(406);
            return;
        }
    }
    // Category can be null
    $data['agen_cate_id'] = $app->request->params('category');
    $id                   = $app->request->params('id');
    if ($id) {
        $agenda = \Api\Model\Agenda::find($id);
        if (!$agenda) {
            $app->response->status(404);
            return;
        }
        if ($agenda->user_id != $user->id) {
            $app->response->status(401);
        }
        $agenda->import($data);
    } else {
        $agenda          = new \Api\Model\Agenda($data);
        $agenda->user_id = $user->id;
    }
    $agenda->save();
});

$app->get('/agenda/delete', function () {
    global $app;
    if (!($user = checkUser())) {
        return;
    }
    $id = $app->request->params('id');
    if (empty($id)) {
        $app->response->status(406);
        return;
    }
    $agenda = \Api\Model\Agenda::find($id);
    if ($agenda) {
        if ($agenda->user_id == $user->id) {
            $agenda->delete();
        } else {
            $app->response->status(401);
        }
    } else {
        $app->response->status(404);
    }
});

$app->get('/category/add', function () {
    global $app;
    if (!($user = checkUser())) {
        return;
    }
    $data               = array();
    $data['cate_title'] = $app->request->params('title');
    $data['cate_color'] = $app->request->params('color');
    foreach ($data as $key => $value) {
        if (empty($value)) {
            $app->response->status(406);
            return;
        }
    }
    $id = $app->request->params('id');
    if ($id) {
        $category = \Api\Model\Category::find($id);
        if (!$category) {
            $app->response->status(404);
            return;
        }
        if ($category->user_id != $user->id) {
            $app->response->status(401);
        }
        $category->import($data);
    } else {
        $category          = new \Api\Model\Category($data);
        $category->user_id = $user->id;
    }
    $category->save();
});

$app->get('/category/delete', function () {
    global $app;
    if (!($user = checkUser())) {
        return;
    }
    $id = $app->request->params('id');
    if (empty($id)) {
        $app->response->status(406);
        return;
    }
    /** @var \Api\Model\Category $category */
    $category = \Api\Model\Category::find($id);
    if ($category) {
        if ($category->user_id == $user->id) {
            $agendas = $category->agendas;
            if (!is_array($agendas)) {
                $agendas = array($agendas);
            }
            foreach ($agendas as $agenda) {
                $agenda->cate_id = null;
                $agenda->save();
            }
            $category->delete();
        } else {
            $app->response->status(401);
        }
    } else {
        $app->response->status(404);
    }
});

$app->get('/category/list', function () {
    global $app;
    if (!($user = checkUser())) {
        return;
    }
    $data       = array();
    $categories = $user->categories;
    if (!is_array($categories)) {
        $categories = array($categories);
    }
    foreach ($categories as $category) {
        $data[] = $category->serialize();
    }
    $app->response()->body(json_encode(
        $data
    ));
});

$app->get('/todo/add', function () {
    global $app;
    if (!($user = checkUser())) {
        return;
    }
    $data                 = array();
    $data['todo_content'] = $app->request->params('content');
    foreach ($data as $key => $value) {
        if (empty($value)) {
            $app->response->status(406);
            return;
        }
    }
    $id = $app->request->params('id');
    if ($id) {
        $todo = \Api\Model\Todo::find($id);
        if (!$todo) {
            $app->response->status(404);
            return;
        }
        if ($todo->user_id != $user->id) {
            $app->response->status(401);
        }
        $todo->import($data);
    } else {
        $todo          = new \Api\Model\Todo($data);
        $todo->user_id = $user->id;
    }
    $todo->save();
});

$app->get('/todo/delete', function () {
    global $app;
    if (!($user = checkUser())) {
        return;
    }
    $id = $app->request->params('id');
    if (empty($id)) {
        $app->response->status(406);
        return;
    }
    /** @var \Api\Model\Todo $todo */
    $todo = \Api\Model\Todo::find($id);
    if ($todo) {
        if ($todo->user_id == $user->id) {
            $todo->delete();
        } else {
            $app->response->status(401);
        }
    } else {
        $app->response->status(404);
    }
});

$app->get('/todo/list', function () {
    global $app;
    if (!($user = checkUser())) {
        return;
    }
    $data  = array();
    $todos = $user->todos;
    if (!is_array($todos)) {
        $todos = array($todos);
    }
    foreach ($todos as $todo) {
        $data[] = $todo->serialize();
    }
    $app->response()->body(json_encode(
        $data
    ));
});

$app->get('/post/add', function () {
    global $app;
    if (!($user = checkUser())) {
        return;
    }
    $data                 = array();
    $data['post_content'] = $app->request->params('content');
    foreach ($data as $key => $value) {
        if (empty($value)) {
            $app->response->status(406);
            return;
        }
    }
    $id = $app->request->params('id');
    if ($id) {
        $post = \Api\Model\Post::find($id);
        if (!$post) {
            $app->response->status(404);
            return;
        }
        if ($post->user_id != $user->id) {
            $app->response->status(401);
        }
        $post->import($data);
    } else {
        $post          = new \Api\Model\Todo($data);
        $post->user_id = $user->id;
    }
    $post->save();
});

$app->get('/post/delete', function () {
    global $app;
    if (!($user = checkUser())) {
        return;
    }
    $id = $app->request->params('id');
    if (empty($id)) {
        $app->response->status(406);
        return;
    }
    /** @var \Api\Model\Post $post */
    $post = \Api\Model\Post::find($id);
    if ($post) {
        if ($post->user_id == $user->id) {
            $post->delete();
        } else {
            $app->response->status(401);
        }
    } else {
        $app->response->status(404);
    }
});

$app->get('/post/get/:year/:month/:day', function ($year, $month, $day) {
    global $app;
    if (!($user = checkUser())) {
        return;
    }
    $time = mktime(0, 0, 0, $month, $day, $year);
    if (empty($time)) {
        $app->response->status(406);
        return;
    }
    $date = date('Y-m-d', $time);
    $post = \Api\Model\Post::getByDate($date, $user->id);
    if (!$post) {
        $app->response->status(404);
        return;
    }

    $app->response()->body(json_encode(
        $post->serialize()
    ));
});

$app->get('/post/list', function () {
    global $app;
    if (!($user = checkUser())) {
        return;
    }
    $data  = array();
    $posts = $user->posts;
    if (!is_array($posts)) {
        $posts = array($posts);
    }

    foreach ($posts as $post) {
        $data[] = date('Y-m-d', strtotime($post->created_at));
    }

    $app->response()->body(json_encode(
        $data
    ));
});

/**
 * @return \Api\Model\User
 */
function checkUser()
{
    global $app;
    $user = \Session\Session::user();
    if (empty($user)) {
        $app->response()->status(401);
    }
    return $user;
}

$app->run();
