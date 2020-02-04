# https://github.com/ddanielsouza/consulta-pessoa-fisica-clientes-dividas

Serviço desenvolvido no micro <a href="https://lumen.laravel.com/">framework Lumen</a> versão 6.0

### Proposta para o desenvolvimento deste projeto ###
Fazer um serviço com bastante perfomance para consumir dados bastantes sensiveis e os armazenarem com segurança

### Solução ###
A solução adotada para segurança do armazenamento foi a mesma do projeto "consulta-pessoa-fisica-clientes-dividas", para mais detalhes acesse <a href="https://github.com/ddanielsouza/consulta-pessoa-fisica-clientes-dividas">https://github.com/ddanielsouza/consulta-pessoa-fisica-clientes-dividas</a><br>.
Para melhorar a perfomance do serviço foi construido um middleware de controle de caches de respostas e <a href="https://laravel.com/docs/6.x/eloquent#observers">observers</a> para atualizar os caches 

#### Middleware
```PHP
    <?php

    namespace App\Http\Middleware;

    use Closure;

    class Caching
    {
        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \Closure  $next
         * @return mixed
         */
        public function handle($request, Closure $next)
        {

            if($request->isMethod('get') && env('ENABLE_CACHE_ROUTES', true)){
                $cacheKey = $request->getPathInfo();

                if(!\Cache::has($cacheKey)) {
                    $response =  $next($request);
                    \Cache::put($cacheKey, $response, 60 * 60 * 24);
                    return $response;
                }
                else {
                    return \Cache::get($cacheKey);
                }
            }
            else{
                return $next($request);
            }

        }
    }
```
#### Observers
```PHP
    <?php
    namespace App\Observers;
    use App\Models\MaterialAsset;
    class MaterialAssetObservers
    {
        public function cacheClear($id){
            $base = '/api/material-assets';
            \Cache::delete($base);
            \Cache::delete("$base/$id");
        }
        public function created(MaterialAsset $model)
        {
            \Cache::delete("/api/client-additional-infos/client/$model->client_id/score");
            $this->cacheClear($model->id);
        }
        public function updated(MaterialAsset $model)
        {
            \Cache::delete("/api/client-additional-infos/client/$model->client_id/score");
            $this->cacheClear($model->id);
        }

        // ...
    }
```
### Registrando Observers

```PHP
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\AddressObservers;
use App\Observers\ClientAdditionalInfoObservers;
use App\Observers\MaterialAssetObservers;
use App\Observers\SourceIncomeObservers;

use App\Models\Address;
use App\Models\ClientAdditionalInfo;
use App\Models\MaterialAsset;
use App\Models\SourceIncome;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function boot()
    {
        Address::observe(AddressObservers::class);
        ClientAdditionalInfo::observe(ClientAdditionalInfoObservers::class);
        MaterialAsset::observe(MaterialAssetObservers::class);
        SourceIncome::observe(SourceIncomeObservers::class);
    }
    //...
}

```
### Prova
Primeira requisição 
<img src="https://i.pinimg.com/originals/41/e1/b4/41e1b44c4ca5fce614bd2012aa0c034e.png"/>

Segunda requisição ja usando cache
<img src="https://i.pinimg.com/originals/8a/f8/d4/8af8d422996c7a93c2215d3df543e47d.png"/>

### Pré-Requisitos
* Docker (Aqui demonstrarei como executar o projeto apenas no docker)
* git

### OBS
Este tem dependencia do projeto consulta-pessoa-fisica-utils para maiores detalhes acesse <a href="https://github.com/ddanielsouza/consulta-pessoa-fisica-utils">https://github.com/ddanielsouza/consulta-pessoa-fisica-utils</a>

### Executando o projeto

1. Configurando o Banco
    * ```docker run -itd -p 5432:5432 -e POSTGRES_PASSWORD=123456 --name pgsql postgres```
    * Será nescessário a criação da database "consulta-pessoa-fisica-credito-pessoal" então  para facilitar, rode a imagem do SGBD pgadmin 4 <br>
     ``` docker run -itd -p 5050:80 -e PGADMIN_DEFAULT_EMAIL=exemplo@email.com -e PGADMIN_DEFAULT_PASSWORD=123456 --name pgsql postgres --link pgsql ```
    * A aplicação em php irá rodar as "migrations" então não se preocupe em rodar nenhum script sql, apenas crie a database com nome de "consulta-pessoa-fisica-credito-pessoal"
2. Instalando
    * ``` git@github.com:ddanielsouza/consulta-pessoa-fisica-credito-pessoal.git ```
    * ``` git submodule update --init --recursive ```
    * ``` docker build -t credito . ```
3. Rodando
    * ``` docker run -itd -p 8003:80 --link pgsql --link dividas --link auth credito ```
    
Após executar o banco será populados com alguns dados aleatorios, código: https://github.com/ddanielsouza/consulta-pessoa-fisica-credito-pessoal/blob/master/database/migrations/2020_02_02_015225_insert_payloads.php
    
### Arquitetura dos microsservicos
A arquitetura adotada para os microsserviços foi a de login unico (Single sign-on)
<img src="https://i.pinimg.com/originals/72/2d/dc/722ddc85dad8a4cdf783dbc23e660d33.png"/>

* AUTH: <a href="https://github.com/ddanielsouza/consulta-pessoa-fisica-auth">https://github.com/ddanielsouza/consulta-pessoa-fisica-auth</a> 
* consulta-pessoa-fisica-clientes-dividas: <a href="https://github.com/ddanielsouza/consulta-pessoa-fisica-clientes-dividas">https://github.com/ddanielsouza/consulta-pessoa-fisica-clientes-dividas</a> 
* consulta-pessoa-fisica-credito-pessoal: <a href="https://github.com/ddanielsouza/consulta-pessoa-fisica-credito-pessoal">https://github.com/ddanielsouza/consulta-pessoa-fisica-credito-pessoal</a> (<b>Este Projeto</b>)
* consulta-pessoa-fisica-eventos: <a href="https://github.com/ddanielsouza/consulta-pessoa-fisica-eventos">https://github.com/ddanielsouza/consulta-pessoa-fisica-eventos</a>
* consulta-pessoa-fisica-utils: <a href="https://github.com/ddanielsouza/consulta-pessoa-fisica-utils">https://github.com/ddanielsouza/consulta-pessoa-fisica-utils</a>
