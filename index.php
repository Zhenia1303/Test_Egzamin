<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZGŁOSZNIA</title>
    <link rel="stylesheet" href="styl.css">
</head>

<body>
    <?php
    $server = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'zgloszenia';

    $connection = mysqli_connect($server, $user, $password, $database);

    if (!$connection) {
        echo 'error';
    }
    ?>
    <header>
        <h1>Zgłoszenia wydarzeń</h1>
    </header>
    <main>
        <section id="blok_lewy">
            <h2>Personel</h2>
            <form action="">
                <input type="radio" name="radio" id="policjant" value="policjant" checked>
                <label for="policjant">Policjant</label>
                <input type="radio" name="radio" id="ratownik" value="ratownik">
                <label for="ratownik">Ratownik</label>
                <button id="select">Pokaż</button>
            </form>
            <h1>Wybrano opcje:</h1>
            <div id="teble_center">
                <table>
                    <tr>
                        <th>id</th>
                        <th>Imie</th>
                        <th>Nazwisko</th>
                    </tr>
                    <?php
                    if (isset($_POST['Osoba'])){
                        $query = 'SELECT personel.id, personel.imie, personel.nazwisko FROM personel WHERE personel.status = "policjant"';
                        $result = mysqli_query($connection, $query);


                        for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                            $table = mysqli_fetch_row($result);

                            echo "<tr>";
                            echo "<th>$table[0]</th>";
                            echo "<th>$table[1]</th>";
                            echo "<th>$table[2]</th>";
                            echo "</tr>";
                        }
                    } else {
                        $query = 'SELECT personel.id, personel.imie, personel.nazwisko FROM personel WHERE personel.status = "ratownik"';
                        $result = mysqli_query($connection, $query);


                        for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                            $table = mysqli_fetch_row($result);

                            echo "<tr>";
                            echo "<th>$table[0]</th>";
                            echo "<th>$table[1]</th>";
                            echo "<th>$table[2]</th>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </table>
            </div>
        </section>
        <section id="blok_prawy">
            <h2>Nowe zgloszenie</h2>
            <ol>
                <?php
                $query = 'SELECT personel.id, personel.nazwisko FROM personel WHERE personel.id NOT IN (SELECT rejestr.id_personel FROM rejestr)';
                $result = mysqli_query($connection, $query);

                for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                    $list = mysqli_fetch_row($result);

                    echo "<ol>";
                    echo "<li>$list[0] $list[1]</li>";
                    echo "<li$list[0] $list[1]</li>";
                    echo "</ol>";
                }

                $query = mysqli_close($connection);
                ?>
            </ol>
            <form action="">
                <label for="inp">Wybierz id osoby:</label>
                <input type="number" id="inp">
                <button>Dodaj zgloszenie</button>
            </form>
        </section>
    </main>
    <footer>
        <p>Strone wykonal:0000000000000000</p>
    </footer>
</body>

</html>