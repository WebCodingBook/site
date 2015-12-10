<?php
namespace WebCoding\Services;

use Image;

class ImageResize
{
    protected $path;
    protected $files = [];

    /**
     * ImageResize constructor.
     * @param $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Prépare le terrain avec le ou les fichiers et le nom de base
     *
     * @param $file
     * @param $name
     * @return $this
     */
    public function prepare($file, $name)
    {
        if( is_array($file) ) {
            $countFiles = count($file);
            foreach( $file as $f ) {
                $fileName = str_slug($name) . '-' . ($countFiles + 1) . '-' . str_random(40) .  '.' . $f->getClientOriginalExtension();
                $f->move($this->path, $fileName);
                $this->files[] = [
                    'name'      =>  $fileName,
                    'position'  =>  $countFiles + 1,
                ];
            }
        } else {
            $fileName = str_slug($name) . '.' . str_random(40) . '-' . $file->getClientOriginalExtension();
            $file->move($this->path, $fileName);
            $this->files[] = [
                'name'      =>  $fileName,
                'position'  =>  1
            ];
        }
        return $this;
    }

    /**
     * Redimensionne la ou les images selon les paramètres
     *
     * @param $width
     * @param $height
     * @param string $folder
     * @return $this
     */
    public function resize($width, $height, $folder = 'thumbs')
    {
        foreach( $this->files as $file ) {
            $img = Image::make($this->path . DIRECTORY_SEPARATOR . $file['name']);
            $img->resize($width, $height);
            $img->save($this->path . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $file['name']);
        }
        return $this;
    }

    /**
     * Enregistre la ou les images en base de donnée
     *
     * @param $model
     * @param $relation
     * @return bool
     */
    public function saveDatabase($model, $relation)
    {
        if( !is_int($relation) ) {
            return false;
        }

        foreach( $this->files as $file ) {
            $save = new $model();
            $save->create([
                'name'          =>  $file['name'],
                'image_id'      =>  $relation,
                'image_type'    =>  get_class($save),
                'position'      =>  $file['position']
            ]);
        }

        return true;
    }
}