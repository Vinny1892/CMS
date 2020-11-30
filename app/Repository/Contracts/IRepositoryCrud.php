<?php


namespace App\Repository\Contracts;


interface IRepositoryCrud
{
    public function paginate(int $itemsPerPage);
    public function findById(int $id);
    public function destroy(int $id);
    public function update(string $id , array $data);
    public function store(array $data);

}
