<?php
/**
 * Created by PhpStorm.
 * User: msv
 * Date: 26.04.18
 * Time: 1:12
 */

namespace App\Controller;

//use Symfony\Component\HttpFoundation\Response;

//use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class LuckyController extends Controller
{
    public function number()
    {
        $number = mt_rand(0, 100);

        return $this->render(
            'lucky/number.html.twig', array(
                'number' => $number
        ));

        /*return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );*/
    }
}