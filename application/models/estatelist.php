<?php

/**
 * Created by PhpStorm.
 * User: p1027
 * Date: 22.06.2016
 * Time: 16:06
 */
class EstateList extends ListResponse
{
    /** @var Estate[] $items  */
    public $items = array();
    /** @var  Token $token */
    protected $token;
    protected $parameters;

    public function __construct($token, $parameters)
    {
        parent::__construct(Emlakurl::EstateList);
        $this->token = $token;
        $this->parameters = $parameters;
        $response = $this->makeRequest();
        $this->checkResponse($response);
        $this->setItems($response);
        for($i = 2; $i <= $this->TotalPageCount; $i++) {
            $this->parameters['PageIndex'] = $i;
            $response = $this->makeRequest();
            $this->setItems($response);
        }
    }

    public function setItems($response)
    {

        // TODO: Implement setItems($response) method.
        $newItems = array();
        foreach($response->Items as $item) {
            $newItems[] = new Estate($item);
        }
        $this->items = array_merge($this->items, $newItems);
    }
}