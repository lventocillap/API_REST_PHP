<?php

declare(strict_types=1);

namespace Src\Repository;

use Src\Repository\SeatAvalaible;
use PDO;
use PDOException;
use Src\Database\Conexion;

class InsertDetailSale
{

    public function __construct(
        private SeatAvalaible $seatAvalaible
    ) {}

    public function insertDetailSale(int $sale_id, int $billboard_id, array $seats, float $price): void
    {
        $conexion = new Conexion();
        $PDO = $conexion->getConexion();

        $result = 1;

        foreach($seats as $seat){
            $result *= (int)$seat['state'];
        }
            $total = (bool)$result;
        if($total){
            foreach($seats as $seat){
                $stmt = $PDO->prepare('INSERT INTO detail_sale(sale_id, billboard_id, seat_id, price)
                VALUES(:sale_id,
                :billboard_id,
                :seat_id,
                :price)');

                $stmt->bindParam(':sale_id',$sale_id,PDO::PARAM_INT);
                $stmt->bindParam(':billboard_id',$billboard_id,PDO::PARAM_INT);
                $stmt->bindParam(':seat_id',$seat['id'],PDO::PARAM_INT);
                $stmt->bindParam(':price',$price,PDO::PARAM_STR);

                $stmt->execute();
                echo json_encode(['message'=>'movie create sucessfutty']);
            }
        }else{
            echo "error";
        }

    }
}
