<?php


namespace App\Repository;


use App\Models\User;
use App\Repository\Contracts\IRepositoryCrud;

class UserRepository implements IRepositoryCrud
{
    public function paginate(int $itemsPerPage)
    {
         return User::paginate($itemsPerPage);
    }

    public function findById(int $id)
    {
        return User::find($id);
    }

    public function destroy(int $id)
    {
       return User::destroy($id);
    }

    public function update(string $id,array $data )
    {
        $user = User::find($id);
       if ($user->update($data)) return $user;
        abort(500);

    }

    public function store(array $data)
    {
       return  User::create($data);
    }
}
