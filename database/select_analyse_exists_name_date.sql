SELECT e.nom_examen, T.date_analyse
            FROM (SELECT e.id_examen, ag.date_analyse_generale as date_analyse
                    FROM disn1imh_v13_examen e INNER JOIN disn1imh_v13_analyse_generale ag
                        ON e.id_examen = ag.id_examen
                    WHERE ag.id_prelevement = (SELECT p.id_prelevement FROM disn1imh_v13_prelevement p WHERE p.id_patient = :id_patient)
                    UNION ALL
                    SELECT e.id_examen, ac.date_analyse_cholesterol as date_analyse
                    FROM disn1imh_v13_examen e INNER JOIN disn1imh_v13_analyse_cholesterol ac
                        ON e.id_examen = ac.id_examen
                    WHERE ac.id_prelevement = (SELECT p.id_prelevement FROM disn1imh_v13_prelevement p WHERE p.id_patient = :id_patient)
                    UNION ALL
                    SELECT e.id_examen, agl.date_analyse_glucose as date_analyse
                    FROM disn1imh_v13_examen e INNER JOIN disn1imh_v13_analyse_glucose agl
                        ON e.id_examen = agl.id_examen
                    WHERE agl.id_prelevement = (SELECT p.id_prelevement FROM disn1imh_v13_prelevement p WHERE p.id_patient = :id_patient)
                    UNION ALL
                    SELECT e.id_examen, ah.date_analyse_hemoglobine as date_analyse
                    FROM disn1imh_v13_examen e INNER JOIN disn1imh_v13_analyse_hemoglobine ah
                        ON e.id_examen = ah.id_examen
                    WHERE ah.id_prelevement = (SELECT p.id_prelevement FROM disn1imh_v13_prelevement p WHERE p.id_patient = :id_patient)
                    UNION ALL
                    SELECT e.id_examen, avd.date_analyse_vitamine_d as date_analyse
                    FROM disn1imh_v13_examen e INNER JOIN disn1imh_v13_analyse_vitamine_d avd
                        ON e.id_examen = avd.id_examen
                    WHERE avd.id_prelevement = (SELECT p.id_prelevement FROM disn1imh_v13_prelevement p WHERE p.id_patient = :id_patient)
                ) T
                INNER JOIN disn1imh_v13_examen e ON T.id_examen = e.id_examen
                INNER JOIN disn1imh_v13_prelevement_examen pe ON e.id_examen = pe.id_examen
                INNER JOIN disn1imh_v13_prelevement p ON pe.id_prelevement = p.id_prelevement
            WHERE p.id_patient = :id_patient AND (exists (SELECT * FROM disn1imh_v13_analyse_generale ag
                                            WHERE (ag.id_prelevement = p.id_prelevement AND ag.id_examen = pe.id_examen))
                                        OR
                                        exists (SELECT * FROM disn1imh_v13_analyse_cholesterol ac
                                            WHERE (ac.id_prelevement = p.id_prelevement AND ac.id_examen = pe.id_examen))
                                        OR
                                        exists (SELECT * FROM disn1imh_v13_analyse_glucose agl
                                            WHERE (agl.id_prelevement = p.id_prelevement AND agl.id_examen = pe.id_examen))
                                        OR
                                        exists (SELECT * FROM disn1imh_v13_analyse_hemoglobine ah
                                            WHERE (ah.id_prelevement = p.id_prelevement AND ah.id_examen = pe.id_examen))
                                        OR
                                        exists (SELECT * FROM disn1imh_v13_analyse_vitamine_d avd
                                            WHERE (avd.id_prelevement = p.id_prelevement AND avd.id_examen = pe.id_examen)));