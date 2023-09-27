<?php
/**
 * Weaver Framework - Base Controller Class
 *
 * This class provides common functionality for handling views and data in controllers.
 */

class Controller
{
    /**
     * Render a layout with optional data.
     *
     * @param string $layoutName The name of the layout view file to render.
     * @param array $data        Optional data to pass to the layout.
     * @return void
     */
    protected function layout($layoutName, $data = [])
    {
        try {
            // Extract data to make it accessible in the layout
            extract($data);

            // Check if the layout view file exists before including it
            $viewFile = "Views/Layout/$layoutName.php";
            if (file_exists($viewFile)) {
                require_once $viewFile;
            } else {
                // Handle the case where the layout view file does not exist
                throw new Exception_("Layout view file not found: $layoutName.php");
            }
        } catch (Exception_ $e) {
            System::displayErrorPage($e);
        }
    }

    /**
     * Render a view with optional data.
     *
     * @param string $viewName The name of the view file to render.
     * @param array $data      Optional data to pass to the view.
     * @return void
     */
    protected function view($viewName, $data = [])
    {
        try {
            // Extract data to make it accessible in the view
            extract($data);

            // Check if the view file exists before including it
            $viewFile = "Views/$viewName.php";
            if (file_exists($viewFile)) {
                require_once $viewFile;
            } else {
                // Handle the case where the view file does not exist
                throw new Exception_("View file not found: $viewName.php");
            }
        } catch (Exception_ $e) {
            System::displayErrorPage($e);
        }
    }
}
