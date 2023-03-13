<?= $this->extend('layouts/layout') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <button type="button" class="btn btn-sm btn-outline-primary" onclick="showAddClubModal()">
                    <i class="fa-solid fa-plus"></i> Add Club
                </button>
            </div>
        </div>
        <div class="row mt-3">
            <table id="clubsTable" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col" style="width:5%">#</th>
                        <th scope="col">Club</th>
                        <th scope="col">City</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Add Edit Modal -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <input type="hidden" class="form-control" id="clubId">
                    <label for="clubName" class="form-label">Club name</label>
                    <input type="text" class="form-control" id="clubName" placeholder="Club Name" required>
                    <div id="validationClubName" class="invalid-feedback">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="clubCity" class="form-label">Club city</label>
                    <input type="text" class="form-control" id="clubCity" placeholder="Club City" required>
                    <div id="validationClubCity" class="invalid-feedback">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-primary" id="createBtn" onclick="createClub()">Save changes</button>
                <button type="button" class="btn btn-outline-primary" id="updateBtn" onclick="updateClub()">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Delete club data</h1>
                <input type="hidden" class="form-control" id="deleteClubId">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-danger" onclick="deleteClub()">Delete Data</button>
            </div>
        </div>
    </div>
</div>

<!-- Toast -->
<div class="position-fixed top-0 end-0 mt-4 mx-4 p-3" style="z-index: 11">
    <div id="toast" class="toast text-bg-primary" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
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