<?php
$prenom = '';
$nom = '';
$email = '';
$age = '';
$filiere = '';
$motivation = '';
$erreurs = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prenom     = $_POST['prenom']     ?? '';
    $nom        = $_POST['nom']        ?? '';
    $email      = $_POST['email']      ?? '';
    $age        = $_POST['age']        ?? '';
    $filiere    = $_POST['filiere']    ?? '';
    $motivation = $_POST['motivation'] ?? '';

    $reglement = isset($_POST['reglement']); // true si cochée, false sinon

    // Validation du prénom
    if (empty($prenom)) {
        $erreurs[] = "Le prénom est obligatoire.";
    }

    // Validation du nom
    if (empty($nom)) {
        $erreurs[] = "Le nom est obligatoire.";
    }

    // Validation de l'email
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = "L'adresse email est invalide.";
    }

    // Validation de l'âge
    if (!is_numeric($age) || $age < 16 || $age > 30) {
        $erreurs[] = "L'âge doit être un nombre entre 16 et 30.";
    }

    // Validation de la filière
    if (empty($filiere)) {
        $erreurs[] = "Veuillez choisir une filière.";
    }

    // Validation de la motivation
    if (strlen($motivation) < 30) {
        $erreurs[] = "La motivation doit contenir au moins 30 caractères.";
    }

    // Validation du règlement
    if (!$reglement) {
        $erreurs[] = "Vous devez accepter le règlement.";
    }


}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>formulaire</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php if (!empty($erreurs)): ?>
        <ul class="erreurs">
            <?php foreach ($erreurs as $e): ?>
                <li><?php echo $e; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="candidature.php" method="POST">
        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom">

        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom">

        <label for="email">Adresse email :</label>
        <input type="email" name="email" id="email">

        <label for="age">Âge :</label>
        <input type="number" name="age" id="age">

        <label for="filiere">Filière souhaitée :</label>
        <select name="filiere" id="filiere">
            <option value="">-- Choisir --</option>
            <option value="Informatique">Informatique</option>
            <option value="Électronique">Électronique</option>
            <option value="Mécanique">Mécanique</option>
            <option value="Autre">Autre</option>
        </select>

        <label for="motivation">Lettre de motivation :</label>
        <textarea name="motivation" id="motivation" rows="6"></textarea>

        <input type="checkbox" name="reglement" id="reglement" value="1">
        <label for="reglement">J'ai lu et j'accepte le règlement du club.</label>

        <button type="submit">Envoyer ma candidature</button>
    </form>
</body>

</html>