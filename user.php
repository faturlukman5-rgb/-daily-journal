<?php
include "koneksi.php";
?>

<div class="container">
    <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalUser">
        <i class="bi bi-plus-lg"></i> Tambah User
    </button>

    <div class="table-responsive" id="user_data"></div>
</div>

<!-- MODAL TAMBAH / EDIT -->
<div class="modal fade" id="modalUser" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Form User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="formUser">
                <div class="modal-body">

                    <input type="hidden" name="id" id="id">

                    <div class="mb-3">
                        <label>Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="text" name="password" id="password" class="form-control" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
$(document).ready(function(){

    let halamanAktif = 1;

    loadData();

    function loadData(hlm = 1){
        halamanAktif = hlm;
        $.post("user_data.php", { hlm: hlm }, function(data){
            $("#user_data").html(data);
        });
    }

    // RESET FORM
    $('#modalUser').on('show.bs.modal', function () {
        $('#id').val('');
        $('#username').val('');
        $('#password').val('');
    });

    // EDIT
    $(document).on('click', '.btn-edit', function(){
        $('#id').val($(this).data('id'));
        $('#username').val($(this).data('username'));
        $('#password').val($(this).data('password'));
        $('#modalUser').modal('show');
    });

    // SIMPAN
    $('#formUser').submit(function(e){
        e.preventDefault();

        $.ajax({
            url: 'user_data.php',
            type: 'POST',
            data: $(this).serialize() + '&aksi=simpan',
            success: function(){
                $('#modalUser').modal('hide');
                loadData(halamanAktif);
            }
        });
    });

    // HAPUS
    $(document).on('click', '.btn-hapus', function(){
        if(confirm('Yakin hapus user ini?')){
            $.post('user_data.php', {
                aksi: 'hapus',
                id: $(this).data('id')
            }, function(){
                loadData(halamanAktif);
            });
        }
    });

    // PAGINATION
    $(document).on('click', '.halaman', function(){
        loadData($(this).attr("id"));
    });

});
</script>
