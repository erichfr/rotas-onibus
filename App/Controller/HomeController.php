<?php

namespace App\Controller;

use App\Repository\VehicleRepository;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\PhpRenderer;
use App\Repository\STPLRepository;

final class HomeController 
{
    /**
     * @var PhpRenderer
     */
    private $renderer;
    /**
     * @var VehicleRepository
     */
    private $vehicleRepository;
    /**
     * @var STPLRepository
     */
    private $sptlRepository;

    public function __construct(PhpRenderer $renderer, VehicleRepository $vehicleRepository, STPLRepository $sptlRepository)
    {
        $this->renderer = $renderer;
        $this->vehicleRepository = $vehicleRepository;
        $this->sptlRepository = $sptlRepository;
    }

    /**
     * Perform routing
     *
     * @param  ServerRequestInterface $request PSR7 Server Request
     * @return ResponseInterface
     *
     * @throws HttpNotFoundException
     */
    public function __invoke(Request $request, Response $response, array $args): Response 
    {
        if($request->getQueryParams()['format'] == 'json') {
            $response->getBody()->write(json_encode($this->vehicleRepository->getVehicles()));
            return $response->withHeader('Content-Type', 'application/json');
        }
        
        //Render a Template
        return $this->renderer->render($response, "home.php", $this->vehicleRepository->getVehicles());
    }

    public function add(Request $request, Response $response, array $args): Response
    {
        $response->getBody()->write(json_encode(array('message'=>'Relatório diário criado com sucesso!!')));

        $this->sptlRepository->batchInsert($this->vehicleRepository->getVehicles());
        return $response
                    ->withStatus(201)
                    ->withHeader('Content-Type', 'application/json');
    }
}