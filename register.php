

 
<?php
/*est ce que des données ont bine été postées*/
if(!empty($_POST)){
/*si il y'a des erruers je les affiche*/
$errors = array();
require_once 'includers/db.php';


/* il ne faut pas que le pseudo ne soit pas vide*/
if(empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])){
/* si le pseudo ne correspond pas aux règles alors j'affiche*/
    $errors['username'] = "Votre pseudo n'est pas valide (alphanumérique)";
} else {
$req =$pdo->prepare('SELECT id FROM users WHERE username= ?');
$req->execute([$_POST['username']]);
$user = $req->fetch();
if($user){
    $errors['username'] = 'Ce pseudo est déjà utilisé';

    }


}
/*validation de l'email*/

if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    $errors['email'] = "Votre email n'est pas valide";
} else {
    $req =$pdo->prepare('SELECT id FROM users WHERE email= ?');
    $req->execute([$_POST['email']]);
    $user = $req->fetch();
    if($user){
        $errors['email'] = 'Cet email  est déjà utilisé pour un autre compte';
    
    }
    
}

/*validation du mot de passe*/
if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){
    $errors['password'] = "Vous devez rentrer un mot de passe valide";
}

if (empty($errors)){


/*inscrire l'utilisateur*/

$req = $pdo->prepare("INSERT INTO users SET username = ?, password = ?, email = ?");
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$req->execute([$_POST['username'], $password, $_POST['email']]);
die("Votre compte a bien été crée");

debug($errors);/* lié au fichier function php*/

}
}
?>











<h1>S'inscrire</h1>
<?php if(!empty($errors)):?>
<div class="alert alert-danger">
<p>Vous n'avez pas rempli le formulaire correctement</p>

<?php foreach($errors as $error): ?>
    <ul>
        <li><?= $error; ?></li>

        <?php endforeach; ?>
    </ul>
</div>
<?php


<form action="" method="POST">
<div class="form-group">
    <label for="">Pseudo</label>
    <input id="username" type="text" name="username" class="form-control" >
</div>

<div class="form-group">
    <label for="">Email</label>
    <input type="email" name="email" class="form-control">
</div>

<div class="form-group">
    <label for="">Mot de passe</label>
    <input type="password" name="password" class="form-control" >
</div>

<div class="form-group">
    <label for="">Confirmez votre mot de passe</label>
    <input type="password" name="password_confirm" class="form-control" >
</div>
<button type="submit" class="btn btn-primary">M'inscrire</button>
</form>



<?php require "includers/footer.php" ;?>