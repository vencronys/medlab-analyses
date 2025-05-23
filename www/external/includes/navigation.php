<nav class="flex flex-jus-con-spa-bet">
    <ul class="lis-sty-non flex flex-ali-ite-cen flex-gap-32px">
        <li><a href="/medlab-analyses/www/external/index.php" class="lnk">Accueil</a></li>
        <li><a href="/medlab-analyses/www/external/pages/about.php" class="lnk">A propos</a></li>
        <li><a href="/medlab-analyses/www/external/pages/services.php" class="lnk">Services</a></li>
        <li><a href="/medlab-analyses/www/external/pages/contact.php" class="lnk">Contact</a></li>
        <li><a href="/medlab-analyses/www/external/pages/rdv-form.php" class="lnk btn rdv">Prise de rendez-vous</a></li>
    </ul>

    <div class="flex flex-gap-24px">
        <?php
        if (isset($_SESSION['id_compte'])) {
            echo "<button class='btn' onclick='window.location.href=\"/medlab-analyses/www/external/pages/Profile.php\"'>Profile</button>";
            echo "<button class='btn logout-btn' onclick='window.location.href=\"/medlab-analyses/www/external/pages/logout.php\"'>Se deconnecter</button>";
        } else {
            echo "<button class='btn' onclick='window.location.href=\"/medlab-analyses/www/external/pages/login-form.php\"'>Se connecter</button>";
            echo "<button class='btn' onclick='window.location.href=\"/medlab-analyses/www/external/pages/signup-form.php\"'>S'inscrire</button>";
        }
        ?>
    </div>
</nav>