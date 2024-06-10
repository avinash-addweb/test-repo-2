<?php 

namespace App\Http\Traits;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use App\Models\MediaUpload;
use Carbon\Carbon;
trait FileUpload
{
    /**
     * @method used for direct upload media into the media_uploads folder using direct file uploads
     * 
     */

    public function uploadMedia(array|UploadedFile $uploadedFile, $module = null, $folder = null, $filename = null, $model_id = null, $model_name = null, $media_for_attribute = null)
    {
        if (!empty($uploadedFile)) {
            $files = [];
            if (!empty($uploadedFile) && is_array($uploadedFile)) {
                //if the multiple files uploaded
                foreach($uploadedFile as $uploadedFileKey => $uploadedFileItem){
                    if ($uploadedFileItem instanceof UploadedFile) {
                        $files[] = $this->uploadMediaFile($uploadedFileItem, $module, $folder, $filename, $model_id = null, $model_name = null, $media_for_attribute = null);
                    }
                }
            } elseif ($uploadedFile instanceof UploadedFile) {
                //if the single file uploaded
                $files[] = $this->uploadMediaFile($uploadedFile, $module, $folder, $filename);
            }
            if(!empty($files) && count($files)>0) {
                $storeFile = $this->storeUploadedMedia($files);
                $storedFiles = \array_map(function($lf){ return $lf['path'].DIRECTORY_SEPARATOR.$lf['name'];},$files);
                return (count($storedFiles)==1) ? \current($storedFiles) : $storedFiles;
            }
        }
        return false;
    }

    private function uploadMediaFile(UploadedFile $uploadedFile, $module = null, $folder = null, $filename = null, $model_id = null, $model_name = null, $media_for_attribute = null)
    {
        $name = !empty($filename) ? $filename :  Carbon::now()->format('YmdHisA').Str::random(25);
        $media_type = $uploadedFile->getMimeType();
        $media_ext = strtolower($uploadedFile->getClientOriginalExtension());
        $media_name = $name.'.'.$media_ext;
        $module_path = ($module?DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.$module:'');
        $folder_path = ($folder?DIRECTORY_SEPARATOR.((empty($module))?'general'.DIRECTORY_SEPARATOR.$folder:$folder):'');
        $media_path = config('constants.media_upload_path').$module_path.$folder_path;
        $file = $uploadedFile->storeAs($media_path, $media_name, 'public');
        //chmod(public_path('storage/'.$media_path.DIRECTORY_SEPARATOR), 777);
        
        $storeMedia = [
            'name' => $media_name,
            'path' => $media_path,
            'module' => $module,
            'media_type' => $media_type,
            'media_ext' => $media_ext,
            'media_for_attribute' => $media_for_attribute,
            'model_name' => $model_name,
            'model_id' => $model_id
        ];
        return $storeMedia;
    }

    private function storeUploadedMedia($mediaData = []) {
        return !empty($mediaData) ? MediaUpload::insert($mediaData) : false;
    }

    /**
     * @method used for file manager upload media into the media_uploads folder using file manager plugin
     * 
     * $media_path : abc/xyz.jpg or abc/xyz.jpg,abc/pqr.jpg
     * $media_for_attribute : 'logo'
     * $model_id : pk of the specific model
     * $model_name : /App/Models/Abc
     * 
     */
    public function saveMediaItem($media_path, $model_id, $model_name, $media_for_attribute, $module="")
    {
        if (!empty($media_path)) {
            $mediaData = [];
            $mediaRecords = (str_contains($media_path,',')) ? explode(',', $media_path) : [$media_path];
            if (!empty($mediaRecords)) {
                foreach ($mediaRecords as $mediaRecord) {
                    if (!empty($mediaRecord)) {
                        $mediaRecord = (\strtolower(\str_replace(\Illuminate\Support\Facades\URL::to('/').DIRECTORY_SEPARATOR,"",$mediaRecord)));
                        $media_name = basename($mediaRecord);
                        $media_path = dirname($mediaRecord); 
                        $media_type = @\File::mimeType(public_path('storage'.DIRECTORY_SEPARATOR.$mediaRecord));
                        $media_ext = @\File::extension(public_path('storage'.DIRECTORY_SEPARATOR.$mediaRecord));
                        $mediaData[] = [
                            'name' => $media_name,
                            'path' => $media_path,
                            'module' => $module,
                            'media_type' => $media_type,
                            'media_ext' => $media_ext,
                            'media_for_attribute' => $media_for_attribute,
                            'model_name' => $model_name,
                            'model_id' => $model_id
                        ];
                    }
                }
                return $this->storeUploadedMedia($mediaData);
            }
        }
        return false;
    }
}