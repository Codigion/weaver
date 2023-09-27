<h1 id='demo-pdf-html'>Welcome to Lab Page</h1>



<!-- Demonstration: Libraries/PDF.js -->
<!-- Master JS Required for loadScripts() below -->
<script src="<?= Generic::baseURL(); ?>/Assets/JS/Master.js"></script>

<a href="#!" onclick="generatePDF()">Generate PDF</a>
<script>
    function generatePDF() {
        loadScripts(['<?= Generic::baseURL(); ?>/Libraries/PDF.js'])
            .then(function() {
                //generate([<HTML_CONTAINER_ID>], [<OUTPUT_PDF_FILENAME>])
                new PDF().generate('demo-pdf-html', 'Demo.pdf');
            })
            .catch(function(error) {
                console.error('Error loading scripts:', error);
            });
    }
</script>
<!--./Demonstration: Libraries/PDF.js-->