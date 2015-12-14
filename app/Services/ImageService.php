<?php
namespace WebCoding\Services;

use Image;

class ImageService
{
    private $path;
    private $files = [];

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
            $countFiles = 0;
            foreach( $file as $f ) {
                $fileName = str_slug($name) . '-' . ($countFiles + 1) . '-' . str_random(10) .  '.' . $f->getClientOriginalExtension();
                $f->move($this->path . DIRECTORY_SEPARATOR . 'full', $fileName);
                $this->setFile([
                    'name'      =>  $fileName,
                    'position'  =>  $countFiles + 1,
                ]);
                $countFiles++;
            }
        } else {
            $fileName = str_slug($name) . '-' . str_random(10) . '.' . $file->getClientOriginalExtension();
            $file->move($this->path . DIRECTORY_SEPARATOR . 'full', $fileName);
            $this->setFile([
                'name'      =>  $fileName,
                'position'  =>  1
            ]);
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
    public function resize($width, $height, $folder = 'thumb')
    {
        foreach( $this->getFiles() as $file ) {
            $img = Image::make($this->path . DIRECTORY_SEPARATOR . 'full' . DIRECTORY_SEPARATOR . $file['name']);
            $img->resize($width, $height);
            $img->save($this->path . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $file['name']);
        }
        return $this;
    }

    public function getFile($key)
    {
        return $this->files[$key];
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

        foreach( $this->getFiles() as $file ) {
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

    public function delete($picture, $paths = [])
    {
        foreach($paths as $path) {
            if( is_file($this->path . '/' . $path . '/' . $picture) ) {
                unlink($this->path . '/' . $path . '/' . $picture);
            }
        }
    }

    /**
     * Retourne le tableau des fichiers
     *
     * @return array
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * Rajoute un fichier à la liste
     *
     * @param $file
     */
    public function setFile($file)
    {
        if( is_array($file) ) {
            $this->files[] = $file;
        }
    }
}