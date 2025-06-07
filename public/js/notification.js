document.addEventListener('DOMContentLoaded', function () {
    const msg = localStorage.getItem('success_message');
    if (msg) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: 'Berhasil!',
            text: msg,
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });

        localStorage.removeItem('success_message');
    }

    const error = localStorage.getItem('error_message');
    if (error) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: 'Gagal!',
            text: error,
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });

        localStorage.removeItem('error_message');
    }
});
