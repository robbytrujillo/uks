

<script src="<?= base_url() ?>/dist/modules/jquery.min.js"></script>
  <script src="<?= base_url() ?>/dist/modules/popper.js"></script>
  <script src="<?= base_url() ?>/dist/modules/tooltip.js"></script>
  <script src="<?= base_url() ?>/dist/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>/dist/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="<?= base_url() ?>/dist/modules/moment.min.js"></script>
  <script src="<?= base_url() ?>/dist/js/stisla.js"></script>
  
  <!-- JS Libraies -->
  <script src="<?= base_url()  ?>/dist/modules/datatables/datatables.min.js"></script>
  <script src="<?= base_url()  ?>/dist/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url()  ?>/dist/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
  <script src="<?= base_url()  ?>/dist/modules/jquery-ui/jquery-ui.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="<?= base_url()  ?>/dist/js/page/modules-datatables.js"></script>
  
  <!-- Template JS File -->
  <script src="<?= base_url() ?>/dist/js/scripts.js"></script>
  <script src="<?= base_url() ?>/dist/js/custom.js"></script>

  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let now = new Date();

        let year = now.getFullYear();
        let month = String(now.getMonth() + 1).padStart(2, '0');
        let day = String(now.getDate()).padStart(2, '0');
        let hours = String(now.getHours()).padStart(2, '0');
        let minutes = String(now.getMinutes()).padStart(2, '0');

        let formatted = `${year}-${month}-${day}T${hours}:${minutes}`;

        document.getElementById("tgl_sakit").value = formatted;
    });
    </script>

<script>
$(function(){

$("#nama_siswa").autocomplete({

    source: "<?= base_url('admin/get_siswa') ?>",
    minLength: 2,

    select: function(event, ui){

        $("#nama_siswa").val(ui.item.value);

        $("form").submit(); // otomatis submit ke admin/cari

    }

});

});
</script>

</body>
</html>