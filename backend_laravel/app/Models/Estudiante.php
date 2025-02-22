<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/** MODELO / CLASE ESTUDIANTE -> ATRIBUTOS Y FUNCIONES  */

class Estudiante extends Model
{
  use HasFactory;

  public $table = 'estudiantes';
  protected $fillable = [
    'nombre',
    'apellido',
    'foto',
    'id'
  ];

  public function cursos(){
    return $this->belongsToMany(Curso::class, 'curso_estudiante'); 
  }
}
