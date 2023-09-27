<?php

/**
 * FileOperation Class
 *
 * The FileOperation class provides methods for compressing and resizing images.
 */
class FileOperation
{
    /**
     * Compress and save an image.
     *
     * @param string $inputFile  Path to the input image file.
     * @param string $outputFile Path to the output compressed image file.
     * @param int    $quality    Compression quality (0-100), where 100 is the best quality.
     *
     * @throws Exception When an unsupported image type is encountered.
     */
    public function compressImage($inputFile, $outputFile, $quality = 80)
    {
        try {
            list($width, $height) = getimagesize($inputFile);
            $image = imagecreatetruecolor($width, $height);

            switch (exif_imagetype($inputFile)) {
                case IMAGETYPE_JPEG:
                    $source = imagecreatefromjpeg($inputFile);
                    break;
                case IMAGETYPE_PNG:
                    $source = imagecreatefrompng($inputFile);
                    break;
                case IMAGETYPE_GIF:
                    $source = imagecreatefromgif($inputFile);
                    break;
                default:
                    throw new Exception_('Unsupported image type');
            }

            imagecopyresampled($image, $source, 0, 0, 0, 0, $width, $height, $width, $height);

            imagejpeg($image, $outputFile, $quality);
            imagedestroy($image);
        } catch (Exception_ $e) {
            System::displayErrorPage($e);
        }
    }

    /**
     * Resize and save an image to a specific size.
     *
     * @param string $inputFile  Path to the input image file.
     * @param string $outputFile Path to the output resized image file.
     * @param int    $newWidth   New width for the resized image.
     * @param int    $newHeight  New height for the resized image.
     * @param int    $quality    Compression quality (0-100), where 100 is the best quality.
     *
     * @throws Exception When an unsupported image type is encountered.
     */
    public function resizeImage($inputFile, $outputFile, $newWidth, $newHeight, $quality = 80)
    {
        try {
            list($width, $height) = getimagesize($inputFile);
            $image = imagecreatetruecolor($newWidth, $newHeight);

            switch (exif_imagetype($inputFile)) {
                case IMAGETYPE_JPEG:
                    $source = imagecreatefromjpeg($inputFile);
                    break;
                case IMAGETYPE_PNG:
                    $source = imagecreatefrompng($inputFile);
                    break;
                case IMAGETYPE_GIF:
                    $source = imagecreatefromgif($inputFile);
                    break;
                default:
                    throw new Exception_('Unsupported image type');
            }

            imagecopyresampled($image, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

            imagejpeg($image, $outputFile, $quality);
            imagedestroy($image);
        } catch (Exception_ $e) {
            System::displayErrorPage($e);
        }
    }
}
