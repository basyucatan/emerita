<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('negocios', function (Blueprint $table) {
            $table->id();
            $table->string('negocio', 200);
            $table->string('rfc', 20)->nullable();
            $table->string('direccion', 200)->nullable();
            $table->string('ciudad', 200)->nullable();
            $table->string('telefono', 50)->nullable();
            $table->string('logo', 200)->nullable();
            $table->text('cuenta')->nullable();
            $table->string('email', 100)->nullable();

            $table->double('margenUtilidad'); //30%
            $table->double('toleranciaClaro'); //3mm
            $table->double('mermaCorte'); //3mm
            $table->double('toleranciaAluminio'); //100mm
            $table->double('toleranciaPVC'); //100mm
            $table->double('sobrecostoVidrio'); //10%
            $table->double('costoMOmc'); //$500
            $table->double('costoMOmat'); //30%
        });
        Schema::create('unidads', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['pieza','longitud','area','peso','tiempo', 'otro']);
            $table->string('unidad', 50);
            $table->string('abreviatura', 10);
            $table->string('prueba')->nullable();
            $table->double('factorConversion')->default(1);
        });     
        Schema::create('monedas', function (Blueprint $table) {
            $table->id();
            $table->string('moneda', 20);
            $table->string('centavos', 20);
            $table->string('simbolo', 1);
            $table->string('abreviatura', 5);
            $table->double('tipoCambio');
        });      
        Schema::create('aperturas', function (Blueprint $table) {
            $table->id();
            $table->string('apertura', 20);
            $table->text('d');
            $table->string('emoji', 10)->nullable();
        });                       
        Schema::create('empresas', function (Blueprint $table) { //Cliente X, Proveedor X, Contratista X
            $table->id();
            $table->enum('tipo', ['cliente', 'proveedor', 'otro']);
            $table->string('nombre',200);
            $table->string('direccion',200)->nullable();
            $table->string('ubicacion',100)->nullable();
            $table->string('gmaps',250)->nullable();
            $table->string('telefono',100)->unique()->nullable();
            $table->string('email',100)->unique()->nullable();
        });
        Schema::create('empresassucs', function (Blueprint $table) { //Las lomas, Madero 
            $table->id();
            $table->foreignId('IdEmpresa')->nullable()->constrained('empresas')->onDelete('cascade');
            $table->string('sucursal',100);
            $table->string('direccion',200)->nullable();
            $table->string('ubicacion',100)->nullable();
            $table->string('gmaps',250)->nullable();
            $table->string('telefono',50)->unique()->nullable();
        });
        Schema::create('contactos', function (Blueprint $table) { //Pedro gerente, Juan  de precios
            $table->id();
            $table->foreignId('IdEmpresa')->nullable()->constrained('empresas')->onDelete('set null');
            $table->string('contacto',100);
            $table->string('telefono',50)->unique();
        });
        Schema::create('colorables', function (Blueprint $table) { //'Aluminio', 'PVC', 'Acero',
            $table->id();
            $table->string('colorable',30);
            $table->enum('tipo', ['Perfil', 'Vidrio', 'Herraje', 'Otro']);
        });         
        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('IdColorable')->constrained('colorables')->onDelete('cascade');
            $table->foreignId('IdColorHerraje')->nullable()->constrained('colors')->onDelete('set null');
            $table->string('color', 50);
            $table->string('colorHex', 7); 
            $table->string('colorRgba', 25);
        });
        Schema::create('vidrios', function (Blueprint $table) { //transparente 6mm, tintex 3mm
            $table->id();
            $table->string('vidrio',50);
            $table->float('grosor'); //en mm
        });    
        Schema::create('divisions', function (Blueprint $table) {
            $table->id();
            $table->string('division',30);
        });                            
        Schema::create('marcas', function (Blueprint $table) { //cuprum, aluplast, etc.
            $table->id();
            $table->string('marca',50);
            $table->foreignId('IdColorable')->nullable()->constrained('colorables')->onDelete('cascade');
            $table->string('foto',250)->nullable();
        });         
        Schema::create('lineas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('IdMarca')->constrained('marcas')->onDelete('cascade');
            $table->foreignId('IdDivision')->nullable()->constrained('divisions')->onDelete('set null');
            $table->foreignId('IdColorablePerfil')->nullable()->constrained('colorables')->onDelete('set null');
            $table->string('linea', 200)->default('nueva línea');
            $table->integer('orden')->unsigned()->default(10000);
        });      
        Schema::create('tipos', function (Blueprint $table) { //Hoja, Marco, Junquillo, refuerzo, etc.
            $table->id();
            $table->string('tipo',30);
            $table->tinyInteger('orden')->unsigned()->default(200);
        });         
        Schema::create('barras', function (Blueprint $table) {
            $table->id();
            $table->float('longitud');
            $table->string('descripcion',20)->nullable();
        });
        Schema::create('panels', function (Blueprint $table) {
            $table->id();
            $table->string('panel',30);
            $table->float('ancho');
            $table->float('alto');
        });        
        Schema::create('clases', function (Blueprint $table) { // perfiles, cristales, herrajes, accesorios etc.
            $table->id();
            $table->string('clase',50);
            $table->tinyInteger('orden')->unsigned()->default(250); 
        });          
        Schema::create('materials', function (Blueprint $table) { // chambrana, zoclo, cabezal, etc.
            $table->id();
            $table->foreignId('IdClase')->constrained('clases')->onDelete('cascade');
            $table->foreignId('IdLinea')->nullable()->constrained('Lineas')->onDelete('cascade');
            $table->foreignId('IdUnidad')->constrained('unidads')->onDelete('restrict');
            $table->tinyInteger('IdTipo')->nullable()->unsigned()->nullable(); //Hoja, Marco, Junquillo, alma, etc.            
            $table->string('referencia',30)->nullable()->unique();
            $table->string('material',250);
            $table->string('foto')->nullable()->default('101.jpg');
            $table->decimal('KgxMetro', 8, 4)->nullable();
            $table->decimal('rendimiento', 8, 4)->nullable();
            $table->foreignId('IdUnidadRend')->nullable()->constrained('unidads')->onDelete('set null');
            $table->json('adicionales')->nullable();
        });     
        Schema::create('materialscostos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('IdMaterial')->constrained('materials')->onDelete('cascade');
            $table->string('referencia',30)->nullable()->unique();
            $table->json('ubicacion')->nullable();
            $table->foreignId('IdMoneda')->constrained('monedas')->onDelete('cascade')->default(1);
            $table->foreignId('IdColor')->nullable()->constrained('colors')->onDelete('set null');
            $table->foreignId('IdVidrio')->nullable()->constrained('vidrios')->onDelete('set null');
            $table->foreignId('IdBarra')->nullable()->constrained('barras')->onDelete('set null');
            $table->foreignId('IdPanel')->nullable()->constrained('panels')->onDelete('set null');
            $table->enum('direccion', ['Izquierda','Derecha', 'otro'])->nullable();
            $table->double('costo')->nullable();
            $table->timestamps();
        });   
        Schema::create('tablaHerrajes', function (Blueprint $table) { //OXXO, ox, batiente
            $table->id();
            $table->foreignId('IdLinea')->constrained('lineas')->onDelete('cascade');
            $table->string('tablaHerraje',50);
            $table->string('fichaTecnica',250)->nullable();
            $table->enum('posicion', ['Horizontal', 'Vertical', 'Otro'])->nullable()->default('Vertical');
            $table->json('adicionales')->nullable();
        });   
        Schema::create('tablaHerrajesDets', function (Blueprint $table) { //perfiles, herrajes, etc.
            $table->id();
            $table->foreignId('IdTablaHerraje')->constrained('tablaHerrajes')->onDelete('cascade');
            $table->Integer('cantidad');
            $table->foreignId('IdMaterial')->constrained('materials')->onDelete('cascade');
            $table->double('rangoMenor')->nullable();
            $table->double('rangoMayor')->nullable();
            $table->double('factorExtra')->nullable();
            $table->json('adicionales')->nullable();
        }); 
        Schema::create('modelos', function (Blueprint $table) { //OXXO, ox, batiente
            $table->id();
            $table->foreignId('IdLinea')->constrained('lineas')->onDelete('cascade');
            $table->string('modelo',200)->default('nuevo Modelo');
            $table->string('foto',250)->nullable();
            $table->string('fichaTecnica',250)->nullable();
            $table->enum('estatus', ['revision', 'optimizado', 'publicado'])->default('revision');
            $table->json('jsonSvg')->nullable();
            $table->timestamps();
        });   

        Schema::create('modelosmats', function (Blueprint $table) { //perfiles, herrajes, etc.
            $table->id();
            $table->foreignId('IdModelo')->constrained('modelos')->onDelete('cascade');
            $table->boolean('principal')->default(false);
            $table->Integer('cantidad');
            $table->foreignId('IdMaterial')->nullable()->constrained('materials')->onDelete('restrict');
            $table->foreignId('IdTablaHerraje')->nullable()->constrained('tablaHerrajes')->onDelete('restrict');
            $table->Integer('cantidadHerraje')->nullable();
            $table->string('diferenciador')->nullable(); //a veces se usa de manera diferente
            $table->tinyInteger('IdTipo')->unsigned()->nullable(); //Hoja, Marco, Junquillo, alma, etc.
            $table->string('posicion',2)->nullable();
            $table->string('formula')->nullable();
            $table->boolean('errFormula')->nullable();
            $table->string('dimensiones')->nullable();
            $table->double('costo')->nullable();
            $table->string('tipCosto')->nullable();
            $table->json('adicionales')->nullable();
            $table->string('obs')->nullable();    
            $table->timestamps();        
        });              
        Schema::create('reglas', function (Blueprint $table) { //para vincular dos materiales
            $table->id();
            $table->foreignId('IdLinea')->nullable()->constrained('lineas')->onDelete('set null');
            $table->foreignId('IdMaterial')->constrained('materials')->onDelete('cascade');
            $table->foreignId('IdTipo')->nullable();
            $table->foreignId('IdMatRelacion')->constrained('materials')->onDelete('restrict');
            $table->enum('baseCalculo', ['unidad', 'longitud', 'area','perimetro'])->default('unidad');
            $table->enum('efectoCalculo', ['unidad', 'longitud', 'area'])->default('unidad');
            $table->tinyInteger('grosorVidrio')->nullable();
            $table->decimal('factor',8,4,true);
            $table->decimal('descuento',8,0)->nullable();
        });          
        Schema::create('pendientes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('IdUserEmite')->constrained('users')->onDelete('cascade');
            $table->foreignId('IdUserRecibe')->nullable()->constrained('users')->onDelete('cascade');
            $table->enum('urgencia', ['Ayer', 'Hoy', 'Semana', 'Mes', 'Otro'])->default('Semana');
            $table->string('titulo',100);
            $table->text('descripcion');
            $table->string('foto')->nullable();
            $table->string('documento')->nullable();
            $table->string('resultado')->nullable();
            $table->date('fechaEmision');
            $table->timestamp('fechaProg')->nullable();
            $table->timestamp('fechaCumple')->nullable();
            $table->smallInteger('reprogramas');
        });  
        Schema::create('laminas', function (Blueprint $table) {
            $table->id();
            $table->string('lamina');
            $table->string('codigo',30);
            $table->string('codigoCinta',30);
            $table->float('pesoML');
            $table->string('calibre',10);
            $table->float('dUtil');
        });
        Schema::create('guias', function (Blueprint $table) {
            $table->id();
            $table->string('guia');
            $table->bigInteger('IdMaterial')->nullable();
        });  
    }
 

    public function down()
    {
        Schema::dropIfExists('negocios');
        Schema::dropIfExists('unidads');
        Schema::dropIfExists('monedas');
        Schema::dropIfExists('aperturas');
        Schema::dropIfExists('colorables');
        Schema::dropIfExists('empresas');
        Schema::dropIfExists('empresassucs');
        Schema::dropIfExists('contactos');
        Schema::dropIfExists('colors');
        Schema::dropIfExists('vidrios');
        Schema::dropIfExists('marcas');
        Schema::dropIfExists('lineas');
        Schema::dropIfExists('tipos');
        Schema::dropIfExists('modelos');
        Schema::dropIfExists('modelosmats');
        Schema::dropIfExists('modelossvgs');
        Schema::dropIfExists('modelosSvgsPaths');
        Schema::dropIfExists('elementossvgs');
        Schema::dropIfExists('barras');
        Schema::dropIfExists('panels');
        Schema::dropIfExists('clases');
        Schema::dropIfExists('materials');
        Schema::dropIfExists('materialscostos');
        Schema::dropIfExists('matPrecios');
        Schema::dropIfExists('reglas');
        Schema::dropIfExists('pendientes');
        Schema::dropIfExists('laminas');
        Schema::dropIfExists('gias');
    }
};
