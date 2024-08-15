<?php

declare(strict_types=1);

namespace Src\Repository;

use PDO;
use PDOException;
use Src\Database\Conexion;
use Src\Model\Seat;
class SeatAvalaible
{
    public function __construct()
    {}

    public function seatAvalaible($id): array
    {
        $conexion = new Conexion();
        $PDO = $conexion->getConexion();
        $stm = $PDO->prepare('select s.id, s.nro_seat, s.state from billboard b
        inner join hall h
        on b.hall_id = h.id
        inner join seat s 
        on s.hall_id = h.id
        where b.id = :id');
        $stm->bindParam(':id',$id, PDO::PARAM_INT);
        $stm->execute();
        foreach($stm as $fila){
            $seat = new Seat(
                $fila['id'],
                $fila['nro_seat'],
                $fila['state'] === 1 ? true : false
            );

            $seats[] = $seat->jsonSerializeSeat();
        }
        return $seats;
    }

    public function getSeat($id): Seat
    {
        $conexion = new Conexion();
        $PDO = $conexion->getConexion();
        $stm = $PDO->prepare('SELECT * FROM seat WHERE id = :id');
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
        $stm->execute();

        foreach($stm as $fila){
            $seat = new Seat(
                $fila['id'],
                $fila['nro_seat'],
                $fila['state'] === 1 ? true : false
            );
        }
        return $seat;

    }
}