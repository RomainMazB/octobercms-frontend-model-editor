<?php namespace RomainMazB\FEModelEditor\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateRomainmazbFEMEModelEditorModels extends Migration
{
    public function up()
    {
        Schema::create('romainmazb_femodeleditor_models', static function ($table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('namespace');
            $table->string('model_name');
            $table->string('url_param')->default('id')->nullable();
            $table->string('link_text')->default('model');
            $table->json('pages_names');
            $table->json('displayed_actions');
        });
    }

    public function down()
    {
        Schema::dropIfExists('romainmazb_femodeleditor_models');
    }
}
