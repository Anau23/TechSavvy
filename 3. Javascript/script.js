console.log('Script berjalan dengan baik');

// Fungsi untuk menampilkan Snackbar dan melakukan redirect
function showToast(message, redirect = null) {
    const snackbar = document.getElementById('snackbar');
    snackbar.textContent = message; // Set pesan snackbar
    snackbar.className = 'show'; // Menambahkan kelas untuk menampilkan snackbar

    setTimeout(() => {
        snackbar.className = snackbar.className.replace('show', ''); // Hapus kelas setelah 3 detik

        // Jika ada URL tujuan (redirect), lakukan navigasi ke halaman tersebut
        if (redirect) {
            window.location.href = redirect;
        }
    }, 3000);
}

// Event listener untuk tombol "Mulai Sekarang"
document.querySelector('.btn_getStarted').addEventListener('click', () => {
    console.log('Tombol "Mulai Sekarang" ditekan');
    showToast('Ayo mulai petualangan teknologi bersama kami!', 'home.html'); // Arahkan ke home.html
});
