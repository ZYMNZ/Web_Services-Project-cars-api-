<?php
namespace Vanier\Api\Helpers;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class WebServiceInvoker
{
    private array $client_options = [];

    public function __construct($options = []){
        $this->client_options = $options;

    }

    /**
     * @throws GuzzleException
     */
    public function carApi(string $resource_uri) : mixed{
        $client = new Client($this->client_options);
        $response = $client->get($resource_uri);

        if($response->getStatusCode() !== 200){
            return $this->returnError(
                $response->getStatusCode(),
                $response->getReasonPhrase(),
            );
        }
        $resource_data = $response->getBody()->getContents();
        if(empty($resource_data)){
            return $this->returnError(
                'Error',
                'Empty response received!',
            );
        }
        return json_decode($resource_data);

    }

    public function invokeAPI1(string $resource_uri): array
    {
        $data = $this->carApi($resource_uri);
        $parsed_cars = array();
        //THIS IS JUST A DEFAULT STRUCTURE (MIGHT BE CHANGED ACCORDING TO THE *API*)
        foreach($data->results as $key => $car){
            $parsed_cars[$key]["make"] = $car->make;
            $parsed_cars[$key]["model"] = $car->model;
            $parsed_cars[$key]["cylinders"] = $car->cylinders;
            $parsed_cars[$key]["drive"] = $car->drive;
            $parsed_cars[$key]["fueltype1"] = $car->fueltype1;
            $parsed_cars[$key]["trany"] = $car->trany;
            $parsed_cars[$key]["year"] = $car->year;

        }
        return $parsed_cars;
    }

    /**
     * @throws GuzzleException
     */
    public function invokeAPI2(string $resource_uri): array
    {
        $data = $this->carApi($resource_uri);
        $parsed_cars = array();
        //THIS IS JUST A DEFAULT STRUCTURE (MIGHT BE CHANGED ACCORDING TO THE *API*)
        foreach($data as $key => $car){
            $parsed_cars[$key]["make"] = $car->make;
            $parsed_cars[$key]["model"] = $car->model;
            $parsed_cars[$key]["year"] = $car->year;
            $parsed_cars[$key]["color"] = $car->color;
            $parsed_cars[$key]["mileage"] = $car->mileage;
            $parsed_cars[$key]["price"] = $car->price;
            $parsed_cars[$key]["transmission"] = $car->transmission;
            $parsed_cars[$key]["engine"] = $car->engine;
            $parsed_cars[$key]["features"] = $car->features;
        }
        return $parsed_cars;
    }
    private function  returnError($code, $message):array{
        return array(
            "code"=> $code,
            "message"=> $message,
        );
    }
}