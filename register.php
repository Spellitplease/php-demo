

 
<?php
if(!empty($_POST)){

$errors = array();



if(empty($_POST['username']) || !preg_match('/^[a-z0-9_]+$/', $_POST['username'])){

    $errors['username'] = "Votre pseudo n'est pas valide (alphanumérique)";
}

debug($errors);


}
?>











<h1>S'inscrire</h1>

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