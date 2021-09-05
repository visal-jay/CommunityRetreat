<?php

/**
 * Class for processing uploaded files as images 
 * Validates for file type, file size
 * */
class Image
{
    private $target_dir ="Uploads/";
    private $file_path = "";

    public function __construct(string $file_name, string $file_path ,string $upload_name, bool $overwrite=false)
    {
        $this->file_name = $file_name;

        $this->file_path = $this->target_dir . $file_path . $file_name . "." .  pathinfo($_FILES[$upload_name]["name"], PATHINFO_EXTENSION);

        $file_ext = strtolower(pathinfo($this->file_path, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES[$upload_name]["tmp_name"]);

        if ($check == false) {
            throw new Exception("File is not an image.");
        }

        if (file_exists($this->file_path) && $overwrite==false) {
            throw new  Exception("Sorry, file already exists.");
        }

        if ($_FILES[$upload_name]["size"] > 10000000) {
            throw new  Exception("Sorry, your file is too large.");
        }

        if (!in_array(trim(strtolower($file_ext)), array("jpg", "png", "jpeg", "gif"))) {
            throw new  Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        }

        if (move_uploaded_file($_FILES[$upload_name]["tmp_name"], $this->file_path)) {
            // File has been successfully uploaded and moved
        } else {
            // file move has failed
            throw new  Exception("Sorry, there was an error uploading your file.");
        }
    }

    public function getURL()
    {
        return "/" . $this->file_path;
    }

    public function __toString()
    {
        return $this->getURL();
    }
}
