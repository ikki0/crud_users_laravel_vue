<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/** MODELO / CLASE CURSO -> ATRIBUTOS Y FUNCIONES  */

class Curso extends Model
{
    use HasFactory;

    public $table = 'cursos';
    protected $fillable = array('*');

    public function estudiantes(){
      return $this->belongsToMany(Estudiante::class, 'curso_estudiante');
    }
}
