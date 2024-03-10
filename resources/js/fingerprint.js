
document.addEventListener("DOMContentLoaded", function() {
    var fingerprintField = document.getElementById('fingerprint');

    if (fingerprintField) {
      
        new Fingerprint2().get(function(result) {
            fingerprintField.value = result;
        });
    }
});



// document.addEventListener("DOMContentLoaded", function() {
//     var registerForm = document.getElementById('registerForm');

//     if (registerForm) {
//         registerForm.addEventListener('submit', function(event) {
//             event.preventDefault(); // Prevent the form from submitting immediately

//             new Fingerprint2().get(function(result) {
//                 // Find the hidden input field for the fingerprint
//                 var fingerprintField = document.getElementById('fingerprint');
//                 if (fingerprintField) {
//                     // Set the value of the fingerprint field to the generated fingerprint
//                     fingerprintField.value = result;
//                 }

//                 // Manually submit the form with the fingerprint included
//                 registerForm.submit();
//             });
//         });
//     }
// });
