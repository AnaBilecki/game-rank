<?php
include_once("templates/header.php");
?>
<div id="main-container">
    <div id="login-container">
        <h2>LOGIN</h2>
        <form action="<?= $BASE_URL ?>/auth_process.php" method="POST" class="form-container">
            <div>
                <input type="hidden" name="type" value="login">
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" placeholder="Digite seu e-mail">
                </div>
                <div class="form-group">
                    <label for="email">Senha:</label>
                    <input type="password" id="password" name="password" placeholder="Digite sua senha">
                </div>
            </div>
            <div>
                <input type="submit" value="Entrar" class="login-button">
                <p class="form-info">Não tem uma conta? <a href="<?= $BASE_URL ?>/register.php">Cadastre-se</a></p>
            </div>
        </form>
    </div>
</div>
<?php
include_once("templates/footer.php");
?>