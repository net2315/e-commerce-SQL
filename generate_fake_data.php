<?php
require 'vendor/autoload.php';
require 'config.php';

$faker = Faker\Factory::create('fr_FR');

// Génération de données pour la table 'product'
for ($i = 1; $i <= 10; $i++) {
    $stmt = $pdo->prepare("INSERT INTO product (nom, prix, description, avis, Quantité) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([
        $faker->word(),
        $faker->randomFloat(2, 10, 200),
        $faker->sentence(),
        $faker->sentence(),
        $faker->numberBetween(0, 100)
    ]);
}

// Génération de données pour la table 'user'
for ($i = 1; $i <= 10; $i++) {
    $stmt = $pdo->prepare("INSERT INTO user (nom, prenom, tel) VALUES (?, ?, ?)");
    $stmt->execute([
        $faker->lastName(),
        $faker->firstName(),
        $faker->randomNumber(8, true)
    ]);
}

// Génération de données pour la table 'adress'
for ($i = 1; $i <= 10; $i++) {
    $stmt = $pdo->prepare("INSERT INTO adress (id_user, rue, codepostal, ville, pays) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([
        $faker->numberBetween(1, 10), // ID utilisateur aléatoire
        $faker->streetAddress(),
        $faker->postcode(),
        $faker->city(),
        $faker->countryCode()
    ]);
}

// Génération de données pour la table 'cart'
for ($i = 1; $i <= 10; $i++) {
    $stmt = $pdo->prepare("INSERT INTO cart (id_user, id_product, nb_product, prix) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $faker->numberBetween(1, 10), // ID utilisateur existant
        $faker->numberBetween(1, 10), // ID produit existant
        $faker->numberBetween(1, 5),
        $faker->randomFloat(2, 5, 500)
    ]);
}

// Génération de données pour la table 'command'
for ($i = 1; $i <= 10; $i++) {
    $stmt = $pdo->prepare("INSERT INTO command (id_user, id_product, id_adress, date_cmd) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $faker->numberBetween(1, 10),
        $faker->numberBetween(1, 10),
        $faker->numberBetween(1, 10),
        $faker->date()
    ]);
}

// Génération de données pour la table 'invoice'
for ($i = 1; $i <= 10; $i++) {
    $stmt = $pdo->prepare("INSERT INTO invoice (id_user, id_command) VALUES (?, ?)");
    $stmt->execute([
        $faker->numberBetween(1, 10),
        $faker->numberBetween(1, 10)
    ]);
}

echo "Données générées avec succès !";
