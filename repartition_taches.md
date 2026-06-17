# 🛒 Répartition des tâches – Caisse Supermarché CI4
## ITUNIVERSITY – Promo 18 – Juin 2026

---

## 📦 Étape 0 — À faire ENSEMBLE (avant de se séparer) ~30 min

| # | Tâche | Détail |
|---|-------|--------|
| 0.1 | Créer la base SQLite | Utiliser le fichier `supermarche.sql` fourni |
| 0.2 | Initialiser CodeIgniter 4 | Copier le framework, configurer `.env` (base path, SQLite) |
| 0.3 | Configurer la DB dans CI4 | `app/Config/Database.php` → driver `SQLite3`, chemin vers le fichier `.db` |
| 0.4 | Créer le layout/template de base | Fichier `app/Views/layouts/main.php` (navbar, header avec nom caisse, footer) |

---

## 👤 BINÔME 1 — Authentification & Choix de Caisse

### Travaux 4-A : Écran de Login
- **Fichiers à créer :**
  - `app/Controllers/AuthController.php`
  - `app/Models/UtilisateurModel.php`
  - `app/Views/auth/login.php`
- **Ce qu'il faut faire :**
  - Formulaire login/mot de passe
  - Vérification avec `password_verify()` en PHP
  - Stocker l'utilisateur en **session** (`session()->set('user', ...)`)
  - Redirection vers choix de caisse si OK, message d'erreur sinon
  - Créer un filtre `app/Filters/AuthFilter.php` pour protéger les pages

### Travaux 2 : Écran de choix de Caisse
- **Fichiers à créer :**
  - `app/Controllers/CaisseController.php`
  - `app/Models/CaisseModel.php`
  - `app/Views/caisse/choix.php`
- **Ce qu'il faut faire :**
  - Afficher la liste des caisses (dropdown ou boutons radio)
  - Après validation → stocker le `caisse_id` en **session**
  - Rediriger vers la page de saisie des achats
  - Afficher le numéro de caisse choisi dans le header (via session)

---

## 👤 BINÔME 2 — Gestion des Achats (page principale)

### Travaux 3 : Page de saisie des achats
- **Fichiers à créer :**
  - `app/Controllers/AchatController.php`
  - `app/Models/AchatModel.php`
  - `app/Models/LigneAchatModel.php`
  - `app/Models/ProduitModel.php`
  - `app/Views/achat/saisie.php`

- **Étape 1 – Partie HAUTE (formulaire d'ajout) :**
  - Dropdown pour choisir un produit (chargé depuis la table `produit`)
  - Champ quantité
  - Bouton « Ajouter »
  - À la soumission :
    - Créer un `achat` en cours si aucun n'existe en session
    - Insérer une `ligne_achat` avec `prix_unitaire` snapshot
    - Décrémenter le stock dans `produit`

- **Étape 2 – Partie BASSE (liste des achats) :**
  - Tableau listant les lignes de l'achat en cours (produit, qté, prix unitaire, sous-total)
  - Afficher le **TOTAL** général en bas

### Travaux 4-B : Bouton « Clôturer l'achat »
- **Dans `AchatController.php` :**
  - Méthode `cloturer()` : passer le statut de l'achat à `'cloture'`
  - Effacer l'`achat_id` de la session (pour repartir sur un achat vide)
  - Afficher un message de confirmation ou rediriger

---

## 🗺️ Routes à définir dans `app/Config/Routes.php`

```php
// Auth
$routes->get('/',                'AuthController::login');
$routes->post('login',           'AuthController::doLogin');
$routes->get('logout',           'AuthController::logout');

// Caisse
$routes->get('caisse/choix',     'CaisseController::index');
$routes->post('caisse/valider',  'CaisseController::valider');

// Achats
$routes->get('achat',            'AchatController::index');
$routes->post('achat/ajouter',   'AchatController::ajouter');
$routes->post('achat/cloturer',  'AchatController::cloturer');
```

---

## ✅ Checklist de rendu final

- [ ] Base SQLite créée avec données de test
- [ ] Login fonctionne (admin / admin123)
- [ ] Choix de caisse → caisse affichée dans le header
- [ ] Ajout de produit dans l'achat (stock mis à jour)
- [ ] Liste des lignes affichée avec total
- [ ] Bouton clôturer remet l'achat à zéro
- [ ] Sessions bien utilisées partout
- [ ] Pas d'accès aux pages sans login (filtre)
