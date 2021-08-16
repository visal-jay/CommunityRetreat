<?php 
class Controller
{
    function HomePage()
    {
        
        $model = new Model();
        $data = [
            'name'    => 'Dave',
            'colours' => ['red', 'green', 'blue'],
            'persons' => $model -> getPersons()
        ];
        
        View::render("homepage", $data);
    }

   
}