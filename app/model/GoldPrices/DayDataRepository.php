<?php
namespace GoldInvestment\Model\GoldPrices;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;

class DayDataRepository
{
    /**
     * @return DayData[]
     * @throws \Exception
     */
    public function get(\DateTime $dayStart, \DateTime $dayEnd)
    {
        $url = "http://api.nbp.pl/api/cenyzlota/";
        $url .= $dayStart->format("Y-m-d") . "/" . $dayEnd->format("Y-m-d");
        $client = new Client();

        $params['connect_timeout'] = 4;
        $params['timeout'] = 20;

        try {
            $os = [];
            $response = $client->get($url, $params);
            $data = json_decode($response->getBody(), true);
            foreach ($data as $row) {
                $os[] = new DayData(new \DateTime($row["data"]), $row["cena"] * 100);
            }
            return $os;

        } catch (ConnectException $e) {
            throw new \Exception($e->getMessage()." - url: ".$url);
        } catch (RequestException $e) {
            $resp = $e->getResponse();
            if ($resp) {
                throw new \Exception("Get request failed (" . $resp->getStatusCode() . "): " . $url . "\nResponse: " . $resp->getBody());
            } else {
                throw new \Exception("Get request failed: " . $url);
            }
        }
    }

}
