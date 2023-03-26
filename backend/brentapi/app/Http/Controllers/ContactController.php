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
 
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\ResidenteAR;

class ContactController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('auth.ufficio', ['only' => 'addResident']);
    }

    /**
     * Prepare contacts
     */
    protected function prepareContacts($user, $categoryID)
    {
        // esecuzione query
        $contatti = $user->contatti->where('categoryID', $categoryID);
        
        foreach ($contatti as $contatto) {
            $structure[] = [
                'name' => $contatto->name, 
                'data' => [
                    'telephone' => $contatto->telephone, 
                    'chatID'    => $contatto->chatID
                ]
            ];
        }

        return $structure;
    }

    /**
     * Prepare residents
     */
    protected function prepareResidents()
    {
        // esecuzione query
        $residenti = ResidenteAR::all();
        
        foreach ($residenti as $residente) {
            $structure[] = [
                'name' => $residente->name, 
                'data' => [
                    'telephone' => $residente->telephone, 
                    'chatID'    => $residente->chatID
                ]
            ];
        }

        return $structure;
    }

    /**
     * Get structured contacts
     */
    public function getContacts()
    {
        // get user
        $user = Auth::user();

        // get function
        $function = $user->function;

        if ($function == "Sindaco") { // Protezione Civile, Ufficio Tecnico, Magazzino
            $structure[0] = [
                'sectionName' => 'Protezione Civile',
                'contacts'    => $this->prepareContacts($user, 2)
            ];
            $structure[1] = [
                'sectionName' => 'Ufficio Tecnico',
                'contacts'    => $this->prepareContacts($user, 3)
            ];
            $structure[2] = [
                'sectionName' => 'Magazzino',
                'contacts'    => $this->prepareContacts($user, 4)
            ];
        }
        else if ($function == "Protezione Civile") { // Sindaco Delegato, Bassano Emergenze
            $structure[0] = [
                'sectionName' => 'Sindaco Delegato',
                'contacts'    => $this->prepareContacts($user, 6)
            ];
            $structure[1] = [
                'sectionName' => 'Bassano Emergenze',
                'contacts'    => $this->prepareContacts($user, 5)
            ];
        }
        else if ($function == "Ufficio Tecnico") { // Reperibili, Funzionari, Residenti
            $structure[0] = [
                'sectionName' => 'Reperibili',
                'contacts'    => $this->prepareContacts($user, 7)
            ];
            $structure[1] = [
                'sectionName' => 'Funzionari',
                'contacts'    => $this->prepareContacts($user, 8)
            ];
            $structure[2] = [
                'sectionName' => 'Residenti',
                'contacts'    => $this->prepareResidents()
            ];
        }
        else if ($function == "Magazzino") { // Referente Magazzino
            $structure[0] = [
                'sectionName' => 'Referente Magazzino',
                'contacts'    => $this->prepareContacts($user, 9)
            ];
        }

        return response()->json(['sections' => $structure], 200);
    }

    public function addResident(Request $request)
    {
        $this->validate($request, [
            'name'      => 'string|max:50',
            'address'   => 'string|max:50',
            'province'  => 'string|max:2',
            'country'   => 'string|max:50', 
            'telephone' => 'string|max:15',
            'chatID'    => 'numeric|unique:residenteAR,chatID'
        ]);

        $residente = ResidenteAR::create($request->all());

        return response()->json(['residente' => $residente, 'message' => 'Created successfully'], 201);
    }
}
