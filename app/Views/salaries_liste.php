<?= $this->extend('_layout') ?>
<?= $this->section('contenu') ?>

<div>
    <h1>Liste des Salariés</h1>
</div>
</header>

<div>
    <section>
        <div class="table-container">
            <form method=get action=<?= url_to('salarie_ajout') ?>><button>Ajouter un Salariés</button></form><br>
            <!-- Formulaire de filtre -->
            <form method="get" action="<?= url_to('salarie_liste') ?>"> <!-- Soumet au même contrôleur -->
                <label for="profil">Filtrer par profil :</label>
                <button type="submit">Filtrer</button>
                <select name="profil" id="profil">
                    <option value="">Tous</option>
                    <?php foreach ($listeProfils as $profil): ?>
                        <option value="<?= esc($profil['ID_PROFIL']) ?>" <?= ($profil['ID_PROFIL'] == $profilSelectionne) ? 'selected' : '' ?>>
                            <?= esc($profil['LIBELLE']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>

            <!-- Formulaire de filtre accreditation-->
            <form method="get" action="<?= url_to('salarie_liste') ?>"> <!-- Soumet au même contrôleur -->
                <label for="accreditation">Filtrer par accreditation :</label>
                <button type="submit">Filtrer</button>
                <select name="accreditation" id="accreditation">
                    <option value="">-- Tous --</option>
                    <option value="">secret defence</option>

                </select>
            </form>

        </div>
        <!-- Affichage des salariés -->
        <div class="table-container">
            <?php

            use \CodeIgniter\View\Table;

            $table = new \CodeIgniter\View\Table();
            $table->setHeading('Prenom', 'Nom', 'Civilité', 'Email', 'Téléphone', 'Adresse', 'Code-Postal', 'Ville', 'Profils', 'Modifier', 'Supprimer');

            foreach ($listeSalaries as $salarie) {
                $table->addRow(
                    esc($salarie['PRENOM_SALARIE']),
                    esc($salarie['NOM_SALARIE']),
                    esc($salarie['CIVILITE']),
                    esc($salarie['EMAIL_SALARIE']),
                    esc($salarie['TELEPHONE_SALARIE']),
                    esc($salarie['ADRESSE_SALARIE']),
                    esc($salarie['CODE_POSTAL_SALARIE']),
                    esc($salarie['VILLE_SALARIE']),
                    esc($salarie['profil']), // Profils concaténés
                    esc($salarie['ACCREDITATION']),
                    '<a href="' . url_to('salarie_modif', $salarie['ID_SALARIE']) . '"><button>Modifier</button></a>',

                    '<form method="post" action="' . url_to('salarie_delete', $salarie['ID_SALARIE']) . '">
                            <input type="hidden" name="ID_SALARIE" value="' . $salarie['ID_SALARIE'] . '">
                            <input type="submit" class="bouton"  value="Supprimer" onclick="return confirm(\'Si vous supprimez ce salarié, cela supprimera toutes les affectations auxquelles il est associé. Confirmez-vous ?\')">
                         </form>'

                );
            }
            echo $table->generate();
            ?>
        </div>
    </section>
</div>
<?= $this->endSection() ?>