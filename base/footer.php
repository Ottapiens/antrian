 <!-- Bootstrap core JavaScript-->
 <script src="assets/vendor/jquery/jquery.min.js"></script>
 <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

 <!-- Core plugin JavaScript-->
 <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

 <!-- Custom scripts for all pages-->
 <script src="assets/js/sb-admin-2.min.js"></script>

 <?php if (
        basename($_SERVER['PHP_SELF']) == 'panggilan_manual.php'
        || 'update_antrian.php' || 'index.php'
    ) { ?>
     <!-- Page level plugins -->
     <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
     <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

     <!-- Page level custom scripts -->
     <script src="assets/js/demo/datatables-demo.js"></script>
 <?php } ?>

 <?php if (basename($_SERVER['PHP_SELF']) == 'ganti_password.php') { ?>

     <script>
         let password_baru = document.getElementById('password_baru');
         let konfirmasi_password = document.getElementById('konfirmasi_password');
         let lihat_password = document.getElementById('lihat_password');

         lihat_password.addEventListener('click', function() {

             if (password_baru.type == "password" && konfirmasi_password.type == "password") {
                 password_baru.type = 'text';
                 konfirmasi_password.type = 'text';
             } else {
                 password_baru.type = 'password';
                 konfirmasi_password.type = 'password';
             }
         });
     </script>
 <?php } ?>
 <?php if (basename($_SERVER['PHP_SELF']) == 'hapus_antrian.php') { ?>

     <script>
         window.onload = () => {
             let hapusAntrian = document.querySelectorAll('.hapusAntrian');

             hapusAntrian.forEach(button => {
                 button.addEventListener("click", function(e) {
                     e.preventDefault();

                     Swal.fire({
                         title: "Apakah Anda yakin?",
                         text: "Tekan Ya jika Anda yakin.",
                         icon: "warning",
                         showCancelButton: true,
                         confirmButtonColor: "#3085d6",
                         cancelButtonColor: "#d33",
                         confirmButtonText: "Ya"
                     }).then((result) => {
                         if (result.isConfirmed) {
                             window.location = button.getAttribute('href');
                         }
                     });

                 });
             });
         }
     </script>
 <?php } ?>

 <?php if (basename($_SERVER['PHP_SELF']) == 'panggil_antrian.php') { ?>
     <script>
         window.onload = () => {
             let isChromium = window.chrome;
             let winNav = window.navigator;
             let vendorName = winNav.vendor;
             let isOpera = typeof window.opr !== "undefined";
             let isIEedge = winNav.userAgent.indexOf("Edg") > -1;
             let isIOSChrome = winNav.userAgent.match("CriOS");
             let isGoogleChrome = winNav.userAgentData?.brands?.some(brand => brand.brand === "Google Chrome");

             let synthesis = window.speechSynthesis;
             let ucapkan = new SpeechSynthesisUtterance();
             let no_antrian = document.querySelector('.no_antrian');
             let btnPanggil = document.querySelector('.btnPanggil');
             let btnPanggilUlang = document.querySelector('.btnPanggilUlang');
             let bel_antrian = document.getElementById('bel_antrian');
             let form = document.querySelector('.form_panggil_antrian');

             let isChromeBrowser = isChromium && typeof isChromium !== "undefined" &&
                 vendorName === "Google Inc." && !isOpera && !isIEedge && (isGoogleChrome || isIOSChrome);

             const updateAntrian = () => {
                 const data = new FormData(form);

                 fetch('ajax/updateNoAntrian.php', {
                         method: 'POST',
                         body: data,

                     })
                     .then(response => response.text())
                     .then(text => {
                         const json = JSON.parse(text); // Parse teks ke JSON
                         return json;
                     })

                     .then(result => {

                         // Cek jika CSRF token valid
                         if (result.status) {

                             // Panggil antrian
                             if (isChromeBrowser && 'speechSynthesis' in window) {
                                 ucapkan.text = `Nomor antrian, ${no_antrian.innerHTML}, menuju farmasi`;
                                 ucapkan.lang = 'id-ID';
                                 synthesis.speak(ucapkan);
                             } else {
                                 responsiveVoice.enableEstimationTimeout = false;
                                 responsiveVoice.speak(
                                     `Nomor antrian, ${no_antrian.innerHTML}, menuju farmasi`,
                                     "Indonesian Female", {
                                         pitch: 1,
                                         rate: 1,
                                         volume: 1
                                     }
                                 );
                             }
                         } else {

                             // Beri pesan jika CSRF token tidak valid
                             alert(result.message)
                         }
                     })
             };

             if (btnPanggil) {
                 btnPanggil.addEventListener("click", () => {
                     bel_antrian.play();
                     setTimeout(updateAntrian, 7000);
                 });
             }

             if (btnPanggilUlang) {
                 btnPanggilUlang.addEventListener("click", function() {
                     bel_antrian.play();

                     setTimeout(() => {
                         if (isChromeBrowser && 'speechSynthesis' in window) {
                             ucapkan.text = `Nomor antrian, ${no_antrian.innerHTML}, menuju farmasi`;
                             ucapkan.lang = 'id-ID';
                             synthesis.speak(ucapkan);
                         } else {
                             responsiveVoice.enableEstimationTimeout = false;
                             responsiveVoice.speak(
                                 `Nomor antrian, ${no_antrian.innerHTML}, menuju farmasi`,
                                 "Indonesian Female", {
                                     pitch: 1,
                                     rate: 1,
                                     volume: 1
                                 }
                             );
                         }
                     }, 7000);
                 })
             }
         };
     </script>
 <?php } ?>
 </body>

 </html>
