<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class LinkUtil extends Model
{
    protected $table 		= 'links_uteis';
    protected $primaryKey 	= 'link_id';

	protected $fillable = [
        'link_id', 'link', 'destino', 'descricao'
    ];

}
