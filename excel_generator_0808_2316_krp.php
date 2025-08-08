<?php
// 代码生成时间: 2025-08-08 23:16:10
class ExcelGenerator extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load the necessary libraries
        $this->load->library('excel');
    }

    /**
     * Generate an Excel file with the provided data.
     *
     * @param array $data Array of data to be written to the Excel file.
     * @param string $filename The name of the Excel file to be generated.
     * @return void
     */
    public function generate($data, $filename = 'export') {
        if (empty($data)) {
            // Handle the error when no data is provided
            log_message('error', 'No data provided to generate Excel file.');
            show_error('No data available to generate the Excel file.', 500);
            return;
        }

        // Set the file name and path
        $file_path = './uploads/' . $filename . '.xlsx';

        // Create a new PHPExcel object
        $objPHPExcel = new PHPExcel();

        // Set active sheet index to the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        // Add data to the Excel file
        $this->addDataToSheet($objPHPExcel, $data);

        // Save the Excel file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        if (!$objWriter->save($file_path)) {
            // Handle the error when the file cannot be saved
            log_message('error', 'Failed to save Excel file.');
            show_error('Failed to generate the Excel file.', 500);
            return;
        }

        // Set the response header to download the file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        readfile($file_path);
    }

    /**
     * Add data to the active sheet of the Excel file.
     *
     * @param PHPExcel $objPHPExcel The PHPExcel object to which data will be added.
     * @param array $data The data to be added to the Excel file.
     * @return void
     */
    private function addDataToSheet($objPHPExcel, $data) {
        $row = 1;
        foreach ($data as $key => $value) {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $key);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $value);
            $row++;
        }
    }
}
