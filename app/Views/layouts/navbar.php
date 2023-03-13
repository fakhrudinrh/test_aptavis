<nav class="navbar navbar-expand-lg" data-bs-theme="dark" style="background-color: #011b36;">
    <div class="container">
        <a class="navbar-brand" href="/">
            <h3>Liga 1</h3>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php $request = service('request'); ?>
                <li class="nav-item">
                    <a class="nav-link <?= $request->uri->getSegment(1) == "" ? "active" : "" ?>" aria-current="page" href="/">Standings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $request->uri->getSegment(1) == "dataclubs" ? "active" : "" ?>" href="<?= base_url() . 'dataclubs' ?>">Data Clubs</a>
                </li>
            </ul>
        </div>
    </div>
</nav>