<?php

namespace App\Repositories;

use GuzzleHttp\Client;


class Outcomes extends GuzzleHttpRequest{

    
    //buscar periodo
    public function buscarperiodo() {
  
        return $this->get("api/v1/accounts/1/terms?per_page=100&page=1");
        
    }
    //buscar id  de la actividad de un curso 
    public function buscarcurso($enrollment_term_id) {
        //https://sanignaciouniversity.instructure.com/api/v1/accounts/1/courses?enrollment_term_id=189&include[]=total_students&include[]=term
        return $this->get("api/v1/accounts/1/courses?enrollment_term_id={$enrollment_term_id}&include[]=total_students&include[]=term&per_page=100&page=1");
    
    }

    //buscar la rubrica del curso por usuario
    public function buscaridactividad($courses_id) {

        return $this->get("api/v1/courses/{$courses_id}/assignments?per_page=100&page=1");
        
    }

    //buscar la rubrica del curso por usuario
    public function listsrubrica($courseid,$actividadid) {
        return $this->get("api/v1/courses/{$courseid}/assignments/{$actividadid}/submissions?per_page=100&include[]=rubric_assessment&include[]=assignment&include[]=course&include[]=user");
        
    }

    //buscar la curso en canvas
    public function cursobusqueda($courseid) {
        return $this->get("api/v1/courses/{$courseid}");
    }




}