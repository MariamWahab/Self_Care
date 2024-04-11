// document.addEventListener('DOMContentLoaded', function () {
//     var requestButton = document.querySelector('.requestButton');
//     if (requestButton) {
//         requestButton.addEventListener('click', function () {
//             var form = document.getElementById('specialistForm'); // Corrected form ID selector
//             var formData = new FormData(form);

//             var xhr = new XMLHttpRequest();
//             xhr.onreadystatechange = function () {
//                 if (xhr.readyState === XMLHttpRequest.DONE) {
//                     if (xhr.status === 200) {
//                         try {
//                             var response = JSON.parse(xhr.responseText);
//                             if (response.status === 'success') {
//                                 // Request successful, display success message
//                                 alert(response.message);
//                             } else {
//                                 // Request failed, display error message from server
//                                 alert(response.message);
//                             }
//                         } catch (error) {
//                             console.error('Error parsing JSON:', error);
//                             console.log('Response:', xhr.responseText);
//                         }
//                     } else {
//                         console.error('Request failed:', xhr.status);
//                     }
//                 }
//             };

//             xhr.open('POST', '../action/request_action.php', true);
//             xhr.send(formData); // Removed setting Content-type header
//         });
//     } else {
//         console.error('Element with class requestButton not found');
//     }
// });
