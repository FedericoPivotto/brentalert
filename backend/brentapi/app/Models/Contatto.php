<?php
/*
 * Copyright (C) 2021 ITIS "E. Fermi", Bassano del Grappa (VI) Italy
 * Please refer to the AUTHORS file for more information.
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 */
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contatto extends Model
{
	public $timestamps = false;
    
    protected $table = 'contatto';
    
    protected $primaryKey = 'contactID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'address', 'province', 'country', 
        'telephone', 'email', 'chatID', 'categoryID'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
    
    public function utenti()
    {
        return $this->belongsToMany('App\Models\User', 'avvisa', 'contactID', 'userID');
    }

    public function categoria()
    {
        return $this->belongsTo('App\Models\Categoria', 'categoria');
    }
}
