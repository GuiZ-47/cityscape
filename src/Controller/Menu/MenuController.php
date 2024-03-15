<?php 

namespace App\Controller\Menu;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class MenuController extends AbstractController
{

    public function menu(CategoryRepository $category): Response
    {
        // dd($category->findBy(['parent'=>null]));

        return $this->render("_partials/_header_top.html.twig", 
        ['Categories'=>$category->findBy(['parent'=>null])]);

    }

}