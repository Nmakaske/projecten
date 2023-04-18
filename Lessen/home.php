<!DOCTYPE html>
<html>

<head>
    <title>tandartsmelding maken</title>
</head>

<body>

    <?php
    if (isset($_POST['submit'])) { // Check if form is submitted
        // Check if required fields are not empty
        if (!empty($_POST['voornaam']) && !empty($_POST['achternaam']) && !empty($_POST['datum']) && !empty($_POST['reden'])) {

            // Maak verbinding met de database
            $pdo = new PDO("mysql:host=localhost;dbname=ZUPERNIELZ", "root", "");

            // Zet foutmeldingen aan
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Bereid de SQL-query voor
            $stmt = $pdo->prepare("INSERT INTO tandarts (voornaam, achternaam, datum, reden) 
        VALUES (:voornaam, :achternaam, :datum, :reden)");

            // Voer de query uit met de gegevens uit het formulier
            $stmt->bindParam(':voornaam', $_POST['voornaam']);
            $stmt->bindParam(':achternaam', $_POST['achternaam']);
            $stmt->bindParam(':datum', $_POST['datum']);
            $stmt->execute();

            echo "Je tandartsmelding is opgeslagen in de database!";
        } else {
            echo "Vul alle verplichte velden in de formulier!";
        }
    }
    ?>

    <h1>aanmelden voor een afspraak bij tandarts</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="voornaam">Voornaam:</label>
        <input type="text" id="voornaam" name="voornaam" required><br>

        <label for="achternaam">Achternaam:</label>
        <input type="text" id="achternaam" name="achternaam" required><br>

        <label for="datum">Datum:</label>
        <input type="date" id="datum" name="datum" required><br>

        <input type="submit" name="submit" value="Verzenden">
    </form>
</body>

</html>