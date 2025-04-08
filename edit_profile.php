<?php
include_once("templates/header.php");
include_once("dao/UserDAO.php");

$userData = $userDao->verifyToken(true);

$fullName = $userData->name . " " . $userData->lastname;

if ($userData->image == "") {
    $userData->image = "user.png";
}

?>
<div id="main-container">
    <div id="profile-container">
        <form action="<?= $BASE_URL ?>/user_process.php" method="POST" enctype="multipart/form-data" class="form-profile">
            <input type="hidden" name="type" value="update">
            <h1 id="user-name"><?= $fullName ?></h1>
            <p>Altere seus dados no formulário abaixo:</p>
            <div id="profile-image-container" style="background-image: url('<?= $BASE_URL ?>/img/users/<?= $userData->image ?>')"></div>
            <div class="form-group">
                <span id="file-name"></span>
                <label for="image" class="file-upload">Alterar foto</label>
                <input type="file" id="image" name="image" hidden>
            </div>
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="name" id="name" name="name" placeholder="Digite seu nome" value="<?= $userData->name ?>">
            </div>
            <div class="form-group">
                <label for="lastname">Sobrenome:</label>
                <input type="lastname" id="lastname" name="lastname" placeholder="Digite seu sobrenome" value="<?= $userData->lastname ?>">
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" readonly class="disabled" value="<?= $userData->email ?>">
            </div>
            <div class="form-group">
                <label for="bio">Sobre você:</label>
                <textarea name="bio" id="bio" placeholder="Escreva uma breve descrição sobre você" rows="5"><?= $userData->bio ?></textarea>
            </div>
            <input type="submit" value="Alterar" class="edit-button">
        </form>
        <div id="vertical-separator"></div>
        <form action="<?= $BASE_URL ?>/user_process.php" method="POST" class="form-profile">
            <input type="hidden" name="type" value="change_password">
            <h1 id="change-password-title">Alterar a Senha</h1>
            <p>Altere e confirme sua senha abaixo:</p>
            <div class="form-group">
                <label for="password">Nova senha:</label>
                <input type="password" id="password" name="password" placeholder="Digite sua nova senha">
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmação de senha:</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirme sua nova senha">
            </div>
            <input type="submit" value="Alterar Senha" class="edit-button">
        </form>
    </div>
</div>
<?php
include_once("templates/footer.php");
?>