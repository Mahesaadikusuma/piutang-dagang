import "./bootstrap";
import "flowbite";
import Alpine from "alpinejs";
import Precognition from "laravel-precognition-alpine";
import mask from "@alpinejs/mask";

window.Alpine = Alpine;

Alpine.plugin([Precognition, mask]);
Alpine.start();
// window.addEventListener('settingUpdated', (event) => {
//     let data = event.detail;
//     console.log(event)
//     console.log(data)

//     Swal.fire({
//         title: "Are you sure?",
//         text: "You won't be able to revert this!",
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#3085d6",
//         cancelButtonColor: "#d33",
//         confirmButtonText: "Yes, save it!"
//         }).then((result) => {
//             console.log(result)
//             Livewire.emit('saveData', data);
//         if (result.isConfirmed) {
//             Swal.fire({
//             title: "Save Success!",
//             text: data.title,
//             icon: "success"
//             });
//         }
//         });
// })

// window.addEventListener('settingUpdated', (event) => {
//     let data = event.detail;
//     console.log(data)
//     Toastify({
//         text: "This is a toast",
//         duration: 3000,
//         destination: "https://github.com/apvarun/toastify-js",
//         newWindow: true,
//         close: true,
//         gravity: "top", // `top` or `bottom`
//         position: "left", // `left`, `center` or `right`
//         stopOnFocus: true, // Prevents dismissing of toast on hover
//         style: {
//             background: "linear-gradient(to right, #00b09b, #96c93d)",
//         },
//         onClick: function(){} // Callback after click
//         }).showToast();
// })
