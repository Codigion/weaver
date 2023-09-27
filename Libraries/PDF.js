class PDF {
    /**
     * Generate a PDF from HTML content and initiate the download.
     *
     * @param {string} htmlContainerID - The ID of the HTML container element to capture.
     * @param {string} filename - The desired filename for the downloaded PDF.
     */
    generate(htmlContainerID, filename) {
        // Check if the HTML container element with the provided ID exists
        var containerElement = document.getElementById(htmlContainerID);

        if (!containerElement) {
            console.error('Error: HTML container element with ID ' + htmlContainerID + ' not found.');
            return; // Exit the function if the element doesn't exist
        }

        var scriptUrls = [
            'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js',
            'https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js'
        ];

        loadScripts(scriptUrls)
            .then(function () {
                // Convert HTML to an image using html2canvas
                html2canvas(containerElement, {
                    useCORS: true, // Enable CORS if your HTML content is from a different origin
                })
                    .then(function (canvas) {
                        var imageData = canvas.toDataURL('image/png');

                        // Define the PDF document structure
                        var docDefinition = {
                            content: [
                                {
                                    text: '',
                                    fontSize: 16,
                                    alignment: 'center',
                                    margin: [0, 0, 0, 20],
                                },
                                {
                                    image: imageData, // Embed the HTML content as an image
                                    width: 500, // Set the width of the image as needed
                                },
                            ],
                        };

                        // Generate the PDF and initiate the download
                        pdfMake.createPdf(docDefinition).download(filename);
                    })
                    .catch(function (error) {
                        console.error('Error converting HTML to image:', error);
                    });
            })
            .catch(function (error) {
                console.error('Error loading scripts:', error);
            });
    }
}
