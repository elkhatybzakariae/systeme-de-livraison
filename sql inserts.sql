INSERT INTO zones (id_Z, zonename) VALUES
('1', 'Tanger-Tétouan-Al Hoceïma'),
('2', 'Oriental'),
('3', 'Fès-Meknès'),
('4', 'Rabat-Salé-Kénitra'),
('5', 'Béni Mellal-Khénifra'),
('6', 'Casablanca-Settat'),
('7', 'Marrakech-Safi'),
('8', 'Drâa-Tafilalet'),
('9', 'Souss-Massa'),
('10', 'Guelmim-Oued Noun'),
('11', 'Laâyoune-Sakia El Hamra'),
('12', 'Dakhla-Oued Ed-Dahab');

INSERT INTO villes (id_V, ref, villename, id_Z) VALUES
('101', 'REF101', 'Tangier', '1'),
('102', 'REF102', 'Tétouan', '1'),
('103', 'REF103', 'Al Hoceima', '1'),
('104', 'REF104', 'Chefchaouen', '1'),
('105', 'REF105', 'Fnideq', '1'),
('106', 'REF106', 'M diq', '1'),
('107', 'REF107', 'Oued Laou', '1'),
('108', 'REF108', 'Martil', '1');

-- Zone 2: Oriental
INSERT INTO villes (id_V, ref, villename, id_Z) VALUES
('201', 'REF201', 'Oujda', '2'),
('202', 'REF202', 'Nador', '2'),
('203', 'REF203', 'Berkane', '2'),
('204', 'REF204', 'Figuig', '2'),
('205', 'REF205', 'Taourirt', '2'),
('206', 'REF206', 'Jebel Bouhachem', '2'),
('207', 'REF207', 'Jerada', '2'),
('208', 'REF208', 'Bouarfa', '2');

-- Zone 3: Fès-Meknès
INSERT INTO villes (id_V, ref, villename, id_Z) VALUES
('301', 'REF301', 'Fes', '3'),
('302', 'REF302', 'Meknes', '3'),
('303', 'REF303', 'Taza', '3'),
('304', 'REF304', 'Sefrou', '3'),
('305', 'REF305', 'Ifrane', '3'),
('306', 'REF306', 'El Hajeb', '3'),
('307', 'REF307', 'Moulay Yacoub', '3'),
('308', 'REF308', 'Boulemane', '3');

-- Zone 4: Rabat-Salé-Kénitra
INSERT INTO villes (id_V, ref, villename, id_Z) VALUES
('401', 'REF401', 'Rabat', '4'),
('402', 'REF402', 'Salé', '4'),
('403', 'REF403', 'Kenitra', '4'),
('404', 'REF404', 'Skhirat', '4'),
('405', 'REF405', 'Témara', '4'),
('406', 'REF406', 'Sidi Slimane', '4'),
('407', 'REF407', 'Sidi Kacem', '4'),
('408', 'REF408', 'Khémisset', '4');

-- Zone 5: Béni Mellal-Khénifra
INSERT INTO villes (id_V, ref, villename, id_Z) VALUES
('501', 'REF501', 'Béni Mellal', '5'),
('502', 'REF502', 'Khénifra', '5'),
('503', 'REF503', 'Khouribga', '5'),
('504', 'REF504', 'Azilal', '5'),
('505', 'REF505', 'Fquih Ben Salah', '5'),
('506', 'REF506', 'Kalaat M Gouna', '5'),
('507', 'REF507', 'Ksar El Kebir', '5'),
('508', 'REF508', 'Souk Sebt Oulad Nemma', '5');

-- Zone 6: Casablanca-Settat
INSERT INTO villes (id_V, ref, villename, id_Z) VALUES
('601', 'REF601', 'Casablanca', '6'),
('602', 'REF602', 'Settat', '6'),
('603', 'REF603', 'Mohammedia', '6'),
('604', 'REF604', 'El Jadida', '6'),
('605', 'REF605', 'Sidi Bennour', '6'),
('606', 'REF606', 'Berrechid', '6'),
('607', 'REF607', 'Benslimane', '6'),
('608', 'REF608', 'Nouaceur', '6');

-- Zone 7: Marrakech-Safi
INSERT INTO villes (id_V, ref, villename, id_Z) VALUES
('701', 'REF701', 'Marrakech', '7'),
('702', 'REF702', 'Essaouira', '7'),
('703', 'REF703', 'Agadir', '7'),
('704', 'REF704', 'Safi', '7'),
('705', 'REF705', 'Ouarzazate', '7'),
('706', 'REF706', 'Ben Guerir', '7'),
('707', 'REF707', 'Chichaoua', '7');

-- Zone 8: Drâa-Tafilalet
INSERT INTO villes (id_V, ref, villename, id_Z) VALUES
('801', 'REF801', 'Errachidia', '8'),
('802', 'REF802', 'Ouarzazate', '8'),
('803', 'REF803', 'Zagora', '8'),
('804', 'REF804', 'Tinghir', '8'),
('805', 'REF805', 'Midelt', '8'),
('806', 'REF806', 'Tinghir', '8'),
('807', 'REF807', 'Goulmima', '8'),
('808', 'REF808', 'Alnif', '8');
INSERT INTO villes (id_V, ref, villename, id_Z) VALUES
('901', 'REF901', 'Agadir', '9'),
('902', 'REF902', 'Inezgane', '9'),
('903', 'REF903', 'Tiznit', '9'),
('904', 'REF904', 'Taroudant', '9'),
('905', 'REF905', 'Biougra', '9'),
('906', 'REF906', 'Ait Melloul', '9'),
('907', 'REF907', 'Tafraout', '9'),
('908', 'REF908', 'Mirleft', '9');

-- Zone 10: Guelmim-Oued Noun
INSERT INTO villes (id_V, ref, villename, id_Z) VALUES
('1001', 'REF1001', 'Guelmim', '10'),
('1002', 'REF1002', 'Tan-Tan', '10'),
('1003', 'REF1003', 'Sidi Ifni', '10'),
('1004', 'REF1004', 'Assa', '10'),
('1005', 'REF1005', 'Tata', '10'),
('1006', 'REF1006', 'Akka', '10'),
('1007', 'REF1007', 'Lakhssas', '10'),
('1008', 'REF1008', 'Bouizakarne', '10');

-- Zone 11: Laâyoune-Sakia El Hamra
INSERT INTO villes (id_V, ref, villename, id_Z) VALUES
('1101', 'REF1101', 'Laâyoune', '11'),
('1102', 'REF1102', 'Tarfaya', '11'),
('1103', 'REF1103', 'Boujdour', '11'),
('1104', 'REF1104', 'El Marsa', '11'),
('1105', 'REF1105', 'Foum El Oued', '11'),
('1106', 'REF1106', 'La Güera', '11'),
('1107', 'REF1107', 'Bir Gandouz', '11'),
('1108', 'REF1108', 'Aousserd', '11');

-- Zone 12: Dakhla-Oued Ed-Dahab
INSERT INTO villes (id_V, ref, villename, id_Z) VALUES
('1201', 'REF1201', 'Dakhla', '12'),
('1202', 'REF1202', 'Oued Ed-Dahab', '12'),
('1203', 'REF1203', 'Aousserd', '12'),
('1204', 'REF1204', 'El Argoub', '12'),
('1205', 'REF1205', 'Puerto Rico', '12'),
('1206', 'REF1206', 'Marsa Al Burtughal', '12'),
('1207', 'REF1207', 'Bir Anzarane', '12'),
('1208', 'REF1208', 'Lassarga', '12');

-- Insert tariffs between all cities (villes) in Morocco
-- Zone 1: Tanger-Tétouan-Al Hoceïma
INSERT INTO tarifs (id_Tar, villeRamassage, ville, prixliv, prixret, prixref, delailiv)
SELECT
    CONCAT('1', LPAD(@rownum := @rownum + 1, 2, '0')) AS id_Tar,
    t1.id_V AS villeRamassage,
    t2.id_V AS ville,
    CASE WHEN t1.id_V = t2.id_V THEN 0 ELSE 35 END AS prixliv,
    10 AS prixret,
    10 AS prixref,
    CONCAT(t1.id_V, '-', t2.id_V) AS delailiv
FROM
    villes t1
JOIN
    villes t2 ON t1.id_V <> t2.id_V
JOIN
    (SELECT @rownum := 0) r
WHERE
    t1.id_Z = '1' AND t2.id_Z = '1';

-- Zone 2: Oriental
INSERT INTO tarifs (id_Tar, villeRamassage, ville, prixliv, prixret, prixref, delailiv)
SELECT
    CONCAT('2', LPAD(@rownum2 := @rownum2 + 1, 2, '0')) AS id_Tar,
    t1.id_V AS villeRamassage,
    t2.id_V AS ville,
    CASE WHEN t1.id_V = t2.id_V THEN 0 ELSE 35 END AS prixliv,
    10 AS prixret,
    10 AS prixref,
    CONCAT(t1.id_V, '-', t2.id_V) AS delailiv
FROM
    villes t1
JOIN
    villes t2 ON t1.id_V <> t2.id_V
JOIN
    (SELECT @rownum2 := 0) r
WHERE
    t1.id_Z = '2' AND t2.id_Z = '2';

-- Zone 3: Fès-Meknès
INSERT INTO tarifs (id_Tar, villeRamassage, ville, prixliv, prixret, prixref, delailiv)
SELECT
    CONCAT('3', LPAD(@rownum3 := @rownum3 + 1, 2, '0')) AS id_Tar,
    t1.id_V AS villeRamassage,
    t2.id_V AS ville,
    CASE WHEN t1.id_V = t2.id_V THEN 0 ELSE 35 END AS prixliv,
    10 AS prixret,
    10 AS prixref,
    CONCAT(t1.id_V, '-', t2.id_V) AS delailiv
FROM
    villes t1
JOIN
    villes t2 ON t1.id_V <> t2.id_V
JOIN
    (SELECT @rownum3 := 0) r
WHERE
    t1.id_Z = '3' AND t2.id_Z = '3';

-- Zone 4: Rabat-Salé-Kénitra
INSERT INTO tarifs (id_Tar, villeRamassage, ville, prixliv, prixret, prixref, delailiv)
SELECT
    CONCAT('4', LPAD(@rownum4 := @rownum4 + 1, 2, '0')) AS id_Tar,
    t1.id_V AS villeRamassage,
    t2.id_V AS ville,
    CASE WHEN t1.id_V = t2.id_V THEN 0 ELSE 35 END AS prixliv,
    10 AS prixret,
    10 AS prixref,
    CONCAT(t1.id_V, '-', t2.id_V) AS delailiv
FROM
    villes t1
JOIN
    villes t2 ON t1.id_V <> t2.id_V
JOIN
    (SELECT @rownum4 := 0) r
WHERE
    t1.id_Z = '4' AND t2.id_Z = '4';

-- Zone 5: Béni Mellal-Khénifra
INSERT INTO tarifs (id_Tar, villeRamassage, ville, prixliv, prixret, prixref, delailiv)
SELECT
    CONCAT('5', LPAD(@rownum5 := @rownum5 + 1, 2, '0')) AS id_Tar,
    t1.id_V AS villeRamassage,
    t2.id_V AS ville,
    CASE WHEN t1.id_V = t2.id_V THEN 0 ELSE 35 END AS prixliv,
    10 AS prixret,
    10 AS prixref,
    CONCAT(t1.id_V, '-', t2.id_V) AS delailiv
FROM
    villes t1
JOIN
    villes t2 ON t1.id_V <> t2.id_V
JOIN
    (SELECT @rownum5 := 0) r
WHERE
    t1.id_Z = '5' AND t2.id_Z = '5';

-- Zone 6: Casablanca-Settat
INSERT INTO tarifs (id_Tar, villeRamassage, ville, prixliv, prixret, prixref, delailiv)
SELECT
    CONCAT('6', LPAD(@rownum6 := @rownum6 + 1, 2, '0')) AS id_Tar,
    t1.id_V AS villeRamassage,
    t2.id_V AS ville,
    CASE WHEN t1.id_V = t2.id_V THEN 0 ELSE 35 END AS prixliv,
    10 AS prixret,
    10 AS prixref,
    CONCAT(t1.id_V, '-', t2.id_V) AS delailiv
FROM
    villes t1
JOIN
    villes t2 ON t1.id_V <> t2.id_V
JOIN
    (SELECT @rownum6 := 0) r
WHERE
    t1.id_Z = '6' AND t2.id_Z = '6';

-- Zone 7: Marrakech-Safi
INSERT INTO tarifs (id_Tar, villeRamassage, ville, prixliv, prixret, prixref, delailiv)
SELECT
    CONCAT('7', LPAD(@rownum7 := @rownum7 + 1, 2, '0')) AS id_Tar,
    t1.id_V AS villeRamassage,
    t2.id_V AS ville,
    CASE WHEN t1.id_V = t2.id_V THEN 0 ELSE 35 END AS prixliv,
    10 AS prixret,
    10 AS prixref,
    CONCAT(t1.id_V, '-', t2.id_V) AS delailiv
FROM
    villes t1
JOIN
    villes t2 ON t1.id_V <> t2.id_V
JOIN
    (SELECT @rownum7 := 0) r
WHERE
    t1.id_Z = '7' AND t2.id_Z = '7';

-- Zone 8: Drâa-Tafilalet
INSERT INTO tarifs (id_Tar, villeRamassage, ville, prixliv, prixret, prixref, delailiv)
SELECT
    CONCAT('8', LPAD(@rownum8 := @rownum8 + 1, 2, '0')) AS id_Tar,
    t1.id_V AS villeRamassage,
    t2.id_V AS ville,
    CASE WHEN t1.id_V = t2.id_V THEN 0 ELSE 35 END AS prixliv,
    10 AS prixret,
    10 AS prixref,
    CONCAT(t1.id_V, '-', t2.id_V) AS delailiv
FROM
    villes t1
JOIN
    villes t2 ON t1.id_V <> t2.id_V
JOIN
    (SELECT @rownum8 := 0) r
WHERE
    t1.id_Z = '8' AND t2.id_Z = '8';

-- Zone 9: Souss-Massa
INSERT INTO tarifs (id_Tar, villeRamassage, ville, prixliv, prixret, prixref, delailiv)
SELECT
    CONCAT('9', LPAD(@rownum9 := @rownum9 + 1, 2, '0')) AS id_Tar,
    t1.id_V AS villeRamassage,
    t2.id_V AS ville,
    CASE WHEN t1.id_V = t2.id_V THEN 0 ELSE 35 END AS prixliv,
    10 AS prixret,
    10 AS prixref,
    CONCAT(t1.id_V, '-', t2.id_V) AS delailiv
FROM
    villes t1
JOIN
    villes t2 ON t1.id_V <> t2.id_V
JOIN
    (SELECT @rownum9 := 0) r
WHERE
    t1.id_Z = '9' AND t2.id_Z = '9';

-- Zone 10: Guelmim-Oued Noun
INSERT INTO tarifs (id_Tar, villeRamassage, ville, prixliv, prixret, prixref, delailiv)
SELECT
    CONCAT('10', LPAD(@rownum10 := @rownum10 + 1, 2, '0')) AS id_Tar,
    t1.id_V AS villeRamassage,
    t2.id_V AS ville,
    CASE WHEN t1.id_V = t2.id_V THEN 0 ELSE 35 END AS prixliv,
     10 AS prixret,
    10 AS prixref,
    CONCAT(t1.id_V, '-', t2.id_V) AS delailiv
FROM
    villes t1
JOIN
    villes t2 ON t1.id_V <> t2.id_V
JOIN
    (SELECT @rownum10 := 0) r
WHERE
    t1.id_Z = '10' AND t2.id_Z = '10';

-- Zone 11: Laâyoune-Sakia El Hamra
INSERT INTO tarifs (id_Tar, villeRamassage, ville, prixliv, prixret, prixref, delailiv)
SELECT
    CONCAT('11', LPAD(@rownum11 := @rownum11 + 1, 2, '0')) AS id_Tar,
    t1.id_V AS villeRamassage,
    t2.id_V AS ville,
    CASE WHEN t1.id_V = t2.id_V THEN 0 ELSE 35 END AS prixliv,
    10 AS prixret,
    10 AS prixref,
    CONCAT(t1.id_V, '-', t2.id_V) AS delailiv
FROM
    villes t1
JOIN
    villes t2 ON t1.id_V <> t2.id_V
JOIN
    (SELECT @rownum11 := 0) r
WHERE
    t1.id_Z = '11' AND t2.id_Z = '11';

-- Zone 12: Dakhla-Oued Ed-Dahab
INSERT INTO tarifs (id_Tar, villeRamassage, ville, prixliv, prixret, prixref, delailiv)
SELECT
    CONCAT('12', LPAD(@rownum12 := @rownum12 + 1, 2, '0')) AS id_Tar,
    t1.id_V AS villeRamassage,
    t2.id_V AS ville,
    CASE WHEN t1.id_V = t2.id_V THEN 0 ELSE 35 END AS prixliv,
    10 AS prixret,
    10 AS prixref,
    CONCAT(t1.id_V, '-', t2.id_V) AS delailiv
FROM
    villes t1
JOIN
    villes t2 ON t1.id_V <> t2.id_V
JOIN
    (SELECT @rownum12 := 0) r
WHERE
    t1.id_Z = '12' AND t2.id_Z = '12';
