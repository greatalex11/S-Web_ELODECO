<?php

namespace App\Service;



use App\Entity\Documents;
use App\Entity\User;
use App\Repository\DocumentsRepository;

//fonction pouvant être injectée dans les vues documents et projet pour filtrer la liste du repo
class searchFunction
{
    private ?array $resultSearch;
//(User $user, $id,
    public function __construct(?array $projetList, ?string $search)
    {
//        if ($user->getId() == $id) {
            dump($projetList);
        dump($search);
            $this->resultSearch =[1,2,3];
    }
//$projetList
    public function getResultSearch(? array $projetList,? string $search ): ?array
    {
        return $this->resultSearch;
    }
}



//                // loop in array of array + test itération/ valeur de $search
//                $resultList = [];
//                foreach ($projetList as $list){
//                    $resultList = array_filter($list, function ($v, $k) use ($search) {
//                        return $k == $search;
//                    });
//                }
//                dump($resultList);
//                //affactation du tableau filtré avec la valeur $search à $projetList
//                if ($resultList) {
//                    $projetList = $resultList;
//                }

