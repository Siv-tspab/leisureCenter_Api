<?php

namespace App\Controller;

use App\Repository\LeisureCenterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class LeisureCenterController extends AbstractController
{
    public function __construct(private HttpClientInterface $client, private LeisureCenterRepository $leisureCenterRepository)
    {
    }

    public function __invoke()
    {
        $leisureCenters = $this->leisureCenterRepository->findAll();
        
        // Reach the current coord and weather for each center
        $centersData = [];
        foreach ($leisureCenters as $center) {
            $address = $center->getAddress();
            $coord = $this->getCoordinates($address);
            $weather = $this->getWeather($coord);
            $centerData['id'] = $center->getId();
            $centerData['coordinates'] = $coord;
            $centerData['weather'] = [
                "icon" => $weather->weather[0]->icon,
                "temp" => $weather->main->temp
            ];
            $centersData[] = $centerData;
        }
        
        return [$leisureCenters, $centersData];
    }


    /**
     * Ask map box api with an address to get the current coordinates of a location 
     * @param $address | string, Address of the location
     * @return $coordinates | array, Coordinates of the location 
     */
    private function getCoordinates(string $address): array
    {
        $apikey = "pk.eyJ1Ijoic2l2dnYiLCJhIjoiY2t0eGdoeDdyMGduczJ1cWhjaGVoZjZ2dCJ9.I1vrVy2ceNAfpCpzoBG8jQ";
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
        $apikey = "0e077eb2226c0ed601048dc512fe27f8";
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
