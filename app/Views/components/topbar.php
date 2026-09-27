<header class="app-topbar">

    <div class="topbar-page">

        <h1 class="topbar-title">
            <?= esc($pageTitle ?? 'Dashboard') ?>
        </h1>

    </div>


    <div class="topbar-user">

        <div class="topbar-user-info">

            <span class="topbar-user-name">
                <?= esc(session()->get('name')) ?>
            </span>

            <span class="topbar-user-role">
                <?= esc(session()->get('role')) ?>
            </span>

        </div>

    </div>

</header>