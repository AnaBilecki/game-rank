<?php
include_once("templates/header.php");
?>
<div id="main-container">
    <div id="login-container">
        <h2>CRIAR CONTA</h2>
        <form action="<?= $BASE_URL ?>/register_process.php" method="POST" class="form-container">
            <div>
                <input type="hidden" name="type" value="register">
                <div class="form-group">
                    <label for="email">E-mail: *</label>
                    <input type="email" id="email" name="email" placeholder="Digite seu e-mail">
                </div>
                <div class="form-group">
                    <label for="name">Nome: *</label>
                    <input type="text" id="name" name="name" placeholder="Digite seu nome">
                </div>
                <div class="form-group">
                    <label for="lastname">Sobrenome: *</label>
                    <input type="text" id="lastname" name="lastname" placeholder="Digite seu sobrenome">
                </div>
                <div class="form-group">
                    <label for="email">Senha: *</label>
                    <input type="password" id="password" name="password" placeholder="Digite sua senha">
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirmação de senha: *</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirme sua senha">
                </div>
            </div>
            <div>
                <input type="submit" value="Registrar" class="login-button">
                <p class="form-info">Já tem uma conta? <a href="<?= $BASE_URL ?>/auth.php">Entre</a></p>
            </div>
        </form>
    </div>
</div>
<?php
include_once("templates/footer.php");
?>