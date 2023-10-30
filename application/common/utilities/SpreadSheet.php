<?php
namespace App\common\utilities;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

defined('BASEPATH') OR exit('No direct script access allowed');
define('TRANSFER_NAME','Phí chuyển đất %s lên %s thời hạn 50 năm');
define('STATE_SHEET_HIDDEN','hidden');
require_once (FCPATH.'/application/common/libs/PhpSpreadsheet/src/Bootstrap.php');
class SpreadSheet extends \PhpOffice\PhpSpreadsheet\Spreadsheet {
    static protected $_instance = NULL;

    /**
     * Use singleton pattern
     *
     * @return SpreadSheet object
     */
    static public  function getInstance(){
        if (self::$_instance === NULL) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }
    private $objSpreadSheet ;

    public static function readOneSheet($filePath,$comments = FALSE,$formatData = FALSE,$calculate = TRUE)
    {
        try {
            $res = array();
            $objReader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($filePath);

            /**
             * @var $objReader \PhpOffice\PhpSpreadsheet\Reader\BaseReader
             */
            $objReader->setReadDataOnly(false);
            $spreadSheet  = $objReader->load($filePath);
            $objWorksheet = $spreadSheet->getSheet(0);
            $res['data'] =   $objWorksheet->toArray(null,$calculate,$formatData,FALSE);
            if($comments === TRUE){
                $res['comments'] = self::getComments($objWorksheet);
            }
            return $res;

        } catch (Exception $e) {
            die($e->getMessage());
        } catch (Exception $e) {
        }

    }
    public static function getComments($objWorksheet){
        /**
         * @var $objWorksheet \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet
         */
        $comments =  $objWorksheet->getComments();
        $datas = array();
        foreach ($comments as $cell => $objComment){
            $rowIndex = $objWorksheet->getCell($cell)->getRow();
            $column = $objWorksheet->getCell($cell)->getColumn();
            $columnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($column);
            $datas[] = array(
                'row'      => $rowIndex-1,
                'col'      => $columnIndex-1,
                'comment'   => [
                    'value' => $objComment->getText()->getPlainText()
                ]

            );
        }
        return $datas;
    }
    public static function updateComments($filePath,$dataComments,$editor = ''){
        try {
            $objPHPExcel = self::readSheet($filePath);
            $sheet = $objPHPExcel->getSheet(0);
            $comments = $sheet->getComments();
            self::setBgComment($comments);

            foreach ($dataComments as $comment){
                $row = $comment[0] + 1;
                $colIndex = $comment[1] +1;
                $value = isset($comment[2])? $comment[2] : '';
                $newComment = $sheet->getCommentByColumnAndRow($colIndex,$row)->getText()->getRichTextElements();
                if(empty($newComment) || count($newComment)< 2){
                    $sheet->getCommentByColumnAndRow($colIndex,$row)->getText()->createTextRun($value);
                }
                if(!empty($newComment)){
                    foreach ($newComment as $index=> $obj){
                        $obj->setText($editor);
                        if($index === 0){
                            $obj->setText(sprintf("Chỉnh sửa bởi %s \r\n",$editor));
                        }else{
                            $obj->setText($value);
                        }
                    };
                }
            };
            self::saveFile($objPHPExcel,$filePath);
            return TRUE;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    private static function setBgComment($comments){
        /**
         * @var $objComment \PhpOffice\PhpSpreadsheet\Comment
         */
        foreach ($comments as $objComment){
            $objComment->getFillColor()->setRGB('ffffe1');
        }
    }
    public static function readSheet($filePath){
        $objReader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($filePath);
        /**
         * @var $objReader \PhpOffice\PhpSpreadsheet\Reader\BaseReader
         */
        $objReader->setReadDataOnly(false);
        $spreadSheet  = $objReader->load($filePath);
        return $spreadSheet;
    }
    public static function updateCell($filePath,$dataCells){
        try {
            $spreadSheet = self::readSheet($filePath);
            $sheet = $spreadSheet->getSheet(0);
            foreach ($dataCells as $cell){
                /**
                 * @var $cell[0] => row
                 * @var $cell[1] => colum
                 * @var $cell[3] => cell value old
                 * @var $cell[4] => cell value new
                 */
                $row = $cell[0] + 1;
                $column = $cell[1] +1;
                $value = $cell[3];
                $sheet->setCellValueByColumnAndRow($column,$row,$value);
                $sheet->getStyleByColumnAndRow($column,$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            }
            $comments = $sheet->getComments();
            self::setBgComment($comments);
            self::saveFile($spreadSheet,$filePath);
            return TRUE;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param $spreadSheet
     * @param $filePath
     * @param string $writerType
     * @return mixed
     */
    public static function saveFile($spreadSheet, $filePath ,$writerType = 'Xlsx')
    {
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadSheet, $writerType );
        $writer->save($filePath);
        return TRUE;
    }

    /**
     * @param $filePath
     * @param int $sheetActiveIndex
     * @return string
     */
    public static function getHtml($filePath,$sheetActiveIndex = 0){
        try {
            $objReader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($filePath);
            /**
             * @var $objReader \PhpOffice\PhpSpreadsheet\Reader\BaseReader
             */
            $objReader->setReadDataOnly(false);
            $spreadSheet  = $objReader->load($filePath);
            /**
             *  get so sheet co tren file (bao gom sheet hidden)
             */
            $numberSheetActive = [];
            $numberSheet = $spreadSheet->getSheetCount();
            for ($i = 0; $i < $numberSheet; $i++){
                $stateSheet = $spreadSheet->getSheet($i)->getSheetState();
                if($stateSheet !== STATE_SHEET_HIDDEN){
                    $numberSheetActive[] = $i;
                }
            };
            /**
             * @var $objWriter \PhpOffice\PhpSpreadsheet\Writer\Html
             */
            $objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadSheet, 'Html');
            /*set index sheet generate html*/
            $objWriter->setSheetIndex($numberSheetActive[$sheetActiveIndex]);
            return $objWriter->generateSheetData();
        } catch (Exception $e) {
            die($e->getMessage());
        }

    }
    public static function readAllSheet($filePath)
    {
        try {
            $objReader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($filePath);
            /**
             * @var $objReader \PHPExcel_Reader_Abstract
             */
            $objReader->setReadDataOnly(true);
            $spreadSheet = $objReader->load($filePath);
            $sheets      = $spreadSheet->getAllSheets();
            $sheetArr    = [];
            foreach ($sheets as $sheetIndex => $s) {
                $sheetArr[$sheetIndex] = $s->toArray();
            }

            return $sheetArr;

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public  function setAutoSize($header,$startCol = 'A')
    {
        $count = count($header);
        for ($i = 0; $i < $count; $i++) {
            $this->getActiveSheet()->getStyle($startCol)->getAlignment()->setWrapText(true);
            $this->getActiveSheet()->getColumnDimension($startCol)->setAutoSize(true);
            $startCol++;
        }
        return $startCol;
    }
    public function calculateEndCol($header,$startCol = 'A'){
        $count = count($header);
        for ($i = 0; $i < $count; $i++) {
            $startCol++;

        }
        return $startCol;
    }
    public function setAllBorder($end_col,$data){
        $styleArray = array(
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        );
        $start_col = 'A3';
        $count_data = count($data);
        $end_col = $end_col.($count_data+3);// ghi du lieu bat dau tu co A3
        $pos = sprintf('%s:%s',$start_col,$end_col);
        $this->getActiveSheet()->getStyle($pos)->applyFromArray($styleArray);
        return $this;
    }
    function setBoldHeader($startCol = 'B',$endCol = ''){
        $rows = sprintf('%s:%s',$startCol,$endCol);
        $this->getActiveSheet()->getStyle($rows)->getFont()->setBold(TRUE);
        return $this;
    }

    public function saveToFile($data,$title,$fileName){
        $sheet = $this->setActiveSheetIndex(0);
        $sheet->setTitle($title);
        $sheet->fromArray($data, NULL, 'A3');
        $this->createdFile($fileName);
        return TRUE;
    }
    public function createdFile($filename,$download = TRUE, $PHPExcel = NULL)
    {
        if ($PHPExcel == NULL){ $PHPExcel = $this; }
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($PHPExcel, 'Xlsx');
        if($download){
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="'.$filename);
            header('Cache-Control: max-age=0');
            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($PHPExcel, 'Xlsx');
            $writer->save('php://output');
        }else{
            $path = FCPATH.'uploads/excel/';
            $writer->save($path.$filename);
        }
    }
    public function exportFile($filePath,$dataCells){
        try {
            $objPHPExcel = self::readSheet($filePath);
            $sheet = $objPHPExcel->getSheet(0);
            if(!empty($dataCells)){
                foreach ($dataCells as $cell){
                    /**
                     * @var $cell[0] => row
                     * @var $cell[1] => colum
                     * @var $cell[3] => cell value old
                     * @var $cell[4] => cell value new
                     */
                    $row = $cell[0] + 1;
                    $column = $cell[1] +1;
                    $value = $cell[3];
                    $sheet->setCellValueByColumnAndRow($column,$row,$value);
                    $sheet->getStyleByColumnAndRow($column,$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                }
            }
            if($filePath === FCPATH.TEMPLATE_THE_TEXT_CLCL){
                $fileName = sprintf('%s_%s.xlsx','clcl',time());
                $newPathFile = FCPATH.UPLOAD_THE_TEXT_ESTATES_DIR.$fileName;
            }else{
                $newPathFile = $filePath;
            }
            self::saveFile($objPHPExcel,$newPathFile);
            return $newPathFile;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    /*set data file tempate tính gia so bo*/
    public function setDataFilePreliminaryPrice($datas ,$pathFile,$dataTransfer){
        $this->objSpreadSheet = self::readSheet($pathFile);
        $sheet = $this->objSpreadSheet ->getSheet(0);
        $arrFormatPercent = [
            'E29','F29','G29','E54','F54','G54'
        ];
        $sheet->getDefaultRowDimension()->setVisible(false);
        if(!empty($datas)){
            foreach ($datas as $data){
                foreach ($data as $cell => $v){
                    $sheet->setCellValue($cell,$v);
                    if($cell == 'E3' || $cell == 'F3' || $cell == 'G3'){
                        $sheet->getCell($cell)->getHyperlink()->setUrl($v);
                    }
                    if(in_array($cell,$arrFormatPercent)){
                        $sheet->getStyle($cell)->getNumberFormat()->applyFromArray(
                            array(
                                'formatCode' => \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE_00
                            )
                        );
                    }
                    $sheet->getStyle($cell)->getAlignment()->setWrapText(true);
                    $sheet->getStyle($cell)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                }
            }

        }
        /*set thong tin chuyen loai dat*/
        self::setDataTransfer($sheet,$dataTransfer);
        return $this;

    }
    public function setDataTransfer($sheet,$dataTransfer){
        foreach ($dataTransfer as$index=> $transfer){
            $cell = sprintf('B%s',$index);
            $nameTransfer = explode('->',$transfer);
            $name = sprintf(TRANSFER_NAME,$nameTransfer[0],$nameTransfer[1]);
            /**
             * @var $sheet \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet
             */
            $sheet->setCellValue($cell,$name);
            $sheet->getStyle($cell)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        }
    }
    public function generateFilPreliminaryPrice(){
        $fileName = sprintf('%s%s.xlsx','bang_tinh_gia_so_bo_',time());
        $newPathFile = UPLOAD_THE_TEXT_ESTATES_GSB_DIR.$fileName;
        self::saveFile($this->objSpreadSheet,FCPATH.$newPathFile);
        return $newPathFile;
    }
    public function setDataCell(){

    }
    public function generateHtml($filePath,$sheetIndex =0){
        try {
            $objReader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($filePath);
            /**
             * @var $objReader \PhpOffice\PhpSpreadsheet\Reader\BaseReader
             */
            $objReader->setReadDataOnly(false);
            $spreadSheet  = $objReader->load($filePath);
            $numberSheetActive = [];
            $numberSheet = $spreadSheet->getSheetCount();
            for ($i = 0; $i < $numberSheet; $i++){
                $stateSheet = $spreadSheet->getSheet($i)->getSheetState();
                if($stateSheet !== STATE_SHEET_HIDDEN){
                    $numberSheetActive[] = $i;
                }
            };
            $table =  "<table style='width:100%;border: 6px #000000 solid;text-align: center'>";
            foreach ($spreadSheet->setActiveSheetIndex($numberSheetActive[$sheetIndex])->getRowIterator() as $row) {
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);
                $table .= '<tr>';
                foreach ($cellIterator as $cell) {
                    if (!is_null($cell)) {
                        $value = $cell->getCalculatedValue();
                        $table.= sprintf('<td>%s </td>',$value);
                    }
                }
                $table .=  '</tr>';
            }
            return $table;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}