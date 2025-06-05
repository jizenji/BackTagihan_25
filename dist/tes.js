function setFixedWidth() {
    document.body.style.width = '58mm';
}

// Panggil fungsi saat halaman dimuat
window.onload = setFixedWidth;

// Fungsi untuk mengubah konten total pembayaran dan token
function updateContent(total, token) {
    document.getElementById('total-pembayaran').textContent = 'Rp ' + total;
    document.getElementById('token-value').textContent = token;
}

// Contoh pemanggilan fungsi dengan nilai baru
updateContent('250.000', '1234 5678 9012 3456 7890');