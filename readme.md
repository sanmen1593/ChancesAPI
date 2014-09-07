## ChancesAPI

Ingresar a backend e instalar las librerías de Laravel, ejecutar:

    cd backend
    composer install
    php artisan migrate

Para ejecutar el servidor:

    php artisan serve

Ingesar a http://localhost:8000

Agregar al composer.json:

    "require-dev": {
    	"way/generators": "~3.0"
    }

Y luego ejecutar:

    composer update --dev

Y agregar en app/config/app.php en el provider array lo siguiente:

    'Way\Generators\GeneratorsServiceProvider'
    
Desarrolladores:
* Santiago Mendoza Ramirez. www.santiagomendoza.org
* Belkis Buelvas. www.facebook.com/BelkisBuelvasC
* Christian Duban. www.facebook.com/cdubanoliveros

Universidad Tecnológica de Bolívar.
