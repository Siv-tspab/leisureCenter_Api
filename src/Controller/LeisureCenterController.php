<?php

namespace App\Controller;

use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Paginator;
use App\Entity\LeisureCenter;
use App\Repository\LeisureCenterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class LeisureCenterController extends AbstractController
{
    public function __construct(private HttpClientInterface $client, private LeisureCenterRepository $leisureCenterRepository)
    {
    }

    public function __invoke(Request $request)
    {
        // Get the query paramerters about pagination
        $maxResults = $request->attributes->get('data')->getQuery()->getMaxResults();
        $page = $request->query->get('page', 1);
        $firstResult = ($page - 1) * $maxResults;
        
        // Getting data and sorting with pagination infos
        $leisureCenters = $this->leisureCenterRepository->findAll();
        $paginedResult = [];
        for ($i = $firstResult; ($i < $firstResult + $maxResults) && $i < count($leisureCenters); $i++) {
            if ($leisureCenters[$i]) {
                $paginedResult[] = $leisureCenters[$i];
            }
        }
        
        // Reach the current coord and weather for each center
        foreach ($paginedResult as $center) {
            $address = $center->getAddress();
            $coord = $this->getCoordinates($address);
            $weather = $this->getWeather($coord);
            $centerData['coordinates'] = $coord;
            $centerData['weather'] = [
                "icon" => $weather->weather[0]->icon,
                "temp" => $weather->main->temp
            ];
            $center->setAdditionnalInfos($centerData);
        }

        return $paginedResult;
    }


    /**
     * Ask map box api with an address to get the current coordinates of a location 
     * @param $address | string, Address of the location
     * @return $coordinates | array, Coordinates of the location 
     */
    private function getCoordinates(string $address): array
    {
        $apikey = $_SERVER["MB_API_KEY"];
        return $this->apiGet(
            'https://api.mapbox.com/geocoding/v5/mapbox.places/' . urlencode($address) . '.json?access_token=' . $apikey
        )->features[0]->geometry->coordinates;
    }


    /**
     * Ask open weather map api with coordinates to get the current weather of a location 
     * @param $coordinates | array, Coordinates of the location 
     * @return $weather | object, basic weather object of OWM
     */
    private function getWeather(array $coordinates): object
    {
        $apikey = $_SERVER["OWM_API_KEY"];
        return $this->apiGet(
            'https://api.openweathermap.org/data/2.5/weather?lat=' . $coordinates[1] . '&lon=' . $coordinates[0] . '&appid=' . $apikey
        );
    }


    /**
     * Perform api call and decode the result
     * @param $url | The complet url for the query
     * @return $reponse | any type, depending on the api called
     */
    private function apiGet(string $url)
    {
        $response = $this->client->request('GET', $url);
        return json_decode($response->getContent());
    }
}
