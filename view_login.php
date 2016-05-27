<!doctype html>
<html>
    <head>
        <h1 align="center">Laomees Lagunovi Laoprogramm</h1>
        <div style="display: flex; justify-content: center;">
        <img src="lagunov.jpg" style="width:480px;height:360px;" align="middle">
        </div>
        <meta charset="utf8" />
        <title>Logi sisse</title>
    </head>
    <body background="papp.jpg">

        <?php
foreach (message_list() as $message):
?>
            <p style="border: 1px solid blue; background: #050505; text-align: center; color: white;">
                <?= $message; ?>
            </p>
        <?php
endforeach;
?>

        <h1>Logi sisse</h1>

        <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">

            <input type="hidden" name="action" value="login">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">

            <table>
                <tr>
                    <td><b>Kasutajanimi</b></td>
                    <td>
                        <input type="text" name="kasutajanimi" required>
                    </td>
                </tr>
                <tr>
                    <td><b>Parool</b></td>
                    <td>
                        <input type="password" name="parool" required>
                    </td>
                </tr>
            </table>

            <p>
                <button type="submit">Logi sisse</button><b> või </b><button><a href="<?= $_SERVER['PHP_SELF']; ?>?view=register">Registreeri konto</a></button>
            </p>

        </form>
    </body>
</html>
