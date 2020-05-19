<?php namespace RomainMazB\FEModelEditor\Models;

use Model;

/**
 * Model
 */
class FEMEModel extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'romainmazb_femodeleditor_models';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    /**
     * @var array Validation rules
     */
    public $jsonable = [
        'displayed_actions',
        'pages_names'
    ];
}
