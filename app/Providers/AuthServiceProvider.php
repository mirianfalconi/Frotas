<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];


     public function boot(GateContract $gate)
     {
         parent::registerPolicies($gate);

         $gate->define('dp', function($funcionario, $cargos_funcionarios){

           return $cargos_funcionarios == 1;
         });

         $gate->define('ct', function($funcionario, $cargos_funcionarios){

           return $cargos_funcionarios == 2;
         });

         $gate->define('rota', function($funcionario, $cargos_funcionarios, $numero_nota){

            if($cargos_funcionarios == 2 && $numero_nota > 0){
                return true;
            }
           return false;
          });
     }
}
