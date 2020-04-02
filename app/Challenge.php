<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    protected $visible = ['token', 'numero_casas', 'cifrado', 'decifrado', 'resumo_criptografico'];
}
