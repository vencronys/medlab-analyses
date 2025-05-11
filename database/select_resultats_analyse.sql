SELECT * FROM disn1imh_v13_ma.disn1imh_v13_analyse_generale ag
WHERE ag.id_prelevement = (
	SELECT p.id_prelevement FROM disn1imh_v13_ma.disn1imh_v13_prelevement p
    WHERE p.id_patient = 5);

SELECT * FROM disn1imh_v13_ma.disn1imh_v13_analyse_cholesterol ac
WHERE ac.id_prelevement = (
	SELECT p.id_prelevement FROM disn1imh_v13_ma.disn1imh_v13_prelevement p
    WHERE p.id_patient = 5);

SELECT * FROM disn1imh_v13_ma.disn1imh_v13_analyse_glucose agl
WHERE agl.id_prelevement = (
	SELECT p.id_prelevement FROM disn1imh_v13_ma.disn1imh_v13_prelevement p
    WHERE p.id_patient = 5);

SELECT * FROM disn1imh_v13_ma.disn1imh_v13_analyse_hemoglobine ah
WHERE ah.id_prelevement = (
	SELECT p.id_prelevement FROM disn1imh_v13_ma.disn1imh_v13_prelevement p
    WHERE p.id_patient = 5);

SELECT * FROM disn1imh_v13_ma.disn1imh_v13_analyse_vitamine_d avd
WHERE avd.id_prelevement = (
	SELECT p.id_prelevement FROM disn1imh_v13_ma.disn1imh_v13_prelevement p
    WHERE p.id_patient = 5);