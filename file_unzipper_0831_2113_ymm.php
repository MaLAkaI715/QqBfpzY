<?php
// 代码生成时间: 2025-08-31 21:13:18
class FileUnzipper {

    /**
     * Unzips a given zip file to a specified directory.
     *
     * @param string $zipFilePath Path to the zip file.
     * @param string $destinationPath Path to the destination directory.
     * @return bool Returns true on success, false on failure.
     */
    public function unzipFile($zipFilePath, $destinationPath) {
        // Check if the zip file exists
        if (!file_exists($zipFilePath)) {
            log_message('error', 'The zip file does not exist.');
            return false;
        }

        // Create the destination directory if it doesn't exist
        if (!is_dir($destinationPath)) {
            if (!mkdir($destinationPath, 0777, true)) {
                log_message('error', 'Failed to create the destination directory.');
                return false;
            }
        }

        // Unzip the file
        if (!$this-> unzip($zipFilePath, $destinationPath)) {
            log_message('error', 'Failed to unzip the file.');
            return false;
        }

        return true;
    }

    /**
     * Helper function to unzip a file using the ZipArchive class.
     *
     * @param string $zipFilePath Path to the zip file.
     * @param string $destinationPath Path to the destination directory.
     * @return bool Returns true on success, false on failure.
     */
    private function unzip($zipFilePath, $destinationPath) {
        $zip = new ZipArchive;

        if ($zip->open($zipFilePath) === TRUE) {
            $zip->extractTo($destinationPath);
            $zip->close();
            return true;
        } else {
            return false;
        }
    }
}
