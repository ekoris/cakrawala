<?php

namespace App\Repositories;

use App\Models\MailBox;

class MailBoxEloquent {

    public function fetch($params =[])
    {
        $query = MailBox::latest();

        if (isset($params['q'])) {
            $query->where('name','like','%'.$params['q'].'%');
        }

        return $query->paginate(15);
    }

    public function store($data)
    {
        return MailBox::create([
            'name' => $data['name'],
            'number' => $data['number'],
        ]);
    }
    
    public function find($id)
    {
        return MailBox::find($id);
    }

    public function update($id, $data)
    {
        return MailBox::where('id', $id)->update([
            'name' => $data['name'],
            'number' => $data['number']
        ]);
    }

    public function delete($id)
    {
        return MailBox::where('id', $id)->delete();
    }
}