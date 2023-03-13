<?= $this->extend('layouts/layout') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <button type="button" class="btn btn-sm btn-outline-primary" onclick="showAddMatchModal()">
                    <i class="fa-solid fa-plus"></i> Add Match
                </button>
            </div>
        </div>
        <div class="row mt-3">
            <table id="standingsTable" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">Pos</th>
                        <th scope="col">Club</th>
                        <th scope="col">Play</th>
                        <th scope="col">Points</th>
                        <th scope="col">Win</th>
                        <th scope="col">Draw</th>
                        <th scope="col">Lose</th>
                        <th scope="col">GF</th>
                        <th scope="col">GA</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Add Match Modal -->
<div class="modal fade" id="matchModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" id="addMatchForm">
                <div class="modal-body">
                    <div class="mb-3" id="formMatch">
                        <div class="row">
                            <div class="col">
                                <label for="selectHome" class="form-label">Match</label>
                                <button type="button" class="badge rounded-pill text-bg-primary border border-primary" id="addMultipleMatch">
                                    <span class="badge rounded-pill text-bg-primary">
                                        <i class="fa-solid fa-plus fa-xl"></i>
                                    </span>
                                </button>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <select class="form-select" name="homeSelect[]" id="homeSelect" required>
                                    <option selected value="" disabled>Home</option>
                                </select>
                            </div>
                            <div class="col col-auto d-flex align-items-center">
                                <span class="badge bg-primary">Vs</span>
                            </div>
                            <div class="col">
                                <select class="form-select" name="awaySelect[]" id="awaySelect" required>
                                    <option selected value="" disabled>Away</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="number" class="form-control" name="homeScore[]" id="homeScore" min="0" required>
                            </div>
                            <div class="col col-auto d-flex align-items-center">
                                <span class="badge bg-primary">-</span>
                            </div>
                            <div class="col">
                                <input type="number" class="form-control" name="awayScore[]" id="awayScore" min="0" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Toast -->
<div class="position-fixed top-0 end-0 mt-4 mx-4 p-3" style="z-index: 11">
    <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <i class="fa-solid fa-circle-exclamation errorToast"></i>
                <i class="fa-solid fa-circle-check successToast"></i>
                <a id="toastMessage">
                    Hello, world! This is a toast message.
                </a>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<?= $this->endSection() ?>