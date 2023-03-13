$(document).ready(function() {
    if(window.location.pathname == "/"){
        loadStandingsData();
        addItemSelectClub();
    }else if(window.location.pathname == "/dataclubs"){
        loadClubsData();
    }
});

function loadStandingsData(){
    $.ajax({
        url: "/standings",
        method: "GET",
        dataType: "JSON",
        success: function(response) {
            let no = 1;
            $('#standingsTable').DataTable({
                responsive: true,
                destroy: true,
                "data": response.standings,
                "columnDefs": [
                    {"defaultContent": "-", "className": "dt-center", "targets": "_all"}
                  ],
                "columns":[
                    { "render": function(){
                        return no++;
                    } },
                    { "data": "club_name" },
                    { "data": "played" },
                    { "data": "points" },
                    { "data": "won" },
                    { "data": "draw" },
                    { "data": "lost" },
                    { "data": "goals_for" },
                    { "data": "goals_againts" },
                ]
            });
        }   
    });
}

function loadClubsData(){
    $.ajax({
        url: "/clubs",
        method: "GET",
        dataType: "JSON",
        success: function(response) {
            let no = 1;
            $('#clubsTable').DataTable({
                destroy: true,
                "data": response.clubs,
                "columnDefs": [
                    {"className": "dt-center", "targets": "_all"}
                  ],
                "columns":[
                    { "render": function(){
                        return no++;
                    } },
                    { "data": "club_name" },
                    { "data": "club_city" },
                    { "render": function ( data, type, row, meta ) {
                        var a = '\
                        <button type="button" class="btn btn-sm btn-outline-success" onclick="showUpdateModal('+row.club_id+')"><i class="fa-solid fa-pen-to-square"></i></button>\
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="showDeleteModal('+row.club_id+')"><i class="fa-solid fa-trash"></i></button>\
                        ';
                        return a;
                      } },
                ]
            });
        }   
    });
}

function addItemSelectClub(){
    $.ajax({
        url: '/clubs',
        method: 'GET',
        dataType: 'JSON',
        success: function(response) {
            $.each(response.clubs, function(key, val){
                var homeSelect = document.getElementById("homeSelect");
                var optionHomeSelect = document.createElement("option");
                optionHomeSelect.text = val['club_name'];
                optionHomeSelect.value = val['club_id'];
                homeSelect.add(optionHomeSelect);
                var awaySelect = document.getElementById("awaySelect");
                var optionAwaySelect = document.createElement("option");
                optionAwaySelect.text = val['club_name'];
                optionAwaySelect.value = val['club_id'];
                awaySelect.add(optionAwaySelect);
            })
        }
    })
}

$("#addMultipleMatch").click(function(e){
    $('#formMatch').prepend('\
        <div class="row" id="formMultipleMatch">\
            <div class="row">\
                <div class="col">\
                    <label for="selectHome" class="form-label">Match</label>\
                    <button type="button" class="badge rounded-pill text-bg-danger border border-danger" id="removeMultipleMatch">\
                        <i class="fa-solid fa-minus fa-lg"></i>\
                    </button>\
                </div>\
            </div>\
            <div class="row mb-3">\
                <div class="col">\
                    <select class="form-select" name="homeSelect[]" id="homeSelect" required>\
                        <option selected value="" disabled>Home</option>\
                    </select>\
                </div>\
                <div class="col col-auto d-flex align-items-center">\
                    <span class="badge bg-primary">Vs</span>\
                </div>\
                <div class="col">\
                    <select class="form-select" name="awaySelect[]" id="awaySelect" required>\
                        <option selected value="" disabled>Away</option>\
                    </select>\
                </div>\
            </div>\
            <div class="row mb-3">\
                <div class="col">\
                    <input type="number" class="form-control" name="homeScore[]" id="homeScore" min="0" required>\
                </div>\
                <div class="col col-auto d-flex align-items-center">\
                    <span class="badge bg-primary">-</span>\
                </div>\
                <div class="col">\
                    <input type="number" class="form-control" name="awayScore[]" id="awayScore" min="0" required>\
                </div>\
            </div>\
        </div>\
    ');
    addItemSelectClub();
})

$("body").on("click","#removeMultipleMatch",function(){ 
    const child = document.getElementById("formMultipleMatch");
    child.remove();
});

$("#addMatchForm").submit(function(e){
    event.preventDefault();
    $.ajax({
        url: "/standings",
        method: "POST",
        data: $(this).serialize(),
        success: function(response) {
            if(response.message == "success"){
                $("#matchModal").modal("hide");
                $("#matchModal").find('input').val('');
                $("#matchModal").find('select').val('');
                const child = document.getElementById("formMultipleMatch");
                if(child){
                    child.remove();
                }
                loadStandingsData();
                showToastStandings(response.message, response.message + " Standings update successfully"); 
            }else{
                showToastStandings(response.message, response.message + " Standings update failed"); 
            }
        }
    })
})

function showAddClubModal(){
    $("#modalLabel").html("Add Club");
    $("#updateBtn").addClass("d-none");
    $("#modal").find('input').removeClass("is-invalid");
    $("#createBtn").removeClass("d-none");
    $("#modal").find('input').val('');
    $("#modal").modal('show');
}

function showAddMatchModal(){
    $("#modalLabel").html("Add Match");
    $("#matchModal").find('input').removeClass("is-invalid");
    $("#matchModal").find('input').val('');
    $("#matchModal").modal('show');
}

function showToastStandings(status, message){
    $('#toast').toast({
        animation: true,
        delay: 3000
    });
    $('#toastMessage').html(message)
    if(status == "error"){
        $('#toast').addClass("text-bg-danger");
        $('#toast').removeClass("text-bg-primary");
        $('.errorToast').removeClass("d-none");
        $('.successToast').addClass("d-none");
    }else{
        $('#toast').removeClass("text-bg-danger");
        $('#toast').addClass("text-bg-primary");
        $('.successToast').removeClass("d-none");
        $('.errorToast').addClass("d-none");
    }
    $('#toast').toast('show');
}

function showToast(message){
    $('#toast').toast({
        animation: true,
        delay: 3000
    });
    $('#toastMessage').html(message)
    $('#toast').toast('show');
}

function createClub(){
    $.ajax({
        url: "/clubs",
        method: "POST",
        data: {
            'clubName': $("#clubName").val(),
            'clubCity': $("#clubCity").val(),
        },
        success: function(response) {
            if(response.message == "error"){
                if(response.validation.clubName){
                    $("#clubName").addClass("is-invalid");
                    $("#validationClubName").html(response.validation.clubName)
                }else if(response.validation.clubCity){
                    $("#clubCity").addClass("is-invalid");
                    $("#validationClubCity").html(response.validation.clubCity)
                }
            }else{
                $("#modal").modal("hide");
                $("#modal").find('input').val('');
                $("#modal").find('input').removeClass("is-invalid");
                loadClubsData();
                showToast("Club added successfully");   
            }
        }
    })
    event.preventDefault();
}

function showUpdateModal(id) {
    $.ajax({
        url: "/clubs/" + id,
        method: "GET",
        success: function(response) {
            $.each(response, function(key, value) {
                $("#modal").find('input').removeClass("is-invalid");
                $("#modalLabel").html("Update Club");
                $("#clubId").val(value['club_id']);
                $("#clubName").val(value['club_name']);
                $("#clubCity").val(value['club_city']);
                $("#createBtn").addClass("d-none");
                $("#updateBtn").removeClass("d-none");
                $("#modal").modal("show");
            })
        }
    })
    event.preventDefault();
}

function updateClub() {
    $.ajax({
        url: "/clubs/" + $("#clubId").val(),
        method: "POST",
        data: {
            'clubName': $("#clubName").val(),
            'clubCity': $("#clubCity").val(),
        },
        success: function(response) {
            if(response.message == "error"){
                if(response.validation.clubName){
                    $("#clubName").addClass("is-invalid");
                    $("#validationClubName").html(response.validation.clubName)
                }else if(response.validation.clubCity){
                    $("#clubCity").addClass("is-invalid");
                    $("#validationClubCity").html(response.validation.clubCity)
                }
            }else{
                $("#modal").modal("hide");
                $("#modal").find('input').val('');
                $("#modal").find('input').removeClass("is-invalid");
                loadClubsData();
                showToast("Club update successfully");   
            }
        }
    })
    event.preventDefault();
}

function showDeleteModal(club_id) {
    $("#deleteModal").modal("show");
    $("#deleteClubId").val(club_id);
    event.preventDefault();
}

function deleteClub(){
    $.ajax({
        url: "/clubs/" + $("#deleteClubId").val(),
        method: "DELETE",
        success: function(response) {
            $("#deleteModal").modal("hide");
            loadClubsData();
            showToast("Club remove successfully");
        }
    })
    event.preventDefault();
}
