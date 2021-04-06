<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[British Software Development](https://www.britishsoftware.co)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- [UserInsights](https://userinsights.com)
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)
- [Invoice Ninja](https://www.invoiceninja.com)
- [iMi digital](https://www.imi-digital.de/)
- [Earthlink](https://www.earthlink.ro/)
- [Steadfast Collective](https://steadfastcollective.com/)
- [We Are The Robots Inc.](https://watr.mx/)
- [Understand.io](https://www.understand.io/)
- [Abdel Elrafa](https://abdelelrafa.com)
- [Hyper Host](https://hyper.host)
- [Appoly](https://www.appoly.co.uk)
- [OP.GG](https://op.gg)

## Engepeças Geração de Api

Procedimento de Desenvolvimento API - Engepecas

C:\xampp\htdocs>git clone https://github.com/paulosergiobp69/api-integracao.git
 
C:\xampp\htdocs\api-integracao>composer install

--> copiar arquivo .env  para a pasta instalada

caso seja necessario reiniciar tabelas utilizar para carregar usuario:

C:\code\api-integracao>php artisan db:seed

1. C:\code\api-integracao>php artisan make:migration create_nome_tabel_table --create=tabela_desejada

						  php artisan make:migration create_fornecedor_table --create=fornecedor

ou
   C:\code\api-integracao>php artisan make:model MODELS\Fornecedor -m
   
	<trata informações migration>
	
	<gera migration>
	php artisan  migrate (todos)

	php artisan migrate --path="database/migrations/2020_11_04_111650_create_fornecedor_table.php"   (uma tabela)
	
   
2. C:\code\api-integracao>php artisan infyom:api Fornecedor --fromTable --tableName=fornecedor --primary=id 

3. MODEL:

        a) $fillable --> Remove created_at ... (campos que vao ser inseridos)
        b) $hidden --> campo que serão ocultados se precisar mostrar tem que retira deste parametro
		
		
		c) $cast --> deixa
        d) $rules ---> copia para usar no Create????APIRequest.php e UpdateApi
		
		
		
4:Altera HTTP -> Request -> API -> Create????APIRequest.php
		adiciona Rules e trata a informação.

5: Altera HTTP -> Request -> API -> Update????APIRequest.php
		adiciona Rules e trata a informação.

6: Controller:

	adiciona em todos as chamadas de metrodo da classe, ma posição indicada abaixo:
     *      path="/fornecedors",
     *      summary="Get a listing of the Fornecedors.",
--->     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"Fornecedor"},
     *      description="Get all Fornecedors",
     *      produces={"application/json"},
		 
	
## Final Engepecas



## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).





