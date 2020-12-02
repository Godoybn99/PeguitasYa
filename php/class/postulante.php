<?php
include_once "php/db.php";
include "php/db.php";


    class Postulante {        
        
        public $idTrabajo;
        private $idUsuario;
        private $years;
        private $city;
        private $nWorks;
        private $speciality;
        private $studies;
        public $score;


        public function _construct($idT, $idU, $year, $cit, $wor, $esp, $stu, $sco){

            $this->idTrabajo = $idT;
            $this->idUsuario = $idU;
            $this->years = $year;
            $this->city = $cit;
            $this->nWorks = $wor;
            $this->speciality = $esp;
            $this->studies = $stu;
            $this->score = $sco;

        }

        
        public function setIdUsuario($idU){

            $this->idUsuario = $idU;

        }


        public function getIdUsuario(){

            return $this->idUsuario;

        }
        
        
        public function setYears($year){

            $this->years = $year;

        }


        public function getYears(){

            return $this->years;

        }
        
        
        public function setCity($cit){

            $this->city = $cit;

        }


        public function getCity(){

            return $this->city;

        }
        public function setNWork($wor){

            $this->nWorks = $wor;

        }


        public function getNWork(){

            return $this->nWorks;

        }
        

        public function setSpeciality($esp){

            $this->speciality = $esp;

        }
        
        
        public function getSpeciality(){

            return $this->speciality;

        }


        public function setStudy($stu){

            $this->studies = $stu;

        }
        
        
        public function getStudies(){

            return $this->studies;

        }


        public function setScore($sco){

            $this->score = $sco;

        }
        
        
        public function getScore(){

            return $this->score;

        }


        public function insertarPostulante($idT, $idU, $year, $cit, $wor, $esp, $stu, $sco){

            $insertPost = "INSERT INTO postulacion (idTrabajo, idUsuario, years, city, nWorks, specialty, studies, score) VALUES ('$idT', $idU, $year, $cit, $wor, $esp, $stu, $sco )";
            return $insertPost;

        }
    }
?>