<? require_once "../../connect_bd.php";
connectBd();

if (!$_GET['code']) {
	exit('error code');
}

include 'const.php';

$token = json_decode(file_get_contents('https://oauth.vk.com/access_token?client_id='.ID.'&redirect_uri='.URL.'&client_secret='.SECRET.'&code='.$_GET['code']), true);
//echo var_dump($token);

if (!$token) {
	exit('error token');
}

$data = json_decode(file_get_contents('https://api.vk.com/method/users.get?v=5.73&user_id='.$token['user_id'].'&access_token='.$token['access_token'].'&fields=uid,first_name,photo'), true);
//echo var_dump($data);

if (!$data) {//данные о пользователе
	exit('error data');
}

$data = $data['response'][0];
//echo var_dump($data);

if(!(R::count('users', "vk_id = ?", array($data['id']))>0))//если пользвателя ещё нет в бд
{
    $usersTable = R::dispense('users');
    $usersTable->vk_id = $data['id'];
    $usersTable->login = $data['first_name'];
    $usersTable->avatar_img = $data['photo'];
    R::store($usersTable);//сохраняем таблицу в бд
}

$_SESSION['user_login'] = ''.$data['first_name'].' '.$data['last_name'].' (vk user '.$data['uid'].')';
$_SESSION['user_login'] = substr($_SESSION['user_login'],0, strpos(trim($_SESSION['user_login']),' '));
$_SESSION['user_img'] = $data['photo'];
$_SESSION['id_user'] = R::getAll('SELECT id FROM users WHERE vk_id = ? LIMIT 1', array($data['id']))[0]['id'];

header("Location: ../../index.php");

?>