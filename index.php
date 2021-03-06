<?php

/* require './controller/frontend/frontend.php'; */
require './lib/autoload.php';
require './controller/PostController.php';
require './controller/CommentController.php';
require './controller/UserController.php';
$UserController = new UserController;
$PostController = new PostController;
$CommentController = new CommentController;

session_start();
if (!empty($_GET['action'])) {
    switch ($_GET['action']) {

        case "listPosts":

            $PostController->listPosts();
            break;

        case "post":
            if (!empty($_GET['id']) && $_GET['id'] > 0) {
                $PostController->listPost();
            } else {
                $_SESSION['flash']['danger'] = "Identifiant de billet invalide";
            }
            break;

        case "addComment":
            if (!empty($_GET['id']) && $_GET['id'] > 0) {
                $CommentController->addComment();
            } else {
                $_SESSION['flash']['danger'] = "Identifiant de billet invalide";
            }
            break;

        case "delete":
            if (!empty($_GET['id']) && $_GET['id'] > 0) {
                if ($_GET['category'] === 'news') {
                    $PostController->deletePost();
                } else {
                    $CommentController->deleteComment();
                }
            } else {
                $_SESSION['flash']['danger'] = "Identifiant de billet invalide";
            }
            break;

        case "admin":
            $PostController->admin();
            break;

        case "editPost":
            $PostController->editPost(true);
            break;

        case "addPost":
            $PostController->addPost();
            break;

        case "rateComment":
            $CommentController->rateComment();
            break;

        case "logout":
            $UserController->logout();
            break;

        case "account":
            $UserController->account();
            break;

        case "login":
            $UserController->login();
            break;

        case "forget":
            $UserController->forget();
            break;

        case "reset":
            $UserController->reset();
            break;

        case "resetPassword":
            if (!empty($_GET['id']) && !empty($_GET['token'])) {
                $UserController->resetPassword();
            } else {
                $_SESSION['flash']['danger'] = "Token ou identifiant invalide";
            }
            break;

        case "register":
            $UserController->register();
            break;

        case "confirm":
            if (!empty($_GET['id']) && !empty($_GET['token'])) {
                $UserController->confirmUser();
            } else {
                $_SESSION['flash']['danger'] = "Token ou identifiant invalide";
            }
            break;

        case "error":
            error();
            break;

        default:
            $PostController->listPosts();
            break;
    }
} else {
    $PostController->listPosts();
}

/* if (!empty($_GET['action'])) {
if ($_GET['action'] == 'listPosts') {
_listPosts();
} elseif ($_GET['action'] == 'post') {
if (!empty($_GET['id']) && $_GET['id'] > 0) {
_listPost();
} else {
$_SESSION['flash']['danger'] = "Identifiant de billet invalide";
}
} elseif ($_GET['action'] == 'addComment') {
if (!empty($_GET['id']) && $_GET['id'] > 0) {
_addComment();
} else {
$_SESSION['flash']['danger'] = "Identifiant de billet invalide";
}
} elseif ($_GET['action'] == 'delete') {
if (!empty($_GET['id']) && $_GET['id'] > 0) {
if ($_GET['category'] === 'news') {
_deletePost();
} else {
_deleteComment();
}
} else {
$_SESSION['flash']['danger'] = "Identifiant de billet invalide";
}
} elseif ($_GET['action'] == 'admin') {
_admin();
} elseif ($_GET['action'] == 'editPost') {
_editPost();
} elseif ($_GET['action'] == 'addPost') {
_addPost();
} elseif ($_GET['action'] == 'rateComment') {
_rateComment();
} elseif ($_GET['action'] == 'logout') {
_logout();
} elseif ($_GET['action'] == 'account') {
_account();
} elseif ($_GET['action'] == 'login') {
_login();
} elseif ($_GET['action'] == 'forget' || $_GET['action'] == 'mail') {
_forget();
} elseif ($_GET['action'] == 'reset') {
_reset();
} elseif ($_GET['action'] == 'resetPassword') {
if (!empty($_GET['id']) && !empty($_GET['token'])) {
_resetPassword();
} else {
$_SESSION['flash']['danger'] = "Token ou identifiant invalide";
}
} elseif ($_GET['action'] == 'loggin') {
_login();
} elseif ($_GET['action'] == 'register' || $_GET['action'] == 'newUser') {
_register();
} elseif ($_GET['action'] == 'confirm') {
if (!empty($_GET['id']) && !empty($_GET['token'])) {
_confirmUser();
} else {
$_SESSION['flash']['danger'] = "Token ou identifiant invalide";
}
} elseif ($_GET['action'] == 'error') {
_error();
}
} else {
_listPosts();
} */
