<?php
namespace app\common\components;
use app\common\utilities\Common;
use CI_Upload;
class Upload
{
    public static function deletePhysicFile($filePath)
    {
        if ($filePath && file_exists(FCPATH . $filePath)) {
            unlink(FCPATH . $filePath);
        }
    }
    public static function isEmpty($attributeName){
        $fileObj = self::getFileObjByAttributeName($attributeName);
        $isEmpty = true;
        if(is_array($fileObj) && isset($fileObj[0]) && isset($fileObj[0]['tmp_name']) && !empty($fileObj[0]['tmp_name'])){
            $isEmpty = false;
        }
        elseif (isset($fileObj['tmp_name']) && !empty($fileObj['tmp_name'])) {
            $isEmpty = false;
        }
        return $isEmpty;
    }

    public static function getFileObjByAttributeName($attributeName=null){
        $fileObj = array();
        $newFileObj = array();
        if($_FILES){
            if($attributeName==null){
                foreach($_FILES as $fileIndex => $fileData){
                    $fileObj = $fileData;
                }
            }elseif(isset($_FILES[$attributeName])){
                $fileObj = $_FILES[$attributeName];
                foreach ($fileObj as $key => $val) {
                    if (is_array($val) && isset($val[0])) {
                        foreach ($val as $index => $v){
                            if(isset($v)){
                                $newFileObj[$index][$key] = $v;
                            }
                        }
                        $fileObj = $newFileObj;
                    }
                }
            }else{
                foreach($_FILES as $modelName => $fileData){
                    $fileObj['name'] = $fileData['name'][$attributeName];// ten file upload
                    $fileObj['type'] = $fileData['type'][$attributeName];// kieu file upload
                    $fileObj['tmp_name'] = $fileData['tmp_name'][$attributeName];//duong dan den file upload ở client
                    $fileObj['error'] = $fileData['error'][$attributeName];//trang thai file upload, 0 => ko loi
                    $fileObj['size'] = $fileData['size'][$attributeName];// kich thuoc file upload
                }
            }
        }
        return $fileObj;
    }
    /**
     * upload image file to upload folder
     * @param string $fileAttributeName: attribute of file model
     * @param string $dirUpload: upload dir
     * @param string $thumbSize: thumbnail size, format 'widthxheigh'
     * @param bool|true $require: require upload or not
     * @param array $allowExtension: allow extension <default all image>
     * @return array $data: information after upload
     */

    public static function uploadFile($fileAttributeName=null, $dirUpload = UPLOAD_BASE_DIR, $thumbSize=null, $require = true, $allowExtension = array()){
        $fileObj = self::getFileObjByAttributeName($fileAttributeName);
        $data = self::_doUploadFile($fileObj,$dirUpload,$thumbSize,$require,$allowExtension);
        return $data;
    }
    private static function _doUploadFile($fileObj, $dirUpload = UPLOAD_BASE_DIR, $thumbSize=null, $require = true, $allowExtension = array()){
        $data = array();
        if ($fileObj) {
            $fileName       = uniqid() . '_' . time();
            if ($fileObj["error"] > 0) {
                if ($fileObj["error"] == 1) {
                    $data['error']   = 1;
                    $data['message'] =  'File có kích thước lớn';
                } elseif ($require && $fileObj["error"] == 4) {
                    $data['error']   = 4;
                    $data['message'] =  'Chọn file';
                }
            } else {
                if(!$allowExtension){
                    $imageInfo = self::image_get_info($fileObj['tmp_name']);
                    $extension = $imageInfo['extension'];
                    $extension = strtolower($extension);
                }else{
                    $array = explode('.', $fileObj['name']);
                    $extension = end($array);
                    $extension = strtolower($extension);
                    if(!in_array($extension, $allowExtension)){
                        $extension = '';
                    }
                }
                if ($extension) {
                    $extension = strtolower($extension);
                    $uploadFolder = UPLOAD_BASE_DIR.$dirUpload;
                    $fileNameWithExt = $fileName . '.' . $extension;
                    if (!file_exists($uploadFolder)) {
                        self::mkdirs($uploadFolder);
                    }
                    if (move_uploaded_file($fileObj["tmp_name"], $uploadFolder.$fileNameWithExt)) {
                        $data['error']             = 0;
                        $data['file_path']         = $dirUpload.$fileNameWithExt;
                        $data['original_filename'] = $fileObj['name'];
                        $data['name']              = str_replace('.' . $extension, '', $fileObj['name']);
                        $data['message']           = "";

//                        if($thumbSize){
//                            $thumbnailFolder = UPLOAD_BASE_DIR . UPLOAD_THUMBNAIL_FOLDER.$dirUpload;
//                            if (!file_exists($thumbnailFolder)) {
//                                self::mkdirs($thumbnailFolder);
//                            }
//                            self::resize_image_IM($uploadFolder.$fileNameWithExt, $thumbnailFolder . $fileNameWithExt, $thumbSize);
//                        }

                    } else {
                        $data['error']   = 9;
                        $data['message'] ='Upload file lỗi';
                    }
                } else {
                    $data = $fileObj;
                    $data['error']   = 10;
                    $data['message'] =  'Chỉ hộ trợ file ảnh';
                }

            }
        }
        return $data;
    }
    public static function uploadMultipleFile($fileObj, $dirUpload = UPLOAD_BASE_DIR, $thumbSize=null, $require = true, $allowExtension = array()){
        $data = self::_doUploadFile($fileObj,$dirUpload,$thumbSize,$require,$allowExtension);
        return $data;
    }
    public static function image_get_info($file){
        if (!is_file($file)) {
            return FALSE;
        }
        $details   = FALSE;

        $data      = @getimagesize($file);

        $file_size = @filesize($file);

        if (isset($data) && is_array($data)) {
            $extensions = array(
                '1' => 'gif',
                '2' => 'jpg',
                '3' => 'png'
            );
            $extension  = array_key_exists($data[2], $extensions) ? $extensions[$data[2]] : '';
            $details    = array(
                'width'     => $data[0],
                'height'    => $data[1],
                'extension' => $extension,
                'file_size' => $file_size,
                'mime_type' => $data['mime']
            );
        }

        return $details;
    }

    /**
     * create dir and sub dir
     *
     * @param string $dir
     * @param int $mode
     * @param bool $recursive
     * @return bool
     */
    public static function mkdirs($dir, $mode = 0777, $recursive = true)
    {
        if (is_null($dir) || $dir === "") {
            return FALSE;
        }
        if (is_dir($dir) || $dir === "/") {
            return TRUE;
        }
        if (self::mkdirs(dirname($dir), $mode, $recursive)) {
            return mkdir($dir, $mode);
        }
        return FALSE;
    }


//    public static function resize_image_IM($sourceImagePath, $thumbnailPath = NULL, $thumbSize = UPLOAD_THUMB_SIZE){
//        $imageMagickPath = isset(Yii::$app->params['image_magick_path']) ? Yii::$app->params['image_magick_path'] : 'convert';
//        //$cmd  = $imageMagickPath ." " . $sourceImagePath . " -resize " . $thumbSize . "^ -gravity center -extent " . $thumbSize . " " . $thumbnailPath;
//        $cmd  = $imageMagickPath ." " . $sourceImagePath . " -resize " . $thumbSize . "^ -gravity center " . $thumbnailPath;
//        $ret = system($cmd);
//        return $ret;
//    }
}