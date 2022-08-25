<?php

namespace ThePLAN\LaravelSagemaker;

use Aws\SageMakerRuntime\SageMakerRuntimeClient;
use ThePLAN\LaravelSagemaker\Exceptions\LaravelSagemakerException;

class LaravelSagemaker
{
    /**
     * Inference Endpoint Name
     */
    protected $endpoint;

    /**
     * Body
     */
    protected $body;

    /**
     * Asyncronous Request
     */
    protected $isAsync = false;

    /**
     * Content Type for request
     */
    protected $contentType = 'application/json';

    /**
     * Initialize the Sagemaker Client
     *
     * @param  \Aws\SageMakerRuntime\SageMakerRuntimeClient  $client
     * @return void
     */
    public function __construct(private SageMakerRuntimeClient $client)
    {
        //
    }

    /**
     * Start a SageMaker session
     *
     * @param  string  $endpoint
     * @return \ThePLAN\LaravelSagemaker\LaravelSagemaker
     */
    public function forEndpoint(string $endpoint): LaravelSagemaker
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * Add Message Body
     *
     * @return \ThePLAN\LaravelSagemaker\LaravelSagemaker
     */
    public function body(mixed $body): LaravelSagemaker
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Set Asyncronous
     *
     * @return \ThePLAN\LaravelSagemaker\LaravelSagemaker
     */
    public function async(): LaravelSagemaker
    {
        $this->isAsync = true;

        return $this;
    }

    /**
     * Set Content Type
     *
     * @param  string  $contentType
     * @return \ThePLAN\LaravelSagemaker\LaravelSagemaker
     */
    public function contentType(string $contentType): LaravelSagemaker
    {
        $this->contentType = $contentType;

        return $this;
    }

    /**
     * Invoke a Sagemaker Endpoint
     *
     * @return \Aws\Result|\Guzzlehttp\Promise\Promise
     */
    public function invoke()
    {
        throw_unless($this->body, new LaravelSagemakerException('Invocation Body is Required'));
        throw_unless($this->endpoint, new LaravelSagemakerException('Invocation Endpoint is Required'));

        $params = [
            'Body' => $this->body,
            'ContentType' => $this->contentType,
            'EndpointName' => $this->endpoint,
        ];

        return $this->isAsync ?
            $this->client->invokeEndpointAsync($params) :
            $this->client->invokeEndpoint($params);
    }
}
