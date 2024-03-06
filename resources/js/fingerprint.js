// fingerprint.js
document.addEventListener("DOMContentLoaded", function() {
    var fingerprintField = document.getElementById('fingerprint');

    if (fingerprintField) {
        // Use FingerPrint.js to generate the fingerprint
        new Fingerprint2().get(function(result) {
            fingerprintField.value = result;
        });
    }
});
