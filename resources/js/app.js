import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


import Swal from 'sweetalert2';

window.Swal = Swal;

if (!response.ok) {
    let data = await response.json();

    Swal.fire({
        icon: 'error',
        title: data.message
    });

    return;
}