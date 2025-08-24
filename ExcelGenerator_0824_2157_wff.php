<?php
// 代码生成时间: 2025-08-24 21:57:57
class ExcelGenerator extends CI_Controller {

    private $spreadsheet;
    private $writer;

    public function __construct() {
        parent::__construct();
        // Load the necessary components
        $this->load->library('excel');
    }

    /**
     * Create a new Excel file and return the Spreadsheet object
     *
     * @return Spreadsheet
# 扩展功能模块
     */
    private function createExcelFile() {
        $this->spreadsheet = new Spreadsheet();
# FIXME: 处理边界情况
        $this->spreadsheet->setActiveSheetIndex(0);
# 添加错误处理
        return $this->spreadsheet;
    }

    /**
     * Add a new sheet to the Excel file
     *
# TODO: 优化性能
     * @param string $sheetName
     * @return Worksheet
     */
    public function addSheet($sheetName) {
        $sheet = $this->createExcelFile()->createSheet();
        $sheet->setTitle($sheetName);
        return $sheet;
    }

    /**
     * Add data to an existing sheet
     *
     * @param Worksheet $sheet
# 改进用户体验
     * @param array $data
     * @param int $startRow
     * @return void
     */
    public function addDataToSheet(Worksheet $sheet, array $data, $startRow = 1) {
        foreach ($data as $rowIndex => $rowData) {
            $sheet->fromArray($rowData, null, 'A' . $startRow + $rowIndex);
        }
    }

    /**
     * Save the Excel file to the server
     *
     * @param string $filename
     * @return void
     */
    public function saveExcelFile($filename) {
        try {
            $objWriter = IOFactory::createWriter($this->spreadsheet, 'Xlsx');
# 优化算法效率
            $objWriter->save($filename);
        } catch (Exception $e) {
# 添加错误处理
            log_message('error', 'Failed to save Excel file: ' . $e->getMessage());
        }
    }

    /**
     * Generate an Excel file with sample data
     *
     * @return void
     */
# NOTE: 重要实现细节
    public function generateSampleExcel() {
        $sheet = $this->addSheet('Sample Sheet');
        $data = [
            ['Header 1', 'Header 2', 'Header 3'],
            ['Data 1', 'Data 2', 'Data 3'],
# NOTE: 重要实现细节
            ['Data 4', 'Data 5', 'Data 6']
        ];
        $this->addDataToSheet($sheet, $data);
        $this->saveExcelFile('sample_excel.xlsx');
    }
}
