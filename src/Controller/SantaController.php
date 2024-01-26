<?php

namespace App\Controller;

use Exception;
use App\Service\Interface\ServiceInterface;
use App\Service\PersonService;
use App\Utils\Logic\SecretSantaLogic;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SantaController extends AbstractController
{

    private ServiceInterface $service;
    private SecretSantaLogic $logic;

    public function __construct(PersonService $service, SecretSantaLogic $logic)
    {
        $this->service = $service;
        $this->logic = $logic;
    }

    #[Route('/runSanta/', name: 'app_santa')]
    public function index(Request $request): JsonResponse
    {
        try{
            $data = $request->get("data");
            if(empty($data)) throw new Exception("Empty data passed in");
            
            $this->service->saveAll($data);
            $repo = $this->service->getRepository();

            $this->logic->execute($repo);

            $response = ["status" => "ok"];
        }catch(\Exception $e){
            $response = [
                "status" => "error",
                "message" => $e->getMessage(),
            ];
        }
       
        return $this->json($response);
    }
}
