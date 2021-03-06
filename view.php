<!doctype HTML>
<html>

<head>
    <title align="center">Laomees Lagunovi Laoprogramm</title>
    <div style="display: flex; justify-content: center;">
    <img src="lagunov.jpg" style="width:480px; height:360px;" align="middle">
    </div>
    <meta charset="utf-8">

    <style>
        #lisa-vorm {
            display: none;
        }
    </style>

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

    <div style="float: right;">
        <form method="post"  action="<?= $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="action" value="logout">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
            <button type="submit">Logi välja</button>
        </form>
    </div>

    <h1 align="center">Laomees Lagunovi Laoprogramm</h1>

    <p id="kuva-nupp">
        <button type="button">Kuva lisamise vorm</button>
    </p>

    <form id="lisa-vorm" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">

        <input type="hidden" name="action" value="add">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">

        <p id="peida-nupp">
            <button type="button">Peida lisamise vorm</button>
        </p>

        <table>
            <tr>
                <td><b>Nimetus</b></td>
                <td>
                    <input type="text" id="nimetus" name="nimetus">
                </td>
            </tr>
            <tr>
                <td><b>Kogus</b></td>
                <td>
                    <input type="number" id="kogus" name="kogus">
                </td>
            </tr>
        </table>

        <p>
            <button type="submit">Lisa kirje</button>
        </p>

    </form>

    <table id="ladu" border="1" style="background: #050505; color: white;">
        <thead>
            <tr>
                <th>Nimetus</th>
                <th>Kogus</th>
                <th>Tegevused</th>
            </tr>
        </thead>

        <tbody>

        <?php
// koolon tsükli lõpus tähendab, et tsükkel koosneb HTML osast
foreach (model_load($page) as $rida):
?>

            <tr>
                <td>
                    <?=
    // vältimaks pahatahtlikku XSS sisu, kus kasutaja sisestab õige

    // info asemel <script> tag'i, peame tekstiväljundis asendama kõik HTML erisümbolid
        htmlspecialchars($rida['nimetus']); ?>
                </td>
                <td>
                    <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                        <input type="hidden" name="id" value="<?= $rida['id']; ?>">

                        <input type="number" style="width: 5em; text-align: right;" name="kogus" value="<?= $rida['kogus']; ?>">
                        <button type="submit">Uuenda</button>
                    </form>
                </td>
                <td>

                    <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                        <input type="hidden" name="id" value="<?= $rida['id']; ?>">
                        <button type="submit">Kustuta rida</button>
                    </form>

                </td>
            </tr>

        <?php
endforeach;
?>

        </tbody>
    </table>

    <p>
        <a href="<?= $_SERVER['PHP_SELF']; ?>?page=<?= $page - 1; ?>" style="color: black;">
            <b>
            Eelmine lehekülg
            </b>
        </a style="color: black;">
        <b>
        |
        </b>
        <a href="<?= $_SERVER['PHP_SELF']; ?>?page=<?= $page + 1; ?>" style="color: black;">
            <b>
            Järgmine lehekülg
          </b>
        </a>
    </p>

    <script src="ladu.js"></script>
</body>

</html>
