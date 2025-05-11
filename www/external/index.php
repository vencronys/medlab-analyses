<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedLab Analyses</title>
    <script src="https://kit.fontawesome.com/0197b6ebf2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/main.css">
    <style>
        .home-services-cards-container {
            text-align: center;
        }
    </style>
</head>

<body class="home-page">
    <div class="sticky-top">
        <?php
        include 'includes/topbar.php';
        include 'includes/navigation.php';
        ?>
    </div>
    <div class="hero flex flex-ali-ite-cen">
        <div>
            <p>caring for life</p>
            <h2>Leading The Way <br>
                In Medical Analysis</h2>
            <button onclick="window.location.href='/medlab-analyses/www/external/pages/services.php'" class="btn">Nos
                Services</button>
        </div>
        <p class="hero-img-credits">
            <a
                href="https://www.pexels.com/photo/woman-in-white-protective-suit-wearing-white-face-mask-looking-through-the-microscope-8442097/">Photo
                by Pavel Danilyuk</a>
        </p>
    </div>

    <div class="hero-cards flex flex-gap-24px">
        <button onclick="window.location.href='/medlab-analyses/www/external/pages/rdv-form.php'"
            class="btn card flex-1 flex flex-jus-con-spa-bet flex-ali-ite-cen">
            <p>Prise de RDV</p>
            <i class="fa-solid fa-calendar-days"></i>
        </button>
        <button onclick="window.location.href='/medlab-analyses/www/external/pages/contact-form.php'"
            class="btn card flex-1 flex flex-jus-con-spa-bet flex-ali-ite-cen">
            <p>Contactez-nous</p>
            <i class="fa-solid fa-phone-volume"></i>
        </button>
        <button class="btn card flex-1 flex flex-jus-con-spa-bet flex-ali-ite-cen">
            <p>Frais de traitement</p>
            <i class="fa-solid fa-money-bill"></i>
        </button>
    </div>

    <div class="welcome">
        <p>Bienvenue chez medlab</p>
        <h3>Un endroit idéal pour faire vos analyses</h3>
        <p>Medlab est un laboratoire médical de pointe qui offre des services de qualité et des analyses fiables. Nous
            sommes fiers de notre expertise et de notre engagement envers la santé et la qualité des analyses.</p>
        <a href="pages/about.php" class="flex flex-ali-ite-cen flex-jus-con-cen flex-gap-8px">
            En savoir plus
            <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>

    <div class="welcome-img">
        <img src="/medlab-analyses/www/external/images/welcome-duow.avif" alt="Two lab nerds analysing blood">
        <a href="https://www.pexels.com/photo/a-man-and-a-woman-holding-a-test-tube-5726837/"
            class="welcome-img-credits">Photo by Artem Podrez</a>
    </div>

    <div class="home-services-container">
        <div class="header">
            <p>soins auxquels vous pouvez croire</p>
            <h3>Nos services</h3>
        </div>
        <div class="home-services flex flex-gap-24px">

            <div class="home-services-cards-container">
                <div class="flex flex-dir-col flex-jus-con-cen flex-ali-ite-cen">
                    <i class="fa-solid fa-vial"></i>
                    <p>Analyse generale</p>
                </div>

                <div class="flex flex-dir-col flex-jus-con-cen flex-ali-ite-cen">
                    <i class="fa-solid fa-vial"></i>
                    <p>Analyse cholesterole</p>
                </div>

                <div class="flex flex-dir-col flex-jus-con-cen flex-ali-ite-cen">
                    <i class="fa-solid fa-vial"></i>
                    <p>Analyse glucose</p>
                </div>

                <div class="flex flex-dir-col flex-jus-con-cen flex-ali-ite-cen">
                    <i class="fa-solid fa-vial"></i>
                    <p>Analyse hemoglobine</p>
                </div>

                <div class="flex flex-dir-col flex-jus-con-cen flex-ali-ite-cen">
                    <i class="fa-solid fa-vial"></i>
                    <p>Analyse vitamine D</p>
                </div>


            </div>

            <div>
                <h4>Une passion pour donner la priorité aux patients.</h4>
                <div class="flex flex-gap-40px flex-ali-ite-cen">
                    <ul>
                        <li>Analyses fiables et rapides</li>
                        <li>Rendez-vous simplifié</li>
                        <li>Suivi patient sécurisé</li>
                    </ul>
                    <ul>
                        <li>Professionnels qualifiés</li>
                        <li>Technologie de pointe</li>
                        <li>Engagés pour votre santé</li>
                    </ul>
                </div>
                <p>MedLab est une solution numérique conçue pour moderniser la gestion des laboratoires d’analyses
                    médicales.
                    Elle facilite la prise de rendez-vous, la gestion des résultats et la coordination entre les
                    différents intervenants du laboratoire.</p>

                <br>

                <p>Côté patient, MedLab offre une plateforme intuitive pour créer un compte, réserver un prélèvement
                    sanguin et consulter ses résultats d’analyse en ligne en toute sécurité. Les examens proposés
                    incluent notamment le glucose, le cholestérol, l’hémoglobine, la vitamine D ainsi qu’un panel
                    d’analyses générales. Le patient reçoit des notifications automatiques lors de la validation d’un
                    rendez-vous ou dès que ses résultats sont disponibles. Ce système vise à réduire les déplacements
                    inutiles et accélérer l’accès aux informations médicales tout en garantissant la confidentialité des
                    données. L’interface est pensée pour être accessible à tous, quel que soit le niveau de familiarité
                    avec les outils numériques.</p>

                <br>

                <p>
                    Pour les professionnels, MedLab intègre des modules adaptés aux secrétaires, infirmiers, techniciens
                    et chefs techniciens. Les secrétaires gèrent les comptes et les rendez-vous, les infirmiers
                    enregistrent les prélèvements réalisés, tandis que les techniciens accèdent à une application dédiée
                    pour suivre les échantillons, saisir les résultats et les valider. Le chef technicien dispose d’une
                    vue d’ensemble sur les activités techniques du laboratoire, les performances du personnel, et peut
                    consulter des statistiques opérationnelles.
                </p>
            </div>

            <div>
                <div>
                    <a href="https://www.pexels.com/photo/a-man-holding-a-test-tube-9629677/">Photo by Ivan Samkov</a>
                </div>
                <div>
                    <a href="https://www.pexels.com/photo/blood-samples-4047146/">Photo by Kaboompics.com</a>
                </div>
            </div>

        </div>
    </div>

    <?php
    include 'includes/contact.php';
    include 'includes/footer.php';
    ?>


</body>

</html>