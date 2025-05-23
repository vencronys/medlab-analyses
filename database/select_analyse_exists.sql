SELECT e.nom_examen
FROM disn1imh_v13_examen e INNER JOIN disn1imh_v13_prelevement_examen pe ON e.id_examen = pe.id_examen
    INNER JOIN disn1imh_v13_prelevement p ON pe.id_prelevement = p.id_prelevement
WHERE p.id_patient = 5 AND (EXISTS (SELECT * FROM disn1imh_v13_analyse_generale ag
								WHERE (ag.id_prelevement = p.id_prelevement AND ag.id_examen = pe.id_examen))
							OR
							EXISTS (SELECT * FROM disn1imh_v13_analyse_cholesterol ac
								WHERE (ac.id_prelevement = p.id_prelevement AND ac.id_examen = pe.id_examen))
                            OR
                            EXISTS (SELECT * FROM disn1imh_v13_analyse_glucose agl
								WHERE (agl.id_prelevement = p.id_prelevement AND agl.id_examen = pe.id_examen))
                            OR
                            EXISTS (SELECT * FROM disn1imh_v13_analyse_hemoglobine ah
								WHERE (ah.id_prelevement = p.id_prelevement AND ah.id_examen = pe.id_examen))
							OR
                            EXISTS (SELECT * FROM disn1imh_v13_analyse_vitamine_d avd
								WHERE (avd.id_prelevement = p.id_prelevement AND avd.id_examen = pe.id_examen))
                            );