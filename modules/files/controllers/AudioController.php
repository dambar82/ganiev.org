<?php

namespace app\modules\files\controllers;

use app\helpers\admin\AdminHelper;
use yii\base\DynamicModel;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\UploadedFile;
use Yii;

class AudioController extends Controller
{

    public function actionUpload()
    {
        if (Yii::$app->request->isAjax) {

            $files = [];

            foreach ($_FILES as $key => $m_file) { //key - это название модели
                $files = UploadedFile::getInstancesByName($key);

                foreach ($files as $file) {
                    if ($file->error === UPLOAD_ERR_OK) {
                        if ($file->type == 'audio/mp3') {
                            $filename = md5($file->baseName . $file->tempName) . '.' . $file->extension;
                            $file->saveAs('files/audio/' . $filename);
                            return json_encode($filename);
                        }
                        else {
                            return json_encode(['error' => 'Файл не поддерживается']);
                        }
                    }
                }
            }

            //return json_encode($files);

        }
        //return NULL;

    }

}
