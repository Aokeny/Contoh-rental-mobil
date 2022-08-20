<div class="page_header">
    <h3>Ganti password</h3>
</div>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <?php
            if(isset($_GET['Pesan'])){
                if($_GET['Pesan']== "berhasil"){
                    echo"<div class='alert alert-success'>password berhasil diganti.></div>";
                }
            }
        ?>
        <form action="<?php echo base_url().'admin/Ganti_password_act' ?>"method="post">
        <div class ="from-group">
            <label>Password Baru</label>
            <input class="form-control" type="password" name="Pass_baru">
            <?php echo form_error ('Pass_baru'); ?>
        </div>
        <div class ="from-group">
            <label>Ulangi Password Baru</label>
            <input class="form-control" type="password" name="Ulang_pass">
            <?php echo form_error ('Ulang_pass'); ?>
        </div>
        <div class ="from-group">
            <input class="btn btn-primary btn-sm" type="submit" value="simpan" >
            </div>
        </form>
    </div>
</div>