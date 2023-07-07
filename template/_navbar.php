<ul class="nav nav-tabs ml-3">
    <li class="nav-item">
        <a class="nav-link active bg-primary text-white" aria-current="page" href="../index.php">Tout les jeux</a>
    </li>
    <li class="nav-item dropdown ">
        <a class="nav-link dropdown-toggle bg-primary text-white " data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Par console</a>
        <ul class=" derouler dropdown-menu bg-primary ">
            <?php
            get_game_by_console()
            ?>
        </ul>
    </li>
    <li class="nav-item dropdown ">
        <a class="nav-link dropdown-toggle bg-primary text-white" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">par prix </a>
        <ul class=" derouler dropdown-menu bg-primary ">
            <li>
                <a class="nav-link active bg-primary text-white border-0" href="../page-desc.php"> Prix décroissant</a>
            </li>
            <li>
                <a class="nav-link active bg-primary text-white border-0" href="../page-asc.php"> Prix décroissant</a>
            </li>
        </ul>
    <li class="nav-item dropdown ">
        <a class="nav-link dropdown-toggle bg-primary text-white" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">par note </a>
        <ul class=" derouler dropdown-menu bg-primary ">
            <li>
                <a class="nav-link active bg-primary text-white border-0" href="../page-user-note.php"> Note utilisateur</a>
            </li>
            <li>
                <a class="nav-link active bg-primary text-white border-0" href="../page-presse-note.php"> Note presse</a>
            </li>
        </ul>
    </li>
    <li class="nav-item dropdown ">
        <a class="nav-link dropdown-toggle bg-primary text-white" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">par age</a>
        <ul class=" derouler dropdown-menu bg-primary ">
            <?php
            get_game_by_age()
            ?>
        </ul>
    </li>

</ul>