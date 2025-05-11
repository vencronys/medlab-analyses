SELECT e.nom_examen
FROM disn1imh_v13_examen e INNER JOIN disn1imh_v13_prelevement_examen pe ON e.id_examen = pe.id_examen
    INNER JOIN disn1imh_v13_prelevement p ON pe.id_prelevement = p.id_prelevement
WHERE p.id_patient = 5;