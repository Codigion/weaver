/**
 * Master JS
 * 
 * Class Index:
 *  HTTP
 *      bindAjax
 *      ajaxRequest
 *  TimeDate
 *      formatTime
 *      formatDate
 *      formatDatetime
 *  Generic
 *      getRandomString
 *      getRandomNumber
 *      baseURL
 * 
 * Global Functions Index:
 *  loadScripts
 */






/**
 * HTTP Class
 *
 * Provides methods for making AJAX requests and binding them to button clicks.
 */
class HTTP {

    /**
     * Binds an AJAX request to a button click event.
     *
     * @param {object} params - An object containing parameters for the AJAX request.
     * @param {string} params.btnID - The ID of the button element that triggers the AJAX request.
     * @param {string} params.formID - The ID of the form to be submitted in the AJAX request.
     * @param {string} params.extraParameters - Extra parameters to be included in the AJAX request, if any.
     * @param {string} params.controllerRoute - The server file and action that handles the AJAX request.
     * @param {function} params.callbackFunction - A callback function to be executed after a successful AJAX request.
     * @param {string} params.loadingID - The ID of the loading element (e.g., a spinner) to display during the AJAX request.
     * @param {string} params.responseID - The ID of the element where the server response will be displayed.
     * @param {boolean} params.formRefresh - Whether to reset the form after a successful AJAX request (default is true).
     */
    bindAjax(params) {
        document.getElementById(params.btnID).addEventListener("click", function (e) {
            e.preventDefault();

            new HTTP().ajaxRequest(
                params.formID,
                params.extraParameters,
                params.controllerRoute,
                params.callbackFunction,
                params.loadingID,
                params.responseID,
                params.formRefresh
            );
        });
    }



    /**
     * Asynchronous Server Request
     *
     * @param {string} formID - Form ID of the form to be submitted.
     * @param {string} extraParameters - Extra parameters (e.g., "TYPE=GET&EVENT=READ_FILE").
     * @param {string} filePath - Server file that handles the request.
     * @param {function} returnFunction - Callback function to be called after success.
     * @param {string} loadingImageID - Loading Image ID for loading effect.
     * @param {string} serverResponseID - Server Response ID for displaying server response.
     * @param {boolean} formReset - Whether to reset the form after success (default is true).
     */
    ajaxRequest(
        formID,
        extraParameters,
        filePath,
        returnFunction,
        loadingImageID,
        serverResponseID,
        formReset = true
    ) {
        // Check if required parameters are missing
        if (!filePath) {
            console.error("#Error: Server controller is undefined.");
            return;
        }

        // Set default values for loadingImageID and serverResponseID
        loadingImageID = loadingImageID || "loading-image";
        serverResponseID = serverResponseID || "server-response";

        // Initialize formData
        let formData;

        if (formID) {
            formData = new FormData(document.getElementById(formID));
        } else {
            formData = new FormData();
        }

        // Parse and append extraParameters
        if (extraParameters) {
            const params = extraParameters.split("&");
            for (const param of params) {
                const [key, value] = param.split("=");
                formData.append(key, value);
            }
        }

        // Show loading image
        const loadingImage = document.getElementById(loadingImageID);
        if (loadingImage) loadingImage.style.display = "block";

        // Create and send AJAX request
        const xhr = new XMLHttpRequest();
        xhr.open("POST", filePath, true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Handle success
                const response = JSON.parse(xhr.responseText);
                if (!response.err) {
                    if (returnFunction) returnFunction(response);

                    // Reset the form if formReset is true
                    if (formID && formReset) {
                        document.getElementById(formID).reset();
                    }

                    // Display server response with proper escaping
                    const responseElement = document.getElementById(serverResponseID);
                    if (responseElement) {
                        responseElement.textContent = response.msg; // Use textContent for escaping
                    }
                } else {
                    // Handle error
                    if (returnFunction) returnFunction(response);

                    // Display error message with proper escaping
                    const errorElement = document.getElementById(serverResponseID);
                    if (errorElement) {
                        errorElement.textContent = response.msg; // Use textContent for escaping
                    }
                }
            } else {
                // Handle AJAX error with proper escaping
                const errorElement = document.getElementById(serverResponseID);
                if (errorElement) {
                    errorElement.textContent = "#Error: " + xhr.statusText; // Use textContent for escaping
                }
            }

            // Hide loading image
            if (loadingImage) loadingImage.style.display = "none";
        };
        xhr.onerror = function () {
            // Handle network error with proper escaping
            const errorElement = document.getElementById(serverResponseID);
            if (errorElement) {
                errorElement.textContent = "#Error: Network Error"; // Use textContent for escaping
            }

            // Hide loading image
            if (loadingImage) loadingImage.style.display = "none";
        };
        xhr.send(formData);
    };
}



/**
 * TimeDate Class
 *
 * Provides methods for formatting time, dates, and datetimes.
 */
class TimeDate {
    /**
     * Format a time string.
     *
     * @param {string} time The time string in HH:MM format.
     * @return {string} The formatted time string with AM/PM.
     */
    formatTime(time) {
        const timeComponents = time.split(':');
        const hours = parseInt(timeComponents[0], 10);
        const minutes = timeComponents[1];
        const amPm = hours >= 12 ? 'PM' : 'AM';

        // Convert to 12-hour format
        const formattedHours = hours % 12 === 0 ? 12 : hours % 12;

        return `${formattedHours}:${minutes} ${amPm}`;
    }

    /**
     * Format a date string in "YYYY-MM-DD" format to "DD/MM/YYYY" format.
     *
     * @param {string} inputDate The input date in "YYYY-MM-DD" format.
     * @return {string} The formatted date in "DD/MM/YYYY" format.
     */
    formatDate(inputDate) {
        const dateComponents = inputDate.split('-');
        if (dateComponents.length === 3) {
            const year = dateComponents[0];
            const month = dateComponents[1];
            const day = dateComponents[2];
            return `${day}/${month}/${year}`;
        } else {
            return 'Invalid date';
        }
    }

    /**
     * Format a datetime string.
     *
     * @param {string} datetime The datetime string.
     * @return {string} The formatted datetime string in "D - d M, Y  H:i" format.
     */
    formatDatetime(datetime) {
        const dateObj = new Date(datetime);
        if (!isNaN(dateObj.getTime())) {
            const options = {
                weekday: 'short',
                day: 'numeric',
                month: 'short',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
            };
            return dateObj.toLocaleDateString('en-US', options);
        } else {
            return 'Invalid date';
        }
    }
}


/**
 * Generic Class
 *
 * Provides utility methods for loading script dynamically, generating random strings, numbers, and working with URLs.
 */
class Generic {
    /**
     * Generate a random string.
     *
     * @param {number} length The length of the random string.
     * @returns {string} The generated random string.
     */
    static getRandomString(length = 5) {
        const characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        let randomString = '';

        for (let i = 0; i < length; i++) {
            const randomIndex = Math.floor(Math.random() * characters.length);
            randomString += characters.charAt(randomIndex);
        }

        return randomString;
    }

    /**
     * Generate a random number.
     *
     * @param {number} length The length of the random number.
     * @returns {string} The generated random number.
     */
    static getRandomNumber(length = 5) {
        const characters = '0123456789';
        let randomNumber = '';

        for (let i = 0; i < length; i++) {
            const randomIndex = Math.floor(Math.random() * characters.length);
            randomNumber += characters.charAt(randomIndex);
        }

        return randomNumber;
    }

    /**
     * Get the base URL of the current page.
     *
     * @returns {string} The base URL of the current page.
     */
    static baseURL() {
        const protocol = window.location.protocol;
        const host = window.location.host;
        const script = window.location.pathname;

        // Remove the script name from the URL
        const baseUrl = `${protocol}//${host}${script.substring(0, script.lastIndexOf('/'))}`;

        return baseUrl;
    }
}









/**
 * Global Functions
 */

/**
 * Dynamically load multiple scripts in a specified order and return a Promise
 * that resolves when all scripts are loaded successfully.
 *
 * @param {string[]} scriptUrls - An array of script URLs to load.
 * @returns {Promise} - A Promise that resolves when all scripts are loaded.
 */
window.loadScripts = function (scriptUrls) {
    return new Promise(function (resolve, reject) {
        var loadedScripts = 0;

        function loadScript(url) {
            var script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = url;

            script.onload = function () {
                loadedScripts++;
                if (loadedScripts === scriptUrls.length) {
                    resolve();
                }
            };

            script.onerror = function (error) {
                reject(error);
            };

            document.head.appendChild(script);
        }

        if (scriptUrls.length === 0) {
            // No scripts to load, resolve immediately
            resolve();
        } else {
            // Load each script in order
            for (var i = 0; i < scriptUrls.length; i++) {
                loadScript(scriptUrls[i]);
            }
        }
    });
}

/**
 * Dynamically load multiple stylesheets in a specified order and return a Promise
 * that resolves when all stylesheets are loaded successfully.
 *
 * @param {string[]} styleUrls - An array of stylesheet URLs to load.
 * @returns {Promise} - A Promise that resolves when all stylesheets are loaded.
 */
window.loadStyles = function (styleUrls) {
    return new Promise(function (resolve, reject) {
        var loadedStyles = 0;

        function loadStyle(url) {
            var link = document.createElement('link');
            link.rel = 'stylesheet';
            link.href = url;

            link.onload = function () {
                loadedStyles++;
                if (loadedStyles === styleUrls.length) {
                    resolve();
                }
            };

            link.onerror = function (error) {
                reject(error);
            };

            document.head.appendChild(link);
        }

        if (styleUrls.length === 0) {
            // No stylesheets to load, resolve immediately
            resolve();
        } else {
            // Load each stylesheet in order
            for (var i = 0; i < styleUrls.length; i++) {
                loadStyle(styleUrls[i]);
            }
        }
    });
}
