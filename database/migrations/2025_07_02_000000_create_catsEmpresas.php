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
            $table->string('razonSocial', 200)->nullable();
            $table->string('logo', 200)->nullable();
            $table->json('adicionales')->nullable();
        });      
        Schema::create('divisions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('IdNegocio')->constrained('negocios')->onDelete('cascade');
            $table->string('division',50);
        });          
        Schema::create('divsCajas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('IdDivision')->nullable()->constrained('divisions')->onDelete('cascade');
            $table->string('caja',50);
        });         
        Schema::create('divsBodegas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('IdDivision')->nullable()->constrained('divisions')->onDelete('cascade');
            $table->string('bodega',50);
        });                      
        Schema::create('empresas', function (Blueprint $table) { //Cliente X, Proveedor X, Contratista X
            $table->id();
            $table->foreignId('IdNegocio')->nullable()->constrained('negocios')->onDelete('cascade');
            $table->enum('tipo', ['cliente', 'proveedor', 'ambos']);
            $table->string('empresa',200);
            $table->string('direccion',200)->nullable();
            $table->string('gmaps',250)->nullable();
            $table->string('telefono',100)->unique()->nullable();
            $table->string('email',100)->unique()->nullable();
            $table->json('adicionales')->nullable();
        });
        Schema::create('empresassucs', function (Blueprint $table) { //Las lomas, Madero 
            $table->id();
            $table->foreignId('IdEmpresa')->nullable()->constrained('empresas')->onDelete('cascade');
            $table->string('sucursal',100);
            $table->string('direccion',200)->nullable();
            $table->string('gmaps',250)->nullable();
            $table->json('adicionales')->nullable();
        });
        Schema::create('empresasContactos', function (Blueprint $table) { //Pedro gerente, Juan  de precios
            $table->id();
            $table->foreignId('IdEmpresa')->nullable()->constrained('empresas')->onDelete('set null');
            $table->string('contacto',100);
            $table->string('telefono',50)->unique();
            $table->json('adicionales')->nullable();
        });
        Schema::create('obras', function (Blueprint $table) { //Tulum, Estación Campeche
            $table->id();
            $table->foreignId('IdEmpresa')->nullabled()->constrained('empresas')->setNullOnDelete();
            $table->string('obra',200);
            $table->string('gmaps',250)->nullable();
            $table->json('adicionales')->nullable();
        });        
    }
 

    public function down()
    {
        Schema::dropIfExists('negocios');
        Schema::dropIfExists('divisions');
        Schema::dropIfExists('empresas');
        Schema::dropIfExists('empresassucs');
        Schema::dropIfExists('contactos');
        Schema::dropIfExists('obras');
    }
};
