<?php


namespace app\models;


use yii\base\Model;
use yii\web\UploadedFile;

class UploadImg extends Model
{
    public $image;


    public function rules(){
        return[
            [['image'], 'file', 'extensions' => 'gif'],
        ];
    }

//    public function upload(){
//        if($this->validate()){
//            $this->image->saveAs("img/src/{$this->image->baseName}.{$this->image->extension}");
//
//        }else{
//            return false;
//        }
//    }
}