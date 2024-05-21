<?php

declare(strict_types=1);

namespace Vanier\Api\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AboutController extends BaseController
{
    public function handleAboutWebService(Request $request, Response $response, array $uri_args): Response
    {
        $data = array(
            'about' => 'Welcome! This is a Web service that provides JSON format data about cars, emissions, consumptions, deals, owners, insurances, users, violations, and violations_cars!',
            'resources' => [
                'Cars' => [
                    [
                        "method" => "GET",
                        "uri" => "/cars",
                        "filters" => [
                            'Car Name',
                            'Cylinders',
                            'Horsepower',
                            'Year',
                            'Engine Type',
                            'Car Make',
                            'Car Model',
                            'Is Fuel Economic'
                        ],
                        "description" => "Gets a list of zero or more cars resources that match the request's filtering criteria",
                    ],
    
                    [  
                        "method" => "GET",
                        "uri" => "/cars/{car_id}",
                        "filters" => '',
                        "description" => "Gets the details of the specified car", 
                    ],
    
                    [
                        "method" => "GET",
                        "uri" => "/cars/{car_id}/emissions",
                        "filters" => [
                            'CO2 Emission'
                        ],
                        "description" => "Gets the emissions data of the specified car",
                        
                    ],
    
                    [
                        "method" => "GET",
                        "uri" => "/cars/{car_id}/consumptions",
                        "filters" => [
                            'Engine Size',
                            'Fuel Consumption City',
                            'Fuel Consumption Highway',
                            'Fuel Consumption Combined'
                        ],
                        "description" => "Gets the consumptions data of the specified car",
                    ],
    
                    [
                        "method" => "GET",
                        "uri" => "/cars/{car_id}/deal",
                        "filters" => [
                            'Selling Price',
                            'Km Driven',
                            'Fuel Type',
                            'Transmission',
                            'Payment Type',
                            'Car Condition'
                        ],
                        "description" => "Gets the deal information of the specified car",
                    ],
    
                    [
                        "method" => "GET",
                        "uri" => "/cars/{car_id}/owner",
                        "filters" => [
                            'Owner Name',
                            'Owner Email',
                            'Postal Code',
                            'Country',
                            'City',
                            'Driver Age',
                            'Driver Gender'
                        ],
                        "description" => "Gets the owner information of the specified car",
                    ]
                ],
                'Consumptions' => [
                    [
                        "method" => "GET",
                        "uri" => "/consumptions",
                        "filters" => [
                            'Engine Size',
                            'Fuel Consumption City',
                            'Fuel Consumption Highway',
                            'Fuel Consumption Combined'
                        ],
                        "description" => "Gets a list of zero or more consumptions resources that match the request's filtering criteria",
                    ],
    
                    [  
                        "method" => "GET",
                        "uri" => "/consumptions/{consumption_id}",
                        "filters" => '',
                        "description" => "Gets the details of the specified consumption", 
                    ]
                ],
                'Deals' => [
                    [
                        "method" => "GET",
                        "uri" => "/deals",
                        "filters" => [
                            'Selling Price',
                            'Km Driven',
                            'Fuel Type',
                            'Transmission',
                            'Payment Type',
                            'Car Condition'
                        ],
                        "description" => "Gets a list of zero or more deals resources that match the request's filtering criteria",
                    ],
    
                    [  
                        "method" => "GET",
                        "uri" => "/deals/{deal_id}",
                        "filters" => '',
                        "description" => "Gets the details of the specified deal", 
                    ]
                ],
                'Emissions' => [
                    [
                        "method" => "GET",
                        "uri" => "/emissions",
                        "filters" => [
                            'Engine Size',
                            'Cylinder Number',
                            'Fuel Type',
                            'Vehicle Class',
                            'CO2 Emission'
                        ],
                        "description" => "Gets a list of zero or more emissions resources that match the request's filtering criteria",
                    ],
    
                    [  
                        "method" => "GET",
                        "uri" => "/emissions/{emission_id}",
                        "filters" => '',
                        "description" => "Gets the details of the specified emission", 
                    ]
                ],
                'Insurances' => [
                    [
                        "method" => "GET",
                        "uri" => "/insurances",
                        "filters" => [
                            'Insurance Name',
                            'Driving Experience',
                            'Vehicle Year',
                            'Vehicle Type',
                            'Annual Mileage',
                            'Price'
                        ],
                        "description" => "Gets a list of zero or more insurances resources that match the request's filtering criteria",
                    ],
    
                    [  
                        "method" => "GET",
                        "uri" => "/insurances/{insurance_id}",
                        "filters" => '',
                        "description" => "Gets the details of the specified insurance", 
                    ]
                ],
                'Owners' => [
                    [
                        "method" => "GET",
                        "uri" => "/owners",
                        "filters" => [
                            'Name',
                            'Email',
                            'Postal Code',
                            'Country',
                            'City',
                            'Driver Age',
                            'Driver Gender',
                            'Insurance ID'
                        ],
                        "description" => "Gets a list of zero or more owners resources that match the request's filtering criteria",
                    ],
                    [  
                        "method" => "GET",
                        "uri" => "/owners/{owner_id}",
                        "filters" => '',
                        "description" => "Gets the details of the specified owner", 
                    ]
                ],
                'Violations' => [
                    [
                        "method" => "GET",
                        "uri" => "/violations",
                        "filters" => [
                            'Location',
                            'Violation Type',
                            'Is Arrested',
                            'Violation Date',
                            'Violation Fee'
                        ],
                        "description" => "Gets a list of zero or more violations resources that match the request's filtering criteria",
                    ],
    
                    [  
                        "method" => "GET",
                        "uri" => "/violations/{violation_id}",
                        "filters" => '',
                        "description" => "Gets the details of the specified violation", 
                    ]
                ],
                'Violations Cars' => [
                    [
                        "method" => "GET",
                        "uri" => "/violations-cars",
                        "filters" => [
                            'Violation ID',
                            'Car ID'
                        ],
                        "description" => "Gets a list of zero or more violations cars resources that match the request's filtering criteria",
                    ],
    
                    [  
                        "method" => "GET",
                        "uri" => "/violations-cars/{violation_id}-{car_id}",
                        "filters" => '',
                        "description" => "Gets the details of the specified violation car", 
                    ]
                ], 
            ]
        );

        return $this->makeResponse($response, $data);
    }
}
