<?php

namespace AdobeMarketingCloud;

/**
 * Abstract class for Api classes
 *
 * @author    Brent Shaffer <bshafs at gmail dot com>
 * @license   MIT License
 */
abstract class Api implements ApiInterface
{
    /**
    * The core AdobeMarketingCloud Client
    * @var Client
    */
    protected
        $client,
        $options = array();

    public function __construct(Client $client, $options = array())
    {
        $this->client  = $client;
        $this->options = $options;
    }

    /**
     * Call any path, GET method
     * Ex: $api->get('artist/biographies', array('name' => 'More Hazards More Heroes'))
     *
     * @param   string  $path             the AdobeMarketingCloud path
     * @param   array   $parameters       GET parameters
     * @param   array   $requestOptions   reconfigure the request
     * @return  array                     data returned
     */
    protected function get($path, array $parameters = array(), $requestOptions = array())
    {
        return $this->client->get($path, $parameters, $requestOptions);
    }

    /**
     * Call any path, POST method
     * Ex: $api->post('catalog/create', array('type' => 'artist', 'name' => 'My Catalog'))
     *
     * @param   string  $path             the AdobeMarketingCloud path
     * @param   array   $parameters       POST parameters
     * @param   array   $requestOptions   reconfigure the request
     * @return  array                     data returned
     */
    protected function post($path, array $parameters = array(), $requestOptions = array())
    {
        return $this->client->post($path, $parameters, $requestOptions);
    }

     /**
     * Call any path, PUT method
     * Ex: $api->put('segments/54321abcdef', array('name' => 'Best Segment Ever'))
     *
     * @param   string  $path             the AdobeMarketingCloud path
     * @param   array   $parameters       PUT parameters
     * @param   array   $requestOptions   reconfigure the request
     * @return  array                     data returned
     */
    protected function put($path, array $parameters = array(), $requestOptions = array())
    {
        return $this->client->put($path, $parameters, $requestOptions);
    }

    /**
     * Call any path, DELETE method
     * Ex: $api->delete('calculatedMetrics/12345abcedf')
     *
     * @param   string  $path             the AdobeMarketingCloud path
     * @param   array   $parameters       POST parameters
     * @param   array   $requestOptions   reconfigure the request
     * @return  array                     data returned
     */
    protected function delete($path, array $parameters = array(), $requestOptions = array())
    {
        return $this->client->delete($path, $parameters, $requestOptions);
    }

    /**
    * Change an option value.
    *
    * @param string $name   The option name
    * @param mixed  $value  The value
    *
    * @return ApiAbstract the current object instance
    */
    public function setOption($name, $value)
    {
        $this->options[$name] = $value;

        return $this;
    }

    /**
    * Get an option value.
    *
    * @param  string $name The option name
    *
    * @return mixed  The option value
    */
    public function getOption($name, $default = null)
    {
        return isset($this->options[$name]) ? $this->options[$name] : $default;
    }

    /**
     * returns the most recent response for debugging purposes (see AdobeMarketingCloud\HttpClient::getLastResponse)
     */
    public function getLastResponse()
    {
        return $this->client->getLastResponse();
    }

    protected function returnResponse($response, $key = null)
    {
        if (!is_null($key) && isset($response[$key]) && !$this->getOption('raw')) {
            return $response[$key];
        }

        return $response;
    }
}
