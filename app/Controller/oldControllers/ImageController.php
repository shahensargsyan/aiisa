<?php

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * @package       app.Controller
 */
class ImageController extends AppController{

    var $name = 'Image';

    public function beforeFilter(){
        parent::beforeFilter();
    }

    public function imageUpload(){
        $this->layout = false;

        $result = array();
        $dataToSave = array();

        $temp_file = $_FILES['qqfile']['tmp_name'];
        $old_name = $_FILES['qqfile']['name'];
        //  $folder_name = $_REQUEST['folder_name'];
        if(isset($_REQUEST['field'])){
            $field = $_REQUEST['field'];
        }
        if(isset($_REQUEST['company_id'])){
            $company_id = $_REQUEST['company_id'];
        }

        if(isset($_REQUEST['path'])){
            $dir = $_REQUEST['path'];
            $dir = str_replace(',', DS, $dir);
            $this->createPaths($dir);

            $upload_path = ROOT . DS . $dir;

            $target_filepath = $upload_path . DS . $old_name;
            $ext = pathinfo($target_filepath, PATHINFO_EXTENSION);

            if(isset($_REQUEST['file_name'])){
                $new_name = $_REQUEST['file_name'] . '.' . $ext;
            }else{
                $new_name = md5(microtime()) . '.' . $ext;
            }
            $moved = move_uploaded_file($temp_file, $upload_path . DS . $new_name);
            if($moved){
                list($w, $h) = getimagesize($upload_path . DS . $new_name);
                $result['success'] = true;
                $result['message'] = 'Upload successful.';
                $result['width'] = $w;
                $result['height'] = $h;
                $result['file'] = $new_name;
                // $result['webpath'] = FULL_BASE_URL . '/system/' . $folder_name . '/' . $new_name;
            }else{
                $result['success'] = false;
            }
        }
        echo json_encode($result);
        die;
    }

    public function documentUpload(){
        $this->layout = false;

        $result = array();
        $dataToSave = array();

        $temp_file = $_FILES['qqfile']['tmp_name'];
        $old_name = $_FILES['qqfile']['name'];
       // $contract_id = $_REQUEST['contract_id'];
        if(isset($_REQUEST['field'])){
            $field = $_REQUEST['field'];
        }
        if(isset($_REQUEST['company_id'])){
            $company_id = $_REQUEST['company_id'];
        }

        if(isset($_REQUEST['path'])){
            $dir = $_REQUEST['path'];
            $dir = str_replace(',', DS, $dir);
            $this->createPaths($dir);

            $upload_path = ROOT . DS . $dir;

            $target_filepath = $upload_path . DS . $old_name;
            $ext = pathinfo($target_filepath, PATHINFO_EXTENSION);

            if(isset($_REQUEST['file_name'])){
                $new_name = $_REQUEST['file_name'] . '.' . $ext;
            }else{
                $new_name = md5(microtime()) . '.' . $ext;
            }
            $moved = move_uploaded_file($temp_file, $upload_path . DS . $new_name);
            if($moved){
                $result['success'] = true;
                $result['message'] = 'Upload successful.';
                $result['file'] = $new_name;
//                $this->loadModel('Contract');
//                $this->Contract->id = $contract_id;
//                $data['document'] = $new_name;
//                $bool = $this->Contract->save($data);
             }else{
                $result['success'] = false;
              }
        }
        echo json_encode($result);
        die;
    }
    
    public function createPaths($dir){
        $explode = explode(DS, $dir);
        if(count($explode) > 0){
            $count = count($explode) + 1;
            for($i = 0; $i < $count; $i++){
                $folder = implode(DS, array_slice($explode, 0, $i));
                if(!file_exists(ROOT . DS . $folder)){
                    mkdir(ROOT . DS . $folder, 0777, true);
                }
            }
        }
    }

    public function deleteUpload(){
        $a = $this->request->data;
        $old_name = $_FILES['qqfile']['name'];
        var_dump($old_name);
        die;
    }

    protected function parseImage($ext, $img, $file = null){
        switch($ext){
            case "png":
                imagepng($img, ($file != null ? $file : ''));
                break;
            case "jpeg":
                imagejpeg($img, ($file ? $file : ''), 90);
                break;
            case "jpg":
                imagejpeg($img, ($file ? $file : ''), 90);
                break;
            case "gif":
                imagegif($img, ($file ? $file : ''));
                break;
        }
    }

    protected function setTransparency($imgSrc, $imgDest, $ext){
        if($ext == "png" || $ext == "gif"){
            $trnprt_indx = imagecolortransparent($imgSrc);
            // If we have a specific transparent color
            if($trnprt_indx >= 0){
                // Get the original image's transparent color's RGB values
                $trnprt_color = imagecolorsforindex($imgSrc, $trnprt_indx);
                // Allocate the same color in the new image resource
                $trnprt_indx = imagecolorallocate($imgDest, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
                // Completely fill the background of the new image with allocated color.
                imagefill($imgDest, 0, 0, $trnprt_indx);
                // Set the background color for new image to transparent
                imagecolortransparent($imgDest, $trnprt_indx);
            }
            // Always make a transparent background color for PNGs that don't have one allocated already
            elseif($ext == "png"){
                // Turn off transparency blending (temporarily)
                imagealphablending($imgDest, true);
                // Create a new transparent color for image
                $color = imagecolorallocatealpha($imgDest, 0, 0, 0, 127);
                // Completely fill the background of the new image with allocated color.
                imagefill($imgDest, 0, 0, $color);
                // Restore transparency blending
                imagesavealpha($imgDest, true);
            }
        }
    }

    protected function returnCorrectFunction($ext){
        $function = "";
        switch($ext){
            case "png":
                $function = "imagecreatefrompng";
                break;
            case "jpeg":
                $function = "imagecreatefromjpeg";
                break;
            case "jpg":
                $function = "imagecreatefromjpeg";
                break;
            case "gif":
                $function = "imagecreatefromgif";
                break;
        }
        return $function;
    }

    public function resizeCrop($name, $folder_name){
        //var_dump($_POST);die;
        // var_dump($name, $_POST["imageSource"]);die;
        $imageToDel = $_POST["imageSource"];
        list($width, $height) = getimagesize($_POST["imageSource"]);
        $viewPortW = $_POST["viewPortW"];
        $viewPortH = $_POST["viewPortH"];
        $pWidth = $_POST["imageW"];
        $pHeight = $_POST["imageH"];
        $ext = end(explode(".", $_POST["imageSource"]));
        $ext = strtolower($ext);
        $function = $this->returnCorrectFunction($ext);
        $image = $function($_POST["imageSource"]);

        if(!$image){
            //Not valid image
        }
        $width = imagesx($image);
        $height = imagesy($image);
        // Resample
        $image_p = imagecreatetruecolor($pWidth, $pHeight);
        $this->setTransparency($image, $image_p, $ext);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $pWidth, $pHeight, $width, $height);
        imagedestroy($image);
        $widthR = imagesx($image_p);
        $hegihtR = imagesy($image_p);
        $selectorX = $_POST["selectorX"];
        $selectorY = $_POST["selectorY"];
        if($_POST["imageRotate"]){
            $angle = 360 - $_POST["imageRotate"];
            $image_p = imagerotate($image_p, $angle, 0);

            $pWidth = imagesx($image_p);
            $pHeight = imagesy($image_p);

            //print $pWidth."---".$pHeight;

            $diffW = abs($pWidth - $widthR) / 2;
            $diffH = abs($pHeight - $hegihtR) / 2;

            $_POST["imageX"] = ($pWidth > $widthR ? $_POST["imageX"] - $diffW : $_POST["imageX"] + $diffW);
            $_POST["imageY"] = ($pHeight > $hegihtR ? $_POST["imageY"] - $diffH : $_POST["imageY"] + $diffH);
        }
        $dst_x = $src_x = $dst_y = $src_y = 0;

        if($_POST["imageX"] > 0){
            $dst_x = abs($_POST["imageX"]);
        }else{
            $src_x = abs($_POST["imageX"]);
        }
        if($_POST["imageY"] > 0){
            $dst_y = abs($_POST["imageY"]);
        }else{
            $src_y = abs($_POST["imageY"]);
        }


        $viewport = imagecreatetruecolor($_POST["viewPortW"], $_POST["viewPortH"]);
        $this->setTransparency($image_p, $viewport, $ext);

        imagecopy($viewport, $image_p, $dst_x, $dst_y, $src_x, $src_y, $pWidth, $pHeight);
        imagedestroy($image_p);


        $selector = imagecreatetruecolor($_POST["selectorW"], $_POST["selectorH"]);
        $this->setTransparency($viewport, $selector, $ext);
        imagecopy($selector, $viewport, 0, 0, $selectorX, $selectorY, $_POST["viewPortW"], $_POST["viewPortH"]);
        $filname = $name . '.' . $ext;
        $file = WWW_ROOT . 'system' . DS . $folder_name . DS . 'resized' . DS . $name;
        // $f_unlink = WWW_ROOT . 'system' . DS . $folder_name . DS . $name;
        $this->parseImage($ext, $selector, $file);
        //  unlink($f_unlink);
        imagedestroy($viewport);
//        $user = $this->User->findByid($this->u_id);
//        if(file_exists(WWW_ROOT . 'system' . DS . $folder_name . DS . $user['User']['image'])){
//            @unlink(WWW_ROOT . 'system' . DS . $folder_name . DS . $user['User']['image']);
//        }
//        $user['User']['image'] = $name;
//        unset($user['User']['created']);
//        unset($user['User']['modified']);
//        $this->User->save($user);
//        if(file_exists($imageToDel) && !strpos($imageToDel, 'default.jpg')){
//            @unlink($imageToDel);
//        }
        // $this->Dashboard->generateDashboard();
        //Return value
        echo $name;
        exit;
    }

}
