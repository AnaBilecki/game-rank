<?php
include_once("templates/header.php");
include_once("dao/UserDAO.php");

$userData = $userDao->verifyToken(true);

?>
<div id="main-container">
    <h1>Edição de Perfil</h1>
</div>
<?php
include_once("templates/footer.php");
?>