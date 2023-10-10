<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use App\Repositories\Outcomes;

use Illuminate\Support\Facades\DB;

class OutcomesController extends Controller
{
    protected $outcomes;

    public function __construct(Outcomes $outcomes)
    {
        $this->outcomes = $outcomes;

    }

    public function index()
    {

      $listaperiodos = $this->outcomes->buscarperiodo();
      $todosperiodos = array($listaperiodos);
      return view('admin/outcomes',  compact('todosperiodos'));
      
    }

    public function listarcursos(Request $request)
    {
      $listacursos = $this->outcomes->buscarcurso($request->selectPeriodo);
      $todoscursos = json_encode($listacursos);
      return $todoscursos;

    }
    
    public function assigmentdetalle($courseId,$assigmentId)
    {

          $resultados = array();
          //$rubricas = $this->listarsrubrica($courseId, $assigmentId);
          //dd($courseId, $assigmentId);


          try {
            $rubricas = $this->listarsrubrica($courseId, $assigmentId);
          } catch (\Exception $e) {
            $rubricas =  [];
          }
         //dd($rubricas);

          if (count($rubricas) > 0) {

            foreach ($rubricas as $rubrica) {

              $resultado = array();
              $coursename = $rubrica->course->name;
              $coursecode = $rubrica->course->course_code;
              $userid = $rubrica->user_id;
              $username = $rubrica->user->name;
              $userlogin = $rubrica->user->login_id;
              $assigmentid = $rubrica->assignment->id;
              $assigmentname = $rubrica->assignment->name;
  
                  $rubricAssessmentData = [];
                  $sumaPuntos = 0;
                  for($i = 1; $i<=5; $i++){
                    $resultado['rubricPoints_'.$i] ="";
                  }
                  // Verifica si rubric_assessment existe antes de intentar recorrerlo
                    if (isset($rubrica->rubric_assessment)) {
                      $i=0;
                      foreach ($rubrica->rubric_assessment as $rubricId => $rubricData) {
                        $i++;
                        $points = isset($rubricData->points) ? $rubricData->points : 0;
                        $resultado['rubricPoints_'.$i] =$points;
                        $sumaPuntos += $points;
                      }
  
                    }
  
  
                    if ($sumaPuntos >= 81 && $sumaPuntos <= 100 || $rubrica->score >= 81 && $rubrica->score <= 100) {
                    $categoria = "Exceeds Mastery";
                    } elseif ($sumaPuntos >= 61 && $sumaPuntos <= 80 || $rubrica->score >= 61 && $rubrica->score <= 89 ) {
                    $categoria = "Mastery";
                    } elseif ($sumaPuntos >= 41 && $sumaPuntos <= 60 || $rubrica->score >= 41 && $rubrica->score <= 60 ) {
                    $categoria = "Near Mastery";
                    } elseif ($sumaPuntos >= 21 && $sumaPuntos <= 40 || $rubrica->score >= 21 && $rubrica->score <= 40 ) {
                    $categoria = "Below Mastery";
                    } elseif ($sumaPuntos >= 0 && $sumaPuntos <= 20 || $rubrica->score >= 0 && $rubrica->score <= 20 ) {
                    $categoria = "Well Below Mastery";
                    } else {
                    $categoria = "Categoría no válida";
                    }
                    
  
              $grade = isset($rubrica->grade) ? $rubrica->grade : 0;
              $score = isset($rubrica->score) ? $rubrica->score : 0;
        
              
              $resultado['coursename'] = $coursename;
              $resultado['userid'] = $userid;
              $resultado['grade'] = $grade;
              $resultado['score'] = $score;
              $resultado['username'] = $username;
              $resultado['userlogin'] = $userlogin;
              $resultado['assigmentid'] = $assigmentid;
              $resultado['assigmentname'] = $assigmentname;
              $resultado['categoria'] =$categoria;
              $resultado['sumaPuntos'] =$sumaPuntos;
  
              //dd($assigmentname);

              //$assigmentname buscar el numero 2;
              if (preg_match('/(\d+)/', $assigmentname, $matches)) {
                $numero = (int)$matches[0];
              } else {
                $numero = 0;
              }

              $valor = 0; 

              if (preg_match('/Assignment/i', $assigmentname)) {
                  $valor = 1;
              } elseif (preg_match('/Discusión/i', $assigmentname)) {
                  $valor = 2;
              } elseif (preg_match('/Exam/i', $assigmentname)) {
                  $valor = 3;
              }else{
                  $valor = 0;
              }

  
             // dd($tipoactividad);  // 7

              $resultados3 = array();
              $buscarcanvasg = $this->outcomes->cursobusqueda($courseId);
  
  
              $buscarbasedatos = DB::select("SELECT 
              oc.id AS course_id, 
              oc.curso, 
              oc.short_name AS short_name,
              ot.id AS task_id, 
              ot.actividad_id AS actividad_id, 
              oa.nombre AS nombre, 
              oa.formato AS formato, 
              ot.tarea, 
              ot.T1,
              ot.T2,
              ot.T3,
              ot.T4,
              ot.T5,
              ot.T6,
              ot.T7,
              ot.T8,
              ot.T9,
              ot.T10,
              CASE WHEN ot.T1 = 1 THEN oc.descrip1 ELSE 'No' END AS dest1,
              CASE WHEN ot.T2 = 1 THEN oc.descrip2 ELSE 'No' END AS dest2,
              CASE WHEN ot.T3 = 1 THEN oc.descrip3 ELSE 'No' END AS dest3,
              CASE WHEN ot.T4 = 1 THEN oc.descrip4 ELSE 'No' END AS dest4,
              CASE WHEN ot.T5 = 1 THEN oc.descrip5 ELSE 'No' END AS dest5,
              CASE WHEN ot.T6 = 1 THEN oc.descrip6 ELSE 'No' END AS dest6,
              CASE WHEN ot.T7 = 1 THEN oc.descrip7 ELSE 'No' END AS dest7,
              CASE WHEN ot.T8 = 1 THEN oc.descrip8 ELSE 'No' END AS dest8,
              CASE WHEN ot.T9 = 1 THEN oc.descrip9 ELSE 'No' END AS dest9,
              CASE WHEN ot.T10 = 1 THEN oc.descrip10 ELSE 'No' END AS dest10
              FROM outcomes_courses oc
              INNER JOIN outcomes_tasks ot ON oc.id = ot.curso_id
              INNER JOIN outcomes_activities oa ON oa.id = ot.actividad_id
              WHERE oc.short_name = '{$buscarcanvasg->course_code}' AND ot.tarea = '{$numero}' AND  ot.actividad_id = '{$valor}'");

  
              if (empty($buscarbasedatos)) {
                $resultados3['buscarbasedatos'] = "No se encontraron resultados de Outcomes";

                $resultados3['elementocurso'] ="";
                $resultados3['elementoshortname'] = "";
                $resultados3['elementotask_id'] =  "";
                $resultados3['elementotasktarea'] =  "";
                $resultados3['elementot1'] =  "";
                $resultados3['elementot2'] =  "";
                $resultados3['elementot3'] =  "";
                $resultados3['elementot4'] =  "";
                $resultados3['elementot5'] =  "";
                $resultados3['elementot6'] =  "";
                $resultados3['elementot7'] =  "";
                $resultados3['elementot8'] =  "";
                $resultados3['elementot9'] =  "";
                $resultados3['elementot10'] =  "";

                $resultados3['elementot1d'] =  "";
                $resultados3['elementot2d'] =  "";
                $resultados3['elementot3d'] =  "";
                $resultados3['elementot4d'] =  "";
                $resultados3['elementot5d'] =  "";
                $resultados3['elementot6d'] =  "";
                $resultados3['elementot7d'] =  "";
                $resultados3['elementot8d'] =  "";
                $resultados3['elementot9d'] =  "";
                $resultados3['elementot10d'] =  "";

                $resultados3['actividad_id'] =  "";
                $resultados3['actividad_nombre'] = "";
              }else{
  
                  $elemento = $buscarbasedatos[0];

                    $resultados3['elementocurso'] = $elemento->curso;
                    $resultados3['elementoshortname'] = $elemento->short_name;
                    $resultados3['elementotask_id'] =  $elemento->task_id;
                    $resultados3['elementotasktarea'] =  $elemento->tarea;
                    $resultados3['elementot1'] =  $elemento->T1;
                    $resultados3['elementot2'] =  $elemento->T2;
                    $resultados3['elementot3'] =  $elemento->T3;
                    $resultados3['elementot4'] =  $elemento->T4;
                    $resultados3['elementot5'] =  $elemento->T5;
                    $resultados3['elementot6'] =  $elemento->T6;
                    $resultados3['elementot7'] =  $elemento->T7;
                    $resultados3['elementot8'] =  $elemento->T8;
                    $resultados3['elementot9'] =  $elemento->T9;
                    $resultados3['elementot10'] =  $elemento->T10;
  

                    $resultados3['elementot1d'] =  $elemento->dest1;
                    $resultados3['elementot2d'] =  $elemento->dest2;
                    $resultados3['elementot3d'] =  $elemento->dest3;

                    $resultados3['elementot4d'] =  $elemento->dest4;
                    $resultados3['elementot5d'] =  $elemento->dest5;
                    $resultados3['elementot6d'] =  $elemento->dest6;

                    $resultados3['elementot7d'] =  $elemento->dest7;
                    $resultados3['elementot8d'] =  $elemento->dest8;
                    $resultados3['elementot9d'] =  $elemento->dest9;

                    $resultados3['elementot10d'] =  $elemento->dest10;
  
                    $resultados3['actividad_id'] =  $elemento->actividad_id;
                    $resultados3['actividad_nombre'] =  $elemento->nombre;
  
              
              }                        
  
              $resultado = array_merge($resultado, $resultados3);
              $resultados[] = $resultado;
            }
  
            $result['rubricas'] = $resultados;
            // dd($resultados);
  
            return view('admin/listarstudents', ['resultados' => $resultados]);

          }


    }


    public function listarsrubrica($courseid, $actividadid)
    {
        $listarubrica = $this->outcomes->listsrubrica($courseid, $actividadid); // Usar $courseid y $actividadid aquí
        $todorubrica = json_decode(json_encode($listarubrica));
       //dd($todorubrica);
        return $todorubrica;
    }

    public function prueba()
    {
      return view('admin/prueba');

    }

    public function assigmentxcourse($course){

      $listatareas = $this->outcomes->buscaridactividad($course);
      $todostareas = json_decode(json_encode($listatareas));

      //dd($todostareas);

      if (empty($todostareas)) {
        $mensaje = "No hay tareas disponibles.";
        return view('admin/listassigment', compact('mensaje'));
      }

      else{

        foreach ($todostareas as $item) {
          $resultado = array();

          $courseid = $item->course_id;
          $tareaid = $item->id;
          $tareadue_at = $item->due_at;
          $tareaunlock_at = $item->unlock_at;
          $tareaname = $item->name;
          $tareaworkflow_state = $item->workflow_state;

          if (isset($item->rubric_settings)) {
            $rubricSettings = $item->rubric_settings;
            } else {
            $rubricSettings = 0; 
            }
          
          $resultado['courseid'] = $courseid;
          $resultado['tareaid'] = $tareaid;
          $resultado['tareadue_at'] = $tareadue_at;
          $resultado['tareaunlock_at'] = $tareaunlock_at;
          $resultado['tareaname'] = $tareaname;
          $resultado['tareaworkflow_state'] = $tareaworkflow_state;
          $resultado['rubricSettings'] = $rubricSettings;

          $resultados[] = $resultado;
          
        }

       // dd($resultado);

    
        return view('admin/listassigment', ['resultados' => $resultados]);



      }


    }





}
