<?php
    include_once("helpers/url.php");
    include_once("utils/FunctionsLogin.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $username = $_POST["username"];
        $password = $_POST["password"];
    
        $Resposta = fazerChamadaApi($username, $password);
        
        if ($Resposta['status'] == 1) {
            session_start();
            $_SESSION['usuario'] = $Resposta['Usuario'];

            header("Location: TelaInicial.php");
            exit();
        } else {
            $mensagemErro = "Usuário inválido. Tente novamente.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="<?= $BASE_URL ?>/css/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Portal PCP</title>
</head>
<body>
    <div class="container">
        <div class="image"><img src="<?= $BASE_URL ?>/imagens/IconeMpl.jpg" alt=""></div>
        <div class="Login">
            <form method="POST" action="">
                <h3>Bem Vindo!</h3>
                <?php if (isset($mensagemErro)) : ?>
                <p style="color: red;"><?php echo $mensagemErro; ?></p>
            <?php endif; ?>
                <div class="Inputs">
                <i class="bi bi-person-fill"></i>
                <input type="text" id="InputLogin" name="username" placeholder="Usuário/Login" required>
                </div>
                <div class="Inputs">
                <i class="bi bi-key-fill"></i>
                <input type="password" id="InputPassword" name="password" placeholder="Senha" required>
                <i class="bi bi-eye-fill" id="openPassword"></i>
                <i class="bi bi-eye-slash-fill" id="closePassword"></i>
                </div>
                <div class="input-login">
                <input type="submit" value="Acessar" >
                </div>
            </form>
        </div>

    </div>
</body>

<script>
    const openPassword = document.getElementById('openPassword');
    const closePassword = document.getElementById('closePassword');
    const InputPassword = document.getElementById('InputPassword');


    openPassword.addEventListener('click', () => {
        openPassword.style.display = 'none';
        closePassword.style.display = 'block';
        InputPassword.type = "text";
    });

    closePassword.addEventListener('click', () => {
        openPassword.style.display = 'block';
        closePassword.style.display = 'none';
        InputPassword.type = "password";
    });


</script>
</html>