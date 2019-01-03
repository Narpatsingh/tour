<?php
App::import('Vendor', 'PhpExcel', array('file' => 'Classes/PHPExcel.php'));

class ExcelComponent extends Component
{
    public $controller;

    function initialize(Controller $controller)
    {
        $this->controller = $controller;
    }

    /**
     * Function used for exporting excel file , Require data as array for exporting
     * @param array $data
     * @param string $fileName
     * @throws PHPExcel_Exception
     * @throws PHPExcel_Reader_Exception
     */
    function export($data = array(), $fileName = 'Exportfile')
    {
        $objPHPExcel = new PHPExcel();
        // Set the active Excel worksheet to sheet 0
        $objPHPExcel->setActiveSheetIndex(0);
        // Initialise the Excel row number

        $objPHPExcel->getActiveSheet()->fromArray($data, NULL, 'A1');
        //Set Auto Width of Column
        foreach (range('A', $objPHPExcel->getActiveSheet()->getHighestDataColumn()) as $col) {
            $objPHPExcel->getActiveSheet()
                ->getColumnDimension($col)
                ->setAutoSize(true);
        }

// Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $fileName . '.xls"');
        header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }


}
