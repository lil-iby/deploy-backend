<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'email', 'mot_de_passe', 'role'];

    // Relation avec les contrats
    public function contrats()
    {
        return $this->hasMany(Contrat::class);
    }

    // Relation avec l'établissement (si gestionnaire)
    public function etablissement()
    {
        return $this->hasOne(Etablissement::class, 'gestionnaire_id');
    }
}
