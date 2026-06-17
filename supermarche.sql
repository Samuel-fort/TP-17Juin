-- ============================================================
--  PROJET : Caisse Supermarche - CodeIgniter 4 + SQLite
--  ITUNIVERSITY - TD SI-IHM - PROMO 18 - Juin 2026
-- ============================================================

-- TABLE : utilisateur
CREATE TABLE IF NOT EXISTS utilisateur (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    nom        TEXT    NOT NULL,
    prenom     TEXT    NOT NULL,
    login      TEXT    NOT NULL UNIQUE,
    mot_passe  TEXT    NOT NULL,
    created_at TEXT    NOT NULL DEFAULT (datetime('now'))
);

-- TABLE : caisse
CREATE TABLE IF NOT EXISTS caisse (
    id        INTEGER PRIMARY KEY AUTOINCREMENT,
    numero    INTEGER NOT NULL UNIQUE,
    libelle   TEXT    NOT NULL,
    actif     INTEGER NOT NULL DEFAULT 1
);

-- TABLE : produit
CREATE TABLE IF NOT EXISTS produit (
    id          INTEGER PRIMARY KEY AUTOINCREMENT,
    designation TEXT    NOT NULL,
    prix        REAL    NOT NULL,
    quantite    INTEGER NOT NULL DEFAULT 0,
    code_barre  TEXT    UNIQUE,
    created_at  TEXT    NOT NULL DEFAULT (datetime('now'))
);

-- TABLE : achat (un achat = un client)
CREATE TABLE IF NOT EXISTS achat (
    id          INTEGER PRIMARY KEY AUTOINCREMENT,
    caisse_id   INTEGER NOT NULL REFERENCES caisse(id),
    date_achat  TEXT    NOT NULL DEFAULT (datetime('now')),
    statut      TEXT    NOT NULL DEFAULT 'en_cours'
);

-- TABLE : ligne_achat (detail des produits dans un achat)
CREATE TABLE IF NOT EXISTS ligne_achat (
    id            INTEGER PRIMARY KEY AUTOINCREMENT,
    achat_id      INTEGER NOT NULL REFERENCES achat(id),
    produit_id    INTEGER NOT NULL REFERENCES produit(id),
    quantite      INTEGER NOT NULL DEFAULT 1,
    prix_unitaire REAL    NOT NULL
);

-- DONNEES : 2 caisses
INSERT INTO caisse (numero, libelle) VALUES
    (1, 'Caisse 1 - Entree principale'),
    (2, 'Caisse 2 - Sortie rapide');

-- DONNEES : 5 produits
INSERT INTO produit (designation, prix, quantite, code_barre) VALUES
    ('Riz 1kg',           2500, 100, '6001001000001'),
    ('Huile vegetale 1L', 3800,  60, '6001001000002'),
    ('Sucre 1kg',         1800,  80, '6001001000003'),
    ('Savon de menage',    900,  50, '6001001000004'),
    ('Lait concentre',    1200,  40, '6001001000005');

-- DONNEES : 1 utilisateur (login: admin / mdp: admin123)
INSERT INTO utilisateur (nom, prenom, login, mot_passe) VALUES
    ('Admin', 'Super', 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');